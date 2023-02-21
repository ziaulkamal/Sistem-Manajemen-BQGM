<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model', 'l');
        
    }

    function laporan_simpanan()
    {
        $load = $this->l->getRekeningAll()->result();
        $data = array(
            'title'     => 'Laporan Simpanan Anggota', 
            'page'      => 'pages/laporan/laporan_simpanan',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_simpanan_frequency()
    {
        $dateFrom   = $this->input->post('s');
        $dateWhere  = $this->input->post('e');
         
        $load = $this->l->getRekeningAll_sort($dateFrom, $dateWhere)->result();
        $data = array(
            'title'     => 'Laporan Simpanan Anggota', 
            'page'      => 'pages/laporan/laporan_simpanan',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);

    }

    function laporan_angsuran()
    {
        $load = $this->l->getAngsuranAll()->result();
        $data = array(
            'title'     => 'Laporan Angsuran Anggota', 
            'page'      => 'pages/laporan/laporan_angsuran',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_angsuran_frequency()
    {
        $dateFrom   = $this->input->post('s');
        $dateWhere  = $this->input->post('e');
        $load = $this->l->getAngsuranAll_sort($dateFrom, $dateWhere)->result();
        $data = array(
            'title'     => 'Laporan Angsuran Anggota', 
            'page'      => 'pages/laporan/laporan_angsuran',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_pembiayaan()
    {
        $getAO = $this->l->getAO()->result();
        $load = $this->l->getPembiayaan()->result();
        $data = array(
            'title'     => 'Laporan Pembiayaan Anggota', 
            'page'      => 'pages/laporan/laporan_pembiayaan',
            'data'      => $load,
            'ao'        => $getAO
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_pembiayaan_frequency()
    {
        $getAO = $this->l->getAO()->result();
        $dateFrom   = $this->input->post('s');
        $dateWhere  = $this->input->post('e');
        $aoSelect = $this->input->post('ao');
        
        $load = $this->l->getPembiayaan_sort($aoSelect, $dateFrom, $dateWhere)->result();
        $data = array(
            'title'     => 'Laporan Pembiayaan Anggota', 
            'page'      => 'pages/laporan/laporan_pembiayaan',
            'data'      => $load,
            'ao'        => $getAO
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_angsuranPending()
    {
        $load = $this->l->getPendingAngsuranAll()->result();
        $data = array(
            'title'     => 'Laporan Angsuran Anggota Tertunda', 
            'page'      => 'pages/laporan/laporan_angsuran_tertunda',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_angsuranPendings($id)
    {
        $id = $this->session->userdata('id');
        $load = $this->l->getPendingAngsuranByAo($id)->result();
        $data = array(
            'title'     => 'Laporan Angsuran Anggota Tertunda', 
            'page'      => 'pages/laporan/laporan_angsuran_tertunda',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_operasional_masuk()
    {
        $load = $this->l->getOperasionalMasukAll()->result();
        $data = array(
            'title'     => 'Laporan Operasional (Masuk)', 
            'page'      => 'pages/laporan/laporan_operasional_masuk',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_operasional_masuk_frequency()
    {
        $dateFrom   = $this->input->post('s');
        $dateWhere  = $this->input->post('e');

        $load = $this->l->getOperasionalMasukAll_sort(trim($dateFrom), trim($dateWhere))->result();
        $data = array(
            'title'     => 'Laporan Operasional (Masuk)', 
            'page'      => 'pages/laporan/laporan_operasional_masuk',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_operasional_keluar()
    {
        $load = $this->l->getOperasionalKeluarAll()->result();
        $data = array(
            'title'     => 'Laporan Operasional (Keluar)', 
            'page'      => 'pages/laporan/laporan_operasional_keluar',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function laporan_operasional_keluar_frequency()
    {
        $dateFrom   = $this->input->post('s');
        $dateWhere  = $this->input->post('e');

        $load = $this->l->getOperasionalKeluarAll_sort(trim($dateFrom), trim($dateWhere))->result();
        $data = array(
            'title'     => 'Laporan Operasional (Keluar)', 
            'page'      => 'pages/laporan/laporan_operasional_keluar',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }

    function trackingSetoranAll()
    {

        $load = $this->l->getSetoranOnly()->result();
        $data = array(
            'title'     => 'Laporan Setoran (Group)', 
            'page'      => 'pages/laporan/laporan_setoran_group',
            'data'      => $load
        );
        
        $this->load->view ('index', $data);
    }
}

/* End of file Main.php and path /application/controllers/Laporan/Main.php */
