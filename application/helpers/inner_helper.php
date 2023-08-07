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

if (!function_exists('view'))
{
  function view($view, $data = [])
  {
    $ci = get_instance();
    $content = $ci->load->view($view, $data, TRUE);
    $ci->load->view('main/main/main', ['content' => $content]);
  }
}

if (!function_exists('form_validate'))
{
  function form_validate($rules = [])
  {
    $ci       = get_instance();
    $validate = $ci->form_validation->set_rules($rules);
		
		if ($validate->run() == false) {
			return [
				'status'  => false,
				'message' => 'invalid-form',
				'error'   => $validate->error_array()
			];
		}

    return [
      'status'  => true,
      'message' => 'Success',
      'error'   => null
    ];
  }
}