<script>
  console.log('utility');


  function toggle_sidebar()
  {
    console.log('toggle_sidebar()')

    let url = window.location.href
    if (url.endsWith("#")) url = url.slice(0, -1)

    let navItem = document.querySelector(`.nav-item.sidebar a[href="${url}"]`)
    if (!navItem) return false
    
    document.querySelectorAll('.nav-item.sidebar a').forEach((item) => {
      item.classList.remove('active')
      item.querySelector('i').classList.remove('text-primary')
      item.querySelector('i').classList.add('text-secondary')
    })
  
    navItem.classList.add('active')
    navItem.querySelector('i').classList.add('text-primary')
    navItem.querySelector('i').classList.remove('text-secondary')
  }
  toggle_sidebar()
</script>