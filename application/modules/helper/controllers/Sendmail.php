<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendmail extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('sendmail');
  }

  private function welcome_message()
  {
    $sendmail = sendcustom_email([
      'emailTo' => $_ENV['EMAIL_RECEIVER'],
      'type'    => 'welcome_message',
      'data' => [
        'uid'      => uuid(),
        'fullname' => 'Nova Ardiansyah',
        'username' => 'novaardiansyah78',
        'password' => '123456'
      ]
    ], true);

    json($sendmail);
  }
}
