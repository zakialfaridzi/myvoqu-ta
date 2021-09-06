  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url('Admin/'); ?>" class="brand-link">
          <img src="<?php echo base_url() ?>assets/dist/img/myvoqu.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">MyVoqu Admin</span>
      </a>

      <!-- Sidebar -->
          <?php foreach ($mahasiswa as $mhs): ?>
      <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                      <img src="<?php echo base_url() ?>/assets/foto/<?php echo $mhs->image ?>" height="160" width="160" style="border-radius: 10%" alt="User Image">
                  </div>
                  <div class="info">
                      <a href="<?php echo base_url('ProfileAdmin/') ?>" class="d-block"><?php
echo $mhs->name
?>
                      </a>

                  </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                      <li class="nav-item">
                          <a href="<?php echo base_url('Admin'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'Admin' ? 'active' : '' ?>">
                              <i class="nav-icon fas fa-home"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>

                      <li class="nav-item has-treeview <?php
$res = (($this->uri->segment(1) == 'KelolaPenghafal') || ($this->uri->segment(1) == 'KelolaMentor') || ($this->uri->segment(1) == 'KelolaUnggahan') || ($this->uri->segment(1) == 'KelolaUnggahanUmum') || ($this->uri->segment(1) == 'KelolaGrup'));
echo $res ? 'menu-open' : ''?>
">
                          <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                              <p>
                                  Pengelolaan Data
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('KelolaPenghafal/'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'KelolaPenghafal' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-users"></i>
                                      <p>
                                          Kelola Penghafal
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('KelolaMentor/') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'KelolaMentor' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                      <p>
                                          Kelola Mentor
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('KelolaUnggahan/') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'KelolaUnggahan' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-upload"></i>
                                      <p>
                                          Kelola Unggahan
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('KelolaUnggahanUmum') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'KelolaUnggahanUmum' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-upload"></i>
                                      <p>
                                          Kelola Materi Umum
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('KelolaGrup') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'KelolaGrup' ? 'active' : '' ?>">
                                      <i class="nav-icon fa fa-users"></i>
                                      <p>
                                          Kelola Grup Hafalan
                                      </p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('UnggahMateriUmum') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'UnggahMateriUmum' ? 'active' : '' ?>">
                              <i class="nav-icon fas fa-book-open"></i>
                              <p>
                                  Unggah Materi Umum
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('PengumumanAdmin') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'PengumumanAdmin' ? 'active' : '' ?>">
                              <i class="nav-icon fas fa-exclamation-circle"></i>
                              <p>
                                  Buat Pengumuman
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('ToDoListAdmin') ?>" class="nav-link <?php echo $this->uri->segment(1) == 'ToDoListAdmin' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tasks"></i>
                              <p>
                                  Daftar Kegiatan Admin
                              </p>
                          </a>
                      </li>
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
          <?php endforeach;?>
      </div>
      <!-- /.sidebar -->
  </aside>