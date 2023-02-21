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
		<?php }elseif ($this->session->flashdata('inf')) { ?>
		<div class="alert alert-dark alert-dismissible fade show" role="alert">
			<strong>Oopss !</strong> <?= $this->session->flashdata('inf') ?>
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
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>No Hp</th>
									<th>Alamat</th>
									<th>Tanggal Keluar</th>

								</tr>
							</thead>
							<tbody>
								<?php 

                                $no = 1;
                                foreach ($data as $r) { ?>
								<tr>
									<td class=""><?= $no++ ?></td>
									<td><?= ucwords($r->namaAnggota) ?></td>
									<td><?php switch ($r->jenisKelamin) {
                                    	case '1': echo "Laki - Laki"; break;                                      
                                      	case '2': echo "Perempuan"; break;                                        
                                        default: echo ""; break;
                                    } ?></td>
									<td><?= ucwords($r->no_hp) ?></td>
									<td><?= ucwords($r->alamatSekarang) ?></td>
									<td><?= date_indo($r->lastUpdate) ?></td>
	
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
