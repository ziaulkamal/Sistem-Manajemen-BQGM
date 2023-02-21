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
									<th>Opsi</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                foreach ($data as $r) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= '<code>*******</code>'.substr($r->serialNumber, 7) ?></td>
                                        <td><?= ucwords($r->type) ?></td>
                                        <td><?= 'Rp. ' . number_format($r->nilaiTransaksi) ?></td>
                                        <td><?= ucwords($r->keterangan) ?></td>
                                        <td><a href="<?= base_url('teller/invoice/' .$r->serialNumber. '/' .$r->type. '/datas'); ?>" class="badge bg-info" >Print Invoice</a></td>
                                        <td><?= date_indo($r->lastUpdate_t) ?></td>
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
