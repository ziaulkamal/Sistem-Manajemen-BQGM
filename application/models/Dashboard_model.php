<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Dashboard_model extends CI_Model 
{

    function totalHutang()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['pembiayaan', 'pinjaman']);
        $result = $this->db->get('bq_transaksi')->row();
        return $result->nilaiTransaksi;
    }

    function totalHutang_persentase()
    {
        // Hitung total nilai transaksi pada bulan ini
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['pembiayaan', 'pinjaman']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01'));
        $this->db->where('lastUpdate_t <=', date('Y-m-t'));
        $result_bulan_ini = $this->db->get('bq_transaksi')->row();
        $total_bulan_ini = $result_bulan_ini->nilaiTransaksi;

        // Hitung total nilai transaksi pada bulan sebelumnya
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['pembiayaan', 'pinjaman']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01', strtotime('-1 month')));
        $this->db->where('lastUpdate_t <=', date('Y-m-t', strtotime('-1 month')));
        $result_bulan_sebelumnya = $this->db->get('bq_transaksi')->row();
        $total_bulan_sebelumnya = $result_bulan_sebelumnya->nilaiTransaksi;

        // Hitung persentase perubahan
        if ($total_bulan_sebelumnya > 0) {
            $persentase_perubahan = (( $total_bulan_ini - $total_bulan_sebelumnya ) / $total_bulan_sebelumnya) * 100;
        } else {
            $persentase_perubahan = 0;
        }

        return $persentase_perubahan;
    }


    function totalPiutang()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['setoran', 'angsuran']);
        $result = $this->db->get('bq_transaksi')->row();
        return $result->nilaiTransaksi;
    }

    function totalPiutang_persentase()
    {
        // Hitung total nilai piutang
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['setoran', 'angsuran']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01'));
        $this->db->where('lastUpdate_t <=', date('Y-m-t'));
        $result_bulan_ini = $this->db->get('bq_transaksi')->row();
        $total_bulan_ini = $result_bulan_ini->nilaiTransaksi;

        // Hitung persentase piutang
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['setoran', 'angsuran']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01', strtotime('-1 month')));
        $this->db->where('lastUpdate_t <=', date('Y-m-t', strtotime('-1 month')));
        $result_bulan_sebelumnya = $this->db->get('bq_transaksi')->row();
        $total_bulan_sebelumnya = $result_bulan_sebelumnya->nilaiTransaksi;

        // Hitung persentase perubahan
        if ($total_bulan_sebelumnya > 0) {
            $persentase_perubahan = (( $total_bulan_ini - $total_bulan_sebelumnya ) / $total_bulan_sebelumnya) * 100;
        } else {
            $persentase_perubahan = 0;
        }

        return $persentase_perubahan;
    }
    
    function totalKas()
    {
        $this->db->select_sum('nilai');
        $this->db->where('nama', 'kas');
        $result = $this->db->get('bq_master')->row();
        return $result->nilai;
    }

    function nilaiPembiayaan()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where('type', 'pembiayaan');
        $result = $this->db->get('bq_transaksi')->row();
        return $result->nilaiTransaksi;
    }


    function nilaiPembiayaan_persentase()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where('type', 'pembiayaan');
        $this->db->where('lastUpdate_t >=', date('Y-m-01'));
        $this->db->where('lastUpdate_t <=', date('Y-m-t'));
        $result_bulan_ini = $this->db->get('bq_transaksi')->row();
        $total_bulan_ini = $result_bulan_ini->nilaiTransaksi;

        $this->db->select_sum('nilaiTransaksi');
        $this->db->where('type', 'pembiayaan');
        $this->db->where('lastUpdate_t >=', date('Y-m-01', strtotime('-1 month')));
        $this->db->where('lastUpdate_t <=', date('Y-m-t', strtotime('-1 month')));
        $result_bulan_sebelumnya = $this->db->get('bq_transaksi')->row();
        $total_bulan_sebelumnya = $result_bulan_sebelumnya->nilaiTransaksi;

        // Hitung persentase perubahan
        if ($total_bulan_sebelumnya > 0) {
            $persentase_perubahan = (( $total_bulan_ini - $total_bulan_sebelumnya ) / $total_bulan_sebelumnya) * 100;
        } else {
            $persentase_perubahan = 0;
        }

        return $persentase_perubahan;
    }

    function setoranAngsuran()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where('type', 'angsuran');
        $result = $this->db->get('bq_transaksi')->row();
        return $result->nilaiTransaksi;
    }

    function setoranAngsuran_persentase()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where('type', 'angsuran');
        $this->db->where('lastUpdate_t >=', date('Y-m-01'));
        $this->db->where('lastUpdate_t <=', date('Y-m-t'));
        $result_bulan_ini = $this->db->get('bq_transaksi')->row();
        $total_bulan_ini = $result_bulan_ini->nilaiTransaksi;

        $this->db->select_sum('nilaiTransaksi');
        $this->db->where('type', 'angsuran');
        $this->db->where('lastUpdate_t >=', date('Y-m-01', strtotime('-1 month')));
        $this->db->where('lastUpdate_t <=', date('Y-m-t', strtotime('-1 month')));
        $result_bulan_sebelumnya = $this->db->get('bq_transaksi')->row();
        $total_bulan_sebelumnya = $result_bulan_sebelumnya->nilaiTransaksi;

        // Hitung persentase perubahan
        if ($total_bulan_sebelumnya > 0) {
            $persentase_perubahan = (( $total_bulan_ini - $total_bulan_sebelumnya ) / $total_bulan_sebelumnya) * 100;
        } else {
            $persentase_perubahan = 0;
        }

        return $persentase_perubahan;
    }

    function pengeluaranBulanIni()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['keluar', 'belanja', 'pembiayaan', 'pinjaman','tsimpok','tsimwa','tsimka']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01'));
        $this->db->where('lastUpdate_t <=', date('Y-m-t'));
        $result = $this->db->get('bq_transaksi')->row();
        return $result->nilaiTransaksi;
    }
    
    function pengeluaranBulanIni_persentase()
    {
        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['keluar', 'belanja', 'pembiayaan', 'pinjaman','tsimpok','tsimwa','tsimka']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01'));
        $this->db->where('lastUpdate_t <=', date('Y-m-t'));
        $result_bulan_ini = $this->db->get('bq_transaksi')->row();
        $total_bulan_ini = $result_bulan_ini->nilaiTransaksi;

        $this->db->select_sum('nilaiTransaksi');
        $this->db->where_in('type', ['keluar', 'belanja', 'pembiayaan', 'pinjaman','tsimpok','tsimwa','tsimka']);
        $this->db->where('lastUpdate_t >=', date('Y-m-01', strtotime('-1 month')));
        $this->db->where('lastUpdate_t <=', date('Y-m-t', strtotime('-1 month')));
        $result_bulan_sebelumnya = $this->db->get('bq_transaksi')->row();
        $total_bulan_sebelumnya = $result_bulan_sebelumnya->nilaiTransaksi;

        // Hitung persentase perubahan
        if ($total_bulan_sebelumnya > 0) {
            $persentase_perubahan = (( $total_bulan_ini - $total_bulan_sebelumnya ) / $total_bulan_sebelumnya) * 100;
        } else {
            $persentase_perubahan = 0;
        }

        return $persentase_perubahan;
    }

    function totalAnggota()
    {
        $this->db->where('statusAnggota', 1);
        $result = $this->db->get('bq_anggota')->num_rows();
        return $result;
    }

    function totalAnggota_persentase()
    {
        $this->db->where('statusAnggota', 1);   
        $this->db->where('lastUpdate >=', date('Y-m-01'));
        $this->db->where('lastUpdate <=', date('Y-m-t'));
        $total_bulan_ini = $this->db->get('bq_anggota')->num_rows();

        $this->db->where('statusAnggota', 1);  
        $this->db->where('lastUpdate >=', date('Y-m-01', strtotime('-1 month')));
        $this->db->where('lastUpdate <=', date('Y-m-t', strtotime('-1 month')));
        $total_bulan_sebelumnya = $this->db->get('bq_anggota')->num_rows();

        // Hitung persentase perubahan
        if ($total_bulan_sebelumnya > 0) {
            $persentase_perubahan = (( $total_bulan_ini - $total_bulan_sebelumnya ) / $total_bulan_sebelumnya) * 100;
        } else {
            $persentase_perubahan = 0;
        }

        return $persentase_perubahan;
    }
    
                        
}


/* End of file Dashboard_model.php and path /application/models/Dashboard_model.php */
