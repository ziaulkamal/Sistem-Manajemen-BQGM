<div class="page-content">

<a type="button" class="btn btn-info btn-outline" onclick="printContent('printOut');"> PRINT TABEL ANGSURAN</a>
	<div class="row" id="printOut">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="container-fluid d-flex justify-content-between">
						<div class="col-lg-3 ps-0">
							<img src="<?= base_url('public/login/logo.png')?>" class="wd-200" alt="">
							<p class="mt-1 mb-1"><b>Baitul Qiradh Gala Muamalah</b></p>
							<p>Jl. Krueng Beukah, Komplek Masjid Baitul Ghaffur -  Blangpidie<br />email: <a href="mailto:bq.galamuamalah@gmail.com" taget="_blank" rel="nofollow">bq.galamuamalah@gmail.com</a></p>
							
						</div>
						<div class="col-lg-3 pe-0">
							<h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Tanggal Dikeluarkan :</span>
								<?= date('Y-m-d') ?></h6>
							<h6 class="text-end fw-normal"><span class="text-muted">ID Pinjaman :</span> <?= ($data->id_pinjaman) ?></h6>
						</div>
					</div>
                    <h5 class="mt-5 mb-2 text-center">JADWAL ANGSURAN PEMBIAYAAN BQ GALA MUAMALAH</h5>
                    <p> Assalamualaikum Wr.Wb.</p>
                    <br>
                    <p> Semoga bapak/Bapak dalam keadaan sehat wal'afiat dan senantiasa dalam perlindungan dari Allah SWT.</p>
                    <p>
Berikut jadwal angsuran Bapak/Ibu <?= strtoupper($data->namaAnggota) ?> yang berlokasi di <?= strtoupper($data->alamatSekarang) ?> , Kabupaten Aceh Barat Daya, dengan nominal total pembiayaan sebesar Rp. <?= number_format($data->plafon) ?>  ,- dengan rincian sebagai berikut;</p>
					<div class="container-fluid mt-5 d-flex justify-content-center w-100">
						<div class="table-responsive w-100">
<div class="table">
                            <?php if ($data->proyeksiPanen > 1080) {
                           $zakat = ($data->hargaGabah * $data->proyeksiPanen) * 0.05;
                        }else {
                            $zakat = '0';
                        } 
                        
                            $afterZakat = ($data->hargaGabah * $data->proyeksiPanen) - $zakat- $data->biayaOperasional;
                            $angsuran = ($data->pokokRahn / $data->tenor) + ($data->pokokMudharabah / $data->tenor) + (($afterZakat * 0.2));
                            $perbayar = ($data->pokokRahn / $data->tenor) + ($data->pokokMudharabah / $data->tenor) ;
                            switch ($data->tenor) {
                                case '5':
                                    $sisa1 = $data->pokokRahn + $data->pokokMudharabah - ($perbayar*1);
                                    $sisa2 = $data->pokokRahn + $data->pokokMudharabah - ($perbayar*2);
                                    $sisa3 = $data->pokokRahn + $data->pokokMudharabah - ($perbayar*3);
                                    $sisa4 = $data->pokokRahn + $data->pokokMudharabah - ($perbayar*4);
                                    $sisa5 = $data->pokokRahn + $data->pokokMudharabah - ($perbayar*5);
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        ?>
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th style="text-align: center">Tahapan Panen</th>
                                                <th style="text-align: center">Hutang Pokok<br>Rahn (Gadai) </th>
                                                <th style="text-align: center">Hutang Pokok<br>Mudharabah</th>
                                                <th style="text-align: center">Bagi Hasil Nisbah Mudharabah<br>untuk BQ GM (20%)</th>
                                                <th style="text-align: center">Bagi Hasil Nisbah Mudharabah<br>untuk Nasabah/Mudharib (80%)</th>
                                                <th style="text-align: center">Jumlah Angsuran</th>
                                                <th style="text-align: center">Sisa Hutang Pokok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Panen Pertama</td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokRahn / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokMudharabah / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.2)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.8)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($angsuran) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($sisa1) ?></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Panen Kedua</td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokRahn / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokMudharabah / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.2)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.8)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($angsuran) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($sisa2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Panen Ketiga</td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokRahn / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokMudharabah / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.2)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.8)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($angsuran) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($sisa3) ?></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Panen Ketiga</td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokRahn / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokMudharabah / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.2)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.8)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($angsuran) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($sisa4) ?></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Panen Ketiga</td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokRahn / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($data->pokokMudharabah / $data->tenor) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.2)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format(($afterZakat * 0.8)) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($angsuran) ?></td>
                                                <td style="text-align: right">Rp <?= number_format($sisa5) ?></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td style="text-align: right"><b>Rp. <?= number_format($data->pokokRahn) ?></b></td>
                                                <td style="text-align: right"><b>Rp. <?= number_format($data->pokokMudharabah) ?></b></td>
                                                <td style="text-align: right"><b>Rp. <?= number_format(($afterZakat * 0.2)*$data->tenor) ?></b></td>
                                                <td style="text-align: right"><b>Rp. <?= number_format(($afterZakat * 0.8)*$data->tenor) ?></b></td>
                                                <td style="text-align: right"><b>Rp. <?= number_format($angsuran* $data->tenor) ?></td>
                                                <td style="text-align: right"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
						</div>
					</div>
					<div class="container-fluid mt-5 w-100">
						<div class="row">
							<div class="col-md-12 ms-auto">
                                <p>Demikian proyeksi jadwal angsuran dibuat guna mempermudah pembayaran hutang pokok nasabah pembiayaan BQ GALA MUAMALAH Blangpidie, Aceh Barat Daya.
<br />
Wassalamualaikum Wr. Wb</p>
							</div>
						</div>
					</div>
					<div class="container-fluid mt-5 w-100">
<div class="row col-md-12">
                          <div class="col-md-6">
                            <p style="text-align: center; font-weight: bold;">KPPS BQ GALA MUAMALAH</p>
                          </div>
                          <div class="col-md-6">
                            <p style="text-align: center">Ditetapkan di Blangpidie, <?= date_indo(date('Y-m-d')) ?></p>
                          </div>

                          <div class="col-md-6">
                            <p style="text-align: center; font-weight: bold;">Mengetahui</p>
                          </div>
                          <div class="col-md-6">
                            <p></p>
                          </div>

                          <div class="col-md-3">
                            <br> <br> <br> <br> <br>
                            <p style="text-align: center; font-weight: bold;">SALMAN SYARIF<br>Manajer</p>
                          </div>
                          <div class="col-md-3">
                            <br> <br> <br> <br> <br>
                            <p style="text-align: center; font-weight: bold;">ASMAUL HUSNA<br>Kabag Operasional</p>
                          </div>
                          <div class="col-md-3">
                            <br> <br> <br> <br> <br>
                            <p style="text-align: center; font-weight: bold;"><?= strtoupper($data->namaAnggota)?><br>Nasabah/Mudharib/Rahin</p>
                          </div>
                          <div class="col-md-3">
                            <br> <br> <br> <br> <br>
                            <p style="text-align: center; font-weight: bold;"><?= strtoupper($data->namaPasangan)?><br>Istri/Suami/Anak</p>
                          </div>

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