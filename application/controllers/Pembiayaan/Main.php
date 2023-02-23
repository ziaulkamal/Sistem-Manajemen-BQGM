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

    function data_anggota_pembiayaan()
    {
        $dataSet = $this->m->data_anggota_pinjaman();

        $data = array(
            'title'     => 'Data Anggota Pembiayaan', 
            'page'      => 'pages/pembiayaan/index',
        );
        if ($dataSet != null) {
            $data['data'] = $dataSet->result();
        }else {
            $data['data'] = NULL;
        }

        $this->load->view ('index', $data);
    }

    function pengajuan_anggota()
    {
        $load = $this->m->getAnggotaAndRekening()->result(); // Anggota dengan status Aktif

        $data = array(
            'title'     => 'Data Anggota Untuk Diberikan Pembiayaan', 
            'page'      => 'pages/pembiayaan/operasi_pembiayaan/index',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function pengajuanLama_detail($id)
    {
        $load = $this->m->getDataPinjamanById($id)->result(); // Anggota dengan status Aktif

        $data = array(
            'title'     => 'Data Pinjaman Sebelumnya', 
            'page'      => 'pages/pembiayaan/operasi_pembiayaan/pembiayaan_lama',
            'data'      => $load
        );

        $this->load->view ('index', $data);
    }

    function pengajuanLama_action($id, $action)
    {
        $load = $this->m->getDataPinjamanBySerial($id)->row(); // Anggota dengan status Aktif
        $validation = $this->m->getDataPinjamanById($load->anggota_id)->row()->statusPinjaman;
        $condition = $this->m->checkPendingPinjaman($load->anggota_id);
        if ($validation != 1) {
            if ($action == 'pengajuan') {
                if ($condition->num_rows() > 0) {
                    $this->session->set_flashdata('err', 'Tidak bisa melanjutkan karena masih ada pinjaman yang belum di approve oleh manajer. Silahkan tunggu di approve oleh manajer atau hapus data yang masih statusnya menuggu persetujuan !');
                    redirect('pembiayaan','refresh');
                }else {
                $data = array(
                    'title'     => 'Form Pembiayaan', 
                    'page'      => 'pages/pembiayaan/operasi_pembiayaan/update_step_pinjaman',
                    'data'      => $load,
                    'rupiah'    => TRUE,
                    'ao'        => $this->m->getUserWithLevel('ao')->result(),
                    'action'    => $action
                );

                $this->load->view ('index', $data);
            }
            }else {
                $data = array(
                    'title'     => 'Form Pembiayaan', 
                    'page'      => 'pages/pembiayaan/operasi_pembiayaan/update_step_pinjaman',
                    'data'      => $load,
                    'rupiah'    => TRUE,
                    'ao'        => $this->m->getUserWithLevel('ao')->result(),
                    'action'    => $action
                );

                $this->load->view ('index', $data);
            }
        }else {
            $this->session->set_flashdata('err', 'Anggota ini masih dalam pinjaman.');
            redirect('pembiayaan/data_anggota','refresh');
        }
       
    }

    function pengajuanLama_process($oldId, $action)
    {

        $getBunga   = $this->m->getBunga();
        $load       = $this->m->getDokumenDataById($this->input->post('id_dokumen'));
        $onload     = $this->m->getAnggotaRekeningById($this->input->post('id_anggota'));
        $this->_rules('step_pinjaman');
        $id_pinjaman = 'PB'.time().date('Yd');
        $tenor = $this->input->post('tenor');
        $tglPrediksi = $this->input->post('prediksi');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('err', 'Harap periksa ulang form isian !');
            
            $this->pengajuanLama_action($oldId, $action);
        } else {
            $al6bulan = str_replace(".", "", $this->input->post('al6bulan'));
            if ($al6bulan == NULL) {
               $angsuranLain = 0;
            }else {
                $angsuranLain = str_replace(".", "", $this->input->post('al6bulan'));
            }
            $data1 = array(
                'id_pinjaman'        => $id_pinjaman, 
                'dokumen_id'         => $this->input->post('id_dokumen'), 
                'anggota_id'         => $load->anggota_id, 
                'tglPrediksi'        => $tglPrediksi, 
                'penghasilan6Bulan'  => str_replace(".", "", $this->input->post('pl6bulan')), 
                'pengeluaran6Bulan'  => str_replace(".", "", $this->input->post('pbrt6bulan')), 
                'angsuranLain6Bulan' => $angsuranLain, 
                'biayaOperasional'   => str_replace(".", "", $this->input->post('bo')), 
                'plafon'             => str_replace(".", "", $this->input->post('rahn')) + str_replace(".", "", $this->input->post('mudharabah')), 
                'hargaGabah'         => str_replace(".", "", $this->input->post('harga_gabah')), 
                'proyeksiPanen'      => str_replace(".", "", $this->input->post('proyeksi')), 
                'bunga'              => $getBunga, 
                'tenor'              => $tenor, 
                'approvalManajer'    => 0, 
                'lastUpdate_p'         => date('Y-m-d'), 
            );

            $zakat =  $this->calculateZakat(str_replace(".", "", $this->input->post('proyeksi')),$this->input->post('harga_gabah'));
            $fees = ($zakat - $data1['biayaOperasional'])*$getBunga;
            $getPokok = (str_replace(".", "", $this->input->post('rahn'))/$tenor) + (str_replace(".", "", $this->input->post('mudharabah'))/$tenor);
 
            $data2 = array(
                'pinjaman_id'           => $id_pinjaman,
                'pokokRahn'             => str_replace(".", "", $this->input->post('rahn')), 
                'pokokMudharabah'       => str_replace(".", "", $this->input->post('mudharabah')), 
                'sisaTenor'             => $tenor,
                'pokokAngsuran'         => ceil($getPokok),
                'bagiHasil'             => ceil($fees),
                'statusPinjaman'        => 0,
                'aoBertugas'            => $this->input->post('ao'),
            );

            switch ($tenor) {
                case '1':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    break;
                    
                case '2':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    break;

                case '3':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    $data2['angsuranKetiga']    = date('Y-m-d', strtotime('+12 months', strtotime($tglPrediksi)));
                    break;

                case '4':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    $data2['angsuranKetiga']    = date('Y-m-d', strtotime('+12 months', strtotime($tglPrediksi)));
                    $data2['angsuranKeempat']   = date('Y-m-d', strtotime('+18 months', strtotime($tglPrediksi)));
                    break;

                case '5':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    $data2['angsuranKetiga']    = date('Y-m-d', strtotime('+12 months', strtotime($tglPrediksi)));
                    $data2['angsuranKeempat']   = date('Y-m-d', strtotime('+18 months', strtotime($tglPrediksi)));
                    $data2['angsuranKelima']    = date('Y-m-d', strtotime('+24 months', strtotime($tglPrediksi)));
                    break;

            }

            $di = $this->DI($zakat, $data1['biayaOperasional'], $data1['penghasilan6Bulan'], $data1['pengeluaran6Bulan'], $data1['angsuranLain6Bulan'], $data2['pokokAngsuran'] + $fees);
            $idir = $this->IDIR($data1['angsuranLain6Bulan'], $data2['pokokAngsuran'] + $fees, $zakat-$data1['biayaOperasional']+$data1['penghasilan6Bulan']-$data1['pengeluaran6Bulan'], $data1['angsuranLain6Bulan'], $data2['pokokAngsuran'] + $fees);

            $data1['idir']  = floatval(substr($idir, 0, 4));
            $data1['di']    = $di;
            if ($idir > 70 ) {
                $this->session->set_flashdata('err', 'Idir melebihi 70%, sesuaikan kembali data pinjaman. IDIR saat ini : ' . substr($idir, 0, 3).'%');
                $this->pengajuanLama_action($oldId, $action);
            }elseif ($idir < 0) {
                $this->session->set_flashdata('err', 'Idir Minus di bawah ketetapan yang ditentukan, sesuaikan kembali data pinjaman. IDIR saat ini : ' . substr($idir, 0, 4).'%');
                $this->pengajuanLama_action($oldId, $action);
            }else {
                if ($action == 'pengajuan') {
                    $this->u->insertPinjamanAnggota($data1, $data2);
                    $this->session->set_flashdata('msg', 'pembiayaan berhasil dilakukan dan menunggu approval manajer.');
                }elseif ($action == 'edit') {
                    $this->u->updatePinjamanId($oldId, $data1, $data2);
                    $this->session->set_flashdata('msg', 'Data berhasil di update. Menunggu persetujuan approval manajer');
                }else {
                    $this->session->set_flashdata('err', 'Parameter tidak dikenal');
                }
                echo "<pre>";
                var_dump($data2);
                echo "</pre>";
                redirect('pembiayaan','refresh');  
            }
        }
    }

    function step_dokumen($id,$opsi,$step)
    {
        error_reporting(0);
        $validation = $this->m->getDataPinjamanById($id)->row()->statusPinjaman;
        $anggota = $this->m->checkPendingPinjaman($id);

        if ($validation != 1) {
            if ($anggota->num_rows() < 1) {
                $load = $this->m->getAnggotaById($id); 
        
                $data = array(
                    'title'     => 'Form Pembiayaan', 
                    'page'      => 'pages/pembiayaan/operasi_pembiayaan/step_dokumen',
                    'data'      => $load,
                    'id'        => $id,
                );
        
                $this->load->view ('index', $data);
            }else {
                $this->session->set_flashdata('err', 'Anggota ini masih memiliki pinjaman yang belum disetujui oleh manajer. Jika ingin dilanjutkan harap hapus terlebih dahulu data pinjaman sebelumnya atau menunggu manajer untuk approve data sebelumnya');
                redirect('pembiayaan/data_anggota','refresh');
            }
        }else {
                $this->session->set_flashdata('err', 'Anggota ini masih dalam pinjaman.');
                redirect('pembiayaan/data_anggota','refresh');
        }
    }

    function process_step_dokumen($id,$opsi,$step)
    {
        $this->_rules('step_dokumen');
        $id_dokumen = 'D'.date('Hism').'B'.time();
        
        if ($this->form_validation->run() == FALSE) {
            $this->step_dokumen($id,$opsi,$step);
        } else {	
            $path = './public/img_documents/'. $id_dokumen.'/';
            $config = array(
                'allowed_types' => 'jpg|png|jpeg|webp',
                'max_size'      => 6000,
                'overwrite'     => TRUE,
                'upload_path'   => $path,
                'encrypt_name'  => TRUE,
            );

            mkdir($path, 0777, true);
            $this->load->library('upload', $config);


            $luasSawahLain      = $this->input->post('luas_sawah_x');
            if ($luasSawahLain != NULL) {
                $setLuasSawahLain = $luasSawahLain.' '. $this->input->post('satuan_sawah_x');
            }else {
                $setLuasSawahLain = '';
            }
            $setLuasSawahGadai     = $this->input->post('luas_sawah_y').' '. $this->input->post('satuan_sawah_y');
            $setLuasSawahKelola    = $this->input->post('luas_sawah_z').' '. $this->input->post('satuan_sawah_z');
            

            $data = array(
                'id_dokumen'        => $id_dokumen, 
                'anggota_id'        => $id, 
                'jenisDokumen'      => $this->input->post('jenis_dokumen'),
                'nomorSurat'        => $this->input->post('nomor_jaminan'), 
                'statusKepemilikan' => $this->input->post('kepemilikan_jaminan'), 
                'kelolaSawah'       => $this->input->post('pengelola_sawah'), 
                'luasJaminan'       => $this->input->post('luas_jaminan'), 
                'namaPemilik'       => strtolower($this->input->post('nama_pemilik')), 
                'alamatJaminan'     => strtolower($this->input->post('alamat_jaminan')), 
                'lokasi'            => $this->input->post('alamat_sawah'), 
                'luasSawah_lain'    => $setLuasSawahLain, 
                'luasSawah_gadai'   => $setLuasSawahGadai, 
                'luasKelola'        => $setLuasSawahKelola, 
                'faktaData'         => 'sesuai', 
                'tglSurvey'         => $this->input->post('tgl_survey'), 
                'lastUpdate_d'      => date('Y-m-d'), 
            );

            if (empty($_FILES['img_satu']['name'])) {
                $this->session->set_flashdata('err', 'Gambar Utama Wajib Di Upload');
                $this->step_dokumen($id,$opsi,$step);
            }else {
                if ($this->upload->do_upload('img_satu')) {
                   $file = $this->upload->data();
                   $data['foto1'] = $file['file_name'];  
                }

                if (!empty($_FILES['img_dua']['name'])) {
                    if ($this->upload->do_upload('img_dua')) {
                        $file = $this->upload->data();
                        $data['foto2'] = $file['file_name'];  
                    }
                }

                if (!empty($_FILES['img_tiga']['name'])) {
                    if ($this->upload->do_upload('img_tiga')) {
                        $file = $this->upload->data();
                        $data['foto3'] = $file['file_name'];  
                 }
                }

                $this->m->dokumenDataInsert($data);

                $this->session->set_flashdata('msg', 'Dokumen berhasil ditambahkan !');
                redirect('pengajuan/pinjaman/'.$id_dokumen.'/2','refresh');
                
                
            }
        }   
    }

    function step_pengajuan_pinjaman($id,$step)
    {
        $load = $this->m->getDokumenDataById($id);
        
        if ($load != NULL) {
            $data = array(
                'title'     => 'Form Pembiayaan', 
                'page'      => 'pages/pembiayaan/operasi_pembiayaan/step_pinjaman',
                'data'      => $load,
                'rupiah'    => TRUE,
                'id'        => $id,
                'ao'        => $this->m->getUserWithLevel('ao')->result()
            );

            $this->load->view ('index', $data);
        }else {
            $this->session->set_flashdata('err', 'Tautan Tidak Valid');
            redirect('pembiayaan/data_anggota','refresh');
        }
    }

    function process_step_pinjaman($id,$step)
    {
        $getBunga   = $this->m->getBunga();
        $load       = $this->m->getDokumenDataById($id);
        $onload     = $this->m->getAnggotaRekeningById($load->anggota_id);
        $this->_rules('step_pinjaman');
        $id_pinjaman = 'PB'.time().date('Yd');
        $tenor = $this->input->post('tenor');
        $tglPrediksi = $this->input->post('prediksi');
        
        if ($this->form_validation->run() == FALSE) {
            $this->step_pengajuan_pinjaman($id,$step);
        } else {
            $al6bulan = str_replace(".", "", $this->input->post('al6bulan'));
            if ($al6bulan == NULL) {
               $angsuranLain = 0;
            }else {
                $angsuranLain = str_replace(".", "", $this->input->post('al6bulan'));
            }
            $data1 = array(
                'id_pinjaman'        => $id_pinjaman, 
                'dokumen_id'         => $id, 
                'anggota_id'         => $load->anggota_id, 
                'rekening_id'        => $onload->id_rekening, 
                'tglPrediksi'        => $tglPrediksi, 
                'penghasilan6Bulan'  => str_replace(".", "", $this->input->post('pl6bulan')), 
                'pengeluaran6Bulan'  => str_replace(".", "", $this->input->post('pbrt6bulan')), 
                'angsuranLain6Bulan' => $angsuranLain, 
                'biayaOperasional'   => str_replace(".", "", $this->input->post('bo')), 
                'plafon'             => str_replace(".", "", $this->input->post('rahn')) + str_replace(".", "", $this->input->post('mudharabah')), 
                'hargaGabah'         => str_replace(".", "", $this->input->post('harga_gabah')), 
                'proyeksiPanen'      => str_replace(".", "", $this->input->post('proyeksi')), 
                'bunga'              => $getBunga, 
                'tenor'              => $tenor, 
                'approvalManajer'    => 0, 
                'lastUpdate_p'         => date('Y-m-d'), 
            );

            $zakat =  $this->calculateZakat(str_replace(".", "", $this->input->post('proyeksi')),$this->input->post('harga_gabah'));
            $fees = ($zakat - $data1['biayaOperasional'])*$getBunga;
            $getPokok = (str_replace(".", "", $this->input->post('rahn'))/$tenor) + (str_replace(".", "", $this->input->post('mudharabah'))/$tenor);

            $data2 = array(
                'pinjaman_id'           => $id_pinjaman,
                'pokokRahn'             => str_replace(".", "", $this->input->post('rahn')), 
                'pokokMudharabah'       => str_replace(".", "", $this->input->post('mudharabah')), 
                'sisaTenor'             => $tenor,
                'pokokAngsuran'         => $getPokok,
                'bagiHasil'             => ceil($fees),
                'statusPinjaman'        => 0,
                'aoBertugas'            => $this->input->post('ao'),
            );

            switch ($tenor) {
                case '1':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    break;
                    
                case '2':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    break;

                case '3':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    $data2['angsuranKetiga']    = date('Y-m-d', strtotime('+12 months', strtotime($tglPrediksi)));
                    break;

                case '4':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    $data2['angsuranKetiga']    = date('Y-m-d', strtotime('+12 months', strtotime($tglPrediksi)));
                    $data2['angsuranKeempat']   = date('Y-m-d', strtotime('+18 months', strtotime($tglPrediksi)));
                    break;

                case '5':
                    $data2['angsuranPertama']   = $tglPrediksi;
                    $data2['angsuranKedua']     = date('Y-m-d', strtotime('+6 months', strtotime($tglPrediksi)));
                    $data2['angsuranKetiga']    = date('Y-m-d', strtotime('+12 months', strtotime($tglPrediksi)));
                    $data2['angsuranKeempat']   = date('Y-m-d', strtotime('+18 months', strtotime($tglPrediksi)));
                    $data2['angsuranKelima']    = date('Y-m-d', strtotime('+24 months', strtotime($tglPrediksi)));
                    break;

            }

            $di = $this->DI($zakat, $data1['biayaOperasional'], $data1['penghasilan6Bulan'], $data1['pengeluaran6Bulan'], $data1['angsuranLain6Bulan'], $data2['pokokAngsuran'] + $fees);
            $idir = $this->IDIR($data1['angsuranLain6Bulan'], $data2['pokokAngsuran'] + $fees, $zakat-$data1['biayaOperasional']+$data1['penghasilan6Bulan']-$data1['pengeluaran6Bulan'], $data1['angsuranLain6Bulan'], $data2['pokokAngsuran'] + $fees);

            $data1['idir']  = floatval(substr($idir, 0, 4));
            $data1['di']    = $di;
            if ($idir > 70 ) {
                $this->session->set_flashdata('err', 'Idir melebihi 70%, sesuaikan kembali data pinjaman. IDIR saat ini : ' . substr($idir, 0, 3).'%');
                $this->step_pengajuan_pinjaman($id,$step);
            }elseif ($idir < 0) {
                $this->session->set_flashdata('err', 'Idir Minus di bawah ketetapan yang ditentukan, sesuaikan kembali data pinjaman. IDIR saat ini : ' . substr($idir, 0, 4).'%');
                $this->step_pengajuan_pinjaman($id,$step);
            }else {
                $this->u->insertPinjamanAnggota($data1, $data2);
                $this->session->set_flashdata('msg', 'pembiayaan berhasil dilakukan dan menunggu approval manajer. Selesaikan tahap akhir !');
                
                redirect('dokumen/survey/'.$id.'/3','refresh');  
            }
        }
    }

    function hapus_pinjaman($id)
    {
        if ($this->m->getDataPinjamanBySerial($id)!= NULL) {
            $this->m->removePinjamanId($id);
            $this->session->set_flashdata('msg', 'ID Pinjaman '. $id.' telah di hapus !'); 
            redirect('pembiayaan','refresh');
        }else {
            $this->session->set_flashdata('err', 'ID Serial Pinjaman Tidak Valid');
            redirect('pembiayaan','refresh');
        }
            
    }

    function step_detail_dokumen($id,$step)
    {
        $load = $this->m->getDokumenDataById($id);
        
        if ($load != NULL) {
            $data = array(
                'title'     => 'Form Survey', 
                'page'      => 'pages/pembiayaan/operasi_pembiayaan/step_detail',
                'data'      => $load,
                'id'        => $id,
                'ao'        => $this->m->getUserWithLevel('ao')->result()
            );

            $this->load->view ('index', $data);
        }else {
            $this->session->set_flashdata('err', 'Tautan Tidak Valid');
            redirect('pembiayaan/data_anggota','refresh');
        }
    }

    function process_step_detail_dokumen($id,$step)
    {
        $this->_rules('step_survey');
        
        if ($this->form_validation->run() == FALSE) {
            $this->step_detail_dokumen($id,$step);
        } else {
            // dokumen_id	sikap	polaHidup	kemudahanInformasi	namaKeuchik	hpKeuchik	namaKeujrun	hpKeujrun	namaTetangga	hpTetangga	penggunaanPinjaman	statusKelayakan	

            $data = array(
                'dokumen_id'            => $id, 
                'sikap'                 => $this->input->post('sikap'),
                'polaHidup'             => $this->input->post('pola'), 
                'kemudahanInformasi'    => $this->input->post('kemudahan'), 
                'namaKeuchik'           => $this->input->post('nama_keuchik'), 
                'hpKeuchik'             => $this->input->post('hp_keuchik'), 
                'namaKeujrun'           => $this->input->post('nama_keujrun'), 
                'hpKeujrun'             => $this->input->post('hp_keujrun'), 
                'namaTetangga'          => $this->input->post('nama_tetangga'), 
                'hpTetangga'            => $this->input->post('hp_tetangga'), 
                'penggunaanPinjaman'    => $this->input->post('penggunaan'), 
                'statusKelayakan'       => $this->input->post('layak'), 
            );

            $this->m->insertDetailDokumen($data);
            $this->session->set_flashdata('msg', 'semua data berhasil di simpan. Menunggu persetujuan Manajer !');
            redirect('pembiayaan','refresh');
        }
        
    }

    function dokumen_anggota()
    {
        $load = $this->m->getAllDokumenAnggotas()->result();
        $data = array(
            'title'     => 'Data Dokumen Anggota', 
            'page'      => 'pages/pembiayaan/dokumen/index',
            'data'      => $load,
        );

        $this->load->view ('index', $data);
    }


    function calculateZakat($a,$b)
    {
       $nilaiZakat = $this->m->getZakat();
       if ($a >= $nilaiZakat) {
           $output = ($a*$b) - (($a*$b)*0.05);
       }else {
           $output = ($a*$b);
       }

       return $output;
    }

    function DI($z,$i,$a,$u,$l,$k)
    {
    if (is_numeric($z) && is_numeric($i) && is_numeric($a) && is_numeric($u) && is_numeric($l) && is_numeric($k)) {
        $output = ($z-$i+$a-$u)-$l-$k;
    } else {
        $output = 'Invalid input data type';
    }

    return $output;
    }

    function IDIR($z, $i, $a, $u, $l)
    {
        if (is_numeric($z) && is_numeric($i) && is_numeric($a) && is_numeric($u) && is_numeric($l)) {
            $output = (($z+$i)/($a-$u-$l)*100);
        } else {
            $output = 'Invalid input data type';
        }

        return $output;
    }


    function _rules($rules)
    {
        switch ($rules) {
            case 'step_survey':
                $this->form_validation->set_rules('sikap', 'Sikap Konsumen Selama Interview', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('kemudahan', 'Kemudahan Dalam Memberikan Informasi', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('pola', 'Pengecekan Pola Hidup Nasabah', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('nama_keuchik', 'Nama Keuchik', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('hp_keuchik', 'No Hp Keuchik', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('nama_keujrun', 'Nama Keujrun', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('hp_keujrun', 'No Hp Keujrun', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('layak', 'Status Kelayakan', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('penggunaan', 'Penggunaan Pembiayaan', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('nama_tetangga', '', 'trim');
                $this->form_validation->set_rules('hp_tetangga', '', 'trim');
                break;

            case 'step_pinjaman':
                $this->form_validation->set_rules('prediksi', 'Prediksi Panen', 'trim|required',array(
                    'required' => '%s Harus di tentukan !'
                ));
                $this->form_validation->set_rules('pl6bulan', 'Penghasilan Lain Selama 6 Bulan', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('pbrt6bulan', 'Pengeluaran Biaya RT Selama 6 Bulan', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('al6bulan', '', 'trim');
                $this->form_validation->set_rules('bo', 'Biaya Operasional', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('proyeksi', 'Proyeksi Panen', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('tenor', 'Jangka Waktu', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('harga_gabah', 'Harga Gabah', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('ao', 'Account Officer', 'trim|required',array(
                    'required' => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('rahn', 'Pokok Rahn', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('mudharabah', 'Pokok Mudharabah', 'trim|required',array(
                    'required' => '%s Harus di isi !'
                ));
                
                break;

            case 'step_dokumen':
                $this->form_validation->set_rules('tgl_survey', 'Tanggal Survey', 'trim|required',array(
                    'required'  => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('jenis_dokumen', 'Dokumen Jaminan / Anggunan', 'trim|required',array(
                    'required'  => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('kepemilikan_jaminan', 'Kepemilikan Jaminan', 'trim|required',array(
                    'required'  => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik Jaminan', 'trim|required',array(
                    'required'  => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('alamat_jaminan', 'Alamat Jaminan', 'trim|required',array(
                    'required'  => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('nomor_jaminan', 'Nomor Jaminan', 'trim|required',array(
                    'required'  => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('luas_jaminan', 'Luas Lahan Jaminan', 'trim|required',array(
                    'required'  => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('alamat_sawah', 'Alamat Sawah', 'trim|required',array(
                    'required'  => '%s Harus di isi !'
                ));
                $this->form_validation->set_rules('pengelola_sawah', 'Yang Kelola Sawah', 'trim|required',array(
                    'required'  => '%s Harus di pilih !'
                ));
                $this->form_validation->set_rules('fileOne', 'Foto Utama', 'trim');
                $this->form_validation->set_rules('fileTwo', 'Foto Pendukung', 'trim');
                $this->form_validation->set_rules('fileThree', 'Foto Pendukung', 'trim');
                $this->form_validation->set_rules('luas_sawah_x', '', 'trim');
                $this->form_validation->set_rules('satuan_sawah_x', '', 'trim');
                $this->form_validation->set_rules('luas_sawah_y', '', 'trim');
                $this->form_validation->set_rules('luas_sawah_z', '', 'trim|required',array(
                    'required'  => 'Area ini harus di isi !'
                ));
                $this->form_validation->set_rules('satuan_sawah_y', 'Satuan', 'trim');
                $this->form_validation->set_rules('satuan_sawah_z', 'Satuan', 'trim|required',array(
                    'required'  => '%s Harus di pilih !'
                ));
                
                break;
            
            default:
                # code...
                break;
        }
    }
}

/* End of file Main.php and path /application/controllers/Pembiayaan/Main.php */
