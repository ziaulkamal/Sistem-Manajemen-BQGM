<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Internal_model extends CI_Model 
{
    function getKas()
    {
        $this->db->select('nilai');
        $this->db->where('nama', 'kas');
        $query = $this->db->get('bq_master')->row();
        return $query->nilai;
        
    }

    function getBunga()
    {
        $this->db->select('nilai');
        $this->db->where('nama', 'bunga');
        $query = $this->db->get('bq_master')->row();
        return $query->nilai;
    }

    function getZakat()
    {
        $this->db->select('nilai');
        $this->db->where('nama', 'zakat');
        $query = $this->db->get('bq_master')->row();
        return $query->nilai;
    }

    function updateKas($value)
    {
        $data['nilai'] = $value;
        $this->db->where('nama', 'kas');
        $this->db->update('bq_master', $data);
        return;
        
    }

    
    function getAllUsers()
    {
        $this->db->order_by('id_admin', 'ASC');
        return $this->db->get('administrator');        
    }

    function getByUsername($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('administrator')->row();   
    }

    function getById($id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->get('administrator')->row();
    }

    function getUserWithLevel($level)
    {
        $this->db->where('levelAkses', $level);
        return $this->db->get('administrator');
        
    }

    function insertUsers($data)
    {
        return $this->db->insert('administrator', $data);      
    }

    function updateUsers($username, $data)
    {
        $this->db->where('username', $username);
        return $this->db->update('administrator', $data);
    }

    function removeUsers($id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->delete('administrator');   
    }

    function insertAnggotas($data1,$data2)
    {
        $this->db->insert('bq_anggota', $data1);
        $this->db->insert('anggota_detail', $data2);
        return ;
    }

    function updateAnggotas($id,$data1,$data2)
    {
        $this->db->where('id_anggota', $id);
        $this->db->update('bq_anggota', $data1);

        $this->db->where('anggota_id', $id);
        $this->db->update('anggota_detail', $data2);

        return ;
    }

    function updateOnlyNorekAnggota($id)
    {
       $data['rekening'] = "";
       $this->db->update('anggota_detail', $data);
       return; 
    }

    function removeAnggotas($id)
    {
        $data = array(
            'statusAnggota' => 2, 
            'lastUpdate' => date('Y-m-d'), 
        );

        $this->db->where('id_anggota', $id);
        $this->db->update('bq_anggota', $data);
        return;
        
        
    }


    function getAnggotas($status)
    {
        $this->db->select('*');
        $this->db->join('anggota_detail', 'anggota_detail.anggota_id = bq_anggota.id_anggota');
        $this->db->where('bq_anggota.statusAnggota', $status);
        $this->db->order_by('bq_anggota.id_anggota', 'DESC');
        return $this->db->get('bq_anggota');    
    }

    function getAnggotaAndRekening()
    {
        $this->db->select('*');
        $this->db->join('anggota_detail', 'anggota_detail.anggota_id = bq_anggota.id_anggota');
        $this->db->join('bq_rekening', 'bq_rekening.anggota_id = bq_anggota.id_anggota');
        $this->db->order_by('bq_anggota.id_anggota', 'DESC');
        return $this->db->get('bq_anggota'); 
    }

    function getAnggotaById($id)
    {
        $this->db->select('*');
        $this->db->join('anggota_detail', 'anggota_detail.anggota_id = bq_anggota.id_anggota');         
        $this->db->where('bq_anggota.id_anggota', $id);
        return $this->db->get('bq_anggota')->row();
        
    }

    function openRekening($id, $norek)
    {
        $data['rekening'] = $norek;
        $this->db->where('anggota_id', $id);
        $this->db->update('anggota_detail', $data);

        $data2 = array(
            'id_rekening' => $norek, 
            'anggota_id' => $id, 
            'lastUpdate' => date('Y-m-d'), 
        );
        $this->db->insert('bq_rekening', $data2);
        return;
        
    }

    function getRekeningByNorek($norek)
    {
        $this->db->select('*');
        $this->db->where('bq_rekening.id_rekening', $norek);
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_rekening.anggota_id');
        return $this->db->get('bq_rekening')->row();
    }

    function getRekening()
    {
        $this->db->select('*');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_rekening.anggota_id');
        return $this->db->get('bq_rekening');
    }

    function removeRekening($norek)
    {
       $this->db->where('id_rekening', $norek);
       return $this->db->delete('bq_rekening');
           
    }

    function getLogTrx($jenis)
    {
        $this->db->where('kodeRelasi', $jenis);
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('bq_transaksi');
    }

    function getLogPembiayaan()
    {
        $this->db->where('type', 'pembiayaan');
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('bq_transaksi');
    }

    function getDataPinjamanKaryawan()
    {
       $this->db->select('*');
       $this->db->join('administrator', 'administrator.id_admin = ks_karyawan.admin_id');
       $this->db->order_by('ks_karyawan.admin_id', 'ASC');
       
       return $this->db->get('ks_karyawan');
        
    }

    function getDataPinjamanKaryawanBySerial($serial)
    {
        $this->db->select('*');
        $this->db->join('administrator', 'administrator.id_admin = ks_karyawan.admin_id');
        $this->db->where('serial', $serial);
        return $this->db->get('ks_karyawan')->row();
    }

    function removePinjamanKaryawan($serial)
    {
       $this->db->where('serial', $serial);
       $this->db->delete('ks_karyawan');
       return;
       
    }

    function getRekeningDatas()
    {
        $this->db->select('bq_anggota.namaAnggota, bq_rekening.id_rekening ,bq_rekening.anggota_id ,bq_rekening.s_pokok ,bq_rekening.s_wajib ,bq_rekening.s_sukarela ,bq_rekening.status_pinjaman ,bq_rekening.lastUpdate ');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_rekening.anggota_id');
        $this->db->order_by('bq_rekening.id_rekening', 'DESC');
        return $this->db->get('bq_rekening')->result();
        
    }

    function getLogBySerial($serial)
    {
       $this->db->where('serialNumber', $serial);
       return $this->db->get('bq_transaksi')->row();
    }

    function checkPinjamanKaryawan($id,$status)
    {
        $this->db->join('administrator', 'administrator.id_admin = ks_karyawan.admin_id');
        $this->db->where('ks_karyawan.admin_id', $id);
        $this->db->where('status', $status);
        return $this->db->get('ks_karyawan');
    }

    function data_anggota_pinjaman()
    {
        $this->db->select('*');
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        return $this->db->get('bq_pinjaman');
        
    }

    function getDataPinjamanById($id)
    {
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('bq_pinjaman.anggota_id', $id);
        return $this->db->get('bq_pinjaman');
    }

    function getDataPinjamanBySerial($id)
    {
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('bq_rekening', 'bq_rekening.anggota_id = bq_pinjaman.anggota_id');
        
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('bq_pinjaman.id_pinjaman', $id);
        return $this->db->get('bq_pinjaman');
    }

    function checkPendingPinjaman($id)
    {
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('bq_pinjaman.anggota_id', $id);
        $this->db->where('approvalManajer', 0);
        return $this->db->get('bq_pinjaman');
    }

    function checkPendingPinjamanAll()
    {
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('approvalManajer', 0);
        return $this->db->get('bq_pinjaman');
    }

    function dokumenDataInsert($data)
    {
        return $this->db->insert('bq_dokumen', $data);
        
    }

    function removePinjamanId($id)
    {
        $this->db->where('id_pinjaman', $id);
        return $this->db->delete('bq_pinjaman');
        
    }

    function getAllDokumenAnggotas()
    {
        $this->db->select('*');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_dokumen.anggota_id');
        return $this->db->get('bq_dokumen');
        
    }

    function getDokumenDataById($id)
    {
        $this->db->select('*');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_dokumen.anggota_id');
        $this->db->where('bq_dokumen.id_dokumen', $id);
        return $this->db->get('bq_dokumen')->row();        
    }

    function getAnggotaRekeningById($id)
    {
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_rekening.anggota_id');
        $this->db->where('bq_rekening.anggota_id', $id);
        return $this->db->get('bq_rekening')->row(); 
    }

    function insertDetailDokumen($data)
    {
        return $this->db->insert('dokumen_detail', $data);
    }

    function getPendingOperasional()
    {
        $this->db->where('is_operasional', 1);
        $this->db->where('kodeRelasi', 'manajer');
        return $this->db->get('bq_transaksi');
    }

    function getSerialNumber($id)
    {
        $this->db->where('serialNumber', $id);
        return $this->db->get('bq_transaksi')->row();  
    }

    function removeSerialNumber($id)
    {
        $this->db->where('serialNumber', $id);
        return $this->db->delete('bq_transaksi');
    }

    function getAllDataPembiayaan()
    {
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('pinjaman_detail.statusPinjaman', 1);
        return $this->db->get('bq_pinjaman');
    }

    function getPinjamanById($id)
    {
        $this->db->join('bq_dokumen', 'bq_dokumen.id_dokumen = bq_pinjaman.dokumen_id');
        $this->db->join('dokumen_detail', 'dokumen_detail.dokumen_id = bq_dokumen.id_dokumen');
        $this->db->join('pinjaman_detail', 'pinjaman_detail.pinjaman_id = bq_pinjaman.id_pinjaman');
        $this->db->join('bq_anggota', 'bq_anggota.id_anggota = bq_pinjaman.anggota_id');
        $this->db->join('bq_rekening', 'bq_rekening.anggota_id = bq_pinjaman.anggota_id');
        
        $this->db->join('administrator', 'administrator.id_admin = pinjaman_detail.aoBertugas');
        $this->db->where('bq_pinjaman.id_pinjaman', $id);
        return $this->db->get('bq_pinjaman')->row();
    }

    function updateRekeningByNorek($id)
    {
        $data['status_pinjaman'] = 1;
        $this->db->where('id_rekening', $id);
        $this->db->update('bq_rekening', $data);
        return;
    }

    function getPendingPenarikan()
    {
        $this->db->where('is_simpanan', 1);
        $this->db->where('kodeRelasi', 'operasional');
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('bq_transaksi');
        
    }
    
    function getTransaksiByUserId($id, $serial)
    {
        $this->db->join('bq_rekening', 'bq_rekening.anggota_id = bq_transaksi.is_anggota');
        $this->db->where('is_anggota', $id);
        $this->db->where('serialNumber', $serial);
        return $this->db->get('bq_transaksi')->row();  
    }

    function beforeCetakInvoice($jenis)
    {

        switch ($jenis) {
            case 'setoran':
                $this->db->where('type', 'setoran');
                $this->db->where('printInvoice', 0);
                $this->db->where('kodeRelasi', 'operasional');
                
                break;
            case 'pembiayaan':
                $this->db->where('type', 'pembiayaan');
                $this->db->where('printInvoice', 0);
                
                break;
            case 'simpanan':
                $this->db->where('is_simpanan', 1);
                $this->db->where('type', 'simpok');
                $this->db->or_where('type', 'simwa');
                $this->db->or_where('type', 'simka');
                $this->db->where('printInvoice', 0);
                
                break;
            case 'penarikan':
                $this->db->where('is_simpanan', 1);                
                $this->db->where('type', 'tsimpok');
                $this->db->or_where('type', 'tsimwa');
                $this->db->or_where('type', 'tsimka');
                $this->db->where('kodeRelasi', 'teller');
                
                $this->db->where('printInvoice', 0);
                
                break;
            case 'angsuran':
                $this->db->where('is_angsuran', 1);                
                $this->db->where('type', 'angsuran');
                $this->db->where('printInvoice', 0);
                break;

            case 'pinjaman':
                $this->db->where('is_pinjaman', 1);                
                // $this->db->where('is_anggota', NULL);                
                $this->db->where('type', 'pinjaman');
                $this->db->where('printInvoice', 0);
                break;

        }
        return $this->db->get('bq_transaksi');
        
    }

    function updateBySerial($serial, $setUpdate)
    {
        $this->db->where('serialNumber', $serial);
        $this->db->update('bq_transaksi', $setUpdate);
        return;
    }

    function getNotifikasi()
    {
        $this->db->where('type', 'pembiayaan');
        $this->db->where('printInvoice', 0);
        $pembiyaan = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'angsuran');
        $this->db->where('printInvoice', 0);
        $angsuran = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'simpok');
        $this->db->where('printInvoice', 0);
        $simpok = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'simwa');
        $this->db->where('printInvoice', 0);
        $simwa = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'simka');
        $this->db->where('printInvoice', 0);
        $simka = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'tsimpok');
        $this->db->where('printInvoice', 0);
        $this->db->where('kodeRelasi', 'teller');
        $tsimpok = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'tsimwa');
        $this->db->where('printInvoice', 0);
        $this->db->where('kodeRelasi', 'teller');
        $tsimwa = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'tsimka');
        $this->db->where('printInvoice', 0);
        $this->db->where('kodeRelasi', 'teller');
        $tsimka = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'setoran');
        $this->db->where('printInvoice', 0);
        $this->db->where('kodeRelasi', 'operasional');
        $setoran = $this->db->get('bq_transaksi')->num_rows();

        $this->db->where('type', 'pinjaman');
        $this->db->where('printInvoice', 0);
        $pinjaman = $this->db->get('bq_transaksi')->num_rows();

        $count = $pembiyaan + $angsuran + $simpok + $simwa + $simka + $tsimpok + $tsimwa + $tsimka + $setoran + $pinjaman;

        return $count;
    }

    function getDetailLastTrxAnggotaId($id)
    {
        $this->db->where('type', 'simpok');
        $this->db->or_where('type', 'simwa');
        $this->db->or_where('type', 'simka');
        $this->db->where('is_anggota', $id);
        $this->db->order_by('id_transaksi', 'DESC');
        return $this->db->get('bq_transaksi', 5, 0)->result();
        
        
    }
    

                        
}


/* End of file Internal_model.php and path /application/models/Internal_model.php */
