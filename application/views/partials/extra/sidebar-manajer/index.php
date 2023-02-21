            <li class="nav-item nav-category">Fitur Manajer</li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Users</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="users">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url ('user') ?>" class="nav-link">Data</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('user/add') ?>" class="nav-link">Tambah</a>
                  </li>

                </ul>
              </div>
            </li>
 
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#logs" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="activity"></i>
                <span class="link-title">Log</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="logs">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url ('log/unit/pembiayaan') ?>" class="nav-link">Pembiayaan Sawah</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('log/unit/operasional') ?>" class="nav-link">Transaksi Operasional</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('log/unit/teller') ?>" class="nav-link">Transaksi Teller</a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#dokumen" role="button" aria-expanded="false" aria-controls="users">
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
              <a class="nav-link" data-bs-toggle="collapse" href="#approval" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="check-square"></i>
                <span class="link-title">Approval</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="approval">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url('pembiayaan/required/approval') ?>" class="nav-link">Pembiayaan</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('operasional/required/approval') ?>" class="nav-link">Operasional</a>
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
              <a class="nav-link" data-bs-toggle="collapse" href="#laporan" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="trello"></i>
                <span class="link-title">Laporan</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="laporan">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/simpanan/_lihat') ?>" class="nav-link">Simpanan Anggota</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/angsuran/_lihat') ?>" class="nav-link">Angsuran Anggota</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/pembiayaan/_lihat') ?>" class="nav-link">Pembiayaan Anggota</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/angsuran/pending/_lihat') ?>" class="nav-link">Angsuran Tertunda</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/operasional/masuk/_lihat') ?>" class="nav-link">Operasional (Masuk)</a>
                  </li>
  
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/operasional/keluar/_lihat') ?>" class="nav-link">Operasional (Keluar)</a>
                  </li>
  
  
                </ul>
              </div>
            </li>
          
          