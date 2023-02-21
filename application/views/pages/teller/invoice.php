<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="container-fluid d-flex justify-content-between">
						<div class="col-lg-3 ps-0">
							<img src="<?= base_url('public/login/logo.png')?>" class="wd-100" alt="">
							<p class="mt-1 mb-1"><b>Baitul Qiradh Gala Muamalah</b></p>
							<p>Jl. Krueng Beukah, Komplek Masjid Baitul Ghaffur -  Blangpidie<br />email: <a href="mailto:bq.galamuamalah@gmail.com" taget="_blank" rel="nofollow">bq.galamuamalah@gmail.com</a></p>
							<h5 class="mt-5 mb-2 text-muted">Invoice Untuk :</h5>
							<p><b><?= ucwords($data1->namaAnggota) ?></b><br>Alamat : <?= ucwords($data1->alamatSekarang) ?><br />HP : <?= ucwords($data1->no_hp) ?></p>
						</div>
						<div class="col-lg-3 pe-0">
							<h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
							<h6 class="text-end mb-5 pb-4"># INV-<?= substr($serial, 7) ?></h6>

							<h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Tanggal Dikeluarkan :</span>
								<?= date('Y-m-d') ?></h6>
							<h6 class="text-end fw-normal"><span class="text-muted">Tanggal Disetujui :</span> <?= date_indo($data2->lastUpdate_t) ?></h6>
						</div>
					</div>
					<div class="container-fluid mt-5 d-flex justify-content-center w-100">
						<div class="table-responsive w-100">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Keterangan</th>
										<th class="text-end">Jumlah</th>
										<th class="text-end">Total</th>
									</tr>
								</thead>
								<tbody>
									<tr class="text-end">
										<td class="text-start">1</td>
										<td class="text-start"><?php 
										switch ($data2->type) {
											case 'simpok':
												echo "Setor Simpanan Pokok";
												break;
											
											case 'simwa':
												echo "Setor Simpanan Wajib";
												break;
											
											case 'simka':
												echo "Setor Simpanan Sukarela";
												break;

											case 'tsimpok':
												echo " Penarikan Simpanan Pokok";
												break;
											
											case 'tsimwa':
												echo " Penarikan Simpanan Wajib";
												break;
											
											case 'tsimka':
												echo " Penarikan Simpanan Sukarela";
												break;
											
											default:
												echo "Simpanan";
												break;
										} ?></td>
										<td><?= 'Rp. ' . number_format($data2->nilaiTransaksi) ?></td>
										<td><?= 'Rp. ' . number_format($data2->nilaiTransaksi) ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="container-fluid mt-5 w-100">
						<div class="row">
							<div class="col-md-6 ms-auto">
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr class="bg-light">
												<td class="text-bold-800">Total Keseluruhan : </td>
												<td class="text-bold-800 text-end"><?= 'Rp. ' . number_format($data2->nilaiTransaksi) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid w-100">
						<a type="button" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send"
								class="me-3 icon-md"></i>Download Invoice PDF</a>
						<a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer"
								class="me-2 icon-md"></i>Print Invoice</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
    function closeAccount(value) {
        location.href = "<?= base_url('anggota/rekening/close/') ?>" + value;
    }
</script>