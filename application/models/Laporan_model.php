<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Laporan_model extends CI_Model 
{

    function getRekeningAll()
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = anggota_detail.anggota_id');
        $this->db->join('bq_rekening', 'bq_rekening.id_rekening = anggota_detail.rekening');
        return $this->db->get('anggota_detail');
        
    }

    function getRekeningAll_sort($dateFrom, $dateWhere)
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = anggota_detail.anggota_id');
        $this->db->join('bq_rekening', 'bq_rekening.id_rekening = anggota_detail.rekening');
        $this->db->where('bq_rekening.lastUpdate >=', $dateFrom);
        $this->db->where('bq_rekening.lastUpdate <=', $dateWhere);
        
        
        return $this->db->get('anggota_detail');
        
    }

    function getAngsuranAll()
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_transaksi.is_anggota');
        $this->db->where('type', 'angsuran');
        $this->db->order_by('id_transaksi', 'DESC');
        
        return $this->db->get('bq_transaksi');
    }

    function getAngsuranAll_sort($dateFrom, $dateWhere)
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_transaksi.is_anggota');
        $this->db->where('type', 'angsuran');
        $this->db->where('bq_transaksi.lastUpdate_t >=', $dateFrom);
        $this->db->where('bq_transaksi.lastUpdate_t <=', $dateWhere);
        $this->db->order_by('id_transaksi', 'DESC');
        
        return $this->db->get('bq_transaksi');
    }

    function getPembiayaan()
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('bq_pinjaman.approvalManajer', 1);
        $this->db->order_by('bq_pinjaman.lastUpdate_p', 'DESC');
        return $this->db->get('bq_pinjaman');
    }

    function getPembiayaan_sort($aoSelect, $dateFrom, $dateWhere)
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        if ($aoSelect != '') {
            $this->db->where('pinjaman_detail.aoBertugas', $aoSelect);
            
        }
        $this->db->where('bq_pinjaman.approvalManajer', 1);
        $this->db->order_by('bq_pinjaman.lastUpdate_p', 'DESC');
        $this->db->where('bq_pinjaman.lastUpdate_p >=', $dateFrom);
        $this->db->where('bq_pinjaman.lastUpdate_p <=', $dateWhere);
        return $this->db->get('bq_pinjaman');
    }

    function getPendingAngsuranAll()
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('bq_pinjaman.approvalManajer', 1);
        $this->db->order_by('bq_pinjaman.lastUpdate_p', 'DESC');
        return $this->db->get('bq_pinjaman');
    }

    function getPendingAngsuranByAo($id)
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('pinjaman_detail.aoBertugas', $id);
        $this->db->where('bq_pinjaman.approvalManajer', 1);
        $this->db->order_by('bq_pinjaman.lastUpdate_p', 'DESC');
        return $this->db->get('bq_pinjaman');
    }

    function getOperasionalMasukAll()
    {
        $this->db->where_in('type', ['masuk', 'simpok', 'simwa', 'simka','setoran','angsuran']);
        $this->db->where_in('kodeRelasi', ['operasional', 'teller']);
        $this->db->or_where('kodeRelasi', 'teller');
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('bq_transaksi');
        
    }
    function getOperasionalMasukAll_sort($dateFrom, $dateWhere)
    {
        $this->db->where_in('type', ['masuk', 'simpok', 'simwa', 'simka','setoran','angsuran']);
        $this->db->where_in('kodeRelasi', ['operasional', 'teller']);
        $this->db->where('lastUpdate_t >=', $dateFrom);
        $this->db->where('lastUpdate_t <=', $dateWhere);
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->last_query();

        return $this->db->get('bq_transaksi');
        
    }

    function getOperasionalKeluarAll()
    {
        $this->db->where_in('type', ['keluar','pembiayaan','belanja', 'pinjaman', 'tsimpok', 'tsimwa', 'tsimka']);
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('bq_transaksi');
        
    }
    function getOperasionalKeluarAll_sort($dateFrom, $dateWhere)
    {
        $this->db->where_in('type', ['keluar','pembiayaan','belanja', 'pinjaman', 'tsimpok', 'tsimwa', 'tsimka']);
        $this->db->where('lastUpdate_t >=', $dateFrom);
        $this->db->where('lastUpdate_t <=', $dateWhere);
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->last_query();

        return $this->db->get('bq_transaksi');
        
    }

    function getAO()
    {
        $this->db->where('levelAkses', 'ao');
        return $this->db->get('administrator');
    }

    function getSetoranOnly()
    {
        $this->db->where_in('type', ['simpok', 'simwa', 'simka']);
        $this->db->where('kodeRelasi', 'teller');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_transaksi.is_anggota');
        
        $this->db->order_by('bq_transaksi.is_anggota', 'ASC');
        $this->db->order_by('id_transaksi', 'DESC');
        
        return $this->db->get('bq_transaksi');
    }

    function getPlafonByPinjamanId($id)
    {
        $this->db->where('id_pinjaman', $id);
        return $this->db->get('bq_pinjaman')->row();
        
    }
}


/* End of file Laporan_model.php and path /application/models/Laporan_model.php */
