        <nav class="navbar">
          <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
          </a>
          <div class="navbar-content">

            <ul class="navbar-nav">
            <?php if (isset($notifikasi)) {?>
                   <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i data-feather="bell"></i>
                  <div class="indicator">
                    <div class="circle"></div>
                  </div>
                </a>

        
                    <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                  <div class="p-1">
                    <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                      <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                        <i class="icon-sm text-white" data-feather="info"></i>
                      </div>
                      <div class="flex-grow-1 me-2">
                        <?php if ($notifikasi < 1 ) { ?>
                          <p>Belum Ada ! </p>
                        <?php }else { ?>
                          
                          <p>Ada <?= $notifikasi ?> Yang Harus Di Print Validasi<br />Periksa Note Invoice</p> 
                        <?php } ?>
                      </div>
                    </a>
                  </div>
 
                </div>
              </li>
            <?php } ?>
         


              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="wd-30 ht-30 rounded-circle" src="<?php if ($this->session->userdata('img') != NULL ) {
                    echo base_url('public/assets/images/users/').$this->session->userdata('img');
                  }else {
                    echo base_url('public/assets/images/').'foto.jpg';
                  } ?>" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                  <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                    <div class="mb-3">
                      <img class="wd-100 ht-100 rounded-circle" src="<?php if ($this->session->userdata('img') != NULL ) {
                    echo base_url('public/assets/images/users/').$this->session->userdata('img');
                  }else {
                    echo base_url('public/assets/images/').'foto.jpg';
                  } ?>" alt="">
                    </div>
                    <div class="text-center">
                   
                      <p class="tx-16 fw-bolder"><?= ucwords($this->session->userdata('nama')) ?></p>
                      <p class="tx-12 text-muted"><?= strtoupper($this->session->userdata('level_akses')) ?></p>
                    </div>
                  </div>
                  <ul class="list-unstyled p-1">
                    <li class="dropdown-item py-2">
                      <a href="<?= base_url('update_profile/').$this->session->userdata('id'); ?>" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="edit"></i>
                        <span>Edit Profil</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="<?= base_url ('logout') ?>" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="log-out"></i>
                        <span>Log Out</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>