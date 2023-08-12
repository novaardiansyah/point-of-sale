<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0 d-flex align-items-center" href="<?= base_url(); ?>" target="_blank">
      <i class="ni ni-app navbar-brand-img fs-5"></i>
      <span class="ms-1 font-weight-bold"><?= $_ENV['APP_NAME']; ?></span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item sidebar">
        <a class="nav-link align-items-center" href="<?= base_url(); ?>">
          <i class="mdi mdi-monitor-dashboard text-secondary fs-5 ms-2 opacity-10"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <!-- /.nav-item -->

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Transaksi</h6>
      </li>
      <!-- /.nav-item -->

      <li class="nav-item sidebar">
        <a class="nav-link align-items-center" href="<?= base_url('pembelian'); ?>">
          <i class="mdi mdi-cash-check text-secondary fs-5 ms-2 opacity-10"></i>
          <span class="nav-link-text">Penjualan</span>
        </a>
      </li>
      <!-- /.nav-item -->

      <li class="nav-item sidebar">
        <a class="nav-link align-items-center" href="<?= base_url('pembelian'); ?>">
          <i class="mdi mdi-cash-minus text-secondary fs-5 ms-2 opacity-10"></i>
          <span class="nav-link-text">Pembelian</span>
        </a>
      </li>
      <!-- /.nav-item -->

      <li class="nav-item sidebar">
        <a class="nav-link align-items-center" href="<?= base_url('pembayaran'); ?>">
          <i class="mdi mdi-cash-plus text-secondary fs-5 ms-2 opacity-10"></i>
          <span class="nav-link-text">Pembayaran</span>
        </a>
      </li>
      <!-- /.nav-item -->

      <li class="nav-item sidebar">
        <a class="nav-link align-items-center" href="<?= base_url('pembayaran'); ?>">
          <i class="mdi mdi-cash-multiple text-secondary fs-5 ms-2 opacity-10"></i>
          <span class="nav-link-text">Hutang & Piutang</span>
        </a>
      </li>
      <!-- /.nav-item -->
    </ul>
  </div>
</aside>