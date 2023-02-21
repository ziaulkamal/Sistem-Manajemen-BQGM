<div class="page-content">

	<?php error_reporting(0); $this->load->view('partials/extra/breadcrumb'); ?>

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


		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url('pengajuan/pinjaman/process/').$id.'/2' ?>"
						method="POST" enctype="multipart/form-data">
						<!-- <input type="hidden" name="pengajuan" value="baru" readyonly> -->
						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Nama Anggota</label>
									<input type="text" class="form-control" value="<?= ucwords($data->namaAnggota).' ***'.$data->id_anggota.'***' ?>"
										readonly>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Nomor Dokumen</label>
									<input type="text" class="form-control"
										value="<?= ucwords($data->id_dokumen) ?>" readonly>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Prediksi Panen</label>
									<input type="date" class="form-control date" name="prediksi" value="<?= set_value('prediksi') ?>">
                                    <?= form_error('prediksi', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>


						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Penghasilan Lainya Selama 6 Bulan</label>
									<input type="text" class="form-control uang" name="pl6bulan" value="<?= set_value('pl6bulan') ?>">
                                    <?= form_error('pl6bulan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Pengeluaran Biaya Rumah Tangga Selama 6 Bulan</label>
									<input type="text" class="form-control uang" name="pbrt6bulan" value="<?= set_value('pbrt6bulan') ?>">
                                    <?= form_error('pbrt6bulan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Angsuran Lainya Selama 6 Bulan <code>*(jika ada)</code></label>
									<input type="text" class="form-control uang" name="al6bulan" value="<?= set_value('al6bulan') ?>">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Biaya Operasional</label>
									<input type="text" class="form-control uang" name="bo" value="<?= set_value('bo') ?>">
                                    <?= form_error('bo', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Proyeksi Panen <code>*(Kg)</code></label>
									<input type="text" class="form-control uang" name="proyeksi" value="<?= set_value('proyeksi') ?>">
                                    <?= form_error('proyeksi', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Jangka Waktu</label>
                                    <select class="form-select form-select-sm mb-3" name="tenor">
                                        <?php
                                            $tenor = set_value('tenor');
                                            switch ($tenor) {
                                                case '1': ?>
                                                <option selected value="1">1x Panen</option>
                                                <option value="2">2x Panen</option>
                                                <option value="3">3x Panen</option>
                                                <option value="4">4x Panen</option>
                                                <option value="5">5x Panen</option>
                                                <?php break;
                                                
                                                case '2': ?>
                                                <option value="1">1x Panen</option>
                                                <option selectted value="2">2x Panen</option>
                                                <option value="3">3x Panen</option>
                                                <option value="4">4x Panen</option>
                                                <option value="5">5x Panen</option>
                                                <?php break;

                                                case '3': ?>
                                                <option value="1">1x Panen</option>
                                                <option value="2">2x Panen</option>
                                                <option selected value="3">3x Panen</option>
                                                <option value="4">4x Panen</option>
                                                <option value="5">5x Panen</option>
                                                <?php break;

                                                case '4': ?>
                                                <option value="1">1x Panen</option>
                                                <option value="2">2x Panen</option>
                                                <option value="3">3x Panen</option>
                                                <option selected value="4">4x Panen</option>
                                                <option value="5">5x Panen</option>
                                                <?php break;

                                                case '5': ?>
                                                <option value="1">1x Panen</option>
                                                <option value="2">2x Panen</option>
                                                <option value="3">3x Panen</option>
                                                <option value="4">4x Panen</option>
                                                <option selected value="5">5x Panen</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option selected value="">- Pilih -</option>
                                                <option value="1">1x Panen</option>
                                                <option value="2">2x Panen</option>
                                                <option value="3">3x Panen</option>
                                                <option value="4">4x Panen</option>
                                                <option value="5">5x Panen</option>
                                                <?php break;
                                            } ?>


                                    </select>
                                    <?= form_error('tenor', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Harga Gabah</label>
                                    <select class="form-select form-select-sm mb-3" name="harga_gabah">
                                        <?php
                                            $harga_gabah = set_value('harga_gabah');
                                            switch ($harga_gabah) {
                                                case '3800': ?>
                                                <option selected value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '3900': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option selected value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4000': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option selected value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4100': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option selected value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4300': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option selected value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4400': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option selected value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4500': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option selected value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4600': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option selected value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4700': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option selected value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4800': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option selected value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '4900': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option selected value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                case '5000': ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option selected value="5000">Rp. 5.000</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option value="3800">Rp. 3.800</option>
                                                <option value="3900">Rp. 3.900</option>
                                                <option value="4000">Rp. 4.000</option>
                                                <option value="4100">Rp. 4.100</option>
                                                <option selected value="4200">Rp. 4.200</option>
                                                <option value="4300">Rp. 4.300</option>
                                                <option value="4400">Rp. 4.400</option>
                                                <option value="4500">Rp. 4.500</option>
                                                <option value="4600">Rp. 4.600</option>
                                                <option value="4700">Rp. 4.700</option>
                                                <option value="4800">Rp. 4.800</option>
                                                <option value="4900">Rp. 4.900</option>
                                                <option value="5000">Rp. 5.000</option>
                                                <?php break;
                                            }
                                        ?>
                                    </select>
                                    <?= form_error('harga_gabah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Account Officer</label>
                                    <select class="form-select form-select-sm mb-3" name="ao">
                                        <option value="" selected>- Pilih -</option>
                                        <?php
                                        foreach ($ao as $r) { ?>
                                            <option value="<?= $r->id_admin ?>"><?= ucwords($r->namaLengkap) ?></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('ao', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Pokok Rahn</label>
									<input type="text" class="form-control uang" name="rahn" value="<?= set_value('rahn') ?>">
                                    <?= form_error('rahn', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Pokok Mudharabah</label>
									<input type="text" class="form-control uang" name="mudharabah" value="<?= set_value('mudharabah') ?>">
                                    <?= form_error('mudharabah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

                        </div>


						<div class="example">
							<button type="reset" class="btn btn-dark">Reset</button>
							<button type="submit" class="btn btn-primary me-2">Lanjut</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
