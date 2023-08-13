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
            data: 'id', 
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
  </script>
@endsection