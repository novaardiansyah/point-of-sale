<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends MX_Controller 
{
  public function index()
  {
    secure_access();
    $data = [
      'breadcrumb' => (object) [
        'title' => 'Pembayaran',
        'content' => [
          ['title' => 'Home', 'url' => base_url('dashboard')],
          ['title' => 'Pembayaran', 'url' => base_url('pembayaran')]
        ]
      ],
      'script' => [
        'pembayaran/script/pembayaran',
      ]
    ];
    
    view('pembayaran/pembayaran', $data);
  }
}