<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Internal_model', 'm');
        $this->load->model('Transaction_model', 'u');
        
    }

    public function index()
    {

    }

    function unique_num()
    {
        $y = date('Y');
        $time = time();
        $algorithm = $y.substr($time, -7);
        return $algorithm;
    }

    function data_anggota()
    {
        $load = $this->m->getAnggotas(1)->result(); // Anggota dengan status Aktif

        $data = array(
            'title'     => 'Data Anggota', 
            'page'      => 'pages/operasional/anggota/index',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function add_anggota()
    {
        $data = array(
            'title'     => 'Tambah Anggota Baru', 
            'page'      => 'pages/operasional/anggota/add',
            'action'    => 'anggota/add/process'
        );

        $this->load->view ('index', $data);
    }

    function save_anggota()
    {
        $this->_rules('add_anggota');
        
        if ($this->form_validation->run() == FALSE) {
            $this->add_anggota();
        } else {
            
            $path = './public/img_ktp/';
            $config = array(
                'allowed_types' => 'jpg|png|jpeg|webp',
                'max_size'      => 6000,
                'overwrite'     => TRUE,
                'upload_path'   => $path,
                'encrypt_name'  => TRUE,
            );

            // mkdir($path, 0777, true);
            $this->load->library('upload', $config);

            $newID = 'GM-'.$this->unique_num();
            $data1 = array(
                'id_anggota'         => $newID,
                'namaAnggota'        => strtolower($this->input->post('nama')),
                'nik'                => $this->input->post('nik'),
                'masaKtp'            => strtolower($this->input->post('masa_ktp')),
                'tempatLahir'        => strtolower($this->input->post('tp_lahir')),
                'tanggalLahir'       => $this->input->post('tg_lahir'),
                'no_hp'              => $this->input->post('no_hp'),
                'alamatKtp'          => strtolower($this->input->post('alamat_ktp')),
                'alamatSekarang'     => strtolower($this->input->post('alamat_sekarang')),
                'jenisKelamin'       => $this->input->post('jk'),
                'statusKawin'        => $this->input->post('status_kawin'),
                'pekerjaan'          => strtolower($this->input->post('pekerjaan')),
                'statusAnggota'      => $this->input->post('status_anggota'),
                'lastUpdate'         => date('Y-m-d'),
            );

            $data2 = array(
                'anggota_id'        => $newID,
                'jumlahTanggungan'  => $this->input->post('tanggungan'),
                'penghasilan'       => $this->input->post('penghasilan'),
                'namaPasangan'      => strtolower($this->input->post('nama_pasangan')),
                'nikPasangan'       => $this->input->post('nik_pasangan'),
                'tlPasangan'        => strtolower($this->input->post('tl_lahir_pasangan')),
                'tglPasangan'       => $this->input->post('tg_lahir_pasangan'),
                'noHpPasangan'      => $this->input->post('no_hp_lain'),
                'namaIbu'           => strtolower($this->input->post('nama_ibu')),
                'tanggalDaftar'     => date('Y-m-d'),  
            );

            if (empty($_FILES['fotoKtpAnggota']['name'])) {
                $this->session->set_flashdata('err', 'Foto KTP anggota *WAJIB* diupload !');
                $this->add_anggota();
            }else {
                if ($this->upload->do_upload('fotoKtpAnggota')) {
                   $file = $this->upload->data();
                   $data2['imgKtp_anggota'] = $file['file_name'];  
                }

                if (!empty($_FILES['fotoKtpPasangan']['name'])) {
                    if ($this->upload->do_upload('fotoKtpPasangan')) {
                        $file = $this->upload->data();
                        $data2['imgKtp_pasangan'] = $file['file_name'];  
                    }
                }

                $this->m->insertAnggotas($data1,$data2);
                $this->session->set_flashdata('msg', 'menambahkan anggota baru dengan nomor ke-anggotaan <b>' . $data1['id_anggota']. '</b> dan nama anggota ' . $data1['namaAnggota']);
                
                redirect('anggota','refresh');
            }
        }
        
    }

    function edit_anggota($id)
    {
        $load = $this->m->getAnggotaById($id);
        $data = array(
            'title'     => 'Tambah Anggota Baru', 
            'page'      => 'pages/operasional/anggota/add',
            'action'    => 'anggota/update/process/'.$id,
            'form'      => $load
        );

        $this->load->view ('index', $data);
    }

    function update_anggota($id)
    {
        $this->_rules('edit_anggota');
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit_anggota($id);
        } else {
            $path = './public/img_ktp/';
            $config = array(
                'allowed_types' => 'jpg|png|jpeg|webp',
                'max_size'      => 6000,
                'overwrite'     => TRUE,
                'upload_path'   => $path,
                'encrypt_name'  => TRUE,
            );

            // mkdir($path, 0777, true);
            $this->load->library('upload', $config);

            $data1 = array(
                'namaAnggota'        => strtolower($this->input->post('nama')),
                'nik'                => $this->input->post('nik'),
                'masaKtp'            => strtolower($this->input->post('masa_ktp')),
                'tempatLahir'        => strtolower($this->input->post('tp_lahir')),
                'tanggalLahir'       => $this->input->post('tg_lahir'),
                'no_hp'              => $this->input->post('no_hp'),
                'alamatKtp'          => strtolower($this->input->post('alamat_ktp')),
                'alamatSekarang'     => strtolower($this->input->post('alamat_sekarang')),
                'jenisKelamin'       => $this->input->post('jk'),
                'statusKawin'        => $this->input->post('status_kawin'),
                'pekerjaan'          => strtolower($this->input->post('pekerjaan')),
                'statusAnggota'      => $this->input->post('status_anggota'),
                'lastUpdate'         => date('Y-m-d'),
            );

            $data2 = array(
                'jumlahTanggungan'  => $this->input->post('tanggungan'),
                'penghasilan'       => $this->input->post('penghasilan'),
                'namaPasangan'      => strtolower($this->input->post('nama_pasangan')),
                'nikPasangan'       => $this->input->post('nik_pasangan'),
                'tlPasangan'        => strtolower($this->input->post('tl_lahir_pasangan')),
                'tglPasangan'       => $this->input->post('tg_lahir_pasangan'),
                'noHpPasangan'      => $this->input->post('no_hp_lain'),
                'namaIbu'           => strtolower($this->input->post('nama_ibu'))
            );

            if (!empty($_FILES['fotoKtpPasangan']['name'])) {
                if ($this->upload->do_upload('fotoKtpAnggota')) {
                    $file = $this->upload->data();
                    $data2['imgKtp_anggota'] = $file['file_name'];  
                }
            }

            if (!empty($_FILES['fotoKtpPasangan']['name'])) {
                if ($this->upload->do_upload('fotoKtpPasangan')) {
                    $file = $this->upload->data();
                    $data2['imgKtp_pasangan'] = $file['file_name'];  
                }
            }
            $this->m->updateAnggotas($id, $data1, $data2);
            $this->session->set_flashdata('msg', 'update anggota dengan nomor ke-anggotaan <b>' . $id . '</b> dan nama anggota ' . ucwords($data1['namaAnggota']));
            
            redirect('anggota','refresh');
        }
        
    }

    function delete_anggota($id)
    {

        if ($this->m->getAnggotaById($id)->rekening != NULL) {
            $this->session->set_flashdata('inf', 'Rekening anggota ini masih ada. Silahkan hapus rekening terlebih dahulu !');
        }else {
            $this->m->removeAnggotas($id);
            $this->session->set_flashdata('msg', 'Anggota yang dipilih sudah dikeluarkan. Silahkan lihat di anggota Keluar !');
        }

        
        redirect('anggota','refresh');
    }

    function anggota_keluar()
    {
        $load = $this->m->getAnggotas(2)->result(); // Anggota dengan status Aktif

        $data = array(
            'title'     => 'Data Anggota Keluar / Non Aktif', 
            'page'      => 'pages/operasional/anggota/keluar',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function add_rekening($id)
    {
        $data = $this->m->getAnggotaById($id);
        $norek = time();
        $this->m->openRekening($id, $norek);

        $this->session->set_flashdata('msg', 'Telah membuka rekening baru untuk anggota <b>' . ucwords($data->namaAnggota). '</b> dan nomor rekening <b>'. $norek. '.</b><br /> Sekarang teller sudah bisa melakukan simpanan pokok awal untuk anggota ini !' );
            
        redirect('anggota/rekening','refresh');
    }

    function rekening_anggota()
    {
        $load = $this->m->getRekening()->result(); // Anggota dengan status Aktif

        $data = array(
            'title'     => 'Data Rekening Anggota', 
            'page'      => 'pages/operasional/anggota/rekening',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function invoice_rekening($norek)
    {
        $load = $this->m->getRekeningByNorek($norek); // Anggota dengan status Aktif

        $data = array(
            'title'     => 'Detail Rekening Anggota', 
            'page'      => 'pages/operasional/anggota/invoice_rekening',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function close_rekening($norek)
    {
        $load   = $this->m->getRekeningByNorek($norek);
        $kas    =  $this->m->getKas();
        $totalSimpanan = $load->s_pokok + $load->s_wajib + $load->s_sukarela;
        $calculate = $kas - $totalSimpanan ;

        if ($totalSimpanan != 0) {
            $this->session->set_flashdata('err', 'Anggota <b>' . ucwords($load->namaAnggota). '</b> masih ada simpanan, minta teller tarik semua simpanan !' );
            redirect('anggota/rekening','refresh');
        }elseif ($load->status_pinjaman != 0) {
            $this->session->set_flashdata('err', 'Anggota <b>' . ucwords($load->namaAnggota). '</b> masih ada  pinjaman !' );
            redirect('anggota/rekening','refresh');
        }else {
            $this->m->updateKas($calculate);
            $this->m->removeRekening($norek);
            $this->m->updateOnlyNorekAnggota($load->anggota_id);
            $this->session->set_flashdata('msg', 'Anggota <b>' . ucwords($load->namaAnggota). '</b> dan nomor rekening <b>'. $norek. '.</b><br /> telah di tutup !' );
            redirect('anggota/rekening','refresh');
        }


    }

    function TrxOperasional_keluar()
    {
        
        $data = array(
            'title'     => 'Update Keuangan [ Keluar ]', 
            'page'      => 'pages/operasional/operasional/transaksi_form',
            'action'    => 'keluar',
            'rupiah'    => TRUE,
            'kas'       => $this->m->getKas(),
        );

        $data['notice'] = 'Harap diperhatikan, form ini hanya untuk melakukan update keuangan yang nilainya di atas Rp.500.000';
        
        $this->load->view ('index', $data);
    }

    function TrxOperasional_masuk()
    {
        $data = array(
            'title'     => 'Update Keuangan [ Masuk ]', 
            'page'      => 'pages/operasional/operasional/transaksi_form',
            'action'    => 'masuk',
            'rupiah'    => TRUE,
            'kas'       => $this->m->getKas(),
        );

        $data['notice'] = 'Harap diperhatikan, form ini hanya untuk melakukan update keuangan masuk.<br /> Contoh: *Uang Masuk Dari Bank Ke Brangkas Kantor*';
        
        $this->load->view ('index', $data);
    }



    function processTrxOprasional($jenis)
    {
        $this->_rules('operasional_trx');
        if ($this->input->post('tanggal_update') == NULL) {
           $dateUpdate = date('Y-m-d');
        }else {
            $dateUpdate = $this->input->post('tanggal_update');
        }

        $jumlah         = str_replace(".", "", $this->input->post('jumlah'));
        $type_keluar    = $this->input->post('jenis');
        
        if ($jenis == 'masuk') {
            $category = '[ MASUK ] ';
        }elseif ($jenis == 'keluar') {
            $this->form_validation->set_rules('jenis', 'Jenis Uang Keluar', 'trim|required', array(
                'required' => '%s wajib dipilih'
            ));
            
            if ($type_keluar == 'keluar') {
                $category = '[ KELUAR ] ';
            }elseif ($type_keluar == 'belanja') {
                $category = '[ BELANJA ] ';
            }
        }

        if ($this->form_validation->run() == FALSE) {
            switch ($jenis) {
                case 'masuk':
                    $this->TrxOperasional_masuk();
                    break;
                case 'keluar':
                    $this->TrxOperasional_keluar();
                    break;               
            }
        } else {
            if ($jenis == 'belanja' && $jumlah > '499999') {
                $this->session->set_flashdata('err', 'Untuk uang belanja di atas Rp.500.000 silahkan masukan di menu uang Keluar');
                redirect('operasional/uang_belanja','refresh');
            }else {
                $data = array(
                    'type' => $jenis, 
                    'nilaiTransaksi'    => $jumlah,
                    'keterangan'        => $category . strtolower($this->input->post('keterangan')),
                    'is_operasional'    => 1,
                    'kodeRelasi'        => 'manajer',
                    'lastUpdate_t'        => $dateUpdate,
                );
                $kas = $this->m->getKas();
                if (($jenis == 'belanja' && $jumlah > $kas) || ($jenis == 'keluar' && $jumlah > $kas)) {
                    $this->session->set_flashdata('err', 'Uang Kas Hanya <b>Rp. '. number_format($kas ). '</b> !');
                
                switch ($jenis) {
                    case 'masuk':
                        redirect('operasional/uang_masuk','refresh');
                        break;
                    case 'keluar':
                        redirect('operasional/uang_keluar','refresh');
                        break;               
                }
                }else {
                    $this->u->updateUangOperasional($jenis, $data);
                    $this->session->set_flashdata('msg', 'Uang <b>'. ucwords($jenis) . '</b> Berhasil di update. Menunggu persetujuan manajer !');
                    
                    switch ($jenis) {
                        case 'masuk':
                            redirect('operasional/uang_masuk','refresh');
                            break;
                        case 'keluar':
                            redirect('operasional/uang_keluar','refresh');
                            break;               
                    }
                }
            }
        } 
    }

    function approvalPenarikanSimpanan()
    {
        $load = $this->m->getPendingPenarikan()->result(); // Anggota dengan status Aktif
        
        $data = array(
            'title'     => 'Data Permohonan Penarikan', 
            'page'      => 'pages/operasional/approval/penarikan',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function process_approvalPenarikanSimpanan($id, $type, $serial)
    {
        $kas    = $this->m->getKas();
        $load   = $this->m->getTransaksiByUserId($id, $serial);
        $rekening = $load->id_rekening;
        $date   = date('Y-m-d');

        switch ($type) {
            case 'tsimpok':
                $simpok = $load->s_pokok;
                $data1 = array(
                    's_pokok'       => $simpok - $load->nilaiTransaksi, 
                    'lastUpdate'    => $date
                );
                break;
            
            case 'tsimwa':
                $simwa = $load->s_wajib;
                $data1 = array(
                    's_wajib'       => $simwa - $load->nilaiTransaksi, 
                    'lastUpdate'    => $date
                );
                break;
            
            case 'tsimka':
                $simka = $load->s_sukarela;
                $data1 = array(
                    's_sukarela'    => $simka - $load->nilaiTransaksi, 
                    'lastUpdate'    => $date
                );
                break;
        }

        if ($kas < $load->nilaiTransaksi) {
           $this->session->set_flashdata('err', 'Kas tidak mencukupi untuk melakukan penarikan'); 
           redirect('operasional/approval/penarikan','refresh'); 
        }elseif ($simpok < $kas || $simwa < $kas || $simka < $kas) {
            $this->m->removeSerialNumber($serial);
            $this->session->set_flashdata('err', 'Simpanan yang ditarik tidak sebesar nilai yang di minta ! Serial dihapus sercara otomatis'); 
            redirect('operasional/approval/penarikan','refresh'); 
        }else {
            $data2 = array(
                'keterangan' => '[DISETUJUI]'.$load->keterangan, 
                'kodeRelasi' => 'teller', 
                'lastUpdate_t' => $date, 
            );

            $trxDatas['nilai'] = $kas - $load->nilaiTransaksi;
            $this->u->updateKas($trxDatas);
            $this->u->updateApprovalPenarikan($rekening, $serial, $data1, $data2);
            $this->session->set_flashdata('msg', 'penarikan sudah disetujui dan sudah dibisa dicetak invoice oleh teller'); 
            redirect('operasional/approval/penarikan','refresh'); 
        }

    }

    function reject_approvalPenarikan($serial)
    {
        $this->m->removeSerialNumber($serial);
        $this->session->set_flashdata('msg', 'penarikan sudah ditolak oleh operasional'); 
        redirect('operasional/approval/penarikan','refresh'); 

    }

    function getLog_operasional()
    {
        $load = $this->m->getLogTrx('operasional')->result(); // Anggota dengan status Aktif
        
        $data = array(
            'title'     => 'Data Log Transaksi Operasional', 
            'page'      => 'pages/operasional/log/trx_operasional',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function pengajuan_pinjaman()
    {
        $kas = $this->m->getKas();
        $load = $this->m->getAllUsers()->result();
        $data = array(
            'title'     => 'Pengajuan Pinjaman Karyawan', 
            'page'      => 'pages/operasional/pinjaman/add',
            'data'      => $load,
            'rupiah'    => TRUE,
            'kas'       => $kas,
        );

        $this->load->view ('index', $data);
    }

    function update_pinjaman($serial)
    {
        $kas = $this->m->getKas();
        $load = $this->m->getDataPinjamanKaryawanBySerial($serial);
        $data = array(
            'title'     => 'Update Nilai Pinjaman Karyawan', 
            'page'      => 'pages/operasional/pinjaman/add',
            'data'      => $load,
            'updateNilai'      => $serial,
            'kas'       => $kas,
        );

        $this->load->view ('index', $data);
    }

    function process_update_pinjaman($serial)
    {

        $this->_rules('update_nilai_pinjaman');
        $jumlah = str_replace(".", "", $this->input->post('jumlah'));
        $kas = $this->m->getKas();
        $load = $this->m->getDataPinjamanKaryawanBySerial($serial);
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->update_pinjaman($serial);
        } else {
            if ($jumlah > $kas) {
                $this->session->set_flashdata('err', 'Uang Kas Hanya <b>Rp. '. number_format($kas) . '</b> !');
                redirect('operasional/data_pinjaman/update_nilai/'.$serial,'refresh');
            }else {

                $data1 = array(
                    'type' => 'pinjaman', 
                    'nilaiTransaksi' => $jumlah, 
                    'is_pinjaman' => 1, 
                    'keterangan' => '[UPDATE JUMLAH] Penambahan Pinjaman Uang ' . ucwords($load->namaLengkap) . ' sebesar Rp. ' . number_format($jumlah).' dari sisa sebelumnya Rp. '. number_format($load->sisaPinjaman), 
                    'kodeRelasi' => $this->session->userdata('level_akses'), 
                    'lastUpdate_t' => date('Y-m-d'),
                    'printInvoice' => 0 
                );
                $data2 = array(
                    'nilaiPinjaman' => $load->nilaiPinjaman + $jumlah, 
                    'sisaPinjaman'  => $load->sisaPinjaman + $jumlah, 
                    'lastUpdate'    => date('Y-m-d')
                );
                
                $this->u->updatePinjamanKaryawan($serial, $data1, $data2);
                $trxDatas['nilai'] = $kas - $jumlah;
                $this->u->updateKas($trxDatas);
                $this->session->set_flashdata('msg', 'Berhasil update pinjaman karyawan ' . ucwords($load->namaLengkap) . '. Sisa pinjaman menjadi <b>Rp. '. number_format($data2['sisaPinjaman']) . '</b> !');
                redirect('operasional/data_pinjaman/update_nilai/'.$serial,'refresh');
            }
        } 

    }

    function process_pinjaman()
    {
        $this->_rules('pinjaman_karyawan');
        $jumlah = str_replace(".", "", $this->input->post('jumlah'));
        $id = $this->input->post('karyawan');
        $serial =  'PJ'.date('Ymdhis');
        $karyawan = $this->m->getById($id);
        $data_pinjaman = $this->m->checkPinjamanKaryawan($id,'1');


        $kas = $this->m->getKas();
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->pengajuan_pinjaman();
        } else {
            if ($jumlah > $kas) {
               $this->session->set_flashdata('err', 'Uang Kas Hanya <b>Rp. '. number_format($kas) . '</b> !');
               redirect('operasional/pengajuan_pinjaman','refresh');
            }else {
              if ($data_pinjaman->num_rows() > 0) {
                    $this->session->set_flashdata('err', 'Karyawan ini sudah pernah ada pinjaman / serial sebelumnya. Silahkan tambahkan nilai pinjaman saja');
                    redirect('operasional/data_pinjaman','refresh');
              }else {
                   $data1 = array(
                   'type' => 'pinjaman', 
                   'serialNumber' => $serial, 
                   'nilaiTransaksi' => $jumlah, 
                   'keterangan' => 'Pinjaman Uang ' . ucwords($karyawan->namaLengkap) . ' sebesar Rp. ' . number_format($jumlah), 
                   'nilaiTransaksi' => $jumlah, 
                   'is_pinjaman' => 1, 
                   'kodeRelasi' => $this->session->userdata('level_akses'), 
                   'lastUpdate_t' => date('Y-m-d'), 
                );

                $data2 = array(
                    'serial' => $serial,
                    'admin_id' => $id,
                    'nilaiPinjaman' => $jumlah,
                    'status'    => 1,
                    'sisaPinjaman'  => $jumlah,
                    'lastUpdate' => date('Y-m-d')
                );

                $trxDatas['nilai'] = $kas - $jumlah;
                $this->u->insertPinjamanKaryawan($data1, $data2);
                $this->u->updateKas($trxDatas);
                $this->session->set_flashdata('msg', 'Telah dikeluarkan pinjaman untuk karyawan <b>'. ucwords($karyawan->namaLengkap) .'</b> sebesar Rp. ' . number_format($jumlah));
                redirect('operasional/pengajuan_pinjaman','refresh');
              }
            }
        }
        
    }

    function data_pinjaman_karyawan()
    {
        $load = $this->m->getDataPinjamanKaryawan()->result();
        
        $data = array(
            'title'     => 'Data Pinjaman Karyawan', 
            'page'      => 'pages/operasional/pinjaman/index',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function setujui_pinjaman($serial)
    {
        $newSerial  =  'PJ'.date('Ymdhis');
        $karyawan   = $this->m->getDataPinjamanKaryawanBySerial($serial);
        $jumlah     = $karyawan->nilaiPinjaman;
        $id         = $karyawan->admin_id;
        $kas        = $this->m->getKas();
        $data_pinjaman = $this->m->checkPinjamanKaryawan($id,'1');
        if ($data_pinjaman->num_rows() == 1) {
                if ($jumlah > $kas) {
                    $this->session->set_flashdata('err', 'Jumlah ketersediaan Kas tidak cukup. Jumlah kas sekarang sebesar Rp. ' . number_format($kas));
                    redirect('operasional/data_pinjaman','refresh');
                }else {

                    $data1 = array(
                        'type' => 'pinjaman', 
                        'nilaiTransaksi' => $jumlah, 
                        'is_pinjaman' => 1, 
                        'keterangan' => '[UPDATE JUMLAH] Penambahan Pinjaman Uang ' . ucwords($data_pinjaman->row()->namaLengkap) . ' sebesar Rp. ' . number_format($jumlah).' dari sisa sebelumnya Rp. '. number_format($data_pinjaman->row()->sisaPinjaman), 
                        'kodeRelasi' => $this->session->userdata('level_akses'), 
                        'lastUpdate_t' => date('Y-m-d'), 
                    );
    
                    $data2 = array(
                        'nilaiPinjaman' => $data_pinjaman->row()->nilaiPinjaman + $jumlah, 
                        'sisaPinjaman'  => $data_pinjaman->row()->sisaPinjaman + $jumlah, 
                        'lastUpdate'    => date('Y-m-d')
                    );
                    $this->m->removePinjamanKaryawan($serial);
                    $this->u->updatePinjamanKaryawan($data_pinjaman->row()->serial, $data1, $data2);
                    $trxDatas['nilai'] = $kas - $jumlah;
                    $this->u->updateKas($trxDatas);
                    $this->session->set_flashdata('msg', 'Telah memperbaharui pinjaman untuk karyawan <b>'. ucwords($data_pinjaman->row()->namaLengkap) .'</b> sebesar Rp. ' . number_format($jumlah));
                    redirect('operasional/data_pinjaman','refresh');
                    // echo 'Jalankan karyawan yang sudah ada pinjaman';
                }
        }else {
            $data1 = array(
                'type' => 'pinjaman', 
                'serialNumber' => $newSerial, 
                'nilaiTransaksi' => $jumlah, 
                'keterangan' => 'Pinjaman Uang ' . ucwords($karyawan->namaLengkap) . ' sebesar Rp. ' . number_format($jumlah), 
                'nilaiTransaksi' => $jumlah, 
                'is_pinjaman' => 1, 
                'kodeRelasi' => $this->session->userdata('level_akses'), 
                'lastUpdate_t' => date('Y-m-d'), 
            );
    
            $data2 = array(
                'serial' => $newSerial,
                'admin_id' => $id,
                'nilaiPinjaman' => $jumlah,
                'status'    => 1,
                'sisaPinjaman'  => $jumlah,
                'lastUpdate' => date('Y-m-d')
            );
    
            if ($jumlah > $kas) {
                $this->session->set_flashdata('err', 'Jumlah ketersediaan Kas tidak cukup. Jumlah kas sekarang sebesar Rp. ' . number_format($kas));
                redirect('operasional/data_pinjaman','refresh');
            }else {
                
                $trxDatas['nilai'] = $kas - $jumlah;
                $this->m->removePinjamanKaryawan($serial);
                $this->u->insertPinjamanKaryawan($data1, $data2);
                $this->u->updateKas($trxDatas);
                $this->session->set_flashdata('msg', 'Telah dikeluarkan pinjaman untuk karyawan <b>'. ucwords($karyawan->namaLengkap) .'</b> sebesar Rp. ' . number_format($jumlah));
                redirect('operasional/data_pinjaman','refresh');
                //  echo 'Jalankan karyawan yang belum ada pinjaman';
            }
        }

    }

    function tolak_pinjaman_karyawan($serial)
    {
        $data = $this->m->getDataPinjamanKaryawanBySerial($serial);
        $this->m->removePinjamanKaryawan($serial);
        $this->session->set_flashdata('msg', 'permohonan pinjaman dari <b>' . ucwords($data->namaLengkap) . '</b> dengan serial <b>' . $serial .'</b> telah ditolak !');
        redirect('operasional/data_pinjaman','refresh');
    }

    function hapus_pinjaman($serial)
    {
        $data = $this->m->getDataPinjamanKaryawanBySerial($serial);
        if ($data->sisaPinjaman != 0) {
            $this->session->set_flashdata('err', 'Harap melunaskan pinjaman sebelum menghapus serial peminjaman !');
            redirect('operasional/data_pinjaman','refresh');
        }else {
            $this->m->removePinjamanKaryawan($serial);
            $this->session->set_flashdata('msg', 'data sudah di hapus !');
            redirect('operasional/data_pinjaman','refresh');
        }
    }

    function bayar_pinjaman($type,$serial)
    {
        $load = $this->m->getDataPinjamanKaryawanBySerial($serial);
        if ($type == 'normal') {
            $title = 'Setoran ';
        }else {
            $title = 'Pelunasan ';
        }
        $data = array(
            'title'     => $title. 'Pinjaman Karyawan', 
            'page'      => 'pages/operasional/pinjaman/update_bayar',
            'data'      => $load,
            'serial'    => $serial,
            'jenis'     => $type
        );

        $this->load->view ('index', $data);
    }

    function process_bayar_pinjaman($serial)
    {
        $load = $this->m->getDataPinjamanKaryawanBySerial($serial);
        $kas = $this->m->getKas();
        $jumlah = str_replace(".", "", $this->input->post('jumlah'));
        

        if ($jumlah > $load->sisaPinjaman) {
            $this->session->set_flashdata('err', 'Jumlah Pembayaran Melebihi Jumlah Pinjaman. Silahkan Ulangi Lagi !');
            redirect('operasional/data_pinjaman','refresh');
        }else {
            $data1 = array(
                'type' => 'setoran', 
                'serialNumber' => 'ST'.time(), 
                'nilaiTransaksi' => $jumlah, 
                'keterangan' => 'Terima Setoran Pinjaman Karyawan '. ucwords($load->namaLengkap) . ' Sebesar Rp. '. number_format($jumlah), 
                'is_pinjaman' => 1,
                'kodeRelasi'    => $this->session->userdata('level_akses'),
                'lastUpdate_t' => date('Y-m-d')
            );

            $data2 = array(
                'sisaPinjaman' => $load->sisaPinjaman - $jumlah, 
                'lastUpdate' => date('Y-m-d')
            );

            $trxDatas['nilai'] = $kas + $jumlah;
            $this->u->updateKas($trxDatas);
            $this->u->bayarPinjamanKaryawan($serial,$data1,$data2);
            $this->session->set_flashdata('msg', 'Karyawan ' . ucwords($load->namaLengkap) . ' Telah Memberikan Setoran Sebesar ' . number_format($jumlah) . '!');
            redirect('operasional/data_pinjaman','refresh');
        }
    }


    function _rules($rules)
    {
        switch ($rules) {
            case 'update_nilai_pinjaman':
            $this->form_validation->set_rules('jumlah', 'Jumlah Pinjaman', 'trim|required|numeric',
            array(
            'required'   => '%s Tidak Boleh Kosong',
            'numeric'    => '%s Hanya Boleh Angka',
            ));
            break;

            case 'pinjaman_karyawan':
            $this->form_validation->set_rules('jumlah', 'Jumlah Pinjaman', 'trim|required|numeric',
            array(
            'required'   => '%s Tidak Boleh Kosong',
            'numeric'    => '%s Hanya Boleh Angka',
            ));
            $this->form_validation->set_rules('karyawan', 'Karyawan', 'trim|required',
            array(
            'required'   => 'Pilih %s Terlebih Dahulu',
            ));
            break;


            case 'add_anggota':
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('nik', 'NIK/SIM', 'trim|required|min_length[5]|max_length[50]|is_unique[bq_anggota.nik]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
                'is_unique'  => '%s Sudah Pernah Digunakan',
            ));
            $this->form_validation->set_rules('masa_ktp', 'Masa Berlaku', 'trim|required|min_length[4]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('tp_lahir', 'Tempat Lahir', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',

            ));
            $this->form_validation->set_rules('tg_lahir', 'Tanggal Lahir', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
            ));
            $this->form_validation->set_rules('no_hp', 'No Telepon', 'trim|required|min_length[10]|max_length[16]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('alamat_ktp', 'Alamat KTP', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));

            $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('status_kawin', 'Status Perkawinan', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('tanggungan', 'Jumlah Tanggungan', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu Kandung', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('status_anggota', 'Status Anggota', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));

            break;

            case 'edit_anggota':
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('nik', 'NIK/SIM', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',

            ));
            $this->form_validation->set_rules('masa_ktp', 'Masa Berlaku', 'trim|required|min_length[4]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('tp_lahir', 'Tempat Lahir', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',

            ));
            $this->form_validation->set_rules('tg_lahir', 'Tanggal Lahir', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
            ));
            $this->form_validation->set_rules('no_hp', 'No Telepon', 'trim|required|min_length[10]|max_length[16]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('alamat_ktp', 'Alamat KTP', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('alamat_sekarang', 'Alamat Sekarang', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));

            $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('status_kawin', 'Status Perkawinan', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('tanggungan', 'Jumlah Tanggungan', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu Kandung', 'trim|required|min_length[5]|max_length[50]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',
            ));
            $this->form_validation->set_rules('status_anggota', 'Status Anggota', 'trim|required',
            array(
                'required'   => '%s Harus Di Pilih',
            ));

            break;

            case 'operasional_trx':
            $this->form_validation->set_rules('jumlah', 'Jumlah Uang', 'trim|required',
            array(
                'required'   => '%s Tidak Boleh Kosong',
            ));
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|min_length[5]|max_length[250]',
            array(
                'required'   => '%s Tidak Boleh Kosong',
                'min_length' => '%s Terlalu Pendek',
                'max_length' => '%s Terlalu Panjang',

            ));

            break;
            
            default:
                # code...
                break;
        }
    }
}

/* End of file Main.php and path /application/controllers/Operasional/Main.php */
