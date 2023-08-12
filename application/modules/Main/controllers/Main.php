<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller 
{
  public function index()
  {
    secure_access();
    view('main/dashboard');
  }

  public function error_404()
  {
    $this->load->view('layout/error/404');
  }
}