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
									<th>Kode Transaksi</th>
									<th>Jenis Transaksi</th>
									<th>Jumlah</th>
									<th>Keterangan</th>
									<th>Tanggal</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                foreach ($data as $r) {
									if ($r->type != 'simpok' || $r->type != 'simwa' || $r->type != 'simka') { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= '<code>*******</code>'.substr($r->serialNumber, 7) ?></td>
                                        <td><?= 'Uang '.ucwords($r->type) ?></td>
                                        <td><?= 'Rp. ' . number_format($r->nilaiTransaksi) ?></td>
                                        <td><?= ucwords($r->keterangan) ?></td>
                                        <td><?= date_indo($r->lastUpdate_t) ?></td>
                                        <td>
                                            <div class="example">
                                                <a type="button" class="badge bg-info" onclick="approveMe('<?= $r->is_anggota ?>','<?= $r->type ?>','<?= $r->serialNumber ?>');">Setujui</a>
                                                <a type="button" class="badge bg-dark" onclick="rejectMe('<?= $r->serialNumber  ?>');">Tolak & Batalkan</a>
                                            </div>    
                                        </td>
                                    </tr>
                                <?php }

								 }

                                ?>
							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>


</div>


<script>
	function approveMe(id,type,serial) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Setujui Penarikan Simpanan Anggota ?',
			icon: 'info',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Lanjut!',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('operasional/approval/penarikan/process/') ?>" + id + '/' + type + '/' + serial
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
	function rejectMe(value) {
		const actDelete = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger me-2'
			},
			buttonsStyling: false,
		})
		actDelete.fire({
			title: 'Tolak & Hapus Permintaan Penarikan ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'me-2',
			confirmButtonText: 'Ya Lanjut!',
			cancelButtonText: 'Batal !',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				location.href = "<?= base_url('operasional/approval/penarikan/reject/') ?>" + value
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
