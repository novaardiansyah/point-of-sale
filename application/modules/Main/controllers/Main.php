<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller 
{
  public function index()
  {
    $this->load->view('main/main');
  }
}