@section('scripts')
  <script>
    console.log('category/scripts/category')
    
    $(document).ready(function() {
      let url = `{{ base_url('master-data/kategori/list-category') }}`

      $('#list_category').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: url,
          type: 'GET'
        },
        columns: [
          { data: 'no', orderable: false, searchable: false, width: '40px' },
          { 
            data: 'a.name', 
            render: function(data, type, row) {
              return row.name
            }
          },
          { 
            data: 'b.name', 
            render: function(data, type, row) {
              return row.parent_name
            }
          },
          { data: 'icon', orderable: false, searchable: false },
          { 
            data: 'uid', 
            orderable: false, 
            searchable: false,
            width: '50px',
            render: function(data, type, row) {
              return `
                <div class="btn-group show">
                  <button type="button" class="btn btn-sm btn-info">Edit</button>
                  <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                  <div class="dropdown-menu" role="menu" x-placement="top-start">
                    <a class="dropdown-item position-relative" href="#">Edit</a>
                    <a class="dropdown-item position-relative" href="#">Delete</a>
                  </div>
                </div>
              `
            }
          }
        ]
      })
    })
    // end document ready

    function md_add_kategori(trigger = true)
    {
      let modal        = $('#dynamic_modal')
      let modal_title  = modal.find('.modal-title')
      let modal_body   = modal.find('.modal-body')
      let modal_footer = modal.find('.modal-footer')
      let modal_dialog = modal.find('.modal-dialog')
      let btn_close    = modal.find('.close-modal')
      let btn_save     = modal.find('.save-modal')

      if (trigger == false) return modal.modal('hide')
      
      btn_close.attr({ 'onclick': 'return md_add_kategori(false)' })
      btn_save.attr({ 'onclick': 'return add_kategori(event)' })

      modal_dialog.css({ 'max-width': '50%' })
      modal_title.html('Tambah Kategori')

      let body = `
        <form action="" method="post" enctype="multipart/form-data" class="px-3" id="form-add_kategori">
          <input type="hidden" id="_token" name="{{ csrf_token()->name }}" value="{{ csrf_token()->hash }}" />

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label text-right">
              Nama Kategori <span class="text-danger">*</span>
            </label>

            <div class="col-sm">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama Kategori" />
              <div class="invalid-feedback name"></div>
            </div>
          </div>
          <!-- /.form-group -->

          <div class="form-group row">
            <label for="parent_uid" class="col-sm-3 col-form-label text-right">
              Induk Kategori <span class="text-danger d-none">*</span>
            </label>

            <div class="col-sm">
              <select class="form-control select2bs4" id="parent_uid" name="parent_uid" style="width: 100%;">
                <!-- from ajax -->
                <option value="">Pilih Induk Kategori</option>
              </select>
            </div>
          </div>
          <!-- /.form-group -->

          <div class="form-group row">
            <label for="icon" class="col-sm-3 col-form-label text-right">
              Icon <span class="text-danger d-none">*</span>
            </label>

            <div class="col-sm">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="icon" name="icon" accept="image/jpeg, image/jpg, image/png" />
                <label class="custom-file-label" for="icon">Choose file</label>
              </div>
              <div class="preview mt-3 icon" data-width="100" style="display: none;">
                <img class="preview-image" src="" />
              </div>
            </div>
          </div>
          <!-- /.form-group -->
        </form>
      `
      modal_body.html(body)

      createSelect2('#parent_uid', `{{ base_url('master-data/kategori/dropdown-category') }}`, 'Pilih Induk Kategori')
      
      return modal.modal('show')
    }

    function add_kategori(event)
    {
      const form     = $('#form-add_kategori')
      const formData = new FormData(form[0])

      $.ajax({
        url: `{{ base_url('master-data/kategori/add-category') }}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
          loadingPage(true, 0)
        },
        success: function(response) {
          loadingPage(false)
          $(form).find('#_token').val(response.csrf)
          
          if (response.message == 'invalid-form') {
            Object.keys(response.error).forEach(function (key) {
              let error = response.error[key]

              $(form).find(`.invalid-feedback.${key}`).html(error)
              $(form).find(`[name="${key}"]`).addClass('is-invalid')
            })

            return false
          }

          if (response.status == true) {
            md_add_kategori(false)
            $('#list_category').DataTable().ajax.reload()
            return true
          }

          console.log(response)
        },
        error: function(xhr, status, error) {
          loadingPage(false)
          console.log(xhr)
        }
      })
    }
  </script>
@endsection