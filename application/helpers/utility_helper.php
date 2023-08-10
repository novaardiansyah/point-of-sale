<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getTimestamp'))
{
  function getTimestamp($date = 'now', $format = 'Y-m-d H:i:s', $country = 'US')
  {
    date_default_timezone_set('Asia/Jakarta');
    $timestamp = strtotime($date);

    if ($country === 'ID') {
      $monthNames = array(
        'F' => 'Januari', 'M' => 'Februari', 'A' => 'Maret', 'Y' => 'April', 'M' => 'Mei', 'J' => 'Juni',
        'J' => 'Juli', 'A' => 'Agustus', 'S' => 'September', 'O' => 'Oktober', 'N' => 'November', 'D' => 'Desember'
      );

      $format = strtr($format, $monthNames);
    }

    return date($format, $timestamp);
  }
}

if (!function_exists('terbilang')) {
  function terbilang($number)
  {
    $angka = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];

    if ($number < 12) {
      return $angka[$number];
    } elseif ($number < 20) {
      return $angka[$number - 10] . ' Belas';
    } elseif ($number < 100) {
      return $angka[floor($number / 10)] . ' Puluh ' . terbilang($number % 10);
    } elseif ($number < 200) {
      return 'Seratus ' . terbilang($number - 100);
    } elseif ($number < 1000) {
      return $angka[floor($number / 100)] . ' Ratus ' . terbilang($number % 100);
    } elseif ($number < 2000) {
      return 'Seribu ' . terbilang($number - 1000);
    } elseif ($number < 1000000) {
      return terbilang(floor($number / 1000)) . ' Ribu ' . terbilang($number % 1000);
    } elseif ($number < 1000000000) {
      return terbilang(floor($number / 1000000)) . ' Juta ' . terbilang($number % 1000000);
    } elseif ($number < 1000000000000) {
      return terbilang(floor($number / 1000000000)) . ' Miliar ' . terbilang($number % 1000000000);
    } elseif ($number < 1000000000000000) {
      return terbilang(floor($number / 1000000000000)) . ' Triliun ' . terbilang($number % 1000000000000);
    } else {
      return 'Angka terlalu besar';
    }
  }
}

use Symfony\Component\Uid\Uuid;
if (!function_exists('uuid'))
{
  // ? dependent > symfony/uid: 5.4.21 > php: >= 7.0
  function uuid()
  {
    return Uuid::v4();
  }
}

if (!function_exists('encrypt')) 
{
  // ? dependent > php: >= 7.0
  function encrypt($string = '') 
  {
    $key = md5($_ENV['ENCRYPTION_KEY']);
    $iv  = openssl_random_pseudo_bytes(16);
  
    $encrypted = openssl_encrypt($string, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    $result    = base64_encode($iv . $encrypted);
    return $result;
  }
}

if (!function_exists('decrypt')) 
{
  // ? dependent > php: >= 7.0
  function decrypt($string = '') {
    $key       = md5($_ENV['ENCRYPTION_KEY']);
    $string    = base64_decode($string);
    $iv        = substr($string, 0, 16);
    $encrypted = substr($string, 16);

    $result = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $result;
  }
}

if (!function_exists('csrf_token'))
{
  function csrf_token()
  {
    $ci = get_instance();

    return (object) [
      'name' => $ci->security->get_csrf_token_name(),
      'hash' => $ci->security->get_csrf_hash()
    ];
  }
}

if (!function_exists('textCapitalize')) 
{
  function textCapitalize($string = '')
  {
    if (is_string($string)) {
      $string = preg_replace('/\s+/', ' ', $string);
      $string = trim($string);
    }
  
    $string = ucwords(strtolower($string));
    return $string;
  }
}

if (!function_exists('textUppercase')) 
{
  function textUppercase($string = '')
  {
    if (is_string($string)) {
      $string = preg_replace('/\s+/', ' ', $string);
      $string = trim($string);
    }

    $string = strtoupper($string);
    return $string;
  }
}

if (!function_exists('textLowercase')) 
{
  function textLowercase($string = '')
  {
    if (is_string($string)) {
      $string = preg_replace('/\s+/', ' ', $string);
      $string = trim($string);
    }

    $string = strtolower($string);
    return $string;
  }
}

if (!function_exists('json'))
{
  function json($data = [])
  {
    $ci = get_instance();

    if (is_object($data)) $data = (array) $data;

    $data['csrf'] = csrf_token()->hash;
    return $ci->output->set_content_type('application/json')->set_output(json_encode($data));
  }
}

if (!function_exists('post'))
{
  function post($name = '', $xss_clean = TRUE)
  {
    $ci = get_instance();
    return $ci->input->post($name, $xss_clean);
  }
}

if (!function_exists('get'))
{
  function get($name = '', $xss_clean = TRUE)
  {
    $ci = get_instance();
    return $ci->input->get($name, $xss_clean);
  }
}

if (!function_exists('hash_password'))
{
  function hash_password($password = '')
  {
    $string = trim($password);
    $string = substr($_ENV['HASHING_KEY'], 0, 18) . $string . substr($_ENV['HASHING_KEY'], -18);
    return hash('sha256', $string);
  }
}

if (!function_exists('verify_password'))
{
  function verify_password($password = '', $hash_password = '')
  {
    if (hash_password($password) === $hash_password) return true;
    return false;
  }
}

if (!function_exists('set_session'))
{
  function set_session($data = [])
  {
    $ci = get_instance();
    
    $temp = [];
    foreach ($data as $key => $value) {
      $key = $key . '_' . $_ENV['APP_SESSION_NAME'];
      $ci->session->set_userdata($key, $value);
      $temp[$key] = $value;
    }

    return (Object) ['status' => true, 'message' => 'Session has been set', 'data' => $temp];
  }
}

if (!function_exists('get_session'))
{
  function get_session($key = '')
  {
    $ci = get_instance();
    $key = $key . '_' . $_ENV['APP_SESSION_NAME'];
    return $ci->session->userdata($key);
  }
}

if (!function_exists('unset_session'))
{
  function unset_session($keys = [])
  {
    $ci = get_instance();
    
    $temp = [];
    foreach ($keys as $key) {
      $key = $key . '_' . $_ENV['APP_SESSION_NAME'];
      $ci->session->unset_userdata($key);
      $temp[] = $key;
    }

    return (Object) ['status' => true, 'message' => 'Session has been unset', 'data' => $temp];
  }
}

if (!function_exists('write_log')) {
  function write_log($prefix = '', $data = [], $newline = false, $path = '')
  {
    date_default_timezone_set('Asia/Jakarta');
    
    $env         = 'front';    // * [front, api]
    $timeExpired = 3;          // * 3 days
    $maxLogs     = 1000 * 20;  // * Maximum number of log lines stored

    if (is_array($data) || is_object($data)) $data = json_encode($data);

    if ($path == '') $path = 'default';
    if ($prefix != '') $prefix = $prefix . ' : ';

    $root = $env == 'front' ? dirname(APPPATH) : dirname(FCPATH);
    $root = $root . '/logs/';
    
    if (!is_dir($root)) mkdir($root, 0755, true);
    file_put_contents($root . '.htaccess', "Options -Indexes\nDeny from All");
    
    $log_dir = $root . $path . '/';
    if (!is_dir($log_dir)) mkdir($log_dir, 0755, true);
    file_put_contents($log_dir . '.htaccess', "Options -Indexes\nDeny from All");
    
    $log_file = $log_dir . date('Y-m-d') . '.log';

    // * If the log file is more than $maxLogs lines, then the log file will be cleared
    if (file_exists($log_file) && count(file($log_file)) >= $maxLogs) file_put_contents($log_file, '');

    $dataWithTimestamp = date('Y-m-d H:i:s') . ' -- ' . $prefix . $data;

    if ($newline) file_put_contents($log_file, $dataWithTimestamp . PHP_EOL . PHP_EOL, FILE_APPEND);
    else file_put_contents($log_file, $dataWithTimestamp . PHP_EOL, FILE_APPEND);

    // * Delete logs older than $timeExpired days
    $logs  = glob($log_dir . '*.log');
    $today = strtotime(date('Y-m-d'));
    if ($timeExpired < 1) $timeExpired = 1; // * Minimum 1 day (24 hours)

    foreach ($logs as $log) {
      if (is_file($log)) {
        $log_date      = date('Y-m-d', strtotime(basename($log, '.log')));
        $log_timestamp = strtotime($log_date);

        if ($log_timestamp < $today - ($timeExpired * 24 * 60 * 60)) {
          if (file_exists($log)) unlink($log);
        }
      }
    }
    
    return ['status' => true, 'log_dir' => $log_dir, 'log_file' => $log_file];
  }
}

/**
 * ! Dependent on : 
 * * > write_log(), 
 * * > logs() - inner_helper.php
 */ 

if (!function_exists('lasq')) {
  function lasq($lasq = '', $message = 0)
  {
    $caller_info = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1];
    $class       = isset($caller_info['class']) ? $caller_info['class'] : '';
    $function    = isset($caller_info['function']) ? $caller_info['function'] : '';
    $file        = basename(isset($caller_info['file']) ? $caller_info['file'] : '');

    $prefix = '';
    if (!empty($class) && !empty($function)) {
      $prefix = $class . '::' . $function . '() - ' . $message;
    } else {
      $prefix = $file . '::' . $message;
    }

    logs($lasq, $prefix, 3);
    write_log($prefix, $lasq, true, 'lasq');
  }
}

/**
 * ! Dependent on : 
 * * > write_log(), 
 * * > logs() - inner_helper.php
 */ 
if (!function_exists('trace')) {
  function trace($trace = '', $message = 0)
  {
    $caller_info = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1];
    $class       = isset($caller_info['class']) ? $caller_info['class'] : '';
    $function    = isset($caller_info['function']) ? $caller_info['function'] : '';
    $file        = basename(isset($caller_info['file']) ? $caller_info['file'] : '');

    $prefix = '';
    if (!empty($class) && !empty($function)) {
      $prefix = $class . '::' . $function . '() - ' . $message;
    } else {
      $prefix = $file . '::' . $message;
    }

    logs($trace, $prefix, 2);
    write_log($prefix, $trace, true, 'trace');
  }
}
