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


		<div class="col-md-10 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url('dokumen/survey/process/').$id.'/3' ?>"
						method="POST" enctype="multipart/form-data">
						<!-- <input type="hidden" name="pengajuan" value="baru" readyonly> -->
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nama Anggota</label>
									<input type="text" class="form-control" value="<?= ucwords($data->namaAnggota).' ***'.$data->id_anggota.'***' ?>"
										readonly>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Nomor Dokumen</label>
									<input type="text" class="form-control"
										value="<?= ucwords($data->id_dokumen) ?>" readonly>
								</div>
							</div>


						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Sikap Konsumen Selama Interview</label>
									<select class="form-select form-select-sm mb-3" name="sikap">
                                        <?php
                                        $sikap = set_value('sikap');

                                        switch ($sikap) {
                                            case '1': ?>
                                            <option selected value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            case '2': ?>
                                            <option value="1">Baik</option>
                                            <option selected value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            case '3': ?>
                                            <option value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option selected value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            default: ?>
                                            <option selected value=""> -- Pilih --</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                            <?php break;
                                        }
                                        ?>
									</select>
                                    <?= form_error('sikap', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Kemudahan Dalam Memberikan Informasi</label>
									<select class="form-select form-select-sm mb-3" name="kemudahan">
                                        <?php
                                        $kemudahan = set_value('kemudahan');

                                        switch ($kemudahan) {
                                            case '1': ?>
                                            <option selected value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            case '2': ?>
                                            <option value="1">Baik</option>
                                            <option selected value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            case '3': ?>
                                            <option value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option selected value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            default: ?>
                                            <option selected value=""> -- Pilih --</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                            <?php break;
                                        }
                                        ?>
									</select>
                                    <?= form_error('kemudahan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Pengecekan Pola Hidup Nasabah</label>
									<select class="form-select form-select-sm mb-3" name="pola">
                                        <?php
                                        $pola = set_value('pola');

                                        switch ($pola) {
                                            case '1': ?>
                                            <option selected value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            case '2': ?>
                                            <option value="1">Baik</option>
                                            <option selected value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            case '3': ?>
                                            <option value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option selected value="3">Kurang Baik</option>
                                             <?php break;
                                            
                                            default: ?>
                                            <option selected value=""> -- Pilih --</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Cukup Baik</option>
                                            <option value="3">Kurang Baik</option>
                                            <?php break;
                                        }
                                        ?>
									</select>
                                    <?= form_error('pola', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Nama Keuchik</label>
									<input type="text" class="form-control" name="nama_keuchik" value="<?= set_value('nama_keuchik') ?>">
                                    <?= form_error('nama_keuchik', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">No Hp Keuchik</label>
									<input type="text" class="form-control" name="hp_keuchik" value="<?= set_value('hp_keuchik') ?>"  onkeypress="return hanyaAngka(event)">
                                    <?= form_error('hp_keuchik', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Nama Keujrun</label>
									<input type="text" class="form-control" name="nama_keujrun" value="<?= set_value('nama_keujrun') ?>">
                                    <?= form_error('nama_keujrun', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">No Hp Keujrun</label>
									<input type="text" class="form-control" name="hp_keujrun" value="<?= set_value('hp_keujrun') ?>"  onkeypress="return hanyaAngka(event)">
                                    <?= form_error('hp_keujrun', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Nama Tetangga</label>
									<input type="text" class="form-control" name="nama_tetangga" value="<?= set_value('nama_tetangga') ?>">
                                    <?= form_error('nama_tetangga', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">No Hp Tetangga</label>
									<input type="text" class="form-control" name="hp_tetangga" value="<?= set_value('hp_tetangga') ?>"  onkeypress="return hanyaAngka(event)">
                                    <?= form_error('hp_tetangga', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>


						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Apakah Layak Diberikan</label>
									<select class="form-select form-select-sm mb-3" name="layak">
                                        <?php
                                        $layak = set_value('layak');

                                        switch ($layak) {
                                            case '1': ?>
                                            <option selected value="1">Layak</option>
                                            <option value="2">Belum Layak</option>
                                             <?php break;
                                            
                                            case '2': ?>
                                            <option value="1">Layak</option>
                                            <option selected value="2">Belum Layak</option>

                                             <?php break;
                                            
                                            default: ?>
                                            <option selected value=""> -- Pilih --</option>
                                            <option value="1">Layak</option>
                                            <option value="2">Belum Layak</option>
                                            <?php break;
                                        }
                                        ?>
									</select>
                                    <?= form_error('layak', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Apakah Pembiayaan Digunakan Oleh Nasabah Sendiri ?</label>
									<select class="form-select form-select-sm mb-3" name="penggunaan">
                                        <?php
                                        $penggunaan = set_value('penggunaan');

                                        switch ($penggunaan) {
                                            case '1': ?>
                                            <option selected value="1">Sendiri</option>
                                            <option value="2">Orang Lain</option>
                                             <?php break;
                                            
                                            case '2': ?>
                                            <option value="1">Sendiri</option>
                                            <option selected value="2">Orang Lain</option>

                                             <?php break;
                                            
                                            default: ?>
                                            <option selected value=""> -- Pilih --</option>
                                            <option value="1">Sendiri</option>
                                            <option value="2">Orang Lain</option>
                                            <?php break;
                                        }
                                        ?>
									</select>
                                    <?= form_error('penggunaan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

                        </div>


						<div class="example">
							<button type="reset" class="btn btn-dark">Reset</button>
							<button type="submit" class="btn btn-primary me-2">Simpan</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
