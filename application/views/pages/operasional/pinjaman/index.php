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
									<th>Nama Karyawan</th>
									<th>Jumlah / Sisa Pinjaman</th>
									<th>Tanggal</th>
									<?php
										if ($this->session->userdata('level_akses') != 'manajer') { ?>
											<th>Opsi</th>
										<?php }
									?>
									
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                foreach ($data as $r) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= '<code>*******</code>'.substr($r->serial, 7) ?></td>
									<td><?= ucwords($r->namaLengkap) ?></td>
									<td><?= 'Rp. ' . number_format($r->sisaPinjaman) ?></td>
									<td><?= date_indo($r->lastUpdate) ?></td>
									<?php
										if ($this->session->userdata('level_akses') != 'manajer') { ?>
																				<td>
										<div class="example">
                                        <?php
                                        if ($r->status != 0 ) { ?>
                                            <a href="<?= base_url('operasional/data_pinjaman/update_nilai/').$r->serial ?>" class="badge bg-success">Tambah Nilai</a>
											<?php
                                                if ($r->sisaPinjaman == 0) { ?>
                                                   <a href="<?= base_url('operasional/data_pinjaman/hapus/').$r->serial ?>" class="badge bg-danger">Hapus Serial</a>
												   <?php }else { ?>
													<a type="button" onclick="setorMe('<?= $r->serial ?>');"class="badge bg-info">Setoran</a>
													
												<?php }
                                            ?>
                                        <?php }else { ?>
                                            <a type="button" onclick="approvePinjaman('<?= $r->serial ?>');" class="badge bg-warning">Setujui</a>
											<a type="button" onclick="rejectPinjaman('<?= $r->serial ?>');" class="badge bg-dark">Tolak</a>
                                        <?php }
                                        ?>
										</div>
									</td>
										<?php }
									?>
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
    function approvePinjaman(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Persetujuan Pinjaman',
			icon: 'warning',
			text: 'Anggota dengan serial ' + value + ' ingin melakukan pinjaman !',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Proses !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('operasional/data_pinjaman/setujui/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Data Karyawan Peminjam gagal di setujui !',
					'error'
				)
			}
		})
	}
    function rejectPinjaman(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Tolak Permohonan Pinjaman',
			icon: 'warning',
			text: 'Catatan : nantinya pemohon akan bisa melakukan permohonan kembali jika di tolak. Apakah anda setuju ?',
			showCancelButton: false,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Setuju dan Tolak !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('operasional/data_pinjaman/tolak/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Data Karyawan Peminjam gagal di setujui !',
					'error'
				)
			}
		})
	}
    function setorMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-info me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Pilih Setoran Karyawan',
			icon: 'info',
			text: 'Setoran pinjaman karyawan, silahkan pilih jenis pembayaran !',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Normal',
			cancelButtonText: 'Pelunasan',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('operasional/data_pinjaman/bayar_pinjaman/normal/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				location.href = "<?= base_url('operasional/data_pinjaman/bayar_pinjaman/pelunasan/') ?>" + value
				
			}
		})
	}

</script>
