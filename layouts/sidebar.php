<?php
$page = $_GET['page'] ?? '';
?>
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <a href="index.php" class="brand-link">
            <img src="assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">SATUPINTU</span>
          </a>
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper d-flex flex-column h-100">
          <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
              <li class="nav-item">
                <a href="index.php?page=dashboard" class="nav-link">
                  <i class="nav-icon bi bi-house-door-fill"></i>
                  <p>BERANDA</p>
                </a>
              </li>
              
              <!-- Menu SATUKAN JIWA -->
              <li class="nav-item <?= in_array($page, ['dashboard', 'sesuk', 'cadil', 'elenopeda', 'laporan_industri']) ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= in_array($page, ['dashboard','sesuk', 'cadil', 'elenopeda', 'laporan_industri']) ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    SATUKAN JIWA
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?page=sesuk" class="nav-link <?= ($page == 'sesuk') ? 'active' : '' ?>">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>SESUK</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?page=cadil" class="nav-link <?= ($page == 'cadil') ? 'active' : '' ?>">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>CADIL</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?page=elenopeda" class="nav-link <?= ($page == 'elenopeda') ? 'active' : '' ?>">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>ELENOPEDA</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <!-- Menu DBES-IKM -->
              <li class="nav-item <?= in_array($page, ['dashboard', 'sesuk', 'cadil', 'elenopeda', 'laporan_industri']) ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= in_array($page, ['dashboard', 'sesuk', 'cadil', 'elenopeda', 'laporan_industri']) ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    DBES-IKM
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?page=laporan_industri" class="nav-link <?= ($page == 'laporan_industri') ? 'active' : '' ?>">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Laporan Industri</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <!--end::Sidebar Menu-->

            <!-- Docs CTA (bottom of sidebar) -->
            <div class="p-3 mt-3 border-top border-secondary border-opacity-25 dropup">
              <button class="btn btn-sm btn-outline-light w-100 dropdown-toggle d-flex align-items-center justify-content-center gap-2" 
                      type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-book"></i> Tautan Halaman
              </button>
              <ul class="dropdown-menu dropdown-menu-dark w-100 shadow">
                  <li><a class="dropdown-item" href="http://192.168.34.169/satukan.jiwa/ "><i class="bi bi-file-earmark"></i> Satukan Jiwa</a></li>
                  <li><a class="dropdown-item" href="http://192.168.34.169/dbes-ikm/"><i class="bi bi-globe"></i> DBES-IKM</a></li>
              </ul>
            </div>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
