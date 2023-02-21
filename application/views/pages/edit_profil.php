<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>');
		?>
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

					<form class="forms-sample" action="<?= base_url($action) ?>" method="POST"
						enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label" for="formFile">Upload Foto Profil<code>* Kosongkan bidang ini jika
									ingin menggunakan Foto sebelumnya</code></label>
							<input class="form-control" type="file" id="formFile" name="img">
						</div>
						<div class="mb-3">
							<label class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control" name="nama" value="<?= $data->namaLengkap ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">User Masuk</label>
							<input type="text" class="form-control" name="username" value="<?= $data->username ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Password <code>* Kosongkan bidang ini jika ingin menggunakan
									password sebelumnya</code></label>
							<input type="text" class="form-control" name="password" value="">
						</div>



						<button type="submit" class="btn btn-primary me-2">Update</button>
						<button class="btn btn-secondary">Kembali</button>
					</form>

				</div>
			</div>
		</div>
		<?php 
		if (isset($data)) {
			if ($data->gambarProfil != '') { ?>
		<div class="col-md-3">
			<div class="card">
				<img class="wd-320 ht-320" src="<?= base_url('public/assets/images/users/').$data->gambarProfil ?>" alt="">

			</div>
		</div>
		<?php }
		}
		
		
		?>
	</div>

</div>
