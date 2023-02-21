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
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>No Hp</th>
									<th>Alamat</th>
									<th>Tanggal Bergabung</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php 

                                $no = 1;
                                foreach ($data as $r) { ?>
								<tr>
									<td class=""><?= $no++ ?></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?php switch ($r->jenisKelamin) {
                                    	case '1': echo "Laki - Laki"; break;                                      
                                      	case '2': echo "Perempuan"; break;                                        
                                        default: echo ""; break;
                                    } ?></td>
									<td><?= ucwords($r->no_hp) ?></td>
									<td><?= ucwords($r->alamatSekarang) ?></td>
									<td><?= date_indo($r->tanggalDaftar) ?></td>
	
									<td>
										<div class="example">
											<a class="badge bg-primary" href="<?= base_url('anggota/edit/').$r->id_anggota ?>">Edit</a>
											<?php if ($r->rekening == NULL) { ?>
											<a type="button" class="badge bg-info" onclick="createRekening('<?= $r->id_anggota ?>');">Buka Rekening</a>
											<?php } ?>
											<a type="button" class="badge bg-dark" onclick="exitMe('<?= $r->id_anggota ?>');">Keluarkan</a>
										</div>
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
	function createRekening(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Anggota Belum Memiliki Rekening !',
			icon: 'warning',
			text: 'Apakah Yakin Ingin Melanjutkan Pembukaan Rekening Baru ?',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('anggota/rekening/process/') ?>" + value
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Rekening Batal di buat !',
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
