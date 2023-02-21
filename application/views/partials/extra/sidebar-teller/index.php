            <li class="nav-item nav-category">Fitur Teller</li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('setoran')?>">
                <i class="link-icon" data-feather="shopping-bag"></i>
                <span class="link-title">Setoran</span>
                
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('angsuran/data_') ?>">
                <i class="link-icon" data-feather="shopping-cart"></i>
                <span class="link-title">Angsuran</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('pinjaman_karyawan/pengajuan_mandiri') ?>">
                <i class="link-icon" data-feather="tag"></i>
                <span class="link-title">Pengajuan Pinjaman</span>
              </a>
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
                    <a href="<?= base_url('log/detail/LogAll_transaksi')?>" class="nav-link">Semua Transaksi</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#invoice" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="bookmark"></i>
                <span class="link-title">Note Invoice</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="invoice">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url('teller/invoice/pembiayaan/datas') ?>" class="nav-link">Pembiayaan</a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="<?= base_url('teller/invoice/simpanan/datas') ?>" class="nav-link">Simpanan</a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="<?= base_url('teller/invoice/penarikan/datas') ?>" class="nav-link">Penarikan</a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url('teller/invoice/angsuran/datas') ?>" class="nav-link">Angsuran</a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url('teller/invoice/pinjaman/datas') ?>" class="nav-link">Pinjaman</a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url('teller/invoice/setoran/datas') ?>" class="nav-link">Setoran</a>
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

  
  
                </ul>
              </div>
            </li>
          