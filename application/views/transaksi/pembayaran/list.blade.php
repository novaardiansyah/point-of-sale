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

            <div class="table-responsive mt-3">
              <table id="list_pembayaran" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No. </th>
                    <th>Tanggal</th>
                    <th>No. Nota</th>
                    <th>Transaksi</th>
                    <th>Metode Bayar</th>
                    <th>Jumlah</th>
                    <th>Bama Bank</th>
                    <th>No. Rekening</th>
                    <th>Lampiran</th>
                    <th>Status</th>
                    <th>Verifikasi</th>
                    <th>::</th>
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