<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
				<?php if ($this->session->flashdata('msg')) { ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Sukses !</strong> <?= $this->session->flashdata('msg') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
		</div>
		<?php }elseif ($this->session->flashdata('err')) { ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Gagal !</strong> <?= $this->session->flashdata('err') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
		</div>
		<?php } ?>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?= $title ?></h4>
					<form class="forms-sample" action="<?= base_url('laporan/operasional/keluar/date/_lihat') ?>" method="POST"
						enctype="multipart/form-data">
						<div class="row mb-3">
							<div class="col-md-3">
								<label class="form-label"><span style="color:#FFF">.</span></label>
								<input type="button" onclick="ExportToExcel();" class="form-control btn btn-primary" value="Download">
							</div>
							<div class="col-md-3">
								<label class="form-label"><span style="color:#FFF">.</span></label>
								<input type="button" onclick="backTo();" class="form-control btn btn-success" value="Refresh Page">
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal Awal</label>
								<input type="date" name="s" class="form-control">
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal Akhir</label>
								<input type="date" name="e" class="form-control">
							</div>
							<div class="col-md-2">
								<label class="form-label"><span style="color:#FFF">.</span></label>
								<input type="submit" class="form-control btn btn-info" value="Proses">
							</div>

						</div>

					</form>
					<div class="table-responsive">
						<table id="dataTableExample" class="table dataTable no-footer">
							<thead>
								<tr>
									<th>No</th>
									<th>ID Transaksi</th>
									<th>Keterangan</th>
									<th>Nilai</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
                                    foreach ($data as $r) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->serialNumber ?></td>
                                            <td><?= ucwords($r->keterangan) ?></td>
                                            <td><?= 'Rp. ' .number_format($r->nilaiTransaksi) ?></td>

                                            <td><?= date_indo($r->lastUpdate_t) ?></td>
                                        </tr>
                                    <?php } ?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>


</div>

<table id="downloadExcel" class="table dataTable no-footer" style="display:none">
							<thead>
								<tr>
									<th>No</th>
									<th>ID Anggota</th>
									<th>Nama Anggota</th>
									<th>Keterangan</th>
									<th>Nilai</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
                                    foreach ($data as $r) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= strtoupper($r->id_anggota) ?></td>
                                            <td><?= strtoupper($r->namaAnggota) ?></td>
                                            <td><?= ucwords($r->type) ?></td>
                                            <td><?= $r->nilaiTransaksi ?></td>

                                            <td><?= date_indo($r->lastUpdate_t) ?></td>
                                        </tr>
                                    <?php } ?>
							</tbody>
						</table>

    <script>

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('downloadExcel');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('[Laporan] Setoran Anggota (Grouping)-<?= date('d-m-Y') ?>.' + (type || 'xlsx')));
        }
		
		function backTo() {
			window.location.href= "<?= base_url('laporan/operasional/keluar/_lihat') ?>"
		}

    </script>

