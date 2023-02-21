<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Transaction_model extends CI_Model 
{


    function updateKas($trxDatas)
    {
        $this->db->where('nama', 'kas');
        $this->db->update('bq_master', $trxDatas);
        return;
    }


    function updateUangOperasional($jenis, $data)
    {
        switch ($jenis) {
            case 'masuk':
                $data['serialNumber'] = 'IN'.time();
                break;
            case 'keluar':
                $data['serialNumber'] = 'OUT'.time();
                break;
            case 'belanja':
                $data['serialNumber'] = 'SHOP'.time();
                break;
        }
        $this->db->insert('bq_transaksi', $data);
        return;
    }

    function pengajuanPinjamanKaryawan($data)
    {
        $this->db->insert('ks_karyawan', $data);
        return;
    }

    function insertPinjamanKaryawan($data1, $data2)
    {
        $this->db->insert('bq_transaksi', $data1);
        $this->db->insert('ks_karyawan', $data2);
        return;
    }

    function updatePinjamanKaryawan($serial, $data1, $data2)
    {
       $this->db->where('serial', $serial);
       $this->db->update('ks_karyawan', $data2);
       $this->db->where('serialNumber', $serial);
       $this->db->update('bq_transaksi', $data1);
       return;
    }

    function bayarPinjamanKaryawan($serial,$data1,$data2)
    {
        $this->db->where('serial', $serial);
        $this->db->update('ks_karyawan', $data2);
        $this->db->insert('bq_transaksi', $data1);
        return;  
    }

    function updateSimpanan($rekening,$data1,$data2)
    {
        $this->db->where('id_rekening', $rekening);
        $this->db->update('bq_rekening', $data1);
        $this->db->insert('bq_transaksi', $data2);
        return;
    }

    function pendingPenarikan($data2)
    {
        $this->db->insert('bq_transaksi', $data2);
        return;
    }
    
    function insertPinjamanAnggota($data1, $data2)
    {
        $this->db->insert('bq_pinjaman', $data1);
        $this->db->insert('pinjaman_detail', $data2);
        return;   
    }

    function updatePinjamanId($id, $data1, $data2)
    {
        $this->db->where('id_pinjaman', $id);
        $this->db->update('bq_pinjaman', $data1);
        $this->db->where('pinjaman_id', $id);
        $this->db->update('pinjaman_detail', $data2); 
        return;
    }

    function approvePencairan($id_pinjaman, $data1, $data2, $data3)
    {
        $this->db->insert('bq_transaksi', $data1);
        $this->db->where('id_pinjaman', $id_pinjaman);
        $this->db->update('bq_pinjaman', $data2);
        $this->db->where('pinjaman_id', $id_pinjaman);
        $this->db->update('pinjaman_detail', $data3);
        return;
    }

    function approveOperasional($id, $data)
    {
        $this->db->where('serialNumber', $id);
        $this->db->update('bq_transaksi', $data);
        return;
    }

    function updateBayarAngsuran($id, $data1, $data2, $extra)
    {
        $this->db->insert('bq_transaksi', $data1);
        $this->db->where('pinjaman_id', $id);
        $this->db->update('pinjaman_detail', $data2);
        $this->db->where('id_rekening', $extra['id_rekening']);
        $this->db->update('bq_rekening', $extra);
        return;
    }

    function updateApprovalPenarikan($rekening, $serial, $data1, $data2)
    {
       $this->db->where('id_rekening', $rekening);
       $this->db->update('bq_rekening', $data1);
       $this->db->where('serialNumber', $serial);
       $this->db->update('bq_transaksi', $data2);
       return;
    }
    
    

                        
}


/* End of file Transaction_model.php and path /application/models/Transaction_model.php */
