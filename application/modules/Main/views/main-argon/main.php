<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= assets_url('img/apple-touch-icon.png'); ?>">
  <link rel="icon" type="image/png" href="<?= assets_url('img/favicon.png'); ?>">
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= argon_url('css/nucleo-icons.css'); ?>" rel="stylesheet" />
  <link href="<?= argon_url('css/nucleo-svg.css'); ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= argon_url('css/nucleo-svg.css'); ?>" rel="stylesheet" />
  <!-- Material Design Icon -->
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet" />
  <!-- jquery.dataTables -->
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= argon_url('css/argon-dashboard.css?v=2.0.4'); ?>" rel="stylesheet" />

  <title>
    Point of Sale
  </title>
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  
  <?php $this->load->view('main/main/components/sidebar'); ?>

  <main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <?php $this->load->view('main/main/components/breadcrumb'); ?>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group d-none">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <!-- /.search -->

          <ul class="navbar-nav justify-content-end">
            <li class="nav-item dropdown pe-2 d-flex align-items-center ms-2">
              <a href="javascript:void(0);" class="nav-link text-white p-0" id="dropdown-profile" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-fw fa-user me-sm-1"></i>
                <?= get_session('login')['fullname']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 pt-2" aria-labelledby="dropdown-profile" style="top: 0 !important">
                <li class="mt-0">
                  <a class="dropdown-item border-radius-md" href="<?= base_url('auth/logout'); ?>">
                    <i class="fa fa-fw fa-sign-out-alt"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            
            <li class="nav-item dropdown pe-2 d-flex align-items-center ms-2">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 pt-2" aria-labelledby="dropdownMenuButton" style="top: 0 !important">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?= argon_url('img/team-2.jpg'); ?>" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?= argon_url('img/small-logos/logo-spotify.svg'); ?>" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    
    <?php $this->load->view('main/main/components/content'); ?>
    
    <div class="container-fluid py-4">
      <?php $this->load->view('main/main/components/footer'); ?>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="<?= argon_url('js/core/popper.min.js'); ?>"></script>
  <script src="<?= argon_url('js/core/bootstrap.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/perfect-scrollbar.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/smooth-scrollbar.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/chartjs.min.js'); ?>"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- jquery@3.3.0 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js" integrity="sha512-b6lGn9+1aD2DgwZXuSY4BhhdrDURVzu7f/PASu4H1i5+CRpEalOOz/HNhgmxZTK9lObM1Q7ZG9jONPYz8klIMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- jquery.dataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= argon_url('js/argon-dashboard.min.js?v=2.0.4'); ?>"></script>

  <?php $this->load->view('main/main/script/utility', true); ?>
  
  <?php if (isset($script)) : ?>
    <?php foreach ($script as $value) : ?>
      <?php $this->load->view($value, true); ?>
    <?php endforeach; ?>
  <?php endif; ?>
</body>

</html>