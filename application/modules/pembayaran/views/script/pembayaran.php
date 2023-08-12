<script>
  console.log('pembayaran/script/pembayaran');

  $(document).ready(function () {
    const table = 'myTable'

    $(`#${table}`).DataTable()
    $(`#${table}_length`).addClass('mt-3')
    $(`#${table}_filter`).addClass('mt-3')
    $(`#${table}_info`).addClass('pb-4 mt-2').css({ 'font-size': '14px' })
    $(`#${table}_paginate`).addClass('pb-4 mt-2').css({ 'font-size': '14px' })
  });
</script>