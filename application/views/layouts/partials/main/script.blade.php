<!-- jQuery -->
<script src="<?= adminlte_url('plugins/jquery/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= adminlte_url('plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= adminlte_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?= adminlte_url('plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?= adminlte_url('plugins/sparklines/sparkline.js'); ?>"></script>
<!-- JQVMap -->
<script src="<?= adminlte_url('plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?= adminlte_url('plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= adminlte_url('plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?= adminlte_url('plugins/moment/moment.min.js'); ?>"></script>
<script src="<?= adminlte_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= adminlte_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?= adminlte_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<!-- Datatables -->
<script src="<?= adminlte_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= adminlte_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= adminlte_url('plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- Toastr -->
<script src="<?= adminlte_url('plugins/toastr/toastr.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= adminlte_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= adminlte_url('dist/js/adminlte.js'); ?>"></script>

@include('layouts.partials.main.scripts.utility')

@yield('scripts')