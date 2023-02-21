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
									<th>ID Anggota</th>
									<th>Nama Anggota</th>
									<th>Simpanan Pokok</th>
									<th>Simpanan Wajib</th>
									<th>Simpanan Sukarela</th>
									<th>Total Simpanan</th>
									<th>Update Terakhir</th>
									<th>Opsi</th>		
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                foreach ($data as $r) { ?>
								<tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $r->anggota_id ?></td>
                                    <td><?= ucwords($r->namaAnggota) ?></td>
                                    <td><?= 'Rp. ' . number_format($r->s_pokok) ?></td>
                                    <td><?= 'Rp. ' . number_format($r->s_wajib) ?></td>
                                    <td><?= 'Rp. ' . number_format($r->s_sukarela) ?></td>
                                    <td><?= 'Rp. ' . number_format($r->s_sukarela + $r->s_wajib + $r->s_pokok) ?></td>
                                    <td><?= date_indo($r->lastUpdate) ?></td>
                                    <td>
										<div class="example">	
											<a type="button" onclick="updateMe('<?= $r->id_rekening ?>');" class="badge bg-info">Update Setoran</a>
											<a type="button" onclick="tarikMe('<?= $r->id_rekening ?>');" class="badge bg-dark">Penarikan</a>
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
    function updateMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Persetujuan Lakukan Update',
			icon: 'info',
			text: 'Apakah Benar Anda Ingin Melakukan Setoran Untuk Anggota Ini ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya, Lanjut!',
			cancelButtonText: 'Tidak, Batalkan!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('setoran/update/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Operasi sudah dibatalkan !',
					'error'
				)
			}
		})
	}
    function tarikMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Persetujuan Lakukan Penarikan',
			icon: 'info',
			text: 'Apakah Benar Anda Ingin Melakukan Penarikan Untuk Anggota Ini ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya, Lanjut!',
			cancelButtonText: 'Tidak, Batalkan!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('penarikan/update/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Operasi sudah dibatalkan !',
					'error'
				)
			}
		})
	}

</script>
