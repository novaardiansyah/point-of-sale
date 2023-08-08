<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  
  public function register($param = [])
  {
    $param = (object) $param;
    $user = $this->db->query("SELECT a.uid FROM users AS a WHERE a.email = ?", [$param->fullname])->row();
    lasq($this->db->last_query(), 1);

    return [
      'status'  => true,
      'message' => 'Register success',
      'data'    => $param,
      'user'    => $user
    ];
  }

  public function signInWithGoogleAccount($param = [])
  {
    $param = (object) $param;
    $now   = getTimestamp();

    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.email = ?", [$param->email])->row();
    lasq($this->db->last_query(), 1);

    if (!empty($user)) {
      // * Login dengan google
      $this->db->update('users', [
        'last_login' => $now,
        'token'      => $param->token,
        'updated_at' => $now,
        'updated_by' => $user->id
      ], ['uid' => $user->uid, 'id' => $user->id]);
      lasq($this->db->last_query(), 2);

      $user->redirectTo = base_url();
      return ['status' => true, 'message' => 'Welcome back ' . $param->displayName, 'data' => $user];
    }
    
    // * Register dengan google
    $param->uid = uuid();

    $send_data = [
      'uid'               => $param->uid ?? null,
      'username'          => explode('@', $param->email)[0] ?? null,
      'email'             => $param->email ?? null,
      'phone'             => $param->phoneNumber ?? null,
      'fullname'          => $param->displayName ?? null,
      'profile_image'     => $param->photoURL ?? null,
      'last_login'        => $now,
      'is_verified_email' => 1,
      'token'             => $param->token ?? null,
      'is_active'         => 1,
      'is_deleted'        => 0
    ];
    $this->db->insert('users', $send_data);
    lasq($this->db->last_query(), 2);

    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.email = ? AND a.uid = ?", [$param->email, $param->uid])->row();
    lasq($this->db->last_query(), 3);

    $this->db->update('users', [
      'created_at' => $now,
      'created_by' => $user->id
    ], ['uid' => $user->uid, 'id' => $user->id]);
    lasq($this->db->last_query(), 2);

    $user->redirectTo = base_url();
    return ['status' => true, 'message' => 'Hi ' . $param->displayName . ', thanks for joining us', 'data' => $user];
  }
}