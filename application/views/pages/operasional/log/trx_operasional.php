<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
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
								</tr>
							</thead>
							<tbody>
								<?php $no =1;
                                foreach ($data as $r) {
									if ($r->type != 'tsimpok' || $r->type != 'tsimwa' || $r->type != 'tsimka') { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= '<code>*******</code>'.substr($r->serialNumber, 7) ?></td>
                                        <td><?= 'Uang '.ucwords($r->type) ?></td>
                                        <td><?= 'Rp. ' . number_format($r->nilaiTransaksi) ?></td>
                                        <td><?= ucwords($r->keterangan) ?></td>
                                        <td><?= $r->lastUpdate_t ?></td>
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
