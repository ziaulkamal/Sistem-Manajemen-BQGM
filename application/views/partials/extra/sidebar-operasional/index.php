            <li class="nav-item nav-category">Fitur Operasional</li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#anggota" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Anggota</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="anggota">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url ('anggota/add') ?>" class="nav-link">Tambah</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('anggota') ?>" class="nav-link">Data</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('anggota/rekening') ?>" class="nav-link">Rekening</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('anggota/disabled') ?>" class="nav-link">Keluar</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#operasional" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="dollar-sign"></i>
                <span class="link-title">Operasional</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="operasional">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url ('operasional/uang_keluar') ?>" class="nav-link">Update Keluar</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('operasional/uang_masuk') ?>" class="nav-link">Update Masuk</a>
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
                    <a href="<?= base_url ('log/pembiayaan_sawah') ?>" class="nav-link">Pembiayaan Sawah</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('log/transaksi_operasional') ?>" class="nav-link">Transaksi Operasional</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('log/transaksi_teller') ?>" class="nav-link">Transaksi Setor Angsuran</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ('log/transaksi_teller') ?>" class="nav-link">Transaksi Setor Simpanan</a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#pinjaman" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="thumbs-up"></i>
                <span class="link-title">Pinjaman Karyawan</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="pinjaman">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url('operasional/data_pinjaman') ?>" class="nav-link">Data Pinjaman</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('operasional/pengajuan_pinjaman') ?>" class="nav-link">Tambah</a>
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
                    <a href="<?= base_url('operasional/approval/penarikan') ?>" class="nav-link">Penarikan Simpanan</a>
                  </li>

                </ul>
              </div>
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
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/tracking/_lihat') ?>" class="nav-link">Lacak Setoran Anggota</a>
                  </li>
  
  
                </ul>
              </div>
            </li>
          