<div class="page-content">

	<?php $this->load->view('partials/extra/breadcrumb'); ?>

	<div class="row">
		<?php if ($this->session->flashdata('msg')) { ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Sukses !</strong> <?= $this->session->flashdata('msg') ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
		</div>
		<?php } 
		
		echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>');
		?>
		<div class="col-md-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<h6 class="card-title"><?= $title; ?></h6>

					<?php 
					if (empty($form)) { ?>
					<form class="forms-sample" action="<?= base_url ('ps/konfigurasi') ?>" enctype="multipart/form-data"
						method="POST">

						<div class="mb-3">
							<label class="form-label">Nama</label>
							<input type="text" name="type" class="form-control" value="<?= set_value('type')?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Deskripsi</label>
							<input type="text" name="deskripsi" class="form-control"
								value="<?= set_value('deskripsi')?>">
						</div>



						<a href="<?= base_url()?>" class="btn btn-secondary">Kembali</a>
						<button type="submit" class="btn btn-primary me-2">Simpan</button>
					</form>
					<?php } else { ?>
					<form class="forms-sample" action="<?= base_url ('ps/konfigurasi/').$form['id_master'] ?>" enctype="multipart/form-data"
						method="POST">

						<div class="mb-3">
							<label class="form-label">Nama</label>
							<input type="text" name="type" class="form-control" value="<?= $form['nama'] ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Deskripsi</label>
							<input type="text" name="deskripsi" class="form-control"
								value="<?= $form['deskripsi'] ?>">
						</div>



						<a href="<?= base_url()?>" class="btn btn-secondary">Kembali</a>
						<button type="submit" class="btn btn-primary me-2">Update</button>
					</form>
					<?php }
					
					
					?>

				</div>
			</div>
		</div>

		<div class="col-md-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">Data yang sudah di tambahkan</h6>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>No. </th>
									<th>Type</th>
									<th>Deskripsi</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;

								foreach ($data as $r) { ?>
								<tr>
									<th><?= $no++ ?></th>
									<td><?= $r->nama ?></td>
									<td><?= $r->deskripsi ?></td>
									<td>
										<div class="example">
											<a class="badge bg-primary" href="<?= base_url('konfigurasi/edit/').$r->id_master ?>">Edit</a>
											<a type="button" class="badge bg-danger" onclick="deleteMe(<?= $r->id_master ?>);">Hapus</a>

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
			  location.href= "<?= base_url('konfigurasi/delete/') ?>" + value
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