  <!--   Core JS Files   -->
  <script src="<?= argon_url('js/core/popper.min.js'); ?>"></script>
  <script src="<?= argon_url('js/core/bootstrap.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/perfect-scrollbar.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/smooth-scrollbar.min.js'); ?>"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
</body>

</html>