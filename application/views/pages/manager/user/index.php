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
						<table class="table table-striped">
							<thead>
								<tr>
									<th>User</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Opsi</th>
									<th>Terakhir Login</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($data as $r ) { ?>
								<tr>
									<td class="py-1">
										<?php if ($r->gambarProfil != NULL ) { ?>
											<img src="<?= base_url('public/assets/images/users/').$r->gambarProfil ?>">
										<?php }else { ?>
											<img src="<?= base_url('public/assets/images/').'foto.jpg' ?>">
										<?php } ?>
									</td>
									<td><?= ucwords($r->namaLengkap) ?></td>
									<td><?= strtoupper($r->levelAkses) ?></td>
									<td>
										<div class="example">
											<a class="badge bg-primary" href="<?= base_url('user/edit/'). $r->username ?>">Edit</a>
											<a type="button" class="badge bg-danger" onclick="deleteMe(<?= $r->id_admin ?>);">Hapus</a>
											
										</div>
									</td>
									<td><?= longdate_indo($r->lastLogin) ?></td>
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
<script>

function deleteMe(value) {
	const actDelete = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger me-2'
		},
		buttonsStyling: false,
		})	
	actDelete.fire({
        title: 'Yakin ingin menghapus ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'me-2',
        confirmButtonText: 'Ya Hapus !',
        cancelButtonText: 'Batalkan !',
        reverseButtons: true
      }).then((result) =>{
		  if (result.value) {
			  location.href= "<?= base_url('user/delete/process/') ?>" + value
		  }else if (
			  result.dismiss === Swal.DismissReason.cancel
		  ){
          actDelete.fire(
            'Sudah di batalkan !',
            'Data tidak jadi dihapus !',
            'error'
          )
        }
		  
		  
	  })
}

</script>