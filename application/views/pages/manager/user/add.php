<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>');
		?>
		<div class="col-md-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url($action) ?>" method="POST"
						enctype="multipart/form-data">

						<?php if (!isset($data)) {?>
						<div class="mb-3">
							<label class="form-label" for="formFile">Upload Foto Profil</label>
							<input class="form-control" type="file" id="formFile" name="img">
						</div>
						<div class="mb-3">
							<label class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">User Masuk</label>
							<input type="text" class="form-control" name="username"
								value="<?= set_value('username') ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="text" class="form-control" name="password" value="<?= set_value('password') ?>"
								required>
						</div>
						<div class="mb-3">
							<label class="form-label">Level Akses</label>
							<select class="form-select form-select-sm mb-3" name="level">
								<option selected>-- Pilih --</option>
								<option value="manajer">Manajer</option>
								<option value="pembiayaan">Kabag Pembiayaan</option>
								<option value="operasional">Kabag Operasional</option>
								<option value="teller">Teller</option>
								<option value="ao">Account Officer</option>
							</select>
						</div>


						<button type="submit" class="btn btn-primary me-2">Simpan</button>
						<button class="btn btn-secondary">Kembali</button>
						<?php }else{ ?>
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
						<div class="mb-3">
							<label class="form-label">Level Akses</label>
							<select class="form-select form-select-sm mb-3" name="level">
								<?php
								switch ($data->levelAkses) {
									case 'manajer': ?>
								<option selected value="manajer">Manajer</option>
								<option value="pembiayaan">Kabag Pembiayaan</option>
								<option value="operasional">Kabag Operasional</option>
								<option value="teller">Teller</option>
								<option value="ao">Account Officer</option>

								<?php break;

									case 'pembiayaan': ?>
								<option value="manajer">Manajer</option>
								<option selected value="pembiayaan">Kabag Pembiayaan</option>
								<option value="operasional">Kabag Operasional</option>
								<option value="teller">Teller</option>
								<option value="ao">Account Officer</option>

								<?php break;

									case 'operasional': ?>
								<option value="manajer">Manajer</option>
								<option value="pembiayaan">Kabag Pembiayaan</option>
								<option selected value="operasional">Kabag Operasional</option>
								<option value="teller">Teller</option>
								<option value="ao">Account Officer</option>

								<?php break;

									case 'teller': ?>
								<option value="manajer">Manajer</option>
								<option value="pembiayaan">Kabag Pembiayaan</option>
								<option value="operasional">Kabag Operasional</option>
								<option selected value="teller">Teller</option>
								<option value="ao">Account Officer</option>

								<?php break;

									case 'ao': ?>
								<option value="manajer">Manajer</option>
								<option value="pembiayaan">Kabag Pembiayaan</option>
								<option value="operasional">Kabag Operasional</option>
								<option value="teller">Teller</option>
								<option selected value="ao">Account Officer</option>

								<?php break;
									
									default:
										# code...
										break;
								}
							?>
							</select>
						</div>


						<button type="submit" class="btn btn-primary me-2">Update</button>
						<button class="btn btn-secondary">Kembali</button>
						<?php } ?>
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
