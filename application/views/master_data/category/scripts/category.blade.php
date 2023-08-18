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
          { 
            data: 'icon', 
            orderable: false, 
            searchable: false,
            render: function(data, type, row) {
              return row?.icon ? `<img src="{{ assets_url('img/master_data/category/${row?.icon}') }}" class="img-fluid" width="50" />` : ''
            }
          },
          { 
            data: 'uid', 
            orderable: false, 
            searchable: false,
            width: '50px',
            render: function(data, type, row) {
              return `
                <div class="btn-group show">
                  <button type="button" class="btn btn-sm btn-info" onclick="return md_edit_kategori(true, '${row?.uid}')">Edit</button>
                  <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                  <div class="dropdown-menu" role="menu" x-placement="top-start">
                    <a class="dropdown-item position-relative" href="#" onclick="return md_edit_kategori(true, '${row?.uid}')">Edit</a>
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

      if (trigger == false) {
        modal_body.html('')
        return modal.modal('hide')
      }
      
      modal_dialog.css({ 'max-width': '50%' })
      modal_title.html('Tambah Kategori')
      btn_close.attr('onclick', 'md_add_kategori(false)')

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

          <hr class="my-0 mb-4" />

          <div class="form-group row mb-0 pb-0">
            <label for="" class="col-sm-3 col-form-label text-right"></label>

            <div class="col-sm text-right">
              <button type="button" class="btn btn-secondary mr-1" onclick="md_add_kategori(false)">Batal</button>
              <button type="button" class="btn btn-primary" onclick="add_kategori(event)">Simpan</button>
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
          $(form).find('input, select, button').attr('disabled', true)
        },
        success: function(response) {
          $(form).find('input, select, button').attr('disabled', false)
          $(form).find('#_token').val(response.csrf)
          
          if (response.message == 'invalid-form') {
            toast('error', 'Silahkan lengkapi form yang tersedia!')

            Object.keys(response.error).forEach(function (key) {
              let error = response.error[key]

              $(form).find(`.invalid-feedback.${key}`).html(error)
              $(form).find(`[name="${key}"]`).addClass('is-invalid')
            })

            return false
          }

          if (response.status == true) {
            md_add_kategori(false)
            toast('success', response.message, () => {
              $('#list_category').DataTable().ajax.reload()
            })
            return true
          }

          toast('error', response.message)
        },
        error: function(xhr, status, error) {
          loadingPage(false)
          console.log(xhr)
        }
      })
    }

    function md_edit_kategori(trigger = true, uid = '')
    {
      let modal        = $('#dynamic_modal')
      let modal_title  = modal.find('.modal-title')
      let modal_body   = modal.find('.modal-body')
      let modal_footer = modal.find('.modal-footer')
      let modal_dialog = modal.find('.modal-dialog')
      let btn_close    = modal.find('.close-modal')

      if (trigger == false) {
        modal_body.html('')
        return modal.modal('hide')
      }

      let data = edit_kategori(uid)
      if (data.status == false) return toast('error', data?.message || 'Something went wrong!')
      let category = data?.data

      modal_dialog.css({ 'max-width': '50%' })
      modal_title.html('Edit Kategori')
      btn_close.attr('onclick', 'md_edit_kategori(false)')

      let body = `
        <form action="" method="post" enctype="multipart/form-data" class="px-3" id="form-update_kategori">
          <input type="hidden" value="${category?.uid || 0}" name="uid" id="uid" />

          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label text-right">
              Nama Kategori <span class="text-danger">*</span>
            </label>

            <div class="col-sm">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama Kategori" value="${category?.name}" />
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
              <div class="preview mt-3 icon" data-width="100" style="${category?.icon ? '' : 'display: none'}">
                <img class="preview-image" src="{{ assets_url('img/master_data/category/${category?.icon}') }}" width="100px;" />
              </div>
            </div>
          </div>
          <!-- /.form-group -->

          <hr class="my-0 mb-4" />

          <div class="form-group row mb-0 pb-0">
            <label for="" class="col-sm-3 col-form-label text-right"></label>

            <div class="col-sm text-right">
              <button type="button" class="btn btn-secondary mr-1" onclick="md_edit_kategori(false)">Batal</button>
              <button type="button" class="btn btn-primary" onclick="update_kategori(event)">Perbarui</button>
            </div>
          </div>
          <!-- /.form-group -->
        </form>
      `
      modal_body.html(body)

      createSelect2('#parent_uid', `{{ base_url('master-data/kategori/dropdown-category') }}`, category?.parent_name || 'Pilih Induk Kategori', category?.parent_uid, [category?.uid]) 
        
      return modal.modal('show')
    }

    function edit_kategori(uid)
    {
      let result = { status: false, message: 'Something went wrong!', data: {} }
      
      $.ajax({
        url: `{{ base_url('master-data/kategori/edit-category') }}`,
        type: 'POST',
        data: { uid: uid },
        dataType: 'JSON',
        async: false,
        beforeSend: function() {},
        success: function(response) {
          result = response
        },
        error: function(xhr, status, error) {
          loadingPage(false)
          toast('error', xhr.responseText)
          console.log(xhr)
        }
      })

      return result
    }

    function update_kategori(event)
    {
      const form     = $('#form-update_kategori')
      const formData = new FormData(form[0])

      $.ajax({
        url: `{{ base_url('master-data/kategori/update-category') }}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $(form).find('input, select, button').attr('disabled', true)
        },
        success: function(response) {
          $(form).find('input, select, button').attr('disabled', false)
          $(form).find('#_token').val(response.csrf)
          
          if (response.message == 'invalid-form') {
            toast('error', 'Silahkan lengkapi form yang tersedia!')

            Object.keys(response.error).forEach(function (key) {
              let error = response.error[key]

              $(form).find(`.invalid-feedback.${key}`).html(error)
              $(form).find(`[name="${key}"]`).addClass('is-invalid')
            })

            return false
          }

          if (response.status == true) {
            md_add_kategori(false)
            toast('success', response.message, () => {
              $('#list_category').DataTable().ajax.reload()
            })
            return true
          }

          toast('error', response.message)
        },
        error: function(xhr, status, error) {
          loadingPage(false)
          console.log(xhr)
        }
      })
    }
  </script>
@endsection