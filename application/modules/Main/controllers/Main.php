<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller 
{
  public function index()
  {
    secure_access();
    logs(['referrer' => base_url('auth/main')], null, 4);

    $data = [
      'breadcrumb' => [
        'title' => 'Dashboard',
        'content' => [
          ['title' => 'Home', 'url' => base_url()],
          ['title' => 'Dashboard', 'is_active' => true]
        ]
      ]
    ];

    view('main.dashboard', $data);
  }
  
  public function error_404()
  {
    view('errors.error-404');
  }
}