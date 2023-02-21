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
		<?php }elseif ($this->session->flashdata('inf')) { ?>
		<div class="alert alert-dark alert-dismissible fade show" role="alert">
			<strong>Oopss !</strong> <?= $this->session->flashdata('inf') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
		</div>
		<?php } ?>
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title"><?= $title; ?></h6>
					<div class="table-responsive">
						<table id="dataTableExample" class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Serial Transaksi</th>
									<th>Nilai</th>
									<th>Keterangan</th>
									<th>Tanggal</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;

									foreach ($data as $r) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= substr($r->serialNumber,0, 8). '<code>****</code>' ?></td>
											<td><?= 'Rp. '. number_format($r->nilaiTransaksi) ?></td>
											<td><?= ucwords($r->keterangan) ?></td>
											<td><?= date_indo($r->lastUpdate_t) ?></td>
											<td>
                                                <a class="badge bg-info" type="button" onclick="approveMe('<?= $r->serialNumber ?>');">Setujui</a>
                                                <a class="badge bg-warning" type="button" onclick="rejectMe('<?= $r->serialNumber ?>');">Tolak</a>
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
	function approveMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Pernyataan Sebelum Persetujuan !',
			icon: 'info',
			text: 'Approve persetujuan dari operasioanl. Setiap Item yang di approve tidak bisa di batalkan. Apakah anda yakin ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('required/approval/process/') ?>" + value +'/operasional'
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'',
					'error'
				)
			}
		})
	}
	function rejectMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Konfirmasi Penolakan !',
			icon: 'warning',
			text: 'Apakah yakin anda ingin menolak pengajuan ini ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('operasional/hapus/process/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Anggota tidak jadi keluar !',
					'error'
				)
			}
		})
	}


</script>
