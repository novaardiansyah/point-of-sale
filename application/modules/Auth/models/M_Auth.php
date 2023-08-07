<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  
  public function register($param = [])
  {
    $param = (object) $param;
    $user = $this->db->query("SELECT a.uid FROM users AS a WHERE a.email = ?", [$param->fullname])->row();
    lasq($this->db->last_query(), 1);

    return [
      'status'  => true,
      'message' => 'Register success',
      'data'    => $param,
      'user'    => $user
    ];
  }
}