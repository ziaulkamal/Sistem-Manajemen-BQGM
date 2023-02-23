<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model','u');
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        
    }

    public function index()
    {
        $load = array(
            'totalHutang'                   => $this->u->totalHutang(), 
            'totalHutang_persentase'        => $this->u->totalHutang_persentase(), 
            'totalPiutang'                  => $this->u->totalPiutang(), 
            'totalPiutang_persentase'       => $this->u->totalPiutang_persentase(), 
            'totalKas'                      => $this->u->totalKas(), 
            'nilaiPembiayaan'               => $this->u->nilaiPembiayaan(), 
            'nilaiPembiayaan_persentase'    => $this->u->nilaiPembiayaan_persentase(), 
            'setoranAngsuran'               => $this->u->setoranAngsuran(), 
            'setoranAngsuran_persentase'    => $this->u->setoranAngsuran_persentase(), 
            'pengeluaranBulanIni'           => $this->u->pengeluaranBulanIni(), 
            'pengeluaranBulanIni_persentase'=> $this->u->pengeluaranBulanIni_persentase(), 
            'totalAnggota'                  => $this->u->totalAnggota(), 
            'totalAnggota_persentase'       => $this->u->totalAnggota_persentase(), 
        );
        $data = array(
            'title' => 'Dashboard',
            'page' => 'pages/dashboard',
            'data' => $load
        );
        $this->load->view('index', $data);
    }
}

/* End of file Dashboard.php and path /application/controllers/Dashboard.php */
