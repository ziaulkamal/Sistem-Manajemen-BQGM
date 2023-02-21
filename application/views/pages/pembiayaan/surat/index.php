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
					<div class="table-responsive">
						<table id="dataTableExample" class="table dataTable no-footer">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nomor Surat</th>
									<th>Nama Anggota</th>
									<th>ID Pembiayaan</th>
									<th>Tanggal Dibuat</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
                                    foreach ($data as $r) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $r->no_surat ?></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?= $r->id_pinjaman ?></td>
									<td><?= date_indo($r->lastUpdate_s) ?></td>
									<td>
										<div class="example">
											<a type="button" class="badge bg-primary" onclick="akadMudharabah('<?= $r->no_surat ?>');">Akad Mudharabah</a>
											<a type="button" class="badge bg-info" onclick="akadRahn('<?= $r->no_surat ?>');">Akad Rahn</a>
											<a type="button" class="badge bg-warning" onclick="suratJanji('<?= $r->no_surat ?>');">Surat Janji Bayar</a>
											<a type="button" class="badge bg-danger" onclick="tandaTerima('<?= $r->no_surat ?>');">Tanda Terima</a>
											<a type="button" class="badge bg-success" onclick="mpp('<?= $r->no_surat  ?>');">MPP</a>
											<a type="button" class="badge bg-dark" onclick="tabelAngsuran('<?= $r->no_surat  ?>');">Tabel Angsuran</a>
										</div>
									</td>
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

<script>
	function akadRahn(value) {
		window.location.href= "<?= base_url('doc/detail_surat/rahn/') ?>" + value
	}
	function akadMudharabah(value) {
		window.location.href= "<?= base_url('doc/detail_surat/mudharabah/') ?>" + value
	}
	function suratJanji(value) {
		window.location.href= "<?= base_url('doc/detail_surat/janjiBayar/') ?>" + value
	}
	function tandaTerima(value) {
		window.location.href= "<?= base_url('doc/detail_surat/tandaTerima/') ?>" + value
	}
	function mpp(value) {
		window.location.href= "<?= base_url('doc/mpp/') ?>" + value
	}
	function tabelAngsuran(value) {
		window.location.href= "<?= base_url('doc/tabelAngsuran/') ?>" + value
	}

</script>
