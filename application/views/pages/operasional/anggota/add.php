<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<?php if ($this->session->flashdata('err')) { ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Gagal !</strong> <?= $this->session->flashdata('err') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
		</div>
		<?php } ?>
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url($action) ?>" method="POST"
						enctype="multipart/form-data">
						<?php
						if (!isset($form)) {?>
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Lengkap</label>
									<input type="text" class="form-control"  autocomplete="off" name="nama"
										value="<?= set_value('nama') ?>">
									<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">NIK/SIM</label>
									<input type="text" class="form-control"  autocomplete="off" name="nik"
										value="<?= set_value('nik') ?>"  onkeypress="return hanyaAngka(event)">
									<?= form_error('nik', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Masa Berlaku</label>
									<input type="text" class="form-control"  autocomplete="off" name="masa_ktp"
										value="<?= set_value('masa_ktp') ?>">
									<?= form_error('masa_ktp', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tempat Lahir</label>
									<input type="text" class="form-control"  autocomplete="off" name="tp_lahir"
										value="<?= set_value('tp_lahir') ?>">
									<?= form_error('tp_lahir', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tanggal Lahir</label>
									<input type="date" class="form-control" name="tg_lahir"
										value="<?= set_value('tg_lahir') ?>">
									<?= form_error('tg_lahir', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">No Telepon</label>
									<input type="text" class="form-control"  autocomplete="off" name="no_hp"
										value="<?= set_value('no_hp') ?>"  onkeypress="return hanyaAngka(event)">
									<?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Alamat KTP</label>
									<input type="text" class="form-control"  autocomplete="off" name="alamat_ktp"
										value="<?= set_value('alamat_ktp') ?>">
									<?= form_error('alamat_ktp', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Alamat Sekarang</label>
									<input type="text" class="form-control"  autocomplete="off" name="alamat_sekarang"
										value="<?= set_value('alamat_sekarang') ?>">
									<?= form_error('alamat_sekarang', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Jenis Kelamin</label>
									<select class="form-select form-select-sm mb-3" name="jk">
										<?php 
										$jk = set_value('jk');
										if (isset($jk)) {
											switch ($jk) {
												case '1': ?>

										<option selected value="1">Pria</option>
										<option value="2">Wanita</option>
										<?php break;
												case '2': ?>

										<option value="1">Pria</option>
										<option selected value="2">Wanita</option>
										<?php break;
												
												default: ?>
										<option selected value="">-- Pilih --</option>
										<option value="1">Pria</option>
										<option value="2">Wanita</option>
										<?php break;
											}
										}else { ?>
										<option selected value="">-- Pilih --</option>
										<option value="1">Pria</option>
										<option value="2">Wanita</option>
										<?php }

										?>


									</select>
									<?= form_error('jk', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Status Perkawinan</label>
									<select class="form-select form-select-sm mb-3" name="status_kawin">
										<?php 
										$status_kawin = set_value('status_kawin');
										if (isset($status_kawin)) {
											switch ($status_kawin) {
												case '1': ?>
										<option selected value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '2': ?>
										<option value="1">Lajang</option>
										<option selected value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '3': ?>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option selected value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '4': ?>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option selected value="4">Cerai Mati</option>
										<?php break;
												
												default: ?>
										<option selected value="">-- Pilih --</option>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
											}
										}else { ?>
										<option selected value="">-- Pilih --</option>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php } ?>

									</select>
									<?= form_error('status_kawin', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Jumlah Tanggungan</label>
									<select class="form-select form-select-sm mb-3" name="tanggungan">
										<?php 
										$tanggungan = set_value('tanggungan');
										if (isset($tanggungan)) {
											switch ($tanggungan) {
												case '0': ?>
										<option selected value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '1': ?>
										<option value="0">Tidak Ada</option>
										<option selected value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '2': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option selected value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '3': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option selected value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '4': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option selected value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '5': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option selected value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '6': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option selected value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '7': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option selected value="7">7</option>
										<?php break;
												
												default: ?>
										<option selected value="">-- Pilih --</option>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
											}
										}else { ?>
										<option selected value="">-- Pilih --</option>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php }
										?>


									</select>
									<?= form_error('tanggungan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Pekerjaan</label>
									<input type="text" class="form-control"  autocomplete="off" name="pekerjaan"
										value="<?= set_value('pekerjaan') ?>">
									<?= form_error('pekerjaan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Penghasilan</label>
									<select class="form-select form-select-sm mb-3" name="penghasilan">
										<?php
											$penghasilan = set_value('penghasilan');
											if (isset($penghasilan)) {
												switch ($penghasilan) {
													case '500000': ?>
										<option selected value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '1000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option selected value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '2000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option selected value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '3000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option selected value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '4000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option selected value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '5000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option selected value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '6000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option selected value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '7000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option selected value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '8000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option selected value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '9000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option selected value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '10000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option selected value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													default: ?>
										<option selected value="">-- Pilih --</option>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
												}
											}else { ?>
										<option selected value="">-- Pilih --</option>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php }
										?>


									</select>
									<?= form_error('penghasilan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Pasangan</label>
									<input type="text" class="form-control"  autocomplete="off" name="nama_pasangan"
										value="<?= set_value('nama_pasangan') ?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">NIK Pasangan</label>
									<input type="text" class="form-control"  autocomplete="off" name="nik_pasangan"
										value="<?= set_value('nik_pasangan') ?>"  onkeypress="return hanyaAngka(event)">
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tempat Lahir Pasangan</label>
									<input type="text" class="form-control"  autocomplete="off" name="tl_lahir_pasangan"
										value="<?= set_value('tl_lahir_pasangan') ?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tanggal Lahir Pasangan</label>
									<input type="date" class="form-control" name="tg_lahir_pasangan"
										value="<?= set_value('tg_lahir_pasangan') ?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">No Telepon Lainya</label>
									<input type="text" class="form-control"  autocomplete="off" name="no_hp_lain"
										value="<?= set_value('no_hp_lain') ?>"  onkeypress="return hanyaAngka(event)">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Ibu Kandung</label>
									<input type="text" class="form-control"  autocomplete="off" name="nama_ibu"
										value="<?= set_value('nama_ibu') ?>">
									<?= form_error('nama_ibu', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Status Anggota</label>
									<select class="form-select form-select-sm mb-3" name="status_anggota">
										<?php
										$status_anggota = set_value('status_anggota');
										if (isset($status_anggota)) {
											switch ($status_anggota) {
												case '1': ?>
										<option selected value="1">Aktif</option>
										<option value="2">Non-Aktif</option>
										<?php break;
												
												case '2': ?>
										<option value="1">Aktif</option>
										<option selected value="2">Non-Aktif</option>
										<?php break;
												
												default: ?>
										<option selected value="">-- Pilih --</option>
										<option value="1">Aktif</option>
										<option value="2">Non-Aktif</option>
										<?php break;
											}
										}else { ?>
										<option selected value="">-- Pilih --</option>
										<option value="1">Aktif</option>
										<option value="2">Non-Aktif</option>
										<?php }
										?>

									</select>
									<?= form_error('status_anggota', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto KTP Anggota</label>
									<input type="file" class="form-control" name="fotoKtpAnggota">
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto KTP Pasangan</label>
									<input type="file" class="form-control" name="fotoKtpPasangan">
									
								</div>
							</div>
						</div>


						<?php }else {?>
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Lengkap</label>
									<input type="text" class="form-control"  autocomplete="off" name="nama"
										value="<?= $form->namaAnggota ?>">
									<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">NIK/SIM</label>
									<input type="text" class="form-control"  autocomplete="off" name="nik"
										value="<?= $form->nik ?>"  onkeypress="return hanyaAngka(event)">
									<?= form_error('nik', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Masa Berlaku</label>
									<input type="text" class="form-control"  autocomplete="off" name="masa_ktp"
										value="<?= $form->masaKtp ?>">
									<?= form_error('masa_ktp', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tempat Lahir</label>
									<input type="text" class="form-control"  autocomplete="off" name="tp_lahir"
										value="<?= $form->tempatLahir ?>">
									<?= form_error('tp_lahir', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tanggal Lahir</label>
									<input type="date" class="form-control" name="tg_lahir"
										value="<?= $form->tanggalLahir ?>">
									<?= form_error('tg_lahir', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">No Telepon</label>
									<input type="text" class="form-control"  autocomplete="off" name="no_hp"
										value="<?= $form->no_hp ?>"  onkeypress="return hanyaAngka(event)">
									<?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Alamat KTP</label>
									<input type="text" class="form-control"  autocomplete="off" name="alamat_ktp"
										value="<?= $form->alamatKtp ?>">
									<?= form_error('alamat_ktp', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Alamat Sekarang</label>
									<input type="text" class="form-control"  autocomplete="off" name="alamat_sekarang"
										value="<?= $form->alamatSekarang ?>">
									<?= form_error('alamat_sekarang', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Jenis Kelamin</label>
									<select class="form-select form-select-sm mb-3" name="jk">
										<?php 
										$jk = set_value('jk');
										if (isset($jk)) {
											switch ($jk) {
												case '1': ?>

										<option selected value="1">Pria</option>
										<option value="2">Wanita</option>
										<?php break;
												case '2': ?>

										<option value="1">Pria</option>
										<option selected value="2">Wanita</option>
										<?php break;
												
												default:
												switch ($form->jenisKelamin) {
													case '1': ?>

										<option selected value="1">Pria</option>
										<option value="2">Wanita</option>
										<?php break;
												case '2': ?>

										<option value="1">Pria</option>
										<option selected value="2">Wanita</option>
										<?php break;						
												}
												break;
											}
										}								
										?>


									</select>
									<?= form_error('jk', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Status Perkawinan</label>
									<select class="form-select form-select-sm mb-3" name="status_kawin">
										<?php 
										$status_kawin = set_value('status_kawin');
										if (isset($status_kawin)) {
											switch ($status_kawin) {
												case '1': ?>
										<option selected value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '2': ?>
										<option value="1">Lajang</option>
										<option selected value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '3': ?>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option selected value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '4': ?>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option selected value="4">Cerai Mati</option>
										<?php break;
												
												default: 
												switch ($form->statusKawin) {
													case '1': ?>
										<option selected value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '2': ?>
										<option value="1">Lajang</option>
										<option selected value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '3': ?>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option selected value="3">Cerai Hidup</option>
										<option value="4">Cerai Mati</option>
										<?php break;
												
												case '4': ?>
										<option value="1">Lajang</option>
										<option value="2">Kawin</option>
										<option value="3">Cerai Hidup</option>
										<option selected value="4">Cerai Mati</option>
										<?php break;
												}
												break;
											}
										} ?>

									</select>
									<?= form_error('status_kawin', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Jumlah Tanggungan</label>
									<select class="form-select form-select-sm mb-3" name="tanggungan">
										<?php 
										$tanggungan = set_value('tanggungan');
										if (isset($tanggungan)) {
											switch ($tanggungan) {
												case '0': ?>
										<option selected value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '1': ?>
										<option value="0">Tidak Ada</option>
										<option selected value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '2': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option selected value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '3': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option selected value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '4': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option selected value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '5': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option selected value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '6': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option selected value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '7': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option selected value="7">7</option>
										<?php break;
												
												default: 
												switch ($form->jumlahTanggungan) {
													case '0': ?>
										<option selected value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '1': ?>
										<option value="0">Tidak Ada</option>
										<option selected value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '2': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option selected value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '3': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option selected value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '4': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option selected value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '5': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option selected value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '6': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option selected value="6">6</option>
										<option value="7">7</option>
										<?php break;
												
												case '7': ?>
										<option value="0">Tidak Ada</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option selected value="7">7</option>
										<?php break;
												}
												break;
											}
										}
										?>


									</select>
									<?= form_error('tanggungan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Pekerjaan</label>
									<input type="text" class="form-control"  autocomplete="off" name="pekerjaan"
										value="<?= $form->pekerjaan ?>">
									<?= form_error('pekerjaan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Penghasilan</label>
									<select class="form-select form-select-sm mb-3" name="penghasilan">
										<?php
											$penghasilan = set_value('penghasilan');
											if (isset($penghasilan)) {
												switch ($penghasilan) {
													case '500000': ?>
										<option selected value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '1000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option selected value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '2000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option selected value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '3000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option selected value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '4000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option selected value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '5000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option selected value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '6000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option selected value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '7000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option selected value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '8000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option selected value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '9000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option selected value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '10000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option selected value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													default:
													switch ($form->penghasilan) {
														case '500000': ?>
										<option selected value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '1000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option selected value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '2000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option selected value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '3000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option selected value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '4000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option selected value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '5000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option selected value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '6000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option selected value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '7000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option selected value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '8000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option selected value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '9000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option selected value="9000000">Rp. 9.000.000</option>
										<option value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													
													case '10000000': ?>
										<option value="500000">Di Bawah Rp.500.0000</option>
										<option value="1000000">Rp. 1.000.000</option>
										<option value="2000000">Rp. 2.000.000</option>
										<option value="3000000">Rp. 3.000.000</option>
										<option value="4000000">Rp. 4.000.000</option>
										<option value="5000000">Rp. 5.000.000</option>
										<option value="6000000">Rp. 6.000.000</option>
										<option value="7000000">Rp. 7.000.000</option>
										<option value="8000000">Rp. 8.000.000</option>
										<option value="9000000">Rp. 9.000.000</option>
										<option selected value="10000000">Di Atas Rp. 10.000.000</option>
										<?php break;
													}
													break;
												}
											}
										?>


									</select>
									<?= form_error('penghasilan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Pasangan</label>
									<input type="text" class="form-control"  autocomplete="off" name="nama_pasangan"
										value="<?= $form->namaPasangan ?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">NIK Pasangan</label>
									<input type="text" class="form-control"  autocomplete="off" name="nik_pasangan"
										value="<?= $form->nikPasangan ?>"  onkeypress="return hanyaAngka(event)">
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tempat Lahir Pasangan</label>
									<input type="text" class="form-control"  autocomplete="off" name="tl_lahir_pasangan"
										value="<?= $form->tlPasangan ?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Tanggal Lahir Pasangan</label>
									<input type="date" class="form-control" name="tg_lahir_pasangan"
										value="<?= $form->tglPasangan ?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">No Telepon Lainya</label>
									<input type="text" class="form-control"  autocomplete="off" name="no_hp_lain"
										value="<?= $form->noHpPasangan ?>"  onkeypress="return hanyaAngka(event)">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Ibu Kandung</label>
									<input type="text" class="form-control"  autocomplete="off" name="nama_ibu"
										value="<?= $form->namaIbu ?>">
									<?= form_error('nama_ibu', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-3" style="display:none;">
								<div class="mb-3">
									<label class="form-label">Status Anggota</label>
									<select class="form-select form-select-sm mb-3" name="status_anggota">
										<?php
										$status_anggota = set_value('status_anggota');
										if (isset($status_anggota)) {
											switch ($status_anggota) {
												case '1': ?>
										<option selected value="1">Aktif</option>
										<option value="2">Non-Aktif</option>
										<?php break;
												
												case '2': ?>
										<option value="1">Aktif</option>
										<option selected value="2">Non-Aktif</option>
										<?php break;
												
												default: ?>
										<option value="">-- Pilih --</option>
										<option selected value="1">Aktif</option>
										<option value="2">Non-Aktif</option>
										<?php break;
											}
										}else { ?>
										<option value="">-- Pilih --</option>
										<option value="1">Aktif</option>
										<option value="2">Non-Aktif</option>
										<?php }
										?>

									</select>
									<?= form_error('status_anggota', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto KTP Anggota</label>
									<input type="file" class="form-control" name="fotoKtpAnggota">
									<?= form_error('fotoKtpAnggota', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto KTP Pasangan</label>
									<input type="file" class="form-control" name="fotoKtpPasangan">
									<?= form_error('fotoKtpPasangan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<?php }

						?>
						<button type="submit" class="btn btn-primary me-2">Proses</button>
						<button class="btn btn-secondary">Kembali</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
