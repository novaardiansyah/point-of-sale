<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Logging extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Logging', 'Logging');
  }

  public function read_log()
  {
    $date  = get('date');
    $token = get('token');
    $path  = get('path') ?: 'default';

    if ($date == null || $token == null) return json(['status'  => false, 'message' => 'date or token is empty', 'error'   => 'invalid-form']);

    $result = $this->Logging->read_log(['date' => $date, 'path' => $path, 'token' => base64_decode($token)]);

    if ($result['status'] == false) return json($result);
    echo $result['data']; exit;
  }

  public function clear_log()
  {
    $date  = get('date');
    $token = get('token');
    $path  = get('path') ?: 'default';

    if (!$token) return json(['status'  => false, 'message' => 'date or token is empty', 'error' => 'invalid-form']);

    $result = $this->Logging->clear_log(['date' => $date, 'path' => $path, 'token' => base64_decode($token)]);

    if ($result['status'] == false) return json($result);
    echo $result['data']; exit;
  }

  public function remove_log()
  {
    $token = get('token');
    $path  = get('path') ?: 'default';

    if (!$token) return json(['status'  => false, 'message' => 'date or token is empty', 'error' => 'invalid-form']);

    $result = $this->Logging->remove_log(['path' => $path, 'token' => base64_decode($token)]);

    return json($result);
  }
}