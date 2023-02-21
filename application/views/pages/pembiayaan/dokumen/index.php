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

					<div class="table-responsive">
						<table id="dataTableExample" class="table dataTable no-footer">
							<thead>
								<tr>
									<th>No</th>
									<th>Nomor Dokumen</th>
									<th>ID Anggota</th>
									<th>Nama Anggota</th>
									<th>Nomor Hp</th>
									<th>Tanggal Update</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
                                    foreach ($data as $r) {?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= '<code>**********</code>'. substr($r->dokumen_id, 10) ?></td>
									<td><?= $r->id_anggota ?></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?= $r->no_hp ?></td>
									<td><?= date_indo($r->lastUpdate_d) ?></td>
									<td>
										<div class="example">
											<a type="button" class="badge bg-info" data-bs-toggle="modal" data-bs-target=".<?= $r->dokumen_id ?>">Selengkapnya</a>
											<a type="button" class="badge bg-primary" onclick="downloadMe('<?= $r->dokumen_id ?>');">Download</a>
										</div>
									</td>
								</tr>
								<?php }
                                ?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>


</div>


<?php foreach ($data as $r ) { ?>
<div class="modal fade <?= $r->dokumen_id ?>" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title h4" id="myExtraLargeModalLabel">Detail Dokumen <code>[ <?= ucwords($r->namaAnggota) ?> ]</code></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"> </button>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php
                        if ($r->foto2 == NULL && $r->foto3  == NULL) { ?>
					<div class="col-md-12">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto1 ?>" class="img-fluid">
					</div>
					<?php }elseif ($r->foto3 == NULL) { ?>
					<div class="col-md-6">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto1 ?>" class="img-fluid">
					</div>
					<div class="col-md-6">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto2 ?>" class="img-fluid">
					</div>
					<?php }elseif ($r->foto2 == NULL) { ?>
					<div class="col-md-6">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto1 ?>" class="img-fluid">
					</div>
					<div class="col-md-6">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto3 ?>" class="img-fluid">
					</div>

					<?php }else { ?>
					<div class="col-md-4">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto1 ?>" class="img-fluid">
					</div>
					<div class="col-md-4">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto2 ?>" class="img-fluid">
					</div>
					<div class="col-md-4">
						<img src="<?= base_url('public/img_documents/').$r->dokumen_id.'/'.$r->foto3 ?>" class="img-fluid"> </div>

					<?php } ?>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td style="font-weight: bold; width:50%;">ID Dokumen</td>
									<td style="width:50%"><?= $r->dokumen_id ?></td>
								</tr>
								<tr>
									<td style="font-weight: bold; width:50%;">Jenis Dokumen</td>
									<td style="width:50%"><?= $r->jenisDokumen ?></td>
								</tr>
								<tr>
									<td style="font-weight: bold; width:50%;">Nomor Surat</td>
									<td style="width:50%"><?= $r->nomorSurat ?></td>
								</tr>
								<tr>
									<td style="font-weight: bold; width:50%;">Status Kepemilikan</td>
									<td style="width:50%"><?php switch ($r->statusKepemilikan) {
                                        case '1':
                                           echo "Pribadi";
                                            break;
                                        case '2':
                                           echo "Orang Tua";
                                            break;
                                        case '3':
                                           echo "Pasangan";
                                            break;
                                        
                                    } ?></td>
								</tr>
								<tr>
									<td style="font-weight: bold; width:50%;">Nama Pemilik</td>
									<td style="width:50%"><?= ucwords($r->namaPemilik) ?></td>
								</tr>
								<tr>
									<td style="font-weight: bold; width:50%;">Yang Kelola Sawah</td>
									<td style="width:50%"><?php switch ($r->kelolaSawah) {
                                        case '1':
                                           echo "Sendiri";
                                            break;
                                        case '2':
                                           echo "Orang Lain";
                                            break;
                                        default:
                                            echo "Sendiri";
                                            break;
                                        
                                    } ?></td>
								</tr>
                                <tr>
									<td style="font-weight: bold; width:50%;">Tanggal Survey</td>
									<td style="width:50%"><?= $r->tglSurvey ?></td>
                                </tr>

                                <tr>
									<td style="font-weight: bold; width:50%;">Luas Sawah Jaminan</td>
									<td style="width:50%"><?= $r->luasJaminan ?></td>
                                </tr>
                                <tr>
									<td style="font-weight: bold; width:50%;">Alamat Jaminan</td>
									<td style="width:50%"><?= $r->alamatJaminan ?></td>
								</tr>
								<tr>
									<td style="font-weight: bold; width:50%;">Lokasi Usaha / Sawah</td>
									<td style="width:50%"><?= $r->lokasi ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tbody>

                                <tr>
									<td style="font-weight: bold; width:50%;">Nama Keuchik</td>
									<td style="width:50%"><?= ucwords($r->namaKeuchik) ?></td>
								</tr>

                                <tr>
									<td style="font-weight: bold; width:50%;">Nomor Hp Keuchik</td>
									<td style="width:50%"><?= $r->hpKeuchik ?></td>
								</tr>
                                <tr>
									<td style="font-weight: bold; width:50%;">Nama Keujrun</td>
									<td style="width:50%"><?= ucwords($r->namaKeujrun) ?></td>
								</tr>

                                <tr>
									<td style="font-weight: bold; width:50%;">Nomor Hp Keujrun</td>
									<td style="width:50%"><?= $r->hpKeujrun ?></td>
								</tr>
                                <tr>
									<td style="font-weight: bold; width:50%;">Nama Tetangga</td>
									<td style="width:50%"><?= ucwords($r->namaTetangga) ?></td>
								</tr>

                                <tr>
									<td style="font-weight: bold; width:50%;">Nomor Hp Tetangga</td>
									<td style="width:50%"><?= $r->hpTetangga ?></td>
								</tr>

                                <tr>
									<td style="font-weight: bold; width:50%;">Luas Lahan Sawah Milik Orang Lain Yang Dikelola <code>*
											(Jika Ada)</td>
									<td style="width:50%"><?= $r->luasSawah_lain ?></td>
								</tr>
                                <tr>
									<td style="font-weight: bold; width:50%;">Luas Lahan Sawah Dalam Status Gadai Pada Pihak
										Lain</td>
									<td style="width:50%"><?= $r->luasSawah_gadai ?></td>
								</tr>
                                <tr>
									<td style="font-weight: bold; width:50%;">Luas Lahan Sendiri Yang Dikelola</td>
									<td style="width:50%"><?= $r->luasKelola ?></td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>


<script>
	function downloadMe(value) {
		alert('Fitur Ini Akan Segera Hadir !');
	}

	function editMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Apakah Yakin Ingin Mengedit Data Ini ?',
			icon: 'info',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya !',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('pembiayaan/data_anggota/update/') ?>" + value + '/edit'
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				actDelete.fire(
					'Sudah di batalkan !',
					'Operasi Batal di buat !',
					'error'
				)
			}
		})
	}

</script>
