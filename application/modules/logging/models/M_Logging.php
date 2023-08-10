<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Logging extends CI_Model
{
  public $env;

  public function __construct()
  {
    parent::__construct();
    $this->env = $_ENV['APP_ENV'] ?: 'production';
  }

  public function read_log($param = null)
  {
    $param = (object) $param;

    if ($this->_validate_token($param->token)['status'] == false) return $this->_validate_token($param->token);

    $date = getTimestamp($param->date, 'Y-m-d');
    $file = str_replace('\\', '/', dirname(APPPATH)) . '/logs/' . $param->path . '/' . $date . '.log';
    
    if (!file_exists($file)) {
      $file = dirname(FCPATH) . '/logs/' . $param->path . '/' . $date . '.log';
      if (!file_exists($file)) return ['status' => false, 'message' => 'Log not found, please try again.', 'error' => 'file-not-found'];
    }

    $logs = file_get_contents($file);
    $logs = '<pre style="white-space: pre-wrap; word-wrap: break-word; font-size: 14px; font-family: Segoe UI; background-color: #000; color: #fff; padding: 20px; border-radius: 15px">file_path : ' . $file . '<br>base_url : ' . base_url() . '<br><br>' . htmlspecialchars($logs) . '</pre><span id="end"></span>';

    return ['status' => true, 'message' => 'Log has been found.', 'data' => $logs];
  }

  public function clear_log($param = null)
  {
    $param = (object) $param;
    
    if ($this->env == 'production') return ['status' => false, 'message' => 'You are not allowed to do this action.', 'error' => 'invalid-environment'];
    if ($this->_validate_token($param->token)['status'] == false) return $this->_validate_token($param->token);
    
    $date = getTimestamp($param->date, 'Y-m-d');
    $file = str_replace('\\', '/', dirname(APPPATH)) . '/logs/' . $param->path . '/' . $date . '.log';
    
    if (!file_exists($file)) {
      $file = str_replace('\\', '/', dirname(FCPATH)) . '/logs/' . $param->path . '/' . $date . '.log';
      if (!file_exists($file)) return ['status' => false, 'message' => 'Log not found, please try again.', 'error' => 'file-not-found'];
    }

    file_put_contents($file, '');
    $logs = '<pre style="white-space: pre-wrap; word-wrap: break-word; font-size: 14px; font-family: Segoe UI; background-color: #000; color: #fff; padding: 20px; border-radius: 15px">file_path : ' . $file . '<br>base_url : ' . base_url() . '<br><br> file has been cleared.</pre><span id="end"></span>';

    return ['status' => true, 'message' => 'Log has been cleared.', 'data' => $logs];
  }

  public function remove_log($param = null)
  {
    $param = (object) $param;

    if ($this->env == 'production') return ['status' => false, 'message' => 'You are not allowed to do this action.', 'error' => 'invalid-environment'];
    if ($this->_validate_token($param->token)['status'] == false) return $this->_validate_token($param->token);

    $root = str_replace('\\', '/', dirname(APPPATH)) . '/logs/' . $param->path . '/';
    if ($param->path == 'root') $root = str_replace('\\', '/', dirname(APPPATH)) . '/logs/';

    if (!is_dir($root)) {
      $root = str_replace('\\', '/', dirname(FCPATH)) . '/logs/' . $param->path . '/';
      if ($param->path == 'root') $root = str_replace('\\', '/', dirname(FCPATH)) . '/logs/';

      if (!is_dir($root)) return ['status' => false, 'message' => 'Log not found, please try again.', 'error' => 'file-not-found'];
    }

    if (file_exists($root . '.htaccess')) unlink($root . '.htaccess');
    $this->_remove_all($root);

    return ['status' => true, 'message' => 'Log has been removed.', 'data' => ['file_path' => $root, 'base_url' => base_url()]];
  }

  private function _remove_all($root)
  {
    $files = glob($root . '*', GLOB_MARK);

    foreach ($files as $file) {
      if (is_dir($file))  {
        $this->_remove_all($file);
      } else {
        if (file_exists($file . '.htaccess')) unlink($file . '.htaccess');
        unlink($file);
      }
    }

    if (file_exists($root . '.htaccess')) unlink($root . '.htaccess');
    if (is_dir($root)) rmdir($root);
  }

  private function _validate_token($token)
  {
    if ($token != $_ENV['APP_ACCESS_LOGS_TOKEN']) return ['status' => false, 'message' => 'You are not allowed to access this page.', 'error' => 'invalid-token'];
    return ['status' => true, 'message' => 'Token is valid.', 'error' => 'none'];
  }
}