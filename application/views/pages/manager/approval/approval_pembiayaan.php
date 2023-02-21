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
									<th>ID Pinjaman</th>
									<th>Nama Pemohon</th>
									<th>Plafon</th>
									<th>Nisbah Bagi Hasil</th>
									<th>Tenor</th>
									<th>Disposable Income</th>
									<th>IDIR</th>
									<th>Tanggal Prediksi</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;

									foreach ($data as $r) { 
                                        if ($r->approvalManajer != 1) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= '<code>********</code>' . substr($r->id_pinjaman, 7) ?></td>
											<td><?= ucwords($r->namaAnggota) ?></td>
											<td><?= 'Rp. '. number_format($r->plafon) ?></td>
											<td><?= 'Rp. '. number_format($r->bagiHasil) ?></td>
											<td><?= $r->tenor . 'x Panen' ?></td>
											<td><?= 'Rp. '.number_format($r->di) ?></td>
											<td><?= $r->idir.'%' ?></td>
											<td><?= date_indo($r->tglPrediksi) ?></td>
											<td>
                                                <a class="badge bg-success" type="button" onclick="approveMe('<?= $r->id_pinjaman ?>');">Setujui</a>
                                            </td>
										</tr>
									<?php } } ?>
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
			text: 'Anggota yang disetujui akan langsung di approve dan diberikan pencairan. Data yang sudah di approve tidak bisa dibatalkan apalagi di hapus. Apakah anda yakin ingin melakukan approval di pembiayaan ini ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('required/approval/process/') ?>" + value + '/pembiayaan'
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
	function exitMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Konfirmasi Sebelum Mengeluarkan Anggota !',
			icon: 'warning',
			text: 'Apakah Yakin Ingin Keluarkan Anggota ini ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('anggota/delete/') ?>" + value
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
