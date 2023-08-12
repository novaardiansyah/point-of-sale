<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ assets_url('img/profile-img.jpg'); }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="javascript:;" class="d-block">{{ get_session('login')['fullname']; }}</a>
    </div>
  </div>
  
  <!-- Sidebar Menu -->
  <nav class="mt-2 pb-5">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-header">SUMMERY</li>

      <li class="nav-item">
        <a href="{{ base_url(); }}" class="nav-link {{ isActiveMenu(); }}">
          <i class="nav-icon mdi mdi-monitor"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-header">TRANSAKSI</li>

      <li class="nav-item">
        <a href="{{ base_url('transaksi/pembayaran'); }}" class="nav-link {{ isActiveMenu('transaksi/pembayaran'); }}">
          <i class="nav-icon mdi mdi-cash-plus"></i>
          <p>
            Pembayaran
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('transaksi/pembelian'); }}" class="nav-link {{ isActiveMenu('transaksi/pembelian'); }}">
          <i class="nav-icon mdi mdi-cash-minus"></i>
          <p>
            Pembelian
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('transaksi/penjualan'); }}">
          <i class="nav-icon mdi mdi-cash-check"></i>
          <p>
            Penjualan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('transaksi/penjualan/kasir'); }}" class="nav-link {{ isActiveMenu('transaksi/penjualan/kasir'); }}">
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Kasir</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('transaksi/penjualan/return'); }}" class="nav-link {{ isActiveMenu('transaksi/penjualan/return'); }}">
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Return</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('hutang'); }}">
          <i class="nav-icon mdi mdi-cash-check"></i>
          <p>
            Hutang & Piutang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('hutang'); }}" class="nav-link" {{ isActiveMenu('hutang'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Hutang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('hutang/piutang'); }}" class="nav-link" {{ isActiveMenu('hutang/piutang'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Piutang</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header">TRANSAKSI LAINNYA</li>

      <li class="nav-item">
        <a href="{{ base_url('transaksi/pemesanan'); }}" class="nav-link {{ isActiveMenu('transaksi/pemesanan'); }}">
          <i class="nav-icon mdi mdi-cart-arrow-up"></i>
          <p>
            Pemesanan
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('transaksi/penawaran'); }}" class="nav-link {{ isActiveMenu('transaksi/penawaran'); }}">
          <i class="nav-icon mdi mdi-cart-arrow-up"></i>
          <p>
            Penawaran
          </p>
        </a>
      </li>

      <li class="nav-header">TAGIHAN</li>

      <li class="nav-item">
        <a href="{{ base_url('tagihan/email'); }}" class="nav-link {{ isActiveMenu('tagihan/email'); }}">
          <i class="nav-icon mdi mdi-cash-register"></i>
          <p>
            Tagihan Email
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('tagihan/ewallet'); }}" class="nav-link {{ isActiveMenu('tagihan/ewallet'); }}">
          <i class="nav-icon mdi mdi-cash-register"></i>
          <p>
            Tagihan E-Wallet
          </p>
        </a>
      </li>

      <li class="nav-header">MUTASI</li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('mutasi/data-transfer'); }}">
          <i class="nav-icon mdi mdi-cart-arrow-right"></i>
          <p>
          Transfer Barang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('mutasi/data-transfer'); }}" class="nav-link" {{ isActiveMenu('mutasi/data-transfer'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Data Transfer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('mutasi/item-transfer'); }}" class="nav-link" {{ isActiveMenu('mutasi/item-transfer'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Item Transfer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('mutasi/terima-barang'); }}" class="nav-link" {{ isActiveMenu('mutasi/terima-barang'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Terima Barang</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('mutasi/data-pengurangan'); }}">
          <i class="nav-icon mdi mdi-cart-arrow-right"></i>
          <p>
          Pengurangan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('mutasi/data-pengurangan'); }}" class="nav-link" {{ isActiveMenu('mutasi/data-pengurangan'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Data Pengurangan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('mutasi/item-pengurangan'); }}" class="nav-link" {{ isActiveMenu('mutasi/item-pengurangan'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Item Pengurangan</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header">STOCK BARANG</li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('stock'); }}">
          <i class="nav-icon mdi mdi-store"></i>
          <p>
          Stock Barang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('stock'); }}" class="nav-link" {{ isActiveMenu('stock'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Semua Stock</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('stock/gudang'); }}" class="nav-link" {{ isActiveMenu('stock/gudang'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Stock Gudang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('stock/masuk'); }}" class="nav-link" {{ isActiveMenu('stock/masuk'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Stock Masuk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('stock/keluar'); }}" class="nav-link" {{ isActiveMenu('stock/keluar'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Stock Keluar</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header">MASTER DATA</li>

      <li class="nav-item">
        <a href="{{ base_url('barcode'); }}" class="nav-link {{ isActiveMenu('barcode'); }}">
          <i class="nav-icon mdi mdi-barcode"></i>
          <p>
            Buat Barcode
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('masterData/barang'); }}">
          <i class="nav-icon mdi mdi-table"></i>
          <p>
          Master Data
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('masterData/barang'); }}" class="nav-link" {{ isActiveMenu('masterData/barang'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Barang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('masterData/customer'); }}" class="nav-link" {{ isActiveMenu('masterData/customer'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Customer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('masterData/gudang'); }}" class="nav-link" {{ isActiveMenu('masterData/gudang'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Gudang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('masterData/kategori'); }}" class="nav-link" {{ isActiveMenu('masterData/kategori'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('masterData/satuan'); }}" class="nav-link" {{ isActiveMenu('masterData/satuan'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Satuan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('masterData/supplier'); }}" class="nav-link" {{ isActiveMenu('masterData/supplier'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Supplier</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('masterData/sales'); }}" class="nav-link" {{ isActiveMenu('masterData/sales'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Sales</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header">AKUNTANSI</li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('akuntansi/akun/kategori-akun'); }}">
          <i class="nav-icon mdi mdi-table"></i>
          <p>
            Akun
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/akun') }}" class="nav-link" {{ isActiveMenu('akuntansi/akun'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Daftar akun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/akun/kategori-akun') }}" class="nav-link" {{ isActiveMenu('akuntansi/akun/kategori-akun'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Kategori akun</p>
            </a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('akuntansi/kas'); }}">
          <i class="nav-icon mdi mdi-cash-100"></i>
          <p>
            Kas
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/kas') }}" class="nav-link" {{ isActiveMenu('akuntansi/kas'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Kas & Bank</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/kas/rekening') }}" class="nav-link" {{ isActiveMenu('akuntansi/kas/rekening'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Rekening</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('akuntansi/pengeluaran'); }}" class="nav-link {{ isActiveMenu('akuntansi/pengeluaran'); }}">
          <i class="nav-icon mdi mdi-cash-minus"></i>
          <p>
            Pengeluaran
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('akuntansi/penerimaan'); }}" class="nav-link {{ isActiveMenu('akuntansi/penerimaan'); }}">
          <i class="nav-icon mdi mdi-cash-check"></i>
          <p>
            Penerimaan
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('akuntansi/transfer'); }}" class="nav-link {{ isActiveMenu('akuntansi/transfer'); }}">
          <i class="nav-icon mdi mdi-bank-transfer"></i>
          <p>
            Transfer
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('akuntansi/jurnal-umum'); }}" class="nav-link {{ isActiveMenu('akuntansi/jurnal-umum'); }}">
          <i class="nav-icon mdi mdi-cash-multiple"></i>
          <p>
            Jurnal Umum
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="javascript:;" class="nav-link {{ isActiveMenu('akuntansi/laporan/neraca'); }}">
          <i class="nav-icon mdi mdi-table"></i>
          <p>
            Laporan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/laporan/neraca'); }}" class="nav-link" {{ isActiveMenu('akuntansi/laporan/neraca'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Neraca</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/laporan/buku-besar'); }}" class="nav-link" {{ isActiveMenu('akuntansi/laporan/buku-besar'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Buku Besar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ base_url('akuntansi/laporan/laba-rugi'); }}" class="nav-link" {{ isActiveMenu('akuntansi/laporan/laba-rugi'); }}>
              <i class="mdi mdi-minus-box-outline"></i>
              <p>Laba - Rugi</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header">PENGATURAN</li>

      <li class="nav-item">
        <a href="{{ base_url('toko'); }}" class="nav-link {{ isActiveMenu('toko'); }}">
          <i class="nav-icon mdi mdi-store"></i>
          <p>
            Daftar Toko
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('toko/profile'); }}" class="nav-link {{ isActiveMenu('toko/profile'); }}">
          <i class="nav-icon mdi mdi-store"></i>
          <p>
            Profile Toko
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('toko/pengaturan'); }}" class="nav-link {{ isActiveMenu('toko/pengaturan'); }}">
          <i class="nav-icon mdi mdi-cog"></i>
          <p>
            Pengaturan Toko
          </p>
        </a>
      </li>

      <li class="nav-header">PENGGUNA</li>
      
      <li class="nav-item">
        <a href="{{ base_url('user/profile'); }}" class="nav-link {{ isActiveMenu('user/profile'); }}">
          <i class="nav-icon mdi mdi-account"></i>
          <p>
            Profile Saya
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('user'); }}" class="nav-link {{ isActiveMenu('user'); }}">
          <i class="nav-icon mdi mdi-account-search"></i>
          <p>
            Data Pengguna
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('user/roles'); }}" class="nav-link {{ isActiveMenu('user/roles'); }}">
          <i class="nav-icon mdi mdi-account-check"></i>
          <p>
            Roles
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('user/permission'); }}" class="nav-link {{ isActiveMenu('user/permission'); }}">
          <i class="nav-icon mdi mdi-account-key"></i>
          <p>
            Hak Akses
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ base_url('auth/logout'); }}" class="nav-link {{ isActiveMenu('auth/logout'); }}">
          <i class="nav-icon mdi mdi-logout"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->