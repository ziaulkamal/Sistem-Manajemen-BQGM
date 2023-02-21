<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Internal_model', 'm');
        $this->load->model('Transaction_model', 'u');
        
    }

 
        
    function pengajuan_pinjaman()
    {
        $data = array(
            'title'     => 'Pengajuan Pinjaman Karyawan', 
            'page'      => 'pages/karyawan/pinjaman/add',
            'rupiah'    => TRUE
        );

        $this->load->view ('index', $data);
    }

    function process_pinjaman()
    {
        $this->_rules();
        $user = $this->m->getById($this->session->userdata('id'));
        $jumlah = str_replace(".", "", $this->input->post('jumlah'));
        $serial =  'PJ'.date('Ymdhis');
        $data_pending = $this->m->checkPinjamanKaryawan($this->session->userdata('id'),'0');
        $data_jalan = $this->m->checkPinjamanKaryawan($this->session->userdata('id'),'1');
        
        if ($this->form_validation->run() == FALSE) {
            $this->pengajuan_pinjaman();
        } else {
            if ($data_pending->num_rows() > 1) {
                    $this->session->set_flashdata('err', 'Anda masih memiliki pinjaman yang belum disetujui oleh operasional.');
                    redirect('pinjaman_karyawan/pengajuan_mandiri','refresh');
            }else {
                $data = array(
                        'serial' => $serial,
                        'admin_id' => $user->id_admin,
                        'nilaiPinjaman' => $jumlah,
                        'status'    => 0,
                        'sisaPinjaman'  => $jumlah,
                        'lastUpdate' => date('Y-m-d')
                );
    
                $this->u->pengajuanPinjamanKaryawan($data);
                $this->session->set_flashdata('msg', 'Pengajuan pinjaman sebesar <b>Rp. ' . number_format($jumlah) . '</b> sudah dilakukan. <br />Menunggu respon dari Manajer dan Operasional !');
                redirect('pinjaman_karyawan/pengajuan_mandiri','refresh');  
            }
        }
    }



    function _rules()
    {
        $this->form_validation->set_rules('jumlah', 'Jumlah Pinjaman', 'trim|required|numeric',
        array(
            'required' => '%s harus di isi!',
            'numeric'   => '%s hanya boleh di isi angka'
        ));
        
    }
}

/* End of file Main.php and path /application/controllers/AccountOfficer/Main.php */
