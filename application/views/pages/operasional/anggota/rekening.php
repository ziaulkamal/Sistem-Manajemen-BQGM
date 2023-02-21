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
									<th>Nama</th>
									<th>Simpanan Pokok</th>
									<th>Simpanan Wajib</th>
									<th>Simpanan Sukarela</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php 

                                $no = 1;
                                foreach ($data as $r) { ?>
								<tr>
									<td class=""><?= $no++ ?></td>
									<td><a type="button" class="badge bg-primary" data-bs-toggle="modal"
											data-bs-target="#M<?= $r->id_rekening ?>">
											<?= strtoupper($r->anggota_id) ?></a></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?= 'Rp. '. number_format($r->s_pokok) ?></td>
									<td><?= 'Rp. '. number_format($r->s_wajib) ?></td>
									<td><?= 'Rp. '. number_format($r->s_sukarela) ?></td>


									<td>
										<div class="example">
											<?php if ($r->status_pinjaman > 0) { ?>
											<span class="badge bg-info">Sedang dalam pinjaman</span>
											<?php } ?>
											<a type="button" class="badge bg-danger" onclick="closeRekening('<?= $r->id_rekening ?>');">Tutup
												Rekening</a>
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

<?php

foreach ($data as $r) {?>
<div class="modal fade" id="M<?= $r->id_rekening ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Rekening <b>[ <?= ucwords($r->namaAnggota) ?>
						]</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-4">
						<div class="mb-1">
							<label class="form-label">Nomor Rekening :</label>
						</div>
					</div><!-- Col -->
					<div class="col-sm-8">
                        <label class="form-label"><?= $r->id_rekening; ?></label>
						<div class="mb-1">
						</div>
					</div><!-- Col -->
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="mb-1">
							<label class="form-label">Total Simpanan :</label>
						</div>
					</div><!-- Col -->
					<div class="col-sm-8">
						<div class="mb-1">
							<label class="form-label"><?= $r->s_pokok + $r->s_wajib + $r->s_sukarela; ?></label>
						</div>
					</div><!-- Col -->
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="mb-1">
							<label class="form-label">Status Pinjaman :</label>
						</div>
					</div><!-- Col -->
					<div class="col-sm-8">
						<div class="mb-1">
							<label class="form-label"><?php if ($r->status_pinjaman == 1) {
                                echo "<b>Anggota Masih Dalam Pinjaman</b>";
                            }else {
                                echo "Tidak Ada Pinjaman";
                            } ?></label>
						</div>
					</div><!-- Col -->
				</div>
			</div>
		</div>
	</div>
</div>
<?php }
?>

<script>
	function closeRekening(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Perhatian Sebelum Menutup Rekening !',
			icon: 'warning',
			text: 'Sebelum melakukan penutupan rekening, harap periksa terlebih dahulu apakah anggota masih dalam status pinjaman atau tidak !',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Lanjutkan Tutup Rekening!',
			cancelButtonText: 'Batalkan !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('anggota/rekening/invoice/') ?>" + value
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

</script>
