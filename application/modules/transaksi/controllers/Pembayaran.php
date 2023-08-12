<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends MX_Controller
{
  public function index()
  {
    secure_access();

    $data = [
      'breadcrumb' => [
        'title' => 'Pembayaran',
        'content' => [
          ['title' => 'Transaksi', 'url' => base_url('transaksi/pembayaran')],
          ['title' => 'Pembayaran', 'is_active' => true]
        ]
      ],
    ];

    view('transaksi.pembayaran.list', $data);
  }
}
