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
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="container-fluid d-flex justify-content-between">
						<div class="col-lg-3 ps-0">
							<img src="<?= base_url('public/login/logo.png')?>" class="wd-100" alt="">
							<p class="mt-1 mb-1"><b>Baitul Qiradh Gala Muamalah</b></p>
							<p>Jl. Krueng Beukah, Komplek Masjid Baitul Ghaffur -  Blangpidie<br />email: <a href="mailto:bq.galamuamalah@gmail.com" taget="_blank" rel="nofollow">bq.galamuamalah@gmail.com</a></p>
							<h5 class="mt-5 mb-2 text-muted">Invoice Untuk :</h5>
							<p><b><?= ucwords($detail->namaAnggota) ?></b><br>Alamat : <?= ucwords($detail->alamatSekarang) ?><br />HP : <?= ucwords($detail->no_hp) ?></p>
						</div>
						<div class="col-lg-3 pe-0">
							<h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
							<h6 class="text-end mb-5 pb-4"># INV-<?= substr($serial, 7) ?></h6>

							<h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Tanggal Dikeluarkan :</span>
								<?= date('Y-m-d') ?></h6>
							<h6 class="text-end fw-normal"><span class="text-muted">Tanggal Disetujui :</span> <?= date_indo($data->lastUpdate_t) ?></h6>
						</div>
					</div>
					<div class="container-fluid mt-5 d-flex justify-content-center w-100">
						<div class="table-responsive w-100">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Keterangan</th>
										<th>Jenis</th>
										<th class="text-end">Jumlah</th>
										<th class="text-end">Total</th>
									</tr>
								</thead>
								<tbody>
									<tr class="text-end">
										<td class="text-start">1</td>
										<td class="text-start"><?= $data->keterangan ?></td>
										<td class="text-start"><?= ucwords($type) ?></td>
										<td><?= 'Rp. ' . number_format($data->nilaiTransaksi) ?></td>
										<td><?= 'Rp. ' . number_format($data->nilaiTransaksi) ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="container-fluid mt-5 w-100">
						<div class="row">
							<div class="col-md-6 ms-auto">
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr class="bg-light">
												<td class="text-bold-800">Total Keseluruhan : </td>
												<td class="text-bold-800 text-end"><?= 'Rp. ' . number_format($data->nilaiTransaksi) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid w-100" id="areaInvoice">
						<a type="button" onclick="downloadPDF();" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send"
								class="me-3 icon-md"></i>Download Invoice PDF</a>
						<a type="button" onclick="printMe();"  class="btn btn-outline-primary float-end mt-4"><i data-feather="printer"
								class="me-2 icon-md"></i>Print Invoice</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
function printMe() {
	var originalContents = document.body.innerHTML;
	var printContents = document.querySelector(".main-wrapper").remove();

//   document.body.innerHTML = printContents;

  // Menambahkan elemen baru
  var newElement = document.createElement("div");
  newElement.innerHTML = "<?= 'SN:'.$serial ?><br />Nominal:<?= 'Rp. '. number_format($data->nilaiTransaksi) ?><br />Kode:<?= $type ?><br /><?= $this->session->userdata('level_akses'); ?>";
  document.body.appendChild(newElement);

  window.print();

  // Mengembalikan isi halaman asli setelah mencetak
  document.body.innerHTML = originalContents;
}

  function downloadPDF() {
      var nameFile = "<?= $serial. ' - '. date('d-m-Y') ?>"
      var body = document.body;
        body.style.margin = "0";
        body.style.marginLeft = "-51px";
        body.style.padding = "0";
        body.style.marginTop = "-50px";
    document.body.classList.remove("sidebar-dark");
    document.body.classList.remove("sidebar-dark");
    document.body.classList.add("sidebar-dark", "sidebar-folded");
    document.querySelector('footer').remove()
    document.querySelector('.sidebar').remove()
    document.querySelector('.page-breadcrumb').remove()
    document.querySelector('.navbar').remove()
    document.querySelector('#areaInvoice').remove()
  html2canvas(document.querySelector('.card-body'), {
      scale: 2,
    onrendered: function (canvas) {
      var data = canvas.toDataURL();
      var pdf = new jsPDF('l', 'mm', [canvas.width, canvas.height]);
      pdf.addImage(data, 'JPEG', 60, 25);
      pdf.save(`${nameFile}.pdf`);
      location.reload();
    }
  });
}
</script>

