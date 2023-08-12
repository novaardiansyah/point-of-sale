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

if (!function_exists('adminlte_url'))
{
  function adminlte_url($path = '')
  {
    return base_url('assets/vendor/adminlte/' . $path);
  }
}

if (!function_exists('view'))
{
  function view($view, $data = [])
  {
    $ci = get_instance();
    $content = $ci->load->view($view, $data, TRUE);
    $ci->load->view('main/main', ['content' => $content]);
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

if (!function_exists('auth'))
{
  function auth()
  {
    $ci = get_instance();
    
    $session = (object) get_session('login'); 
    trace($session, 'auth() - session');
    if (empty($session)) return ['status' => false, 'message' => 'You are not logged in'];

    $user = $ci->db->query("SELECT a.id, a.uid, a.username, a.email, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.uid = ? AND a.email = ?", [$session->uid, $session->email])->row();
    lasq($ci->db->last_query(), 1);
    trace($user, 'auth() - user');

    if (empty($user)) {
      trace($session, 'auth() - empty');
      return ['status' => false, 'message' => 'Your session is incorrect, please re-login for fix this issue (e01).'];
    }

    if ($user->is_active == 0) {
      trace($session, 'auth() - not-active');
      return ['status' => false, 'message' => 'Your account is not active'];
    }

    if ($user->is_deleted == 1) {
      trace($session, 'auth() - deleted');
      return ['status' => false, 'message' => 'Your account is deleted'];
    }
    
    if ($user->token !== $session->token) {
      trace($session, 'auth() - invalid-token');
      return ['status' => false, 'message' => 'Your session is incorrect, please re-login for fix this issue (e02).'];
    }

    return ['status' => true, 'message' => 'You are securely logged in'];
  }
}

if (!function_exists('secure_access'))
{
  function secure_access($redirect = 'auth')
  {
    $auth = (object) auth();
    if (!$auth->status) return logout($redirect);
    return true;
  } 
}

if (!function_exists('logout'))
{
  function logout($redirect = 'auth')
  {
    $ci = get_instance();
    unset_session(['login']);
    $ci->session->sess_destroy();
    return redirect(base_url($redirect));
  } 
}

if (!function_exists('isActiveMenu'))
{
  function isActiveMenu($menu = '')
  {
    $ci = get_instance();

    $menu_length = count(explode('/', $menu));
    
    $segment = '';
    for ($i = 1; $i <= $menu_length; $i++) {
      $segment .= $ci->uri->segment($i) . '/';
    }
    $segment = rtrim($segment, '/');
    
    if ($segment == $menu) return 'active';
    return '';
  } 
}