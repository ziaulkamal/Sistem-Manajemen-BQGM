<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Internal_model', 'm');
        $this->load->model('Transaction_model', 'u');
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        
    }


    function users()
    {
        $load = $this->m->getAllUsers()->result();
        $data = array(
            'title'     => 'Data User', 
            'page'      => 'pages/manager/user/index',
            'data'      => $load,
        );

        $this->load->view ('index', $data);
    }

    function users_add()
    {
        $data = array(
            'title'     => 'Tambah User', 
            'page'      => 'pages/manager/user/add',
            'action'    => 'user/add/process'
        );

        $this->load->view ('index', $data);
    }

    function save_users()
    {
        $this->_rules('users');
        $config = array(
            'allowed_types' => 'jpg|png|jpeg|webp',
            'max_size'      => 6000,
            'overwrite'     => TRUE,
            'upload_path'   => './public/assets/images/users/',
            'encrypt_name'  => TRUE,
          );
        $this->load->library('upload', $config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->users_add();
        } else {
            $data = array(
                'namaLengkap'   => strtolower($this->input->post('nama')), 
                'username'      => strtolower($this->input->post('username')), 
                'password'      => md5($this->input->post('password')), 
                'levelAkses'    => $this->input->post('level'), 

            );


            if (!empty($_FILES['img']['name'])) {
                
                if (!$this->upload->do_upload('img')) {
                    echo $this->upload->display_errors();
                }else {
                    $file = $this->upload->data();
                    $data['gambarProfil'] = $file['file_name'];
                    
                }
            }

            $this->m->insertUsers($data);
            $this->session->set_flashdata('msg', 'User dengan nama ' . $data['namaLengkap']. ' sudah ditambahkan !');
            
            redirect('user','refresh');
            
            
        }
    }

    function edit_users($username)
    {
        $load = $this->m->getByUsername($username);
        $data = array(
            'title'     => 'Edit User', 
            'page'      => 'pages/manager/user/add',
            'action'    => 'user/update/process/'. $username,
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function update_users($username)
    {
        $this->_rules('users_edit');
        $config = array(
            'allowed_types' => 'jpg|png|jpeg|webp',
            'max_size'      => 6000,
            'overwrite'     => TRUE,
            'upload_path'   => './public/assets/images/users/',
            'encrypt_name'  => TRUE,
          );
        $this->load->library('upload', $config);

        
        if ($this->form_validation->run() == FALSE) {
            $this->edit_users($username);
        } else {
                      
            $data = array(
                'namaLengkap'   => strtolower($this->input->post('nama')), 
                'username'      => strtolower($this->input->post('username')), 
                'levelAkses'    => $this->input->post('level'), 
            );
            
            if ($this->input->post('password') != '') {
                $data['password'] = md5($this->input->post('password'));
            }


            if (!empty($_FILES['img']['name'])) {
                
                if (!$this->upload->do_upload('img')) {
                    echo $this->upload->display_errors();
                }else {
                    $file = $this->upload->data();
                    $data['gambarProfil'] = $file['file_name'];
                    
                }
            }
            

            $this->m->updateUsers($username,$data);
            $this->session->set_flashdata('msg', 'User dengan nama ' . $data['namaLengkap']. ' sudah diperbaharui !');
            
            redirect('user','refresh');
            
            
        }
    }

    function delete_users($id)
    {
        $load = $this->m->getById($id);
        $path = './public/assets/images/users/';

        if ($this->session->userdata('user') == $load->username) {
            $this->session->set_flashdata('err', 'User dengan nama '. ucwords($load->namaLengkap) .' gagal dihapus karena anda sedang login !' );
            redirect('user','refresh');
        }else {
            if ($load->gambarProfil != NULL) {
            $file = $path.$load->gambarProfil;
            if (file_exists($file) && is_file($file)) {
                unlink($file);
                }
            }
            $this->m->removeUsers($id);
            $this->session->set_flashdata('msg', 'User dengan nama '. ucwords($load->namaLengkap) .' telah di hapus !' );
            redirect('user','refresh');
        }
       
        
        
    }


    function logAllUnit($unit)
    {
        
        switch ($unit) {
            case 'pembiayaan':
                $load = $this->m->getLogPembiayaan()->result();
                $data['title'] = 'Log Pembiayaan Sawah';
                $data['unit']  = $unit;
                break;
            
            case 'operasional':
                $load = $this->m->getLogTrx('operasional')->result();
                $data['title'] = 'Log Transaksi Operasional';
                $data['unit']  = $unit;
                break;
            
            case 'teller':
                $load = $this->m->getLogTrx('teller')->result();
                $data['title'] = 'Log Transaksi Teller';
                $data['unit']  = $unit;
                break;
        }
        $data['data'] = $load;
        $data['page'] = 'pages/manager/log/trx_all_unit';

        $this->load->view ('index', $data);
    }

    function pendingApproval($unit)
    {
        if ($unit == 'pembiayaan') {
            $load = $this->m->checkPendingPinjamanAll()->result();
 
            $data = array(
                'title'     => 'Permintaan Pembiyaan Sawah', 
                'page'      => 'pages/manager/approval/approval_pembiayaan',
                'data'      => $load
            );
        }elseif ($unit == 'operasional') {
            $load = $this->m->getPendingOperasional()->result();
            $data = array(
                'title'     => 'Permintaan Transaksi Operasional', 
                'page'      => 'pages/manager/approval/approval_operasional',
                'data'      => $load
            );
        }else {
            echo 'Parameter Tidak Dikenal';
        }

        $this->load->view ('index', $data);
    }

    function processApproval($id, $unit)
    {
        $kas = $this->m->getKas();
        switch ($unit) {
            case 'pembiayaan':
                $load = $this->m->getDataPinjamanBySerial($id)->row();

                if ($load->plafon > $kas) {
                    $this->session->set_flashdata('err', 'Uang kas tidak mencukupi. Uang kas saat ini Rp. '. number_format($kas));
                    redirect('pembiayaan/required/approval','refresh');
                }else {
                    $data1 = array(
                        'type'              => 'pembiayaan', 
                        'serialNumber'      => 'PCAIR'.date('hisYm').substr(time(),0,5), 
                        'nilaiTransaksi'    => $load->plafon, 
                        'is_pinjaman'       => 1, 
                        'is_anggota'        => $load->anggota_id, 
                        'keterangan'        => '[ DISETUJUI ] Pencairan Anggota ' . ucwords($load->namaAnggota) . ' sebesar Rp. ' . number_format($load->plafon).' dengan Kode Serial ' . $id, 
                        'kodeRelasi'        => $this->session->userdata('level_akses'), 
                        'lastUpdate_t'        => date('Y-m-d'), 
                    );

                    $data2 = array(
                        'approvalManajer'   => 1, 
                        'lastUpdate_p'      => date('Y-m-d'), 
                    );
                
                    $data3['statusPinjaman'] = 1;

                    $trxDatas['nilai'] = $kas - $load->plafon;
                    $this->m->updateRekeningByNorek($load->id_rekening);
                    $this->u->updateKas($trxDatas);
                    $this->u->approvePencairan($id, $data1, $data2, $data3);
                    $this->session->set_flashdata('msg', 'Anggota dengan nama '. ucwords($load->namaAnggota) . ' sudah di setujui untuk pencairan !');
                    redirect('pembiayaan/required/approval','refresh');
                }
                break;
            
                case 'operasional':
                    $load = $this->m->getSerialNumber($id);

                    $data = array(
                        'kodeRelasi' => 'operasional', 
                        'keterangan' => '[ DISETUJUI ]'.$load->keterangan, 
                        'lastUpdate_t' => date('Y-m-d'), 
                    );

                    if ($load->type == 'belanja') {
                       $trxDatas['nilai'] = $kas - $load->nilaiTransaksi;
                        $this->u->updateKas($trxDatas);
                        $this->u->approveOperasional($id, $data);
                        $this->session->set_flashdata('msg', 'Nilai kas telah disesuaikan');
                    redirect('operasional/required/approval','refresh');
                    }elseif ($load->type == 'keluar') {
                        $trxDatas['nilai'] = $kas - $load->nilaiTransaksi;
                        $this->u->updateKas($trxDatas);
                        $this->u->approveOperasional($id, $data);
                        $this->session->set_flashdata('msg', 'Nilai kas telah disesuaikan');
                    redirect('operasional/required/approval','refresh');
                    }elseif ($load->type == 'masuk') {
                        $trxDatas['nilai'] = $kas + $load->nilaiTransaksi;
                        $this->u->updateKas($trxDatas);
                        $this->u->approveOperasional($id, $data);
                        $this->session->set_flashdata('msg', 'Nilai kas telah disesuaikan');
                    redirect('operasional/required/approval','refresh');
                    }else {
                        echo "Parameter tidak dikenal !";
                    }
                    break;
        }

    }

    function removeSerial($id)
    {
        $this->m->removeSerialNumber($id);
        $this->session->set_flashdata('msg', 'Permintaan operasional ini telah ditolak');
        redirect('operasional/required/approval','refresh');
        
        
    }

    function log_pembiayaan_sawah()
    {
        $data = array(
            'title'     => 'Log Pembiayaan Sawah', 
            'page'      => 'pages/manager/log/pembiayaan-sawah'
        );

        $this->load->view ('index', $data);
    }
    


    function _rules($rules)
    {
        switch ($rules) {
            case 'users':
                $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]|max_length[25]|is_unique[administrator.namaLengkap]',
                array(
                    'required' => '%s tidak boleh kosong',
                    'min_length' => '%s terlalu pendek',
                    'max_length' => '%s terlalu panjang',
                    'is_unique' => '%s sudah pernah ada'
                ));

                $this->form_validation->set_rules('username', 'User Masuk', 'trim|required|min_length[5]|max_length[25]|is_unique[administrator.username]',
                array(
                    'required' => '%s tidak boleh kosong',
                    'min_length' => '%s terlalu pendek',
                    'max_length' => '%s terlalu panjang',
                    'is_unique' => '%s sudah pernah ada'
                ));

                $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[25]',
                array(
                
                    'min_length' => '%s terlalu pendek',
                    'max_length' => '%s terlalu panjang',
                    
                ));

                $this->form_validation->set_rules('level', 'Level Akses', 'trim|required',
                array(
                    'required' => '%s harus dipilih',                   
                ));
                
                break;

            case 'users_edit':
                $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]|max_length[25]',
                array(
                    'required' => '%s tidak boleh kosong',
                    'min_length' => '%s terlalu pendek',
                    'max_length' => '%s terlalu panjang',
                ));

                $this->form_validation->set_rules('username', 'User Masuk', 'trim|required|min_length[5]|max_length[25]',
                array(
                    'required' => '%s tidak boleh kosong',
                    'min_length' => '%s terlalu pendek',
                    'max_length' => '%s terlalu panjang',
                ));

                $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[25]',
                array(
                
                    'min_length' => '%s terlalu pendek',
                    'max_length' => '%s terlalu panjang',
                    
                ));

                $this->form_validation->set_rules('level', 'Level Akses', 'trim|required',
                array(
                    'required' => '%s harus dipilih',                   
                ));
                
                break;
            
            default:
                # code...
                break;
        }
    }
    
}

/* End of file Main.php and path /application/controllers/Manager/Main.php */
