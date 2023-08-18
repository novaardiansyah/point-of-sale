<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Auth', 'Auth');
  }

  public function index()
  {
    logs(['referrer' => base_url('auth')], null, 4);

    $session = (object) get_session('login'); 
    if (isset($session->uid)) return redirect(base_url());

    $data = [
      'script' => [
        assets_url('js/auth/login.js')
      ]
    ];

    $this->load->view('auth/auth/login', $data);
  }

  public function login()
  {
    return redirect(base_url('auth'));
  }

  public function signin()
  {
    $validate = form_validate($this->_signin());

    if ($validate['status'] == false) return json($validate);

    $send = [
      'username_or_email' => post('username_or_email'),
      'password'          => post('password')
    ];

    $result = (object) $this->Auth->signin($send);

    if ($result->status) {
      $this->_login_success($result->data);
    }

    json($result);
  }

  private function _login_success($data = [])
  {
    if (is_array($data)) $data = (object) $data;

    $session = [
      'login' => [
        'id'                => base64_encode($data->id),
        'uid'               => $data->uid,
        'username'          => $data->username,
        'email'             => $data->email,
        'phone'             => $data->phone,
        'fullname'          => $data->fullname,
        'profile_image'     => $data->profile_image,
        'is_verified_email' => $data->is_verified_email,
        'last_login'        => $data->last_login,
        'token'             => $data->token
      ]
    ];

    set_session($session);
  }

  private function _signin()
  {
    $rules = [
			['field' => 'username_or_email', 'label' => 'Username or Email', 'rules' => 'trim|required'],
      ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'],
		];

    return $rules;
  }

  public function signup()
  {
    logs(['referrer' => base_url('auth/signup')], null, 4);

    $session = (object) get_session('login'); 
    if (isset($session->uid)) return redirect(base_url());
    
    $data = [
      'script' => [
        assets_url('js/auth/signup.js')
      ]
    ];

    $this->load->view('auth/auth/signup', $data);
  }

  public function register()
  {
    $this->load->helper('sendmail');
    $validate = form_validate($this->_register());

    if ($validate['status'] == false) return json($validate);

    $send = [
      'fullname'         => post('fullname'),
      'email'            => post('email'),
      'password'         => post('password'),
      'confirm_password' => post('confirm_password')
    ];

    $result = $this->Auth->register($send);
    trace($result, 1);

    if ($result['status'] == true) {
      $data = (object) $result['data'];
      
      $sendmail = sendcustom_email([
        'emailTo' => $data->email,
        'type'    => 'signup_message',
        'data' => [
          'uid'      => $data->uid,
          'fullname' => textCapitalize($data->fullname),
          'username' => textUppercase($data->username),
          'email'    => $data->email,
          'password' => $data->default_password ?? 'very_secret'
        ]
      ], true);
      trace($sendmail, 2);
    }

    json($result);
  }

  private function _register()
  {
    $rules = [
			['field' => 'fullname', 'label' => 'Fullname', 'rules' => 'trim|required'],
      ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'],
      ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]'],
      ['field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[password]']
		];

    return $rules;
  }

  public function signInWithGoogleAccount()
  {
    $this->load->helper('sendmail');

    $send = [
      'token'          => post('token'),
      'email'          => post('email'),
      'emailVerified'  => post('emailVerified'),
      'isAnonymous'    => post('isAnonymous'),
      'displayName'    => post('displayName'),
      'photoURL'       => post('photoURL'),
      'phoneNumber'    => post('phoneNumber'),
      'lastLoginAt'    => post('lastLoginAt'),
      'lastSignInTime' => post('lastSignInTime')
    ];
      
    $result = $this->Auth->signInWithGoogleAccount($send);
    trace($result, 1);

    if ($result['status'] == true) {
      $data = (object) $result['data'];
      $this->_login_success($data);

      if (isset($data->isNewUser) && $data->isNewUser) {
        $sendmail = sendcustom_email([
          'emailTo' => $data->email,
          'type'    => 'signup_message',
          'data' => [
            'uid'      => $data->uid,
            'fullname' => textCapitalize($data->fullname),
            'username' => textUppercase($data->username),
            'email'    => $data->email,
            'password' => $data->default_password ?? 'very_secret'
          ]
        ], true);
        trace($sendmail, 2);
      }
    }

    json($result);
  }

  public function logout()
  {
    return logout();
  }
}