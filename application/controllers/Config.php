<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Config_model', 'msconfig');
        
        
        // if ($this->session->userdata('level_akses') != 'manajer') {
            
        //     redirect('/','refresh');
            
        // }else if ($this->session->userdata('status_login') != TRUE) {
            
        //     redirect('login','refresh');
            
        // }
    }

    function custom_css()
    {
        $this->load->view('custom-css');
    }

    function custom_css_2()
    {
        $this->load->view('custom-css-2');
    }

    public function css_2_compiler()
    {
        $this->load->view('compiler_css_2');
        
    }

    function updateProfil($id)
    {
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        $real_id = $this->session->userdata('id');

        if ($id == $real_id) {
            $load = $this->msconfig->getProfilById($id);
            $data = array(
                'title'     => 'Edit Profile', 
                'page'      => 'pages/edit_profil',
                'action'    => 'update_profile/process/'. $real_id,
                'data'      => $load,
            );

            $this->load->view('index', $data);
        }else {
            redirect('404','refresh');   
        }
    }

    function processUpdateProfil($id)
    {
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        $config = array(
            'allowed_types' => 'jpg|png|jpeg|webp',
            'max_size'      => 10000,
            'overwrite'     => TRUE,
            'upload_path'   => './public/assets/images/users/',
            'encrypt_name'  => TRUE,
        );
        $this->load->library('upload', $config);

       $data = array(
           'namaLengkap'        => $this->input->post('nama'), 
           'username'           => $this->input->post('username'), 
           'lastLogin'          => date('Y-m-d'), 
        );

        if (!empty($_FILES['img']['name'])) {
            
            if (!$this->upload->do_upload('img')) {
                echo $this->upload->display_errors();
            }else {
                $file = $this->upload->data();
                $data['gambarProfil'] = $file['file_name'];
            }
        }

        if (!$this->input->post('password') == '') {
            $data['password'] = md5($this->input->post('password'));
        }

        $this->msconfig->updateProfilById($id, $data);
        $this->session->set_flashdata('msg', 'Data berhasil diperbaharui !');
        redirect('update_profile/'.$id,'refresh');
        
    }


    function setup_master()
    {
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        $load = $this->msconfig->get_master()->result();
        $data = array(
            'title' => 'Konfigurasi Aplikasi', 
            'page'  => 'pages/konfigurasi',
            'data'  => $load 
        );

        $this->load->view('index', $data);
        
    }

    function save_master()
    {
        $this->_rules('setup_master');
        if ($this->form_validation->run() == FALSE) {
           
           $this->setup_master();
           
        } else {
            $data = array(
                'nama'          => strtolower($this->input->post('type', TRUE)), 
                'deskripsi'     => strtolower($this->input->post('deskripsi', TRUE)), 
                'lastUpdate'    => date('Y-m-d'), 
            );

            $this->msconfig->save_master($data);
            $this->session->set_flashdata('msg', 'berhasil menambahkan '. $data['nama'] . ' kedalam sistem !');
            
            redirect('konfigurasi','refresh');
            
        }
        
    }

    function edit_master($id)
    {
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        $load        = $this->msconfig->get_master()->result();
        $load_single = $this->msconfig->select_single_master($id);
        $data = array(
            'title' => 'Edit Konfigurasi Aplikasi', 
            'page'  => 'pages/konfigurasi',
            'data'  => $load,
            'form'  => $load_single
        );

        $this->load->view('index', $data);
    }

    function update_master($id)
    {
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        $this->_rules('setup_master');
        if ($this->form_validation->run() == FALSE) {
           
           $this->edit_master($id);
           
        } else {
            $data = array(
                'nama'          => strtolower($this->input->post('type', TRUE)), 
                'deskripsi'     => strtolower($this->input->post('deskripsi', TRUE)), 
                'lastUpdate'    => date('Y-m-d'), 
            );

            $this->msconfig->update_master($id, $data);
            $this->session->set_flashdata('msg', 'berhasil update '. $data['nama'] . ' kedalam sistem !');
            
            redirect('konfigurasi','refresh');
            
        }
    }

    function delete_master($id)
    {
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
       $this->msconfig->delete_master($id);
       $this->session->set_flashdata('msg', 'berhasil menghapus data !');
       redirect('konfigurasi');
    }

    function _404()
    {
        echo "<script>alert('Aksi Tidak Dikenal');</script>";
        redirect('/','refresh');
        
    }


    function _rules($typeOfRule)
    {
        switch ($typeOfRule) {
            case 'setup_master':
                $this->form_validation->set_rules('type', 'Nama', 'trim|required|max_length[12]|is_unique[bq_master.nama]',array(
                    'required'      => '%s harus di isi !',
                    'max_length'    => 'panjang karakter %s maksimum 12 huruf !',
                    'is_unique'     => '%s ini sudah pernah ada sebelumnya !',
                ));
                # code...
                break;
            
            default:
                # code...
                break;
        }
        
    }
}

/* End of file Config.php and path /application/controllers/Config.php */
