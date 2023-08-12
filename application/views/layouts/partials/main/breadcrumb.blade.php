<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0">{{ $breadcrumb['title'] ?? '' }}</h4>
      </div><!-- /.col -->
      
      @if (isset($breadcrumb['content']))
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            @foreach ($breadcrumb['content'] as $value)
              @php $value = (object) $value; @endphp
              
              @if (isset($value->url))
                <li class="breadcrumb-item">
                  <a href="{{ $value->url; }}">{{ $value->title; }}</a>
                </li>
              @else
                <li class="breadcrumb-item {{ isset($value->is_active) && $value->is_active ? 'active' : ''; }}">
                  {{ $value->title; }}
                </li>
              @endif
            @endforeach
          </ol>
        </div><!-- /.col -->
      @endif

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->