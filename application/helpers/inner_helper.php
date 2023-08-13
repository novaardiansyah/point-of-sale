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

use Jenssegers\Blade\Blade;
if (!function_exists('view'))
{
  // ? dependent > jenssegers/blade: ^1.4 > php: >= 7.0
  function view($view, $data = [])
  {
    $views = VIEWPATH;
    $cache = APPPATH . 'cache';

    $blade = new Blade($views, $cache);
    echo $blade->make($view, $data)->render();
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

if (!function_exists('dataTable'))
{
  function dataTable()
  {
    $draw         = get('draw');
    $start        = get('start');
    $length       = get('length');
    $search       = get('search[value]');
    $order_column = get('order[0][column]');
    $order_dir    = get('order[0][dir]') ?? 'asc';
    $orderable    = array_column(get('columns'), 'orderable');
    $columns      = array_column(get('columns'), 'data');
    $searchable   = array_column(get('columns'), 'searchable');

    $order_dir = textUppercase($order_dir);

    $search_item = array_filter($columns, function ($key) use ($searchable) {
      return $searchable[$key] == 'true';
    }, ARRAY_FILTER_USE_KEY);

    $columns = array_filter($columns, function ($key) use ($orderable) {
      return $orderable[$key] == 'true';
    }, ARRAY_FILTER_USE_KEY);

    $sort_by = null;
    if (!empty($columns[$order_column])) $sort_by = "ORDER BY $columns[$order_column] $order_dir";

    $searchQuery = '';
    if (!empty($search)) {
      $search = str_replace("'", "", $search);

      $searchQuery = "AND (";
      foreach ($search_item as $key => $value) {
        $searchQuery .= "$value LIKE '%$search%' OR ";
      }
      $searchQuery = substr($searchQuery, 0, -4);
      $searchQuery .= ")";
    }

    $send = [
      'draw'          => $draw,
      'start'         => $start,
      'length'        => $length,
      'searchQuery'   => $searchQuery,
      'searchKeyword' => $search,
      'sort_by'       => $sort_by,
      'order_by'      => isset($columns[$order_column]) ? $columns[$order_column] : null,
      'order_dir'     => $order_dir,
    ];

    return $send;
  } 
}

if (!function_exists('dataTableResponse'))
{
  function dataTableResponse($param = [])
  {
    if (empty($param)) return ['status' => false, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => []];
    if (is_array($param)) $param = (object) $param;
    if (is_array($param->request)) $param->request = (object) $param->request;

    $no = $param->request->start;
    foreach ($param->data as $value) {
      $value->no = $no + 1;
      $no++;
    }

    $response = [
      'status'          => (int) $param->total > 0 ? true : false,
      'draw'            => $param->request->draw ?? 0,
      'start'           => $param->request->start ?? 0,
      'length'          => $param->request->length ?? 10,
      'recordsTotal'    => (int) $param->total ?? 0,
      'recordsFiltered' => count($param->data) ?? 0,
      'data'            => $param->data
    ];

    return $response;
  }
}

if (!function_exists('upload_image'))
{
  function upload_image($field_name, $upload_path, $allowed_types = 'jpg|jpeg|png', $max_size = 2048)
  {
    $ci = get_instance();
    
    $path = './assets/img/' . $upload_path . '/';
    if (!is_dir($path)) mkdir($path, 0777, true);

    $config = [
      'upload_path'   => $path,
      'allowed_types' => $allowed_types,
      'max_size'      => $max_size,
      'file_name'     => getTimestamp('now', 'YmdHis')
    ];
    
    $ci->load->library('upload', $config);
    
    if (!$ci->upload->do_upload($field_name)) {
      $error = $ci->upload->display_errors();
      return ['status' => false, 'message' => $error];
    } else {
      $data = $ci->upload->data();
      return ['status' => true, 'file_name' => $data['file_name']];
    }
  }
}

if (!function_exists('remove_image'))
{
  function remove_image($image_name, $path)
  {
    $path = './assets/img/' . $path . '/';
    if (!is_dir($path)) return false;

    $image = $path . $image_name;
    if (file_exists($image)) unlink($image);
    return true;
  }
}