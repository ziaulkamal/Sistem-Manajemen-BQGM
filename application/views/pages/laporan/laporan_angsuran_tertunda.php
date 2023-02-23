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
					<a type="button" onclick="ExportToExcel('xlsx');" class="btn btn-outline btn-primary mt-2 mb-2"> Download </a>
					<div class="table-responsive">
						<table id="dataTableExample" class="table dataTable no-footer">
							<thead>
								<tr>
									<th>No</th>
									<th>ID Pinjaman</th>
									<th>ID Anggota</th>
									<th>Nama Anggota</th>
									<th>Plafon</th>
									<th>Tenor Panen</th>
									<th>Sisa Tenor</th>
									<th>Jatuh Tempo</th>
									<th>Account Officer</th>
								</tr>
							</thead>
							<tbody>
                            <?php

                            $dateNow = strtotime(date('Y-m-d'));
                            $no = 1;
                            foreach ($data as $r ) {

                            if ($r->tenor == 5 && $r->sisaTenor == 5 ) { 
                            if ($dateNow >= strtotime($r->angsuranPertama)) { ?>
                            <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranPertama) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 4 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranPertama) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranPertama) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 2 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranPertama) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 1 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranPertama) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 4 ) { 
                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKedua) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKedua) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKedua) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 2 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKedua) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKetiga) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKetiga) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKetiga) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKeempat)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKeempat) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKeempat)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->angsuranKeempat) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->ansuranKelima)) { ?>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= 'Rp. ' . number_format($r->plafon) ?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= date_indo($r->ansuranKelima) ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}
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

						<table id="downloadExcel" class="table dataTable no-footer" style="display:none">
							<thead>
								<tr>
									<th>No</th>
									<th>ID Pinjaman</th>
									<th>ID Anggota</th>
									<th>Nama Anggota</th>
									<th>Plafon</th>
									<th>Tenor Panen</th>
									<th>Sisa Tenor</th>
									<th>Jatuh Tempo</th>
									<th>Account Officer</th>
								</tr>
							</thead>
							<tbody>
                            <?php

                            $dateNow = strtotime(date('Y-m-d'));
                            $no = 1;
                            foreach ($data as $r ) {
                            if ($r->tenor == 5 && $r->sisaTenor == 5 ) { 
                            if ($dateNow >= strtotime($r->angsuranPertama)) { ?>
                            <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranPertama ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 4 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranPertama ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranPertama ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 2 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranPertama ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 1 && $r->sisaTenor == 1 && !empty($r->angsuranPertama)) { 

                            if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranPertama ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 4 ) { 
                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKedua ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKedua ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKedua ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 2 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKedua ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKetiga ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 3 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKetiga ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKetiga ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 2 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKeempat)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKeempat ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->angsuranKeempat)) { ?><tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->angsuranKeempat ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}

                            if ($r->tenor == 5 && $r->sisaTenor == 1 ) { 

                            if ( $dateNow >= strtotime($r->ansuranKelima)) { ?>
                            <td><?= $r->id_pinjaman ?></td>
                            <td><?= $r->id_anggota ?></td>
                            <td><?= ucwords($r->namaAnggota) ?></td>
                            <td><?= $r->plafon?></td>
                            <td><?= $r->tenor.'x Panen' ?></td>
                            <td><?= $r->sisaTenor.'x Panen' ?></td>
                            <td><?= $r->ansuranKelima ?></td>
                            <td><?= ucwords($r->namaLengkap) ?></td>
                            </tr>
                            <?php }}
                            }

                            ?>
							</tbody>
						</table>




    <script>

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('downloadExcel');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('[Laporan] Data-Angsuran-Tertunda-<?= date('d-m-Y') ?>.' + (type || 'xlsx')));
        }

    </script>
