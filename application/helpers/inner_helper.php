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

if (!function_exists('logs'))
{
  function logs($data = [], $name = '1', $type_id = 1)
  {
    $ci = get_instance();
    $ci->load->library('user_agent');

    if (!$_ENV['DB_WRITE_LOGS']) return false;
    $max_length = 1000;

    if (is_array($data) || is_object($data)) $data = json_encode($data);
    if (strlen($data) > $max_length) $data = substr($data, 0, $max_length);

    $send = [
      'uid'             => uuid(),
      'name'            => $name,
      'ip_address'      => $ci->input->ip_address(),
      'user_agent'      => $ci->input->user_agent(),
      'platform'        => $ci->agent->platform(),
      'browser'         => $ci->agent->browser(),
      'browser_version' => $ci->agent->version(),
      'type_id'         => $type_id,
      'description'     => $data
    ];

    return $ci->db->insert('logs', $send);
  }
}