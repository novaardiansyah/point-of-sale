<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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