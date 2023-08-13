@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-sm btn-primary" onclick="return modalAdd()">
              <i class="fa fa-fw fa-plus"></i> Add
            </button>

            <div class="table-responsive mt-3 pb-4">
              <table id="list_category" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Nama Kategori</th>
                    <th>Induk</th>
                    <th>Icon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- from ajax -->
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
@endsection

@include('master_data.category.scripts.category')