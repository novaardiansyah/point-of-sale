  <!--   Core JS Files   -->
  <script src="<?= argon_url('js/core/popper.min.js'); ?>"></script>
  <script src="<?= argon_url('js/core/bootstrap.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/perfect-scrollbar.min.js'); ?>"></script>
  <script src="<?= argon_url('js/plugins/smooth-scrollbar.min.js'); ?>"></script>
  <script src="<?= assets_url('js/utility.js'); ?>"></script>

  <script>
    const conf = {
      base_url: (path = '') => '<?= base_url(); ?>' + path,
      csrf_name: '<?= $this->security->get_csrf_token_name(); ?>',
      csrf_hash: '<?= $this->security->get_csrf_hash(); ?>'
    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <?php $this->load->view('firebase/firebase-google-auth'); ?>

  <?php if (isset($script)) : ?>
    <?php foreach ($script as $path) : ?>
      <script src="<?= $path; ?>"></script>
    <?php endforeach; ?>
  <?php endif; ?>
</body>

</html>