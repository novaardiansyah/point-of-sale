<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('assets_url'))
{
  function assets_url($path = '')
  {
    return base_url('assets/' . $path);
  }
}

if (!function_exists('argon_url'))
{
  function argon_url($path = '')
  {
    return base_url('assets/vendor/argon/' . $path);
  }
}