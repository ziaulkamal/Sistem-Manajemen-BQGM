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
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?= $title ?></h4>
					<form class="forms-sample" action="<?= base_url('laporan/pembiayaan/date/_lihat') ?>" method="POST"
						enctype="multipart/form-data">
						<div class="row mb-3">
							<div class="col-md-2">
								<label class="form-label"><span style="color:#FFF">.</span></label>
								<input type="button" onclick="ExportToExcel();" class="form-control btn btn-primary" value="Download">
							</div>
							<div class="col-md-2">
								<label class="form-label"><span style="color:#FFF">.</span></label>
								<input type="button" onclick="backTo();" class="form-control btn btn-success" value="Refresh Page">
							</div>
							<div class="col-md-2">
								<label class="form-label">AO Bertugas</label>
									<select class="form-select form-select-sm mb-3" name="ao">
										<option selected value="">-- Pilih --</option>
										<?php 

										foreach ($ao as $r) { ?> 
										<option value="<?= $r->id_admin ?>"><?= strtoupper($r->namaLengkap) ?></option>
										<?php }	?>


									</select>
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal Awal</label>
								<input type="date" name="s" class="form-control">
							</div>
							<div class="col-md-2">
								<label class="form-label">Tanggal Akhir</label>
								<input type="date" name="e" class="form-control">
							</div>
							<div class="col-md-2">
								<label class="form-label"><span style="color:#FFF">.</span></label>
								<input type="submit" class="form-control btn btn-info" value="Proses">
							</div>

						</div>

					</form>
					<div class="table-responsive">
						<table id="dataTableExample" class="table dataTable no-footer">
							<thead>
								<tr>
									<th>No</th>
									<th>ID Pinjaman</th>
									<th>Nama Anggota</th>
									<th>Plafon</th>
									<th>Pokok Rahn</th>
									<th>Pokok Mudharabah</th>
									<th>Bagi Hasil</th>
									<th>O/S Rahn</th>
									<th>O/S Mudharabah</th>
									<th>O/S Bagi Hasil</th>
									<th>Tenor Panen</th>
									<th>Sisa Tenor</th>
									<th>Tanggal Pengajuan</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
                                    foreach ($data as $r) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->id_pinjaman ?></td>
                                            <td><?= ucwords($r->namaAnggota) ?></td>
                                            <td><?= 'Rp. ' . number_format($r->pokokRahn + $r->pokokMudharabah) ?></td>
                                            <td><?= 'Rp. ' . number_format($r->pokokRahn) ?></td>
                                            <td><?= 'Rp. ' . number_format($r->pokokMudharabah) ?></td>
                                            <td><?= 'Rp. ' . number_format($r->bagiHasil*$r->tenor) ?></td>
                                            <td><?= 'Rp. ' . number_format((($r->pokokRahn/$r->tenor)*$r->sisaTenor)) ?></td>
                                            <td><?= 'Rp. ' . number_format((($r->pokokMudharabah/$r->tenor)*$r->sisaTenor) ) ?></td>
                                            <td><?= 'Rp. ' . number_format(($r->bagiHasil*$r->sisaTenor)) ?></td>
                                            <td><?= $r->tenor. 'x Panen' ?></td>
                                            <td><?= $r->sisaTenor. 'x Panen' ?></td>
                                            <td><?= date_indo($r->lastUpdate_p) ?></td>
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

<table id="downloadExcel" class="table dataTable no-footer" style="display:none">
							<thead>
								<tr>
									<th>No</th>
									<th>ID Pinjaman</th>
									<th>Nama Anggota</th>
									<th>Plafon</th>
									<th>Pokok Rahn</th>
									<th>Pokok Mudharabah</th>
									<th>Bagi Hasil</th>
									<th>O/S Rahn</th>
									<th>O/S Mudharabah</th>
									<th>O/S Bagi Hasil</th>
									<th>Tenor Panen</th>
									<th>Sisa Tenor</th>
									<th>Angsuran Pokok</th>
									<th>Bagi Hasil Perpanen</th>
									<th>Tanggal Pengajuan</th>
									<th>Panen Pertama</th>
									<th>Panen Kedua</th>
									<th>Panen Ketiga</th>
									<th>Panen Keempat</th>
									<th>Panen Kelima</th>
									<th>AO Bertugas</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
                                    foreach ($data as $r) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->id_pinjaman ?></td>
                                            <td><?= ucwords($r->namaAnggota) ?></td>
                                            <td><?= $r->pokokRahn + $r->pokokMudharabah ?></td>
                                            <td><?= $r->pokokRahn ?></td>
                                            <td><?= $r->pokokMudharabah ?></td>
											<td><?= $r->bagiHasil*$r->tenor ?></td>
                                            <td><?= (($r->pokokRahn/$r->tenor)*$r->sisaTenor) ?></td>
                                            <td><?= (($r->pokokMudharabah/$r->tenor)*$r->sisaTenor)  ?></td>
                                            <td><?= ($r->bagiHasil*$r->sisaTenor) ?></td>

                                            <td><?= $r->tenor. 'x Panen' ?></td>
                                            <td><?= $r->sisaTenor. 'x Panen' ?></td>
                                            <td><?= $r->pokokAngsuran ?></td>
                                            <td><?= $r->bagiHasil ?></td>
                                            <td><?= ($r->lastUpdate_p) ?></td>
                                            <td><?= ($r->angsuranPertama) ?></td>
                                            <td><?= ($r->angsuranKedua) ?></td>
                                            <td><?= ($r->angsuranKetiga) ?></td>
                                            <td><?= ($r->angsuranKeempat) ?></td>
                                            <td><?= ($r->angsuranKelima) ?></td>
                                            <td><?= ucwords($r->namaLengkap) ?></td>
                                        </tr>
                                    <?php } ?>
							</tbody>
						</table>

    <script>

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('downloadExcel');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('[Laporan] Data-Pembiayaan-<?= date('d-m-Y') ?>.' + (type || 'xlsx')));
        }
		
		function backTo() {
			window.location.href= "<?= base_url('laporan/pembiayaan/_lihat') ?>"
		}

    </script>

