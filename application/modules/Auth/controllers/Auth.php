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
    $this->load->view('auth/auth/login');
  }

  public function signup()
  {
    $data = [
      'script' => [
        assets_url('js/auth/signup.js')
      ]
    ];

    $this->load->view('auth/auth/signup', $data);
  }

  public function register()
  {
    $validate = form_validate($this->_register());

    if ($validate['status'] == false) return json($validate);

    $send = [
      'fullname'         => post('fullname'),
      'email'            => post('email'),
      'password'         => post('password'),
      'confirm_password' => post('confirm_password')
    ];

    $result = $this->Auth->register($send);
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
    trace($result, 2);

    if ($result['status'] == true) {
      $data = (object) $result['data'];
      if (isset($data->isNewUser) && $data->isNewUser) {
        $sendmail = sendcustom_email([
          'emailTo' => $data->email,
          'type'    => 'welcome_message',
          'data' => [
            'uid'      => $data->uid,
            'fullname' => textCapitalize($data->fullname),
            'username' => $data->username,
            'password' => $data->default_password
          ]
        ], true);
        trace($sendmail, 1);
      }
    }

    json($result);
  }
}