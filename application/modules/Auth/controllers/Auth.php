<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller 
{
  public function index()
  {
    $this->load->view('Auth/auth/login');
  }

  public function signup()
  {
    $this->load->view('Auth/auth/signup');
  }
}