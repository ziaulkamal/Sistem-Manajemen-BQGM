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
									<th>Nama Anggota</th>
									<th>Plafon</th>
									<th>Sisa Tenor</th>
									<th>Tanggal Update</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                if ($data != NULL) {
									foreach ($data as $r ) { 
                                        if ($r->sisaTenor != 0) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= 'PB<code>*****</code>'.substr($r->id_pinjaman, 9) ?></td>
                                            <td><?= ucwords($r->namaAnggota) ?></td>
                                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                                            <td><?= $r->sisaTenor . 'x Panen' ?></td>
                                            <td><?= date_indo($r->lastUpdate_p) ?></td>
                                            <td>
                                                <div class="example">
                                                    <a type="button" class="badge bg-info" onclick="normalMe('<?= $r->id_pinjaman ?>');">Bayar Normal</a>
                                                    <a type="button" class="badge bg-primary" onclick="percepatMe('<?= $r->id_pinjaman ?>');">Percepat Pelunasan</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } } } ?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>


</div>

<script>
	function normalMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Ingin Lanjut Setoran Normal !',
			icon: 'info',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Lanjut!',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('angsuran/update/') ?>" + value +'/normal'
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
	function percepatMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Ingin Lanjut Setoran Percepatan !',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Lanjut!',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('angsuran/update/') ?>" + value +'/percepat'
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
