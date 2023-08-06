<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('sendcustom_email'))
{
  function sendcustom_email($data = [])
  {
    $ci = get_instance();

    if (!is_array($data['emailTo'])) {
      $emailTo = trim(textLowercase($data['emailTo']));
    } else {
      $emailTo = $data['emailTo'];
    }

    $type = trim(textLowercase($data['type']));

    $config = [
      'protocol'    => 'smtp',
      'smtp_host'   => $_ENV['SMTP_HOST'],
      'smtp_user'   => $_ENV['SMTP_USER'],
      'smtp_pass'   => $_ENV['SMTP_PASS'],
      'smtp_port'   => $_ENV['SMTP_PORT'],
      'smtp_crypto' => 'tls',
      'mailtype'    => 'html',
      'charset'     => 'utf-8',
      'crlf'        => "\r\n",
      'newline'     => "\r\n",
    ];

    $ci->load->library('email', $config);

    $ci->email->clear();
    $ci->email->from($config['smtp_user'], 'Nova Ardiansyah');
    $ci->email->to($emailTo);

    /**
     * ! Email content manager (Start)
     */
    switch ($type) {
      default:
        $message = 'Email Delivery Test';

        $ci->email->subject('Email Delivery Test');
        $ci->email->message($message);
        break;
    }
    // ! Email content manager (End)

    // ! Response (Start)
    if ($ci->email->send()) {
      $response = [
        'status'  => true,
        'message' => 'Email successfully sent to ' . $emailTo . '.',
        'data' => [
          'sender'  => $config['smtp_user'],
          'emailTo' => $emailTo,
          'type'    => $type,
          'error'   => null
        ]
      ];

      return $response;
    } else {
      $response = [
        'status'  => false,
        'message' => 'Email failed to send to ' . $emailTo . '.',
        'data'    => [
          'sender'  => $config['smtp_user'],
          'emailTo' => $emailTo,
          'type'    => $type,
          'error'   => $ci->email->print_debugger()
        ]
      ];

      return $response;
    }
    // ! Response (End)

    return false;
  }
}