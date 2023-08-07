<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getTimestamp'))
{
  function getTimestamp($date = 'now', $format = 'Y-m-d H:i:s', $country = 'ID')
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

if (!function_exists('hash_pass'))
{
  function hash_pass($string = '')
  {
    $string = trim($string);
    $string = substr($_ENV['HASHING_KEY'], 0, 18) . $string . substr($_ENV['HASHING_KEY'], -18);
    return md5(hash('sha256', $string));
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
  /**
   * ! Dependent on :
   * *   > $_ENV['APP_DOWNLOAD_LOGS_TOKEN']
   */

  function write_log($prefix = '', $data = [], $newline = false, $auto_encode = true, $path = '')
  {
    date_default_timezone_set('Asia/Jakarta');
    
    $env         = 'front';    // * [front, api]
    $timeExpired = 3;          // * 3 days
    $maxLogs     = 1000 * 20;  // * Maximum number of log lines stored

    if ($auto_encode) {
      if (is_array($data) || is_object($data)) $data = json_encode($data);
    }

    if ($path == '') $path = 'default';
    if ($prefix != '') $prefix = $prefix . ' : ';

    $root = $env == 'front' ? dirname(APPPATH) : dirname(FCPATH);
    $root = $root . '/logs/';
    $downloadLogsFile = $root . 'download_logs.php';
    
    if (!is_dir($root)) mkdir($root, 0755, true);
     
    if (!file_exists($downloadLogsFile)) {
      $token        = base64_encode($_ENV['APP_DOWNLOAD_LOGS_TOKEN'] . '-' . date('Y-m-d'));
      $redirect_url = base_url();

      $downloadLogsScript = <<<EOT
      <?php
        date_default_timezone_set('Asia/Jakarta');

        \$path          = isset(\$_GET['path']) ? \$_GET['path'] : '';
        \$zipFileName   = \$path != '' ? 'logs-' . \$path . date('Y-m-d H.i') . '.zip' : 'logs-' . date('Y-m-d H.i') . '.zip';
        \$logsDirectory = \$path != '' ? dirname(__FILE__) . '\\\\' . \$path : dirname(__FILE__);
        \$history_logs  = dirname(__FILE__) . '\\\\' . 'history_download_log.log';
        \$max_logs      = 1000; // * Maximum number of log lines stored

        \$ip_address = \$_SERVER['REMOTE_ADDR'];
        \$user_agent = \$_SERVER['HTTP_USER_AGENT'];

        if (file_exists(\$history_logs) && count(file(\$history_logs)) >= \$max_logs) unlink(\$history_logs);

        if (isset(\$_GET['token']) && \$_GET['token'] === '$token') {
          file_put_contents(\$history_logs, date('Y-m-d H:i:s') . ' -- Download Success Request From : {ip_address: ' . \$ip_address . ', user_agent: ' . \$user_agent . ', zipFileName: ' . \$zipFileName . '}' . PHP_EOL, FILE_APPEND);

          \$zip = new ZipArchive();
          if (\$zip->open(\$zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            \$files = new RecursiveIteratorIterator(
              new RecursiveDirectoryIterator(\$logsDirectory),
              RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach (\$files as \$name => \$file) {
              if (!\$file->isDir() && \$file->getFilename() !== 'download_logs.php' && \$file->getFilename() !== '.htaccess') {
                \$filePath = \$file->getRealPath();
                \$relativePath = substr(\$filePath, strlen(\$logsDirectory) + 1);
                \$zip->addFile(\$filePath, \$relativePath);
              }
            }

            \$zip->close();

            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . \$zipFileName . '"');
            header('Content-Length: ' . filesize(\$zipFileName));
            readfile(\$zipFileName);
            unlink(\$zipFileName);
            exit;
          }
        }

        file_put_contents(\$history_logs, date('Y-m-d H:i:s') . ' -- Download Failed Request From : {ip_address: ' . \$ip_address . ', user_agent: ' . \$user_agent . ', zipFileName: ' . \$zipFileName . '}' . PHP_EOL, FILE_APPEND);

        header('Location: ' . '$redirect_url'); exit;
      EOT;
  
      $downloadLogsFile = $root . 'download_logs.php';
      file_put_contents($downloadLogsFile, $downloadLogsScript);
    }

    $htaccess_content = "# Turn off access to all files inside the logs directory\nDeny from all\n\n# Allow special access to scripts download_logs.php\n<Files \"download_logs.php\">\n    Allow from all\n    Satisfy any\n</Files>";
    file_put_contents($root . '.htaccess', $htaccess_content);
    
    $log_dir = $root . $path . '/';
    if (!is_dir($log_dir)) mkdir($log_dir, 0755, true);
    
    $temp_folder = $root . $path . '/temp/';
    if (!is_dir($temp_folder)) mkdir($temp_folder, 0755, true);

    $log_file = $log_dir . date('Y-m-d') . '.log';

    // * If the log file is more than $maxLogs lines, then the log file will be archived
    if (file_exists($log_file) && count(file($log_file)) >= $maxLogs) {
      $increment     = 1;
      $max_increment = 3;
      $new_log_file  = $temp_folder . date('Y-m-d') . '-' . $increment . '.log';
      
      while (file_exists($new_log_file)) {
        if ($increment >= $max_increment) {
          for ($i = 1; $i <= $max_increment; $i++) {
            $old_log_file = $temp_folder . date('Y-m-d') . '-' . $i . '.log';
            if (file_exists($old_log_file)) unlink($old_log_file);
          }

          $increment = 1;
        }

        $new_log_file = $temp_folder . date('Y-m-d') . '-' . $increment . '.log';
        $increment++;
      }

      rename($log_file, $new_log_file);
    }

    $dataWithTimestamp = date('Y-m-d H:i:s') . ' -- ' . $prefix . $data;

    if ($newline) {
      file_put_contents($log_file, $dataWithTimestamp . PHP_EOL . PHP_EOL, FILE_APPEND);
    } else {
      file_put_contents($log_file, $dataWithTimestamp . PHP_EOL, FILE_APPEND);
    }

    // * Delete logs older than $timeExpired days
    $logs  = glob($log_dir . '*.log');
    $today = strtotime(date('Y-m-d'));

    foreach ($logs as $log) {
      if (is_file($log)) {
        $log_date = date('Y-m-d', strtotime(basename($log, '.log')));
        $log_timestamp = strtotime($log_date);

        if ($log_timestamp < $today - ($timeExpired * 24 * 60 * 60)) {
          $temp_logs = glob($temp_folder . $log_date . '-*.log');

          foreach ($temp_logs as $temp_log) {
            if (file_exists($temp_log)) unlink($temp_log);
          }

          if (file_exists($log)) unlink($log);

          // * Delete download_logs.phpevery time the log is deleted so that the download_logs.php script can be automatically updated
          if (file_exists($downloadLogsFile)) unlink($downloadLogsFile);
        }
      }
    }
    
    return ['status' => true, 'log_dir' => $log_dir, 'log_file' => $log_file];
  }
}

// ! Dependent on write_log()
if (!function_exists('lasq')) {
  function lasq($lasq = '', $message = 0)
  {
    $caller_info = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1];
    $class       = isset($caller_info['class']) ? $caller_info['class'] : '';
    $function    = isset($caller_info['function']) ? $caller_info['function'] : '';
    $file        = basename($caller_info['file']);

    $prefix = '';
    if (!empty($class) && !empty($function)) {
      $prefix = $class . '::' . $function . '() - ' . $message;
    } else {
      $prefix = $file . '::' . $prefix . ' - ' . $message;
    }

    write_log($prefix, $lasq, true, false, 'lasq');
  }
}

// ! Dependent on write_log()
if (!function_exists('trace')) {
  function trace($trace = '', $message = 0)
  {
    $caller_info = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1];
    $class       = isset($caller_info['class']) ? $caller_info['class'] : '';
    $function    = isset($caller_info['function']) ? $caller_info['function'] : '';
    $file        = basename($caller_info['file']);

    $prefix = '';
    if (!empty($class) && !empty($function)) {
      $prefix = $class . '::' . $function . '() - ' . $message;
    } else {
      $prefix = $file . '::' . $prefix . ' - ' . $message;
    }

    write_log($prefix, $trace, true, false, 'trace');
  }
}
