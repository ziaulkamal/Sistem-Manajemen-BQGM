<div class="page-content">

<a type="button" class="btn btn-info btn-outline" onclick="printContent('printOut');"> PRINT MPP</a>
	<div class="row" id="printOut">
        <?php
            $jumlahPengajuan = $pengajuan->num_rows();
        ?>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="container-fluid d-flex justify-content-between">
						<div class="col-lg-12 ps-0">
							<img src="<?= base_url('public/login/logo.png')?>" class="wd-250" alt="">
							<h2 class="text-center">MEMO PERSETUJUAN PEMBIAYAAN</h2>
						</div>

					</div>
					<div class="container-fluid mt-5 d-flex justify-content-center w-100">
						<div class="table-responsive w-100">
							<table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="wd-250 fw-bold">Nama Account Officer</td>
                                        <td class="wd-650"><?= strtoupper($data->namaLengkap) ?></td>
                                        <td class="wd-250 fw-bold">ID Anggota</td>
                                        <td class="wd-350"><?= $data->anggota_id ?></td>
                                    </tr>
                                    <tr>
                                        <td class="wd-250 fw-bold">Nama Anggota</td>
                                        <td class="wd-650"><?= strtoupper($data->namaAnggota) ?></td>
                                        <td class="wd-250 fw-bold">ID Pinjaman</td>
                                        <td class="wd-350"><?= $data->pinjaman_id ?></td>
                                    </tr>
                                    <tr>
                                        <td class="wd-250 fw-bold">Alamat</td>
                                        <td class="wd-650"><?= strtoupper($data->alamatSekarang) ?></td>
                                        <td class="wd-250 fw-bold">Status Pengajuan</td>
                                        <td class="wd-350"><?php if ($jumlahPengajuan > 1) { echo "LAMA"; }else { echo "BARU"; } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="wd-250 fw-bold">Tanggal Survey</td>
                                        <td class="wd-650"><?= date_indo($data->tglSurvey) ?></td>
                                        <td class="wd-250 fw-bold">Pengajuan Ke</td>
                                        <td class="wd-350"><?= $jumlahPengajuan ?></td>
                                    </tr>
                                </tbody>
							</table>
                            <br />
                            <span class="mt-5 mb-5 fw-bold">Validasi Verifikasi</span>
                            <br />
                            <br />
                            <table class="table table-bordered">
                        
                          <tbody><tr>
                            <td style="" class="fw-bold">Produk Pembiayaan</td>
                            <td>Gadai Sawah</td>
                          </tr>
                          <tr>
                            <td style="width:30%; " class="fw-bold">Dokumen Jaminan/Angunan</td>
                            <td><?= strtoupper($data->jenisDokumen) ?></td>
                            <td><strong>No:</strong> <?= strtoupper($data->nomorSurat) ?></td>
                            <td><strong>Luas:</strong> <?= strtoupper($data->luasJaminan) ?></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="width:10px; " class="fw-bold">Nama Pemilik :</td>
                            <td><?= strtoupper($data->namaPemilik) ?></td>
                            <td><b>Alamat Jaminan :</b><?= strtoupper($data->alamatJaminan) ?></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="width:10px; " class="fw-bold">Kepemilikan Jaminan :</td>
                            <td><?php switch ($data->statusKepemilikan) {
                                case '1':
                                    echo "SENDIRI";
                                    break;
                                case '2':
                                    echo "ORANG TUA";
                                    break;
                                case '3':
                                    echo "PASANGAN";
                                    break;
                                
                            } ?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Pengujian kebenaran data dan informasi atas dokumen lainnya</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Lokasi/Alamat Usaha</td>
                            <td><?= strtoupper($data->lokasi) ?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Luas lahan sawah milik orang lain yang dikelola (jika ada)</td>
                            <td><?= strtoupper($data->luasSawah_lain) ?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Luas lahan sawah dalam status gadai pada pihak lain</td>
                            <td><?= strtoupper($data->luasSawah_gadai) ?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Luas Lahan Sawah sendiri yang dikelola</td>
                            <td><?= strtoupper($data->luasKelola) ?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Siapa yang mengelola sawah</td>
                            <td><?php switch ($data->kelolaSawah) {
                                case '1':
                                    echo "SENDIRI";
                                    break;
                                case '2':
                                    echo "ORANG LAIN";
                                    break;
                                
                            } ?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Hasil gabah rata-rata sekali panen/Bruto</td>
                            <td><?= number_format($data->proyeksiPanen) ?> Kg</td>
                            <td></td>
                            <td>Rp. <?= number_format($data->hargaGabah * $data->proyeksiPanen) ?></td>
                          </tr>

                        <?php if ($data->proyeksiPanen > 1080) {
                           $zakat = ($data->hargaGabah * $data->proyeksiPanen) * 0.05;
                        }else {
                            $zakat = '0';
                        } 
                        
                            $afterZakat = ($data->hargaGabah * $data->proyeksiPanen) - $zakat;
                            $afterOperasional = $afterZakat - $data->biayaOperasional;
                            $afterPenghasilan = $afterOperasional + $data->penghasilan6Bulan;
                            $afterPengeluaran = $afterPenghasilan - $data->pengeluaran6Bulan;
                        ?>

                        <tr>
                            <td style="width:10px; " class="fw-bold">Proyeksi hasil panen setelah potong zakat</td>
                            <td>5%</td>
                            <td>Rp. <?= number_format($zakat)?></td><td>Rp. <?= number_format($afterZakat)?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Biaya operasional usaha setiap panen</td>
                            <td></td>
                            <td>Rp. <?= number_format($data->biayaOperasional)?></td>

                            <td>Rp. <?= number_format($afterOperasional)?></td>

                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Penghasilan lainnya Selama 6 Bulan</td>
                            <td></td>
                            <td>Rp. <?= number_format($data->penghasilan6Bulan)?></td>

                            <td>Rp. <?= number_format($afterPenghasilan)?></td>

                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Biaya Rumah Tangga Selama 6 Bulan</td>
                            <td></td>
                            <td>Rp. <?= number_format($data->pengeluaran6Bulan)?></td>

                            <td>Rp. <?= number_format($afterPengeluaran)?></td>

                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Nisbah Bagi Hasil</td>
                            <td>Nasabah</td>
                            <td>80%</td>
                                                        <td>Rp. <?= number_format($afterOperasional * 0.8)?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold"></td>
                            <td>BQGM</td>
                            <td>20%</td>

                            <td>Rp. <?= number_format($afterOperasional * 0.2)?></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Kewajiban angsuran per panen</td>
                            <td>Angsuran Pokok Gadai (Rahn)</td>
                            <td>Rp. <?= number_format($data->pokokRahn)?></td>
                            <td>Rp. <?= number_format($data->pokokRahn / $data->tenor)?> ( Masa Panen <?= $data->tenor?>x )</td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold"></td>
                            <td>Angsuran Pokok Mudharabah (Nisbah Bagi Hasil)</td>
                            <td>Rp. <?= number_format($data->pokokMudharabah)?></td>
                            <td>Rp. <?= number_format($data->pokokMudharabah / $data->tenor)?> ( Masa Panen <?= $data->tenor?>x )</td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Rekomendasi Angsuran Pembiayaan Setiap Panen</td>
                            <td></td>
                            <td></td>
                            <td><b>Rp. <?= number_format(($afterOperasional * 0.2)+ ($data->pokokRahn / $data->tenor) + ($data->pokokMudharabah / $data->tenor))?></b></td>
                          </tr>


                          <tr>
                            <td style="width:10px; " class="fw-bold">Pendapatan Bersih setelah potong Kewajiban Angsuran/Lainnya</td>
                            <td></td>
                            <td></td>
                            <td><b>Rp. <?= number_format($afterPengeluaran - ($afterOperasional * 0.2)- ($data->pokokRahn / $data->tenor) - ($data->pokokMudharabah / $data->tenor))?></b></td>
                          </tr>
                          <tr>
                            <td style="width:10px; " class="fw-bold">Kewajiban Angsuran pinjaman saat ini di bank/lembaga keuangan lainnya</td>
                            <td></td>
                            <td></td>
                            <td>Rp. <?= number_format($data->angsuranLain6Bulan)?></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="width:10px; " class="fw-bold">Diposable Income</td>
                            <td>Rp. <?= number_format($data->di)?></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><b>IDIR (Max 70%)</b></td>
                            <td><?= number_format($data->idir)?>%</td>
                            <td></td>
                          </tr>

                          <tr>
                            <td></td>
                            <td style="width:10px; " class="fw-bold">Jumlah Total Plafon direkoemendasikan</td>
                            <td><b>Rp. <?= number_format($data->plafon)?></b></td>
                            <td></td>
                          </tr>
                        </tbody></table>
                            <br />
                            <span class="mt-5 mb-5 fw-bold">Karakteristik Nasabah</span>
                            <br />
                            <br />

                        <table class="table table-bordered">
                            
                            <tbody><tr>
                              <td style="" class="fw-bold">a. Sikap konsumen selama interview</td>
                              <td><?php switch ($data->sikap) {
                                  case '1':
                                      echo "BAIK";
                                      break;
                                  case '2':
                                      echo "CUKUP";
                                      break;
                                  case '1':
                                      echo "TIDAK BAIK";
                                      break;
                                  
                              }?></td>
                              <td style="" class="fw-bold">b. Kemudahan dalam memberikan informasi</td>
                              <td><?php switch ($data->kemudahanInformasi) {
                                  case '1':
                                      echo "BAIK";
                                      break;
                                  case '2':
                                      echo "CUKUP";
                                      break;
                                  case '1':
                                      echo "TIDAK BAIK";
                                      break;
                                  
                              }?></td>
                              <td style="" class="fw-bold">c. Pengecekan pola hidup nasabah</td>
                              <td><?php switch ($data->polaHidup) {
                                  case '1':
                                      echo "BAIK";
                                      break;
                                  case '2':
                                      echo "CUKUP";
                                      break;
                                  case '1':
                                      echo "TIDAK BAIK";
                                      break;
                                  
                              }?></td>
                            </tr>
 
                            <tr>
                              <td style="" class="fw-bold">a. Nama Keuchik</td>
                              <td><?= strtoupper($data->namaKeuchik)?></td>
                              <td></td>
                              <td style="" class="fw-bold">No Hp</td>
                              <td><?= strtoupper($data->hpKeuchik)?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td style="" class="fw-bold">b. Nama Keujrun Blang</td>
                              <td><?= strtoupper($data->namaKeujrun)?></td>
                              <td></td>
                              <td style="" class="fw-bold">No Hp</td>
                              <td><?= strtoupper($data->hpKeujrun)?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td style="" class="fw-bold">c. Nama Tetangga Calon Nasabah</td>
                              <td><?= strtoupper($data->namaTetangga)?></td>
                              <td></td>
                              <td style="" class="fw-bold">No Hp</td>
                              <td><?= strtoupper($data->hpTetangga)?></td>
                              <td></td>
                            </tr>
                          </tbody></table>
                    </div>
                    
					</div>
                    <br />
                    <br />
                    <br />
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <b>Account Officer</b>
                            <br><br><br><br><br><br>
                            <b><?= strtoupper($data->namaLengkap)?></b>
                        </div>
                        <div class="col-sm-4">
                            <b>Kabag. Pembiayaan</b>
                            <br><br><br><br><br><br>
                            <b>M. HASAN</b>
                        </div>
                        <div class="col-sm-4">
                            <b>Manajer</b>
                            <br><br><br><br><br><br>
                            <b>SALMAN SYARIF</b>
                        </div>
                    </div>

				
                                                    </div>
			</div>
		</div>
	</div>

</div>

<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>