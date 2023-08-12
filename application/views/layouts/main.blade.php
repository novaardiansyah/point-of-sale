<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $_ENV['APP_NAME']; }}</title>

  @include('layouts.partials.main.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" id="preloader">
    <img class="animation__shake" src="<?= assets_url('img/logo-point-of-sale.png'); ?>" alt="{{ $_ENV['APP_NAME']; }}" height="60" width="60" />
  </div>

  @include('layouts.partials.main.navbar')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ base_url(); }}" class="brand-link">
      <img src="{{ assets_url('img/logo-point-of-sale.png'); }}" alt="Brand Image" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $_ENV['APP_NAME']; }}</span>
    </a>

    @include('layouts.partials.main.sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('layouts.partials.main.breadcrumb')

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.partials.main.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  @include('layouts.partials.main.script')
</body>
</html>
