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
					<?php 
						if (!isset($updateNilai)) { ?>
						<form class="forms-sample" action="<?= base_url('operasional/pengajuan_pinjaman/process/')?>" method="POST"
								enctype="multipart/form-data">

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Total Kas Tersedia</label>

									<input type="text" class="form-control" value="<?= 'Rp. '.number_format($kas) ?>"
										readonly style="border:0">

								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-4">
									<label class="form-label">Jumlah Pinjaman</label>
									<input type="text" class="form-control uang" name="jumlah"
										value="<?= set_value('jumlah') ?>">
									<?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Karyawan</label>
									<select class="form-select form-select-sm mb-3" name="karyawan">

										<option selected value="">-- Pilih --</option>
										<?php
                                            foreach ($data as $r) { ?>
										<option value="<?= $r->id_admin; ?>"><?= ucwords($r->namaLengkap); ?></option>
										<?php } ?>

									</select>
									<?= form_error('karyawan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

						</div>
					<?php }else { ?>
						<form class="forms-sample" action="<?= base_url('operasional/data_pinjaman/process_update/').$updateNilai ?>" method="POST"
								enctype="multipart/form-data">

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Total Kas Tersedia</label>

									<input type="text" class="form-control" value="<?= 'Rp. '.number_format($kas) ?>"
										readonly style="border:0">

								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Jumlah Sisa Pinjaman</label>
									<input type="text" class="form-control" style="border:0;"
										value="Rp. <?= number_format($data->sisaPinjaman) ?>" readonly>
									<?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Jumlah Tambahan Pinjaman</label>
									<input type="number" class="form-control" name="jumlah"
										value="">
									<?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Karyawan</label>
									<select class="form-select form-select-sm mb-3" name="karyawan">
										<option value="<?= $data->id_admin; ?>" selected><?= ucwords($data->namaLengkap); ?></option>

									</select>
									<?= form_error('karyawan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							</div>

						</div>
					<?php }
					?>


						<button type="submit" class="btn btn-primary me-2">Update</button>
						<button class="btn btn-secondary">Kembali</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
