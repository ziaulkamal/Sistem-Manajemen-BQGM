<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Internal_model', 'm');
        $this->load->model('Transaction_model', 'u');

        if ($this->session->userdata('level_akses') != 'teller' && $this->session->userdata('status_login') != TRUE) {
            redirect('logout');
        }
    }

    public function getNotifikasi()
    {
        return $this->m->getNotifikasi();
    }


    function data_simpanan_anggota()
    {
        $load = $this->m->getRekeningDatas(); 
        
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Data Rekening Anggota', 
            'page'      => 'pages/teller/setoran/index',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function update_simpanan_anggota($rekening)
    {
        $load = $this->m->getRekeningByNorek($rekening);
        $table = $this->m->getDetailLastTrxAnggotaId($load->anggota_id);
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Update Setoran Anggota', 
            'page'      => 'pages/teller/setoran/update',
            'data'      => $load,
            'rupiah'    => TRUE,
            'table'     => $table,
            'rekening'  => $rekening,
        );

        $this->load->view ('index', $data);
    }

    function process_update_simpanan($rekening)
    {
        $kas = $this->m->getKas();
        $_type = 'setoran';
        $this->_rules($_type);

        $load = $this->m->getRekeningByNorek($rekening);
        $jumlah = str_replace(".", "", $this->input->post('jumlah'));
        $jenis  = $this->input->post('jenis');
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->update_simpanan_anggota($rekening);
        } else {
           switch ($jenis) {
               case '1':
                  $data1['s_pokok'] = $load->s_pokok + $jumlah;
                  $kode = 'SIMPOK-';
                  $keterangan = 'Setoran Simpanan Pokok dari ' . $load->namaAnggota . ' senilai Rp. ' . number_format($jumlah);
                  $types = 'simpok';
                   break;
               
               case '2':
                   $data1['s_wajib'] = $load->s_wajib + $jumlah;
                   $kode = 'SIMWA-';
                   $keterangan = 'Setoran Simpanan Wajib dari ' . $load->namaAnggota . ' senilai Rp. ' . number_format($jumlah);
                   $types = 'simwa';
                   break;
               
               case '3':
                   $data1['s_sukarela'] = $load->s_sukarela + $jumlah;
                   $kode = 'SIMKA-';
                   $keterangan = 'Setoran Simpanan Sukarela dari ' . $load->namaAnggota . ' senilai Rp. ' . number_format($jumlah);
                   $types = 'simka';
                   break;
           }

           $data2 = array(
               'type'           => $types, 
               'serialNumber'   => $kode.time(), 
               'nilaiTransaksi' => $jumlah, 
               'is_simpanan'    => 1, 
               'is_anggota'     => $load->anggota_id, 
               'keterangan'     => $keterangan, 
               'kodeRelasi'     => $this->session->userdata('level_akses'), 
               'lastUpdate_t'     => date('Y-m-d')
            );

           $data1['lastUpdate']  =   date('Y-m-d');
           $trxDatas['nilai']   = $kas + $jumlah;
           $this->u->updateKas($trxDatas);
           $this->u->updateSimpanan($rekening, $data1, $data2);

           $this->session->set_flashdata('msg', 'Berhasil Update Setoran. Silahkan Cetak Invoice Telebih Dahulu');
           redirect('teller/invoice/simpanan/datas','refresh');
           
        }      
    }

    function penarikan_simpanan($rekening)
    {
        $load = $this->m->getRekeningByNorek($rekening);
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Update Penarikan Anggota', 
            'page'      => 'pages/teller/setoran/penarikan',
            'data'      => $load,
            'rupiah'    => TRUE,
            'rekening'  => $rekening,
        );

        $this->load->view ('index', $data);
    }

    function process_penarikan_simpanan($rekening)
    {
        $_type = 'penarikan';
        $this->_rules($_type);
        $kas = $this->m->getKas();

        $load = $this->m->getRekeningByNorek($rekening);
        $jumlah = str_replace(".", "", $this->input->post('jumlah'));
        $jenis  = $this->input->post('jenis');

        
        if ($this->form_validation->run() == FALSE) {
            $this->penarikan_simpanan($rekening);
        } else {
                switch ($jenis) {
                   case '1':
                    if ($jumlah > $load->s_pokok) {
                        $this->session->set_flashdata('err', 'Jumlah permintaan lebih besar di bandingkan tabungan <b>Simpanan Pokok</b>. <br />'. 'Simpanan Pokok : Rp. ' . number_format($load->s_pokok).'<br />Simpanan Wajib : Rp. '. number_format($load->s_wajib).'<br />Simpanan Sukarela : Rp. '. number_format($load->s_sukarela));
                        redirect('penarikan/update/' . $rekening,'refresh');
                    }else {
        
                        $kode = 'TSIMPOK-';
                        $keterangan = 'Penarikan Simpanan Pokok dari ' . $load->namaAnggota . ' senilai Rp. ' . number_format($jumlah);
                        $types = 'tsimpok';
                    }
                       break;
                   
                   case '2':
                    if ($jumlah > $load->s_wajib) {
                        $this->session->set_flashdata('err', 'Jumlah permintaan lebih besar di bandingkan tabungan <b>Simpanan Wajib</b>. <br />'. 'Simpanan Pokok : Rp. ' . number_format($load->s_pokok).'<br />Simpanan Wajib : Rp. '. number_format($load->s_wajib).'<br />Simpanan Sukarela : Rp. '. number_format($load->s_sukarela));
                        redirect('penarikan/update/' . $rekening,'refresh');
                    }else {
       
                       $kode = 'TSIMWA-';
                       $keterangan = 'Penarikan Simpanan Wajib dari ' . $load->namaAnggota . ' senilai Rp. ' . number_format($jumlah);
                       $types = 'tsimwa';
                    }
                       break;
                   
                   case '3':
                    if ($jumlah > $load->s_sukarela) {
                        $this->session->set_flashdata('err', 'Jumlah permintaan lebih besar di bandingkan tabungan <b>Simpanan Sukarela</b>. <br />'. 'Simpanan Pokok : Rp. ' . number_format($load->s_pokok).'<br />Simpanan Wajib : Rp. '. number_format($load->s_wajib).'<br />Simpanan Sukarela : Rp. '. number_format($load->s_sukarela));
                        redirect('penarikan/update/' . $rekening,'refresh');
                    }else {
          
                       $kode = 'TSIMKA-';
                       $keterangan = 'Penarikan Simpanan Sukarela dari ' . $load->namaAnggota . ' senilai Rp. ' . number_format($jumlah);
                       $types = 'tsimka';
                    }
                       break;
               }
                $data2 = array(
                    'type'           => $types, 
                    'serialNumber'   => $kode.time(), 
                    'nilaiTransaksi' => $jumlah, 
                    'is_simpanan'    => 1, 
                    'is_anggota'     => $load->anggota_id, 
                    'keterangan'     => $keterangan, 
                    'kodeRelasi'     => 'operasional', 
                    'lastUpdate_t'     => date('Y-m-d')
                );

                $this->u->pendingPenarikan($data2);
                
                $this->session->set_flashdata('msg', 'Pengajuan penarikan sudah dilakukan. Menunggu approval operasional');
                // redirect('penarikan/invoice/'. $_type . '/'.$data2['serialNumber'].'/'.$rekening,'refresh');
                redirect('setoran','refresh');

        }
    }

    function cetakInvoiceDatas($jenis)
    {
        $load = $this->m->beforeCetakInvoice($jenis)->result();
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Data Invoice ' .$jenis. ' Belum Dicetak', 
            'page'      => 'pages/teller/printInvoice/index',
            'data'      => $load,

        );

        $this->load->view ('index', $data);
    }

    function updateCetakInvoice($serial, $type)
    {
        $load = $this->m->getLogBySerial($serial);
        $data = array(
            'title'     => 'Invoice '. $type, 
            'type'      =>  $type, 
            'serial'    => $serial, 
            'data'      => $load, 
        );


        switch ($type) {
            case 'pembiayaan':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/pembiayaan' ;
                break;
            
            case 'simpok':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/simpanan' ;
                break;
            case 'simwa':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/simpanan' ;
                break;
            case 'simka':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/simpanan' ;
                break;
            
            case 'tsimpok':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/penarikan' ;
                break;
            case 'tsimwa':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/penarikan' ;
                break;
            case 'tsimka':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/penarikan' ;
                break;
            
            case 'angsuran':
                $data['detail'] = $this->m->getAnggotaById($load->is_anggota);
                $data['page'] = 'pages/teller/printInvoice/angsuran' ;
                break;
            
            case 'pinjaman':
                $data['page'] = 'pages/teller/printInvoice/pinjaman' ;
                break;
            
            case 'setoran':
                $data['page'] = 'pages/teller/printInvoice/pinjaman' ;
                break;
        }

        $setUpdate = array(
            'lastUpdate_t' => date('Y-m-d'), 
            'printInvoice' => $load->printInvoice + 1
        );
        $this->m->updateBySerial($serial, $setUpdate);
        $this->load->view ('index', $data);
    }

    function invoice($_type, $serial, $rekening)
    {
        $load1 = $this->m->getRekeningByNorek($rekening);
        $load2 = $this->m->getLogBySerial($serial);
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Invoice', 
            'page'      => 'pages/teller/invoice',
            'serial'    => $serial,
            'data1'      => $load1,
            'data2'      => $load2,
        );

        $this->load->view ('index', $data);
    }

    function log_transaksi_simpanan()
    {
        $load = $this->m->getLogTrx('teller')->result();
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Log Transaksi Setoran Anggota', 
            'page'      => 'pages/teller/log/trx_teller',
            'data'      => $load,

        );

        $this->load->view ('index', $data);
    }

    function data_anggsuran_anggota()
    {
        $load = $this->m->getAllDataPembiayaan()->result();
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Data Anggota Dalam Pembiayaan', 
            'page'      => 'pages/teller/angsuran/index',
            'data'      => $load,

        );

        $this->load->view ('index', $data);
    }

    function update_data_angsuran($id,$opsi)
    {
        $load = $this->m->getPinjamanById($id);
        if ($opsi == 'normal') {
            $data = array(
                'title'     => 'Setor Angsuran Pinjaman', 
                'page'      => 'pages/teller/angsuran/bayar',
                'data'      => $load,
                'id'        => $id,
                'opsi'      => $opsi,

            );
        }elseif ($opsi == 'percepat') {
            $data = array(
                'title'     => 'Setor Angsuran Pinjaman [PERCEPAT]', 
                'page'      => 'pages/teller/angsuran/percepat',
                'data'      => $load,
                'id'        => $id,
                'opsi'      => $opsi,

            );
        }
 

        $this->load->view ('index', $data);
    }

    function process_update_angsuran($id, $opsi)
    {
        $kas = $this->m->getkas();
        $load = $this->m->getPinjamanById($id);
        $rekening = $load->id_rekening;
        $serial = 'S'.date('Ymdhis');
        
        if ($opsi == 'normal') {
            $totalTrx = ($load->pokokRahn/$load->tenor) + ($load->pokokMudharabah/$load->tenor) + $load->bagiHasil;
            $data1 = array(
                'type'              => 'angsuran', 
                'serialNumber'      => 'N'.$serial, 
                'nilaiTransaksi'    => $totalTrx, 
                'keterangan'        => 'Telah Terima Setoran ' . ucwords($load->namaAnggota) . ' Tanggal '. date('d-m-Y') . ' dengan jumlah Rp. ' . number_format($totalTrx), 
                'is_angsuran'       => 1, 
                'is_anggota'        => $load->anggota_id, 
                'kodeRelasi'        => $this->session->userdata('level_akses'), 
                'lastUpdate_t'        => date('Y-m-d'), 
                'pinjaman_id'       => $id,
            );

            
            if ($load->sisaTenor == 1) {
                $data2 = array(
                    'sisaTenor' => 0, 
                    'statusPinjaman' => 2, 
                );
                $extra = array(
                    'id_rekening' => $rekening, 
                    'status_pinjaman' => 0, 
                );
            }else {
                $data2['sisaTenor']     = $load->sisaTenor - 1;
                $extra = array(
                    'id_rekening' => $rekening, 
                    'status_pinjaman' => 1, 
                );
            }
            
        }elseif ($opsi == 'percepat') {
            $totalTrx = (($load->pokokRahn/$load->tenor)*$load->sisaTenor) + (($load->pokokMudharabah/$load->tenor)*$load->sisaTenor);
            $data1 = array(
                'type'              => 'angsuran', 
                'serialNumber'      => 'P'.$serial, 
                'nilaiTransaksi'    => $totalTrx, 
                'keterangan'        => 'Telah Terima Setoran ' . ucwords($load->namaAnggota) . ' Tanggal '. date('d-m-Y') . ' dengan jumlah Rp. ' . number_format($totalTrx), 
                'is_angsuran'       => 1, 
                'is_anggota'        => $load->anggota_id, 
                'kodeRelasi'        => $this->session->userdata('level_akses'), 
                'lastUpdate_t'        => date('Y-m-d'), 
                'pinjaman_id'       => $id,
            );

            $data2 = array(
                'sisaTenor' => 0, 
                'statusPinjaman' => 2, 
            );
            $extra = array(
                'id_rekening' => $rekening, 
                'status_pinjaman' => 0, 
            );

        }

        $trxDatas['nilai']          = $kas+$totalTrx;
        $this->u->updateKas($trxDatas);
        $this->u->updateBayarAngsuran($id, $data1, $data2, $extra);
        $this->session->set_flashdata('msg', $data1['keterangan']);
        
        redirect('teller/invoice/angsuran/datas','refresh');
        
    }

    function invoiceAngsuran($serial, $id)
    {
        $trxDatas = $this->m->getSerialNumber($serial);
        $load = $this->m->getPinjamanById($id);
        $data = array(
            'notifikasi'=> $this->getNotifikasi(),
            'title'     => 'Invoice', 
            'page'      => 'pages/teller/angsuran/invoice',
            'trxDatas'  => $trxDatas,
            'data'      => $load,
   
        );

        $this->load->view ('index', $data);
    }

    function _rules($rules)
    {
        switch ($rules) {
            case 'setoran':
                $this->form_validation->set_rules('jenis', 'Jenis Setoran', 'trim|required',array(
                    'required'  => '%s harus dipilih !'
                ));
                $this->form_validation->set_rules('jumlah', 'Jumlah Setoran', 'trim|required|numeric',array(
                    'required'  => '%s harus dipilih !',
                    'numeric'  => '%s hanya boleh angka !'
                ));
                
                break;

            case 'penarikan':
                $this->form_validation->set_rules('jenis', 'Jenis Setoran', 'trim|required',array(
                    'required'  => '%s harus dipilih !'
                ));
                $this->form_validation->set_rules('jumlah', 'Jumlah Setoran', 'trim|required|numeric',array(
                    'required'  => '%s harus dipilih !',
                    'numeric'  => '%s hanya boleh angka !'
                ));
                
                break;
            
            default:
                # code...
                break;
        }
    }
}

/* End of file Main.php and path /application/controllers/Teller/Main.php */
