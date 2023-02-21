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
        
        
        <?php if (!$this->session->flashdata('msg')) { ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Info !</strong> <?= $notice; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
		</div>
        <?php } ?>
		
		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url('operasional/process_trx/').$action ?>" method="POST"
						enctype="multipart/form-data">

						<div class="row">
							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Total Kas Tersedia</label>
									<input type="text" class="form-control" value="<?= 'Rp. '.number_format($kas) ?>" readonly style="border:0">

								</div>
							</div>

							<div class="col-md-3">
								<div class="mb-3">
									<label class="form-label">Jumlah Transaksi</label>
									<input type="text" class="form-control uang" name="jumlah"
										value="<?= set_value('jumlah') ?>">
									<?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Tanggal Transaksi <code>* akan di set tanggal hari ini jika dikosongkan</code></label>
									<input type="date" class="form-control" name="tanggal_update"
										value="<?= set_value('tanggal_update') ?>">
									<?= form_error('tanggal_update', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>
						<?php if ($action != 'masuk') { ?>
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Jenis</label>
									<select class="form-select form-select-sm mb-3" name="jenis">
										<option value="">--Pilih--</option>
										<option value="keluar">Uang Keluar Lain</option>
										<option value="belanja">Belanja Operasional</option>


									</select>
									<?= form_error('jenis','<small class="text-danger">', '</small>') ?>
								</div>
							</div>
								<?php } ?>
						<div class="row">
							<div class="col-md-12">
								<div class="mb-3">
									<label class="form-label">Keterangan</label>
                                    <textarea rows="5" class="form-control" name="keterangan"><?= set_value('keterangan') ?></textarea>
                                    <?= form_error('keterangan','<small class="text-danger">', '</small>') ?>
								</div>
							</div>

						</div>


						
						<button type="submit" class="btn btn-primary me-2">Update</button>
						<button class="btn btn-secondary">Kembali</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
