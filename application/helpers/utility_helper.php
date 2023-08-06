<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getTimestamp'))
{
  function getTimestamp($date = 'now', $format = 'Y-m-d H:i:s')
  {
    date_default_timezone_set('Asia/Jakarta');
    return date($format, strtotime($date));
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