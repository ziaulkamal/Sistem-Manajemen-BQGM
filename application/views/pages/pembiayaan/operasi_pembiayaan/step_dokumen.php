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


		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<form class="forms-sample" action="<?= base_url('dokumen/pinjaman/process/').$id.'/baru/1' ?>"
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
									<label class="form-label">Alamat</label>
									<input type="text" class="form-control"
										value="<?= ucwords($data->alamatSekarang) ?>" readonly>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Tanggal Survey</label>
									<input type="date" class="form-control date" name="tgl_survey" value="<?= set_value('tgl_survey') ?>">
                                    <?= form_error('tgl_survey', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Dokumen Jaminan / Anggunan</label>
									<select class="form-select form-select-sm mb-3" name="jenis_dokumen">
                                        <?php
                                            $jenis_dokumen = set_value('jenis_dokumen');
                                            switch ($jenis_dokumen) {
                                                case 'SHM': ?>
                                                <option selected value="SHM">SHM</option>
                                                <option value="AJB">AJB</option>
                                                <option value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option value="APHB">APHB</option>
                                                <option value="BPKB">BPKB</option>
                                                <option value="SHM">SHM</option>
                                                <?php break;
                                                
                                                case 'AJB': ?>
                                                <option value="SHM">SHM</option>
                                                <option selected value="AJB">AJB</option>
                                                <option value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option value="APHB">APHB</option>
                                                <option value="BPKB">BPKB</option>
                                                <option value="SHM">SHM</option>
                                                <?php break;
                                                
                                                case 'AKTA-HIBAH': ?>
                                                <option value="SHM">SHM</option>
                                                <option value="AJB">AJB</option>
                                                <option selected value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option value="APHB">APHB</option>
                                                <option value="BPKB">BPKB</option>
                                                <option value="SHM">SHM</option>
                                                <?php break;
                                                
                                                case 'APHB': ?>
                                                <option value="SHM">SHM</option>
                                                <option value="AJB">AJB</option>
                                                <option value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option selected value="APHB">APHB</option>
                                                <option value="BPKB">BPKB</option>
                                                <option value="SHM">SHM</option>
                                                <?php break;
                                                
                                                case 'BPKB': ?>
                                                <option value="SHM">SHM</option>
                                                <option value="AJB">AJB</option>
                                                <option value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option value="APHB">APHB</option>
                                                <option selected value="BPKB">BPKB</option>
                                                <option value="SHM">SHM</option>
                                                <?php break;
                                                
                                                case 'SHM': ?>
                                                <option value="SHM">SHM</option>
                                                <option value="AJB">AJB</option>
                                                <option value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option value="APHB">APHB</option>
                                                <option value="BPKB">BPKB</option>
                                                <option selected value="SHM">SHM</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option selected value=""> -- Pilih --</option>
                                                <option value="SHM">SHM</option>
                                                <option value="AJB">AJB</option>
                                                <option value="AKTA-HIBAH">AKTA HIBAH</option>
                                                <option value="APHB">APHB</option>
                                                <option value="BPKB">BPKB</option>
                                                <option value="SHM">SHM</option>
                                                <?php break;
                                            }
                                        ?>
										
									</select>
                                    <?= form_error('jenis_dokumen', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

						</div>

						<div class="row">


							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Nama Pemilik Jaminan</label>
									<input type="text" class="form-control" name="nama_pemilik" value="<?= set_value('nama_pemilik') ?>">
                                    <?= form_error('nama_pemilik', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Alamat Jaminan</label>
									<input type="text" class="form-control" name="alamat_jaminan" value="<?= set_value('alamat_jaminan') ?>">
                                    <?= form_error('alamat_jaminan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Nomor</label>
									<input type="text" class="form-control" name="nomor_jaminan" value="<?= set_value('nomor_jaminan') ?>">
                                    <?= form_error('nomor_jaminan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Luas</label>
									<input type="text" class="form-control" name="luas_jaminan" value="<?= set_value('luas_jaminan') ?>">
                                    <?= form_error('luas_jaminan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Kepemilikan Jaminan</label>
									<select class="form-select form-select-sm mb-3" name="kepemilikan_jaminan">
                                        <?php
                                        $kepemilikan_jaminan = set_value('kepemilikan_jaminan');

                                        switch ($kepemilikan_jaminan) {
                                            case '1': ?>
                                            <option selected value="1">Sendiri</option>
                                            <option value="2">Orang Tua</option>
                                            <option value="3">Pasangan</option>
                                             <?php break;
                                            
                                            case '2': ?>
                                            <option value="1">Sendiri</option>
                                            <option selected value="2">Orang Tua</option>
                                            <option value="3">Pasangan</option>
                                             <?php break;
                                            
                                            case '3': ?>
                                            <option value="1">Sendiri</option>
                                            <option value="2">Orang Tua</option>
                                            <option selected value="3">Pasangan</option>
                                             <?php break;
                                            
                                            default: ?>
                                            <option selected value=""> -- Pilih --</option>
                                            <option value="1">Sendiri</option>
                                            <option value="2">Orang Tua</option>
                                            <option value="3">Pasangan</option>
                                            <?php break;
                                        }
                                        ?>
									</select>
                                    <?= form_error('kepemilikan_jaminan', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Alamat Sawah / Usaha</label>
									<input type="text" class="form-control" name="alamat_sawah" value="<?= set_value('alamat_sawah') ?>">
                                    <?= form_error('alamat_sawah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Yang Kelola Sawah</label>
									<select class="form-select form-select-sm mb-3" name="pengelola_sawah">
                                        <?php
                                        $pengelola_sawah = set_value('pengelola_sawah');

                                        switch ($pengelola_sawah) {
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
                                        } ?>

									</select>
                                    <?= form_error('pengelola_sawah', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Luas Lahan Sawah Milik Orang Lain Yang Dikelola <code>*
											(Jika Ada)</code></label>
									<input type="text" class="form-control" name="luas_sawah_x" value="<?= set_value('luas_sawah_x') ?>"  onkeypress="return hanyaAngka(event)">
                                    
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Satuan</label>
									<select class="form-select form-select-sm mb-3" name="satuan_sawah_x">
                                        <?php $satuan_sawah_x = set_value('satuan_sawah_x');
                                            switch ($satuan_sawah_x) {
                                                case 'bambu': ?>
                                                <option selected value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                                
                                                case 'nalis': ?>
                                                <option value="bambu">Bambu</option>
                                                <option selected value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                                
                                                case 'm2': ?>
                                                <option value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option selected value="m2">M²</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option selected value=""> -- Pilih --</option>
                                                <option value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                            } ?>

									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto Utama</label>
									<input type="file" class="form-control" name="img_satu">
                                    <?= form_error('img_satu', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Luas Lahan Sawah Dalam Status Gadai Pada Pihak
										Lain</label>
									<input type="text" class="form-control" name="luas_sawah_y" value="<?= set_value('luas_sawah_y') ?>"  onkeypress="return hanyaAngka(event)">
                                    <?= form_error('luas_sawah_y', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Satuan</label>
									<select class="form-select form-select-sm mb-3" name="satuan_sawah_y">
                                        <?php $satuan_sawah_y = set_value('satuan_sawah_y');
                                            switch ($satuan_sawah_y) {
                                                case 'bambu': ?>
                                                <option selected value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                                
                                                case 'nalis': ?>
                                                <option value="bambu">Bambu</option>
                                                <option selected value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                                
                                                case 'm2': ?>
                                                <option value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option selected value="m2">M²</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option selected value=""> -- Pilih --</option>
                                                <option value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                            } ?>
									</select>
                                    <?= form_error('satuan_sawah_y', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto Pendukung</label>
									<input type="file" class="form-control" name="img_dua">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="mb-3">
									<label class="form-label">Luas Lahan Sendiri Yang Dikelola</label>
									<input type="text" class="form-control" name="luas_sawah_z" value="<?= set_value('luas_sawah_z') ?>"  onkeypress="return hanyaAngka(event)">
                                    <?= form_error('luas_sawah_z', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-2">
								<div class="mb-3">
									<label class="form-label">Satuan</label>
									<select class="form-select form-select-sm mb-3" name="satuan_sawah_z">
                                        <?php $satuan_sawah_z = set_value('satuan_sawah_z');
                                            switch ($satuan_sawah_z) {
                                                case 'bambu': ?>
                                                <option selected value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                                
                                                case 'nalis': ?>
                                                <option value="bambu">Bambu</option>
                                                <option selected value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                                
                                                case 'm2': ?>
                                                <option value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option selected value="m2">M²</option>
                                                <?php break;
                                                
                                                default: ?>
                                                <option selected value=""> -- Pilih --</option>
                                                <option value="bambu">Bambu</option>
                                                <option value="nalis">Nalis</option>
                                                <option value="m2">M²</option>
                                                <?php break;
                                            } ?>
									</select>
                                    <?= form_error('satuan_sawah_z', '<small class="text-danger">', '</small>') ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mb-3">
									<label class="form-label">Foto Pendukung</label>
									<input type="file" class="form-control" name="img_tiga">
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
