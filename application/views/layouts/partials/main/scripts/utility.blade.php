<script>
  console.log('layout/main/script/utility');

  $(document).ready(function() {
    loadingPage(false)
  })

  function loadingPage(trigger = true, callback = null)
  {
    setTimeout(() => {
      if (trigger) {
        $('#preloader').css({ 'height': '100vh' }).find('img').css({ 'display': 'block' })
      } else {
        $('#preloader').css({ 'height': '0vh' }).find('img').css({ 'display': 'none' })
      }
  
      if (typeof callback === 'function') callback();
    }, 300);
  }
</script>