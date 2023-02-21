      <nav class="sidebar">
        <div class="sidebar-header">
          <a href="#" class="sidebar-brand"> SM <span>BQGM</span>
          </a>
          <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div class="sidebar-body">
          <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
              <a href="<?= base_url ('/') ?>" class="nav-link">
                <i class="link-icon" data-feather="home"></i>
                <span class="link-title">Dashboard</span>
              </a>
            </li>
            <?php if ($this->session->userdata('level_akses') == 'ao') { ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#laporan" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="trello"></i>
                <span class="link-title">Nasabah Tertunda</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="laporan">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="<?= base_url('laporan/angsuran/pending/'.$this->session->userdata('id').'/_lihat') ?>" class="nav-link">Data Nasabah</a>
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
            <?php }?>

            <?php
            $sidebar = array(
              'manajer'     => 'partials/extra/sidebar-manajer/index', 
              'operasional' => 'partials/extra/sidebar-operasional/index', 
              'pembiayaan'  => 'partials/extra/sidebar-pembiayaan/index', 
              'teller'      => 'partials/extra/sidebar-teller/index', 
            );

            
              
            switch ($this->session->userdata('level_akses')) {
              case 'manajer':
                $this->load->view($sidebar['manajer']);               
                break;
              
              case 'operasional':
                $this->load->view($sidebar['operasional']);               
                break;
              
              case 'pembiayaan':
                $this->load->view($sidebar['pembiayaan']);               
                break;
              
              case 'teller':
                $this->load->view($sidebar['teller']);               
                break;
              
              default:
                # code...
                break;
            }
            ?>
          </ul>
        </div>
      </nav>