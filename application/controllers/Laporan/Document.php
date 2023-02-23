<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('./vendor/autoload.php');
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

class Document extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Document_model','d');
        $this->load->model('Internal_model','m');
        if ($this->session->userdata('status_login') != TRUE) {
            $this->session->set_flashdata('out', 'Anda Tidak Dibenarkan Mengakses Ini !');
            redirect('login');
        }
        
    }

    function createSurat($id)
    {
        $date = date('Y');
        $dataPinjaman = $this->m->getPinjamanById($id);
        $dataSuratLast = $this->d->getLastNo_surat($date);

        if ($dataPinjaman != NULL) {
            $dataCheck = $this->d->getSuratById($id)->num_rows();
                if ($dataCheck == 0) {
                    if ($dataSuratLast->result() == NULL) {
                        $noSurat = 1;
                    }else {
                        $noSurat = $dataSuratLast->row()->no_surat + 1;
                    }
                    $data = array(
                    'no_surat' => $noSurat, 
                    'pinjaman_id' => $id, 
                    'lastUpdate_s' => date('Y-m-d'), 
                    'tahun' => date('Y'), 
                    );

                    $this->d->createNew_surat($data);
                    $this->session->set_flashdata('msg', 'Surat Berhasil dibuat untuk anggota yang dipilih');
                    redirect('doc/daftar_surat','refresh');
                }else {
                    $this->session->set_flashdata('err', 'Surat telah dibuat sebelumnya, silahkan di cetak !');
                    redirect('pembiayaan','refresh');
                }
        }else {
            $this->session->set_flashdata('err', 'ID Pinjaman Tiak Ditemukan !');
            redirect('pembiayaan','refresh');
        }
       
            // var_dump($dataCheck);
    }

    function daftar_surat()
    {
        $load = $this->d->getAll_surat()->result();
        $data = array(
            'title'     => 'Data Surat Pembiayaan Anggota', 
            'page'      => 'pages/pembiayaan/surat/index',
            'data'      => $load,
        );

        $this->load->view ('index', $data);
        
    }

    function surat_detail($jenis, $no)
    {


        $load = $this->d->getSuratByNo_surat($no);

        switch ($load->tenor) {
            case '1':
                $setTahun = 'Setengah';
                break;
            
            case '2':
                $setTahun = 'Satu';
                break;
            
            case '3':
                $setTahun = 'Satu Setengah';
                break;
            
            
            case '4':
                $setTahun = 'Dua';
                break;
            
            
            case '5':
                $setTahun = 'Dua Setengah';
                break;
            
        }
        if ($load != NULL) {
             switch ($jenis) {
                case 'rahn':
                    $doc_rahn = new TemplateProcessor('./public/template/word/akad-rahn-template.docx');
                    $doc_rahn->setValue('nama_nasabah',                 strtoupper($load->namaAnggota));
                    $doc_rahn->setValue('nomor_surat',                  $load->no_surat);
                    $doc_rahn->setValue('bulan_romawi',                 $this->getRomawi(date('m')));
                    $doc_rahn->setValue('tahun',                        date('Y'));
                    $doc_rahn->setValue('full_tanggal_indo',            longdate_indo(date('Y-m-d')));
                    $doc_rahn->setValue('set_waktu',                    date('H:i'));
                    $doc_rahn->setValue('akad_rahn',                    number_format($load->pokokRahn));
                    $doc_rahn->setValue('no_surat_tanah',               $load->nomorSurat);
                    $doc_rahn->setValue('luas_tanah',                   $load->luasJaminan );
                    $doc_rahn->setValue('alamat_sawah',                 ucwords($load->lokasi)  );
                    $doc_rahn->setValue('atas_nama',                    strtoupper($load->namaPemilik));
                    $doc_rahn->setValue('set_tahun',                    $setTahun);
                    $doc_rahn->setValue('nama_pasangan',                strtoupper($load->namaPasangan));

                    
                    $filename = date_indo(date('Y-m-d')).' [AKAD RAHN '.strtoupper($load->namaAnggota).'-'.$load->id_pinjaman.'].docx'; // Ganti 'surat_pengantar.docx' dengan nama file yang ingin Anda gunakan untuk menyimpan hasil dokumen Word
                    
                    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    header('Content-Disposition: attachment;filename="'.$filename.'"');
                    header('Cache-Control: max-age=0');
                    
                    $doc_rahn->saveAs('php://output');
                    break;
                
                    case 'mudharabah':
                        $kotor = $load->proyeksiPanen * $load->hargaGabah;
                        $zakat = $this->m->getZakat();
                        $bunga = $this->m->getBunga();
                        if ($load->proyeksiPanen > $zakat || $load->proyeksiPanen  == $zakat) {
                            // NOTE: OPT = Nilai Setelah Zakat Atau Tampa Zakat
                            $opt = ($kotor)*(5/100);
                            $setelah_zakat = $kotor - $opt;
                        }else {
                            $setelah_zakat = $kotor;
                        }

                        $neto = $setelah_zakat - $load->biayaOperasional;
                        $doc_mudharabah = new TemplateProcessor('./public/template/word/akad-mudharabah-template.docx');
                        $doc_mudharabah->setValue('nama_nasabah',                strtoupper($load->namaAnggota));
                        $doc_mudharabah->setValue('tl_nasabah',                  strtoupper($load->tempatLahir));
                        $doc_mudharabah->setValue('tgl_nasabah',                 date_indo($load->tanggalLahir));
                        $doc_mudharabah->setValue('nik_nasabah',                 strtoupper($load->nik));
                        $doc_mudharabah->setValue('alamat_nasabah',              strtoupper($load->alamatSekarang));
                        $doc_mudharabah->setValue('nama_pasangan',               strtoupper($load->namaPasangan));
                        $doc_mudharabah->setValue('tl_pasangan',                 strtoupper($load->tlPasangan));
                        $doc_mudharabah->setValue('tgl_pasangan',                date_indo($load->tglPasangan));
                        $doc_mudharabah->setValue('nik_pasangan',                strtoupper($load->nikPasangan));
                        $doc_mudharabah->setValue('alamat_pasangan',             strtoupper($load->alamatSekarang));

                        $doc_mudharabah->setValue('palfond',                     number_format($load->plafon));
                        $doc_mudharabah->setValue('proyeksi',                    number_format($load->proyeksiPanen));
                        $doc_mudharabah->setValue('harga_gabah',                 number_format($load->hargaGabah));
                        $doc_mudharabah->setValue('bruto',                       number_format($kotor));
                        $doc_mudharabah->setValue('neto',                        number_format($neto));

                        $doc_mudharabah->setValue('bqgm',                        number_format($neto*0.2));
                        $doc_mudharabah->setValue('net_nasabah',                 number_format($neto*0.8));

                        $doc_mudharabah->setValue('net_nasabah',                 $load->tenor);
                        $doc_mudharabah->setValue('tanggal_cetak',               date_indo(date('Y-m-d')));
                        $doc_mudharabah->setValue('tanggal_pj',                  date_indo(date('Y-m-d')));

                        $doc_mudharabah->setValue('ttd_nasabah',                strtoupper($load->namaAnggota));
                        $doc_mudharabah->setValue('ttd_pasangan',               strtoupper($load->namaPasangan));

                        $doc_mudharabah->setValue('nomor_surat',                  $load->no_surat);
                        $doc_mudharabah->setValue('bulan_romawi',                 $this->getRomawi(date('m')));
                        $doc_mudharabah->setValue('tahun',                        date('Y'));
                        $doc_mudharabah->setValue('date_today',                   longdate_indo(date('Y-m-d')));
                        
                        $filename = date_indo(date('Y-m-d')).' [AKAD MUDHARABAH '.strtoupper($load->namaAnggota).'-'.$load->id_pinjaman.'].docx'; // Ganti 'surat_pengantar.docx' dengan nama file yang ingin Anda gunakan untuk menyimpan hasil dokumen Word
                        
                        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                        header('Content-Disposition: attachment;filename="'.$filename.'"');
                        header('Cache-Control: max-age=0');
                        
                        $doc_mudharabah->saveAs('php://output');
                        break;
                    
                    case 'janjiBayar':
                        switch ($load->jenisKelamin) {
                            case '1':
                                $jk = 'Laki-Laki';
                                break;
                            case '2':
                                $jk = 'Perempuan';
                                break;
                            
                        }
                        $doc_janji = new TemplateProcessor('./public/template/word/surat-janji-bayar-template.docx');
                        $doc_janji->setValue('nama_nasabah',           strtoupper($load->namaAnggota));
                        $doc_janji->setValue('ttd_tanggal',            longdate_indo(date('Y-m-d')));
                        $doc_janji->setValue('tempat_lahir',           strtoupper($load->tempatLahir));
                        $doc_janji->setValue('nik',                    $load->nik);
                        $doc_janji->setValue('jenis_kelamin',          strtoupper($jk));
                        $doc_janji->setValue('tanggal_lahir',          date_indo($load->tanggalLahir));
                        $doc_janji->setValue('nik_nasabah',            strtoupper($load->nik));
                        $doc_janji->setValue('alamat',                 strtoupper($load->alamatSekarang));
                        $doc_janji->setValue('total_pinjaman',         number_format($load->plafon));
                        $doc_janji->setValue('tempo_panen',            $setTahun);
                        $doc_janji->setValue('tenor',                  number_format($load->tenor));
                        $doc_janji->setValue('angsuran',               number_format($load->pokokAngsuran));

                        
                        $filename = date_indo(date('Y-m-d')).' [SURAT JANJI BAYAR '.strtoupper($load->namaAnggota).'-'.$load->id_pinjaman.'].docx'; // Ganti 'surat_pengantar.docx' dengan nama file yang ingin Anda gunakan untuk menyimpan hasil dokumen Word
                        
                        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                        header('Content-Disposition: attachment;filename="'.$filename.'"');
                        header('Cache-Control: max-age=0');
                        
                        $doc_janji->saveAs('php://output');
                        break;

                    case 'tandaTerima':
                        $doc_tanda = new TemplateProcessor('./public/template/word/tanda-terima-jaminan-template.docx');
                        $doc_tanda->setValue('nama_nasabah',           strtoupper($load->namaAnggota));
                        $doc_tanda->setValue('no_surat',               $load->no_surat );
                        $doc_tanda->setValue('luas_tanah',             $load->luasJaminan );
                        $doc_tanda->setValue('alamat_sawah',           ucwords($load->lokasi)  );
                        $doc_tanda->setValue('pemilik',              strtoupper($load->namaPemilik));
                        $doc_tanda->setValue('tanggal',                date_indo(date('Y-m-d')));

                        
                        $filename = date_indo(date('Y-m-d')).' [TANDA TERIMA '.strtoupper($load->namaAnggota).'-'.$load->id_pinjaman.'].docx'; // Ganti 'surat_pengantar.docx' dengan nama file yang ingin Anda gunakan untuk menyimpan hasil dokumen Word
                        
                        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                        header('Content-Disposition: attachment;filename="'.$filename.'"');
                        header('Cache-Control: max-age=0');
                        
                        $doc_tanda->saveAs('php://output');
                        break;
            }
        }else {
            redirect('404','refresh');
            
        }
       
    }

    function createMpp($id)
    {
       $load = $this->d->getSuratByNo_surat($id);
       $dataPengajuan = $this->d->getJumlahPengajuan($load->anggota_id);
        $data = array(
            'title'     => 'MPP', 
            'page'      => 'pages/pembiayaan/surat/mpp',
            'data'      => $load,
            'pengajuan'      => $dataPengajuan,
        );

        $this->load->view ('index', $data);
    }

    function createTabelAngsuran($id)
    {
       $load = $this->d->getSuratByNo_surat($id);
        $data = array(
            'title'     => 'Tabel Angsuran', 
            'page'      => 'pages/pembiayaan/surat/tabel_angsuran',
            'data'      => $load,
        );

        $this->load->view ('index', $data);
    }

    function getRomawi($bln){
                switch ($bln){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
                }
}
}

/* End of file Document.php and path /application/controllers/Laporan/Document.php */
