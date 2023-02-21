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
									<th>Pokok Rahn</th>
									<th>Pokok Mudharabah</th>
									<th>Prediksi Panen</th>
									<th>Tenor</th>
									<th>IDIR</th>
									<th>DI</th>
									<th>AO Bertugas</th>
									<th>Tanggal Update</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                if ($data != NULL) {
									foreach ($data as $r ) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= 'PB<code>*****</code>'.substr($r->id_pinjaman, 9) ?></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?= 'Rp. ' . number_format($r->plafon) ?></td>
									<td><?= 'Rp. ' . number_format($r->pokokRahn) ?></td>
									<td><?= 'Rp. ' . number_format($r->pokokMudharabah) ?></td>
									<td><?= $r->tglPrediksi ?></td>
									<td><?= $r->tenor .'x Panen' ?></td>
									<td><?= $r->idir. '%'?></td>
									<td><?= 'Rp. '.number_format($r->di) ?></td>
									<td><?= ucwords($r->namaLengkap) ?></td>
									<td><?= date_indo($r->lastUpdate_p) ?></td>
									<td>
										<div class="example">
											<?php if ($r->approvalManajer != 1) { ?>
												<a type="button" class="badge bg-warning">Menunggu Persetujuan</a>
												<a type="button" class="badge bg-danger" onclick="editMe('<?= $r->id_pinjaman ?>');">Edit Data</a>
												<a type="button" class="badge bg-dark" onclick="deleteMe('<?= $r->id_pinjaman ?>');">Hapus Data</a>
											<?php }else { ?>
												<a type="button" class="badge bg-info">Di Setujui</a>
												<a type="button" class="badge bg-primary" onclick="optionMe('<?= $r->id_pinjaman ?>');">Buat Surat</a>
											<?php } ?>
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
	function optionMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Validasi Pembuatan Dokumen Surat !',
			icon: 'info',
			text: 'Data "Dengan memilih setuju, maka surat akan dibuatkan. Surat tidak bisa dibuatkan 2x karena system telah mengatur berdasarkan urutan nomor surat',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Setujui',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('buat_surat/') ?>" + value
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


	function deleteMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Persetujuan Hapus Data !',
			icon: 'warning',
			text: 'Data "Serial Pinjaman" yang di hapus tidak akan muncul lagi di sistem, namun Dokumen berkas tetap ada. Apakah yakin ingin menghapus ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Hapus!',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('pinjaman/delete/') ?>" + value
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

		function editMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Apakah Yakin Ingin Mengedit Data Ini ?',
			icon: 'info',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('pembiayaan/data_anggota/update/') ?>" + value + '/edit' 
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
