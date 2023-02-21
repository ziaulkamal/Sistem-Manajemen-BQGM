<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<div class="col-12 col-xl-12 stretch-card">
			<div class="row flex-grow-1">
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Total Hutang</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['totalHutang'] != NULL) {
											echo 'Rp. ' . number_format($data['totalHutang']);
										}else {
											echo 'Rp. ' . number_format(0);
										}
									?></h3>
									<div class="d-flex align-items-baseline">
										<?php 
											if ($data['totalHutang_persentase'] > 0 ) { ?>
										<p class="text-success">
											<span>+<?= $data['totalHutang_persentase'] ?>%</span>
											<i data-feather="arrow-up" class="icon-sm mb-1"></i>
										</p>
										<?php }else { ?>
										<p class="text-danger">
											<span>-<?= $data['totalHutang_persentase'] ?>%</span>
											<i data-feather="arrow-down" class="icon-sm mb-1"></i>
										</p>
										<?php }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Total Piutang</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['totalPiutang'] != NULL) {
											echo 'Rp. ' . number_format($data['totalPiutang']);
										}else {
											echo 'Rp. ' . number_format(0);
										}
									?></h3>
									<div class="d-flex align-items-baseline">
										<?php 
											if ($data['totalHutang_persentase'] > 0 ) { ?>
										<p class="text-success">
											<span>+<?= $data['totalHutang_persentase'] ?>%</span>
											<i data-feather="arrow-up" class="icon-sm mb-1"></i>
										</p>
										<?php }else { ?>
										<p class="text-danger">
											<span>-<?= $data['totalHutang_persentase'] ?>%</span>
											<i data-feather="arrow-down" class="icon-sm mb-1"></i>
										</p>
										<?php }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Total Kas</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['totalKas'] != NULL) {
											echo 'Rp. ' . number_format($data['totalKas']);
										}else {
											echo 'Rp. ' . number_format(0);
										}
									?></h3>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xl-12 stretch-card">
			<div class="row flex-grow-1">
				<div class="col-md-3 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Nilai Pembiayaan</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['nilaiPembiayaan'] != NULL) {
											echo 'Rp. ' . number_format($data['nilaiPembiayaan']);
										}else {
											echo 'Rp. ' . number_format(0);
										}
									?></h3>
									<div class="d-flex align-items-baseline">
										<?php 
											if ($data['nilaiPembiayaan_persentase'] > 0 ) { ?>
										<p class="text-success">
											<span>+<?= $data['nilaiPembiayaan_persentase'] ?>%</span>
											<i data-feather="arrow-up" class="icon-sm mb-1"></i>
										</p>
										<?php }else { ?>
										<p class="text-danger">
											<span>-<?= $data['nilaiPembiayaan_persentase'] ?>%</span>
											<i data-feather="arrow-down" class="icon-sm mb-1"></i>
										</p>
										<?php }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Setoran Angsuran</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['setoranAngsuran'] != NULL) {
											echo 'Rp. ' . number_format($data['setoranAngsuran']);
										}else {
											echo 'Rp. ' . number_format(0);
										}
									?></h3>
									<div class="d-flex align-items-baseline">
										<?php 
											if ($data['setoranAngsuran_persentase'] > 0 ) { ?>
										<p class="text-success">
											<span>+<?= $data['setoranAngsuran_persentase'] ?>%</span>
											<i data-feather="arrow-up" class="icon-sm mb-1"></i>
										</p>
										<?php }else { ?>
										<p class="text-danger">
											<span>-<?= $data['setoranAngsuran_persentase'] ?>%</span>
											<i data-feather="arrow-down" class="icon-sm mb-1"></i>
										</p>
										<?php }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Pengeluaran Bulan Ini</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['pengeluaranBulanIni'] != NULL) {
											echo 'Rp. ' . number_format($data['pengeluaranBulanIni']);
										}else {
											echo 'Rp. ' . number_format(0);
										}
									?></h3>
									<div class="d-flex align-items-baseline">
										<?php 
											if ($data['pengeluaranBulanIni_persentase'] > 0 ) { ?>
										<p class="text-success">
											<span>+<?= $data['pengeluaranBulanIni_persentase'] ?>%</span>
											<i data-feather="arrow-up" class="icon-sm mb-1"></i>
										</p>
										<?php }else { ?>
										<p class="text-danger">
											<span>-<?= $data['pengeluaranBulanIni_persentase'] ?>%</span>
											<i data-feather="arrow-down" class="icon-sm mb-1"></i>
										</p>
										<?php }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-baseline">
								<h6 class="card-title mb-0">Total Anggota</h6>
							</div>
							<div class="row">
								<div class="col-6 col-md-12 col-xl-5">
									<h3 class="mb-2"><?php 
										if ($data['totalAnggota'] != NULL) {
											echo $data['totalAnggota'];
										}else {
											echo '0';
										}
									?></h3>
									<div class="d-flex align-items-baseline">
										<?php 
											if ($data['totalAnggota_persentase'] > 0 ) { ?>
										<p class="text-success">
											<span>+<?= $data['totalAnggota_persentase'] ?>%</span>
											<i data-feather="arrow-up" class="icon-sm mb-1"></i>
										</p>
										<?php }else { ?>
										<p class="text-danger">
											<span>-<?= $data['totalAnggota_persentase'] ?>%</span>
											<i data-feather="arrow-down" class="icon-sm mb-1"></i>
										</p>
										<?php }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>
