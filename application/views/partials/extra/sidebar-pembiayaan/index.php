            <li class="nav-item nav-category">Fitur Pembiayaan</li>

            <li class="nav-item">
            	<a class="nav-link" data-bs-toggle="collapse" href="#pembiayaan" role="button" aria-expanded="false"
            		aria-controls="users">
            		<i class="link-icon" data-feather="users"></i>
            		<span class="link-title">Pembiayaan</span>
            		<i class="link-arrow" data-feather="chevron-down"></i>
            	</a>
            	<div class="collapse" id="pembiayaan">
            		<ul class="nav sub-menu">
            			<li class="nav-item">
            				<a href="<?= base_url ('pembiayaan') ?>" class="nav-link">Data</a>
            			</li>
            			<li class="nav-item">
            				<a href="<?= base_url ('pembiayaan/data_anggota') ?>" class="nav-link">Pengajuaan</a>
            			</li>

            		</ul>
            	</div>
            </li>

            <li class="nav-item">
            	<a class="nav-link" data-bs-toggle="collapse" href="#dokumen" role="button" aria-expanded="false"
            		aria-controls="users">
            		<i class="link-icon" data-feather="file-plus"></i>
            		<span class="link-title">Dokumen</span>
            		<i class="link-arrow" data-feather="chevron-down"></i>
            	</a>
            	<div class="collapse" id="dokumen">
            		<ul class="nav sub-menu">
            			<li class="nav-item">
            				<a href="<?= base_url('dokumen') ?>" class="nav-link">Data Dokumen Pembiayaan</a>
            			</li>
            			<li class="nav-item">
            				<a href="<?= base_url('doc/daftar_surat') ?>" class="nav-link">Data Surat Pembiayaan</a>
            			</li>
            		</ul>
            	</div>
            </li>

            <li class="nav-item">
            	<a class="nav-link" href="<?= base_url('pinjaman_karyawan/pengajuan_mandiri') ?>">
            		<i class="link-icon" data-feather="tag"></i>
            		<span class="link-title">Pengajuan Pinjaman</span>
            	</a>
            </li>

            <li class="nav-item nav-category">Extra</li>

            <li class="nav-item">
            	<a class="nav-link" data-bs-toggle="collapse" href="#laporan" role="button" aria-expanded="false"
            		aria-controls="users">
            		<i class="link-icon" data-feather="trello"></i>
            		<span class="link-title">Laporan</span>
            		<i class="link-arrow" data-feather="chevron-down"></i>
            	</a>
            	<div class="collapse" id="laporan">
            		<ul class="nav sub-menu">
            			<li class="nav-item">
            				<a href="<?= base_url('laporan/pembiayaan/_lihat') ?>" class="nav-link">Pembiayaan Anggota</a>
            			</li>
            			<li class="nav-item">
            				<a href="<?= base_url('laporan/angsuran/pending/_lihat') ?>" class="nav-link">Angsuran Tertunda</a>
            			</li>
            		</ul>
            	</div>
            </li>
