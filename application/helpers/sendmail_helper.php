<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('sendcustom_email'))
{
  function sendcustom_email($data = [], $toObject = false)
  {
    $ci = get_instance();
    
    if (is_array($data) && $toObject) {
      $data = (object) $data;
    }

    $emailTo = $toObject ? $data->emailTo : $data['emailTo'];
    $emailTo = trim(textLowercase($emailTo));

    $type = $toObject ? $data->type : $data['type'];
    $type = trim(textLowercase($type));

    $config = [
      'protocol'    => 'smtp',
      'smtp_host'   => $_ENV['SMTP_HOST'],
      'smtp_user'   => $_ENV['SMTP_USER'],
      'smtp_pass'   => $_ENV['SMTP_PASS'],
      'smtp_port'   => $_ENV['SMTP_PORT'] ?? 587,
      'smtp_crypto' => $_ENV['SMTP_CRYPTO'] ?? 'tls',
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
      case 'signup_message':
        $message = $ci->load->view('helper/sendmail/signup_message', $data->data, true);

        $ci->email->subject($_ENV['APP_NAME'] . ' - Your Account Has Been Created');
        $ci->email->message($message);
        break;
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