<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendmail extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('sendmail');
  }

  private function signup_message()
  {
    $sendmail = sendcustom_email([
      'emailTo' => $_ENV['EMAIL_RECEIVER'],
      'type'    => 'signup_message',
      'data' => [
        'uid'      => uuid(),
        'fullname' => 'Nova Ardiansyah',
        'username' => 'A736EAED',
        'email'    => $_ENV['EMAIL_RECEIVER'],
        'password' => '123456'
      ]
    ], true);
    trace($sendmail, 1);

    json($sendmail);
  }
}
