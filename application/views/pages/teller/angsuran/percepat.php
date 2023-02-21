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

					<form class="forms-sample" action="<?= base_url('angsuran/update/process/').$id.'/percepat' ?>" method="POST"
						enctype="multipart/form-data">

						<div class="row">
							<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Anggota</label>
									<input type="text" class="form-control" value="<?= ucwords($data->namaAnggota). '  ***[ '.$data->anggota_id.' ]***'; ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Kode Pinjaman</label>
									<input type="text" class="form-control" value="<?= $data->pinjaman_id ?>" readonly>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="mb-4">
									<label class="form-label">Pokok Rahn</label>
										<input type="text" class="form-control" value="<?= 'Rp. '.number_format($data->pokokRahn/$data->tenor) ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-4">
									<label class="form-label">Pokok Mudharabah</label>
										<input type="text" class="form-control" value="<?= 'Rp. '.number_format($data->pokokMudharabah/$data->tenor) ?>" readonly>
								</div>
							</div>
							<div class="col-md-4">
								<div class="mb-4">
									<label class="form-label">Sisa Tenor</label>
										<input type="text" class="form-control" value="<?= $data->sisaTenor ?>" readonly>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-4">
									<label class="form-label">Total Setoran</label>
										<input type="text" class="form-control" value="<?= 'Rp. '. number_format((($data->pokokRahn/$data->tenor)* $data->sisaTenor) + (($data->pokokMudharabah/$data->tenor) * $data->sisaTenor)) ?>" readonly>
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
