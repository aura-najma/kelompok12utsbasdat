<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <meta name="description" content="" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <script src="../assets/js/config.js"></script>

    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
      #layout-menu {
        background: linear-gradient(-180deg, #204ae6, #36bef8) !important;
      }
      .layout-navbar {
        background: linear-gradient(-180deg, #204ae6, #36bef8);
      }
      #layout-menu .menu-inner .menu-item .menu-link {
        color: white !important;
      }
      #layout-menu .menu-inner .menu-item .menu-link:hover,
      #layout-menu .menu-inner .menu-item.active .menu-link {
        color: white !important;
        font-weight: 600;
        font-size: 20px;
      }
      .app-brand-link img {
        width: 250px;
        height: auto;
        margin-left: -30px;
        margin-bottom: 20px;
        margin-top: 10px;
      }
      .card-title {
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 10px;
      }
      .avatar img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        object-fit: cover;
      }
      .logout-btn {
        background-color: white;
        color: #ff4d4d;
        width: 100%;
        border: none;
        border-radius: 15px;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 20px;
        font-weight: 600;
      }
      .logout-btn:hover {
        background-color: #e60000;
        color: white;
        width: 110%;
      }
      .welcome-image {
        width: 250px;
        height: auto;
        margin-left: 300px;
      }
    </style>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <img src="assets/images/logo2.png" alt="logo">
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="index.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/validasidokter" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="dokter">Daftar Dokter</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/daftar-pasien" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="pasien">Daftar Pasien</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/lihatstokobat" class="menu-link">
                <i class="menu-icon tf-icons bx bx-capsule"></i>
                <div data-i18n="obat">Daftar Obat</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/inputpasien" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="pembelian">Pembelian</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/analisispenjualan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-line-chart"></i>
                <div data-i18n="analisis">Analisis Penjualan</div>
              </a>
            </li>

            <div class="d-flex justify-content-center mt-3">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn logout-btn">Logout</button>
              </form>
            </div>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <i class="bx bx-menu bx-sm"></i>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item lh-1 me-3">
                  <a class="github-button" href="https://github.com/aura-najma/kelompok12utsbasdat" data-icon="octicon-star" data-size="large" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">profil</a>
                </li>
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <div class="avatar avatar-online">
                    <img src="assets/images/profil.png" alt="profil">
                  </div>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li><div class="dropdown-divider"></div></li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li><div class="dropdown-divider"></div></li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Selamat Datang {{ $user }}! 🎉</h5>
                          <p class="mb-4"><span class="fw-bold">Melayani dengan Sepenuh Hati</span></p>
                          <img src="assets/images/halo.png" alt="Halo" class="welcome-image">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Tombol Lihat Statistik Apotek -->
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="card-body text-center">
                      <h5 class="card-title text-primary">Lihat Statistik Apotek</h5>
                      <p class="mb-4">Klik tombol di bawah untuk melihat data statistik apotek secara detail.</p>
                      <!-- Tombol untuk membuka modal -->
                      <a href="#" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#statistikModal">Lihat Statistik Apotek</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Statistik Apotek -->
            <div class="modal fade" id="statistikModal" tabindex="-1" aria-labelledby="statistikModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="statistikModalLabel">Pilih Statistik Apotek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="list-group">
                      <a href="/dashboard_dw1" class="list-group-item list-group-item-action">Lihat Evaluasi</a>
                      <a href="/dashboard_dw2dw3" class="list-group-item list-group-item-action">Lihat Penjualan</a>
                      
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , Lifespring Drugstore ❤️ Apotek Aman dan Terpercaya
                </div>
              </div>
            </footer>
            <!-- / Footer -->
          </div>
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- GitHub JS -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
