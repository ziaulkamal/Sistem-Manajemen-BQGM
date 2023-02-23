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

					<form class="forms-sample" action="<?= base_url('setoran/process/'). $rekening ?>" method="POST"
						enctype="multipart/form-data">

						<div class="row">
							<div class="col-md-6">
								<div class="mb-4">
									<label class="form-label">Anggota</label>
									<input type="text" class="form-control" value="<?= ucwords($data->namaAnggota). '  ***[ '.$data->anggota_id.' ]***'; ?>"
										readonly>

								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Jenis</label>
									<select class="form-select form-select-sm mb-3" name="jenis">
                                        <?php
                                        $jenis = set_value('jenis');
                                            switch ($jenis) {
                                                case '1':?>
                                                <option selected value="1">Pokok</option>
                                                <option value="2">Wajib</option>
                                                <option value="3">Sukarela</option>
                                                <?php break;
                                                case '2':?>
                                                <option value="1">Pokok</option>
                                                <option selected value="2">Wajib</option>
                                                <option value="3">Sukarela</option>
                                                <?php break;
                                                case '3':?>
                                                <option value="1">Pokok</option>
                                                <option value="2">Wajib</option>
                                                <option selected value="3">Sukarela</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option value="" selected>-- Pilih --</option>
                                                <option value="1">Pokok</option>
                                                <option value="2">Wajib</option>
                                                <option value="3">Sukarela</option>
                                                <?php break;
                                            }
                                        ?>

									</select>
									<?= form_error('jenis', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="mb-4">
									<label class="form-label">Jumlah</label>
										<input type="text" class="form-control uang" name="jumlah" value="<?= set_value('jumlah') ?>">
									<?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary me-2">Update !</button>


					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">History Transaksi Terakhir</h4>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<?php
									foreach ($table as $r) { ?>
									<tr class="table-info">
										<td><?= ucwords($r->keterangan) ?></td>
										<td><?= longdate_indo($r->lastUpdate_t) ?></td>
									</tr>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
