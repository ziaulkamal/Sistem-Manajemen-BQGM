<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Dashboard';
$route['404_override'] = 'Config/_404';


// Manajemen Halaman Manajer
$route['user']                                                      = 'Manager/Main/users';
$route['user/add']                                                  = 'Manager/Main/users_add';
$route['user/add/process']                                          = 'Manager/Main/save_users';
$route['user/edit/(:any)']                                          = 'Manager/Main/edit_users/$1';
$route['user/update/process/(:any)']                                = 'Manager/Main/update_users/$1';
$route['user/delete/process/(:any)']                                = 'Manager/Main/delete_users/$1';

$route['anggota']                                                   = 'Operasional/Main/data_anggota';
$route['anggota/disabled']                                          = 'Operasional/Main/anggota_keluar';
$route['anggota/add']                                               = 'Operasional/Main/add_anggota';
$route['anggota/add/process']                                       = 'Operasional/Main/save_anggota';
$route['anggota/edit/(:any)']                                       = 'Operasional/Main/edit_anggota/$1';
$route['anggota/delete/(:any)']                                     = 'Operasional/Main/delete_anggota/$1';
$route['anggota/update/process/(:any)']                             = 'Operasional/Main/update_anggota/$1';
$route['anggota/rekening/process/(:any)']                           = 'Operasional/Main/add_rekening/$1';
$route['anggota/rekening']                                          = 'Operasional/Main/rekening_anggota';
$route['anggota/rekening/invoice/(:any)']                           = 'Operasional/Main/invoice_rekening/$1';
$route['anggota/rekening/close/(:any)']                             = 'Operasional/Main/close_rekening/$1';


$route['operasional/uang_masuk']                                    = 'Operasional/Main/TrxOperasional_masuk';
$route['operasional/uang_keluar']                                   = 'Operasional/Main/TrxOperasional_keluar';
$route['operasional/uang_belanja']                                  = 'Operasional/Main/TrxOperasional_belanja';
$route['operasional/process_trx/(:any)']                            = 'Operasional/Main/processTrxOprasional/$1';
$route['operasional/pengajuan_pinjaman']                            = 'Operasional/Main/pengajuan_pinjaman';
$route['operasional/pengajuan_pinjaman/process']                    = 'Operasional/Main/process_pinjaman';
$route['operasional/data_pinjaman']                                 = 'Operasional/Main/data_pinjaman_karyawan';
$route['operasional/data_pinjaman/setujui/(:any)']                  = 'Operasional/Main/setujui_pinjaman/$1';
$route['operasional/data_pinjaman/tolak/(:any)']                    = 'Operasional/Main/tolak_pinjaman_karyawan/$1';
$route['operasional/data_pinjaman/hapus/(:any)']                    = 'Operasional/Main/hapus_pinjaman/$1';
$route['operasional/data_pinjaman/update_nilai/(:any)']             = 'Operasional/Main/update_pinjaman/$1';
$route['operasional/data_pinjaman/process_update/(:any)']           = 'Operasional/Main/process_update_pinjaman/$1';
$route['operasional/data_pinjaman/bayar_pinjaman/(:any)/(:any)']    = 'Operasional/Main/bayar_pinjaman/$1/$2';
$route['operasional/bayar_pinjaman/setoran/(:any)']                 = 'Operasional/Main/process_bayar_pinjaman/$1';
$route['operasional/approval/penarikan']                            = 'Operasional/Main/approvalPenarikanSimpanan';
$route['operasional/approval/penarikan/process/(:any)/(:any)/(:any)'] = 'Operasional/Main/process_approvalPenarikanSimpanan/$1/$2/$3';
$route['operasional/approval/penarikan/reject/(:any)']              = 'Operasional/Main/reject_approvalPenarikan/$1';

$route['teller/invoice/(:any)/datas']                               = 'Teller/Main/cetakInvoiceDatas/$1';
$route['teller/invoice/(:any)/(:any)/datas']                               = 'Teller/Main/updateCetakInvoice/$1/$2';
$route['log/transaksi_operasional']                                 = 'Operasional/Main/getLog_operasional';

$route['setoran']                                                   = 'Teller/Main/data_simpanan_anggota';
$route['setoran/update/(:any)']                                     = 'Teller/Main/update_simpanan_anggota/$1';
$route['setoran/process/(:any)']                                    = 'Teller/Main/process_update_simpanan/$1';
$route['setoran/invoice/(:any)/(:any)/(:any)']                      = 'Teller/Main/invoice/$1/$2/$3';
$route['penarikan/invoice/(:any)/(:any)/(:any)']                    = 'Teller/Main/invoice/$1/$2/$3';
$route['penarikan/update/(:any)']                                   = 'Teller/Main/penarikan_simpanan/$1';
$route['penarikan/process/(:any)']                                  = 'Teller/Main/process_penarikan_simpanan/$1';

$route['pembiayaan']                                                ='Pembiayaan/Main/data_anggota_pembiayaan';
$route['pembiayaan/data_anggota']                                   ='Pembiayaan/Main/pengajuan_anggota';
$route['pembiayaan/data_anggota/recover/(:any)']                    ='Pembiayaan/Main/pengajuanLama_detail/$1';
$route['pembiayaan/data_anggota/update/(:any)/(:any)']              ='Pembiayaan/Main/pengajuanLama_action/$1/$2';
$route['pembiayaan/data_anggota/update/process/(:any)/(:any)']      ='Pembiayaan/Main/pengajuanLama_process/$1/$2';

$route['dokumen']                                                   = 'Pembiayaan/Main/dokumen_anggota';
$route['dokumen/pinjaman/(:any)/(:any)/(:any)']                     = 'Pembiayaan/Main/step_dokumen/$1/$2/$3';
$route['dokumen/pinjaman/process/(:any)/(:any)/(:any)']             = 'Pembiayaan/Main/process_step_dokumen/$1/$2/$3';

$route['pengajuan/pinjaman/(:any)/(:any)']                          = 'Pembiayaan/Main/step_pengajuan_pinjaman/$1/$2';
$route['pengajuan/pinjaman/process/(:any)/(:any)']                  = 'Pembiayaan/Main/process_step_pinjaman/$1/$2';

$route['dokumen/survey/(:any)/(:any)']                              = 'Pembiayaan/Main/step_detail_dokumen/$1/$2';
$route['dokumen/survey/process/(:any)/(:any)']                      = 'Pembiayaan/Main/process_step_detail_dokumen/$1/$2';

$route['pinjaman/delete/(:any)']                                    = 'Pembiayaan/Main/hapus_pinjaman/$1';

$route['pinjaman_karyawan/pengajuan_mandiri']                       = 'AccountOfficer/Main/pengajuan_pinjaman';
$route['pinjaman_karyawan/process']                                 = 'AccountOfficer/Main/process_pinjaman';

$route['angsuran/data_']                                             = 'Teller/Main/data_anggsuran_anggota';
$route['angsuran/update/(:any)/(:any)']                             = 'Teller/Main/update_data_angsuran/$1/$2';
$route['angsuran/update/process/(:any)/(:any)']                     = 'Teller/Main/process_update_angsuran/$1/$2';

$route['angsuran/invoice/(:any)/(:any)']                            = 'Teller/Main/invoiceAngsuran/$1/$2';


$route['(:any)/required/approval']                                  = 'Manager/Main/pendingApproval/$1';
$route['required/approval/process/(:any)/(:any)']                   = 'Manager/Main/processApproval/$1/$2';
$route['log/unit/(:any)']                                           = 'Manager/Main/logAllUnit/$1';

$route['log/detail/LogAll_transaksi']                                = 'Teller/Main/log_transaksi_simpanan/';

$route['operasional/hapus/process/(:any)']                          = 'Manager/Main/removeSerial/$1';

//-----------------------------------------------------------------------------------------------------------------//
$route['laporan/simpanan/_lihat']                                   = 'Laporan/Main/laporan_simpanan';
$route['laporan/simpanan/date/_lihat']                              = 'Laporan/Main/laporan_simpanan_frequency';

$route['laporan/angsuran/_lihat']                                   = 'Laporan/Main/laporan_angsuran';
$route['laporan/angsuran/date/_lihat']                              = 'Laporan/Main/laporan_angsuran_frequency';

$route['laporan/pembiayaan/_lihat']                                 = 'Laporan/Main/laporan_pembiayaan';
$route['laporan/pembiayaan/date/_lihat']                            = 'Laporan/Main/laporan_pembiayaan_frequency';

$route['laporan/operasional/masuk/_lihat']                          = 'Laporan/Main/laporan_operasional_masuk';
$route['laporan/operasional/masuk/date/_lihat']                     = 'Laporan/Main/laporan_operasional_masuk_frequency';

$route['laporan/operasional/keluar/_lihat']                          = 'Laporan/Main/laporan_operasional_keluar';
$route['laporan/operasional/keluar/date/_lihat']                     = 'Laporan/Main/laporan_operasional_keluar_frequency';

$route['laporan/angsuran/pending/_lihat']                           = 'Laporan/Main/laporan_angsuranPending';
$route['laporan/angsuran/pending/(:any)/_lihat']                    = 'Laporan/Main/laporan_angsuranPendings/$1';
$route['laporan/tracking/_lihat']                                   = 'Laporan/Main/trackingSetoranAll';
$route['laporan/tracking/date/_lihat']                               = 'Laporan/Main/trackingSetoranAll_frequency';


/*----------------------------------------------------------------------------------------------------- */
$route['buat_surat/(:any)']                                         = 'Laporan/Document/createSurat/$1';
$route['doc/daftar_surat']                                          = 'Laporan/Document/daftar_surat';
$route['doc/detail_surat/(:any)/(:any)']                            = 'Laporan/Document/surat_detail/$1/$2';
/*----------------------------------------------------------------------------------------------------- */
$route['doc/mpp/(:any)']                                            = 'Laporan/Document/createMpp/$1';
$route['doc/tabelAngsuran/(:any)']                                  = 'Laporan/Document/createTabelAngsuran/$1';


$route['login']                                                     = 'Auth/index';
$route['process_login']                                             = 'Auth/process_login';
$route['logout']                                                    = 'Auth/logout';
$route['custom_me.css']                                             = 'Config/custom_css';
$route['custom_me_login.css']                                       = 'Config/custom_css_2';
$route['custom_me_login_compile.css']                               = 'Config/css_2_compiler';

$route['konfigurasi']                                               = 'Config/setup_master';
$route['ps/konfigurasi']                                            = 'Config/save_master';
$route['konfigurasi/edit/(:any)']                                   = 'Config/edit_master/$1';
$route['konfigurasi/delete/(:any)']                                 = 'Config/delete_master/$1';
$route['ps/konfigurasi/(:any)']                                     = 'Config/update_master/$1';

$route['update_profile/(:any)']                                     = 'Config/updateProfil/$1';
$route['update_profile/process/(:any)']                              = 'Config/processUpdateProfil/$1';

$route['translate_uri_dashes'] = FALSE;
