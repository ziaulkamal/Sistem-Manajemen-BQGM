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


		<div class="col-md-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url('operasional/bayar_pinjaman/setoran/'). $serial ?>" method="POST"
						enctype="multipart/form-data">

						<div class="row">
							<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Peminjam</label>
									<input type="text" class="form-control" value="<?= ucwords($data->namaLengkap); ?>"
										readonly>

								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Sisa Pinjaman</label>
									<input type="text" class="form-control"
										value="<?= 'Rp. '. number_format($data->sisaPinjaman) ?>" readonly>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="mb-4">
									<label class="form-label">Jumlah Setoran</label>
									<?php if ($jenis != 'pelunasan') { ?>
										<input type="text" class="form-control uang" name="jumlah" value="">
									<?php }else { ?>
										<input type="text" class="form-control uang" name="jumlah" value="<?= $data->sisaPinjaman ?>" readonly>
									<?php } ?>
									<?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary me-2">Update !</button>


					</form>
				</div>
			</div>
		</div>
	</div>
</div>
