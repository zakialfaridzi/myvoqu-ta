  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url('Admin/index/'); ?>" class="brand-link">
          <img src="<?php echo base_url() ?>assets/dist/img/myvoqu.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">MyVoqu Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <?php foreach ($mahasiswa as $mhs): ?>
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                      <img src="<?php echo base_url() ?>/assets/foto/<?php echo $mhs->image ?>" height="160" width="160" style="border-radius: 10%" alt="User Image">
                  </div>
                  <div class="info">
                      <a href="<?php echo base_url('Admin/indexProfile/') ?>" class="d-block"><?php
$data['user'] = $this->db->get_where('user', ['role_id' => 1])->row_array();
echo $data['user']['name'];
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
                          <a href="<?php echo base_url('Admin/index/'); ?>" class="nav-link <?php echo $this->uri->segment(2) == '' || $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
                              <i class="nav-icon fas fa-home"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>
                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                              <p>
                                  Pengelolaan Data
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('Admin/indexPenghafal/'); ?>" class="nav-link <?php echo $this->uri->segment(2) == 'indexPenghafal' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-users"></i>
                                      <p>
                                          Kelola Penghafal
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('Admin/indexMentor/') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'indexMentor' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                      <p>
                                          Kelola Mentor
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('Admin/indexPosting/') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'indexPosting' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-upload"></i>
                                      <p>
                                          Kelola Unggahan
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('Admin/indexPostingGen/') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'indexPostingGen' ? 'active' : '' ?>">
                                      <i class="nav-icon fas fa-upload"></i>
                                      <p>
                                          Kelola Materi Umum
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item ml-3">
                                  <a href="<?php echo base_url('Admin/indexGroup/') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'indexGroup' ? 'active' : '' ?>">
                                      <i class="nav-icon fa fa-users"></i>
                                      <p>
                                          Kelola Grup Hafalan
                                      </p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('Admin/pagepostGen/') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'pagepostGen' ? 'active' : '' ?>">
                              <i class="nav-icon fas fa-book-open"></i>
                              <p>
                                  Unggah Materi Umum
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="<?php echo base_url('Admin/indexTodo/') ?>" class="nav-link <?php echo $this->uri->segment(2) == 'indexTodo' ? 'active' : '' ?>">
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