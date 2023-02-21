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
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>No Hp</th>
									<th>Alamat</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php 

                                $no = 1;
                                foreach ($data as $r) { ?>
								<tr>
									<td class=""><?= $no++ ?></td>
									<td><?= $r->id_anggota ?></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?php switch ($r->jenisKelamin) {
                                    	case '1': echo "Laki - Laki"; break;                                      
                                      	case '2': echo "Perempuan"; break;                                        
                                        default: echo ""; break;
                                    } ?></td>
									<td><?= ucwords($r->no_hp) ?></td>
									<td><?= ucwords($r->alamatSekarang) ?></td>

									<td>
										<?php
                                            if ($r->status_pinjaman == 1) { ?>
										<a type="button" class="badge bg-info">Anggota Dalam Status Pinjaman</a>
										<?php }elseif ($r->status_pinjaman == 0) { ?>
										<div class="example">
											<a type="button" class="badge bg-success" onclick="pengajuanBaru('<?= $r->id_anggota ?>');">Pengajuan Baru</a>
											<a type="button" class="badge bg-danger" onclick="pengajuanLama('<?= $r->id_anggota ?>');">Pengajuan Lama</a>
										</div>
										<?php } ?>
									</td>
								</tr>
								<?php }
                                ?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<script>
	function pengajuanBaru(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Pernyataan Sebelum Melanjutkan !',
			icon: 'info',
			text: 'Apakah Yakin Ingin Melanjutkan Untuk Pengajuan Pembiayaan Baru ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('dokumen/pinjaman/') ?>" + value + '/baru/1'
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
	function pengajuanLama(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Pernyataan Sebelum Melanjutkan !',
			icon: 'warning',
			text: 'Apakah Yakin Ingin Melanjutkan Untuk Pengajuan Pembiayaan Lama ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('pembiayaan/data_anggota/recover/') ?>" + value
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
