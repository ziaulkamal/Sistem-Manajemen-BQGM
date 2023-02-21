<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Document_model extends CI_Model 
{

    function createNew_surat($data)
    {
        $this->db->insert('bq_surat', $data);
        return;
    }

    function getLastNo_surat($date)
    {

       $this->db->where('tahun',$date); 
       $this->db->order_by('id_surat', 'desc');
       
        return $this->db->get('bq_surat', 1);
       
    }


    function getAll_surat()
    {
        $this->db->join('bq_pinjaman', 'bq_pinjaman.id_pinjaman = bq_surat.pinjaman_id');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->order_by('id_surat', 'DESC');
        
        return $this->db->get('bq_surat');
    }

    function getSuratById($id_pinjaman)
    {
        $this->db->where('pinjaman_id', $id_pinjaman);
        return $this->db->get('bq_surat');
    }

    function getSuratByNo_surat($no)
    {
        $this->db->join('bq_pinjaman', 'bq_pinjaman.id_pinjaman = bq_surat.pinjaman_id');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('anggota_detail', 'anggota_detail.anggota_id = bq_anggota.id_anggota');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        
        $this->db->where('bq_surat.no_surat', $no);
        return $this->db->get('bq_surat')->row();
    }
         
    function getJumlahPengajuan($id)
    {
        $this->db->where('anggota_id', $id);
        return $this->db->get('bq_pinjaman');
        
        
    }
}


/* End of file Document_model.php and path /application/models/Document_model.php */
