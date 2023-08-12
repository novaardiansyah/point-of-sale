<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $_ENV['APP_NAME']; ?></title>

  <?php $this->load->view('layout/main/style'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= assets_url('img/logo-point-of-sale.png'); ?>" alt="<?= $_ENV['APP_NAME']; ?>" height="60" width="60" />
  </div>

  <?php $this->load->view('layout/main/navbar'); ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= assets_url('img/logo-point-of-sale.png'); ?>" alt="Brand Image" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $_ENV['APP_NAME']; ?></span>
    </a>

    <?php $this->load->view('layout/main/sidebar'); ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->load->view('layout/main/breadcrumb'); ?>

    <!-- Main content -->
    <section class="content">
      <?= $content ?? ''; ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('layout/main/footer'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <?php $this->load->view('layout/main/script'); ?>
</body>
</html>
