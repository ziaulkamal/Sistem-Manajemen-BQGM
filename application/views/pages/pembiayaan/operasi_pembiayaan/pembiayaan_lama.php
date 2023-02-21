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
									<th>No</th>
									<th>Kode Pinjaman</th>
									<th>Plafon</th>
									<th>Pokok Rahn</th>
									<th>Pokok Mudharabah</th>
									<th>Tenor</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                if ($data != NULL) {
									foreach ($data as $r ) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $r->id_pinjaman ?></td>
									<td><?= 'Rp. ' . number_format($r->plafon) ?></td>
									<td><?= 'Rp. ' . number_format($r->pokokRahn) ?></td>
									<td><?= 'Rp. ' . number_format($r->pokokMudharabah) ?></td>
									<td><?= $r->tenor .'x Panen' ?></td>
									<td>
										<div class="example">
											<a type="button" class="badge bg-success" onclick="useData('<?= $r->id_pinjaman ?>');">Gunakan Data</a>
										</div>
									</td>
								</tr>
								<?php }
								} ?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<script>
	function useData(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Apakah Yakin Ingin Menggunakan Data Ini ?',
			icon: 'info',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('pembiayaan/data_anggota/update/') ?>" + value + '/pengajuan' 
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Operasi Batal di buat !',
					'error'
				)
			}
		})
	}

</script>
