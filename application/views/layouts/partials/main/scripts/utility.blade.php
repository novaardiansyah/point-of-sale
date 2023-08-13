<script>
  console.log('layout/main/script/utility');

  $(document).ready(function() {
    loadingPage(false)

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

  $(document).on('click blur', 'input, textarea, select, checkbox, radio', function() {
    const propertyName    = $(this).attr('id')
    const invalidFeedback = $(`.invalid-feedback.${propertyName}`)

    if (invalidFeedback.length > 0) {
      invalidFeedback.html('')
      $(this).removeClass('is-invalid')
    }
  })

  $(document).on("change", ".custom-file-input", function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);

    let preview = $(this).attr('name')
        preview = $(`.preview.${preview}`)

    if (preview.length === 0) return
    preview.empty()
    let width = preview.data('width') || 100

    let files = $(this)[0].files

    if (files.length === 0) return

    if (files[0].type.indexOf('image') === -1) {
      $(this).val('')
      $(this).next('.custom-file-label').removeClass("selected").html('Choose file')
      // notifyPopup(false, 'File yang diupload harus berupa gambar!', 3000)
      return
    }

    let image = $('<img>').addClass('preview-image')
    image.attr('src', URL.createObjectURL(files[0]))
    image.attr('width', width)

    preview.append(image)
    preview.show()
  });

  function testing_utility()
  {
    console.log('testing utility')
  }

  function loadingPage(trigger = true, after = 400, callback = null)
  {
    setTimeout(() => {
      if (trigger) {
        $('#preloader').css({ 'height': '100vh' }).find('img').css({ 'display': 'block' })
      } else {
        $('#preloader').css({ 'height': '0vh' }).find('img').css({ 'display': 'none' })
      }
  
      if (typeof callback === 'function') callback();
    }, after);
  }

  function createSelect2(selector, url, defaultText = null, delay = 250, callback = null) {
    $(selector).select2({
      theme: 'bootstrap4',
      ajax: {
        url: url,
        dataType: 'json',
        delay: delay,
        data: function(params) {
          return {
            search: params.term
          };
        },
        processResults: function(response) {
          if (defaultText != null) response.data.unshift({ uid: '', text: defaultText });

          return {
            results: response.data.map(function(item) {
              return {
                id: item.uid, 
                text: item.text
              }
            })
          }
        }
      }
    })

    if (typeof callback === 'function') callback();
  }
</script>