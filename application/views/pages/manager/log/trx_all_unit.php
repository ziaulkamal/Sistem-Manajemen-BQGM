<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title"><?= $title; ?></h6>
					<div class="table-responsive">
						<table id="dataTableExample" class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Jenis</th>
									<th>Nilai</th>
									<th>Keterangan</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;

									foreach ($data as $r) { ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= '<code>****</code>' . substr($r->serialNumber, 4) ?></td>
											<td><?= ucwords($r->type) ?></td>
											<td><?= 'Rp. '. number_format($r->nilaiTransaksi) ?></td>
											<td><?= ucwords($r->keterangan) ?></td>
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
