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
    $now   = getTimestamp();

    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.password, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.email = ?", [$param->email])->row();
    lasq($this->db->last_query(), 1);

    if (!empty($user)) return ['status' => false, 'message' => 'Your email is already registered'];

    $param->uid      = uuid();
    $param->username = $this->generate_username();

    $send_data = [
      'uid'               => $param->uid ?? null,
      'username'          => textUppercase($param->username) ?? null,
      'email'             => textLowercase($param->email) ?? null,
      'phone'             => $param->phone ?? null,
      'fullname'          => textLowercase($param->fullname) ?? null,
      'profile_image'     => $param->profile_image ?? null,
      'last_login'        => $now,
      'is_verified_email' => $param->is_verified_email ?? 0,
      'password'          => hash_password($param->password),
      'token'             => base64_encode($param->uid . '-' . $param->email . '-' . $now),
      'is_active'         => 1,
      'is_deleted'        => 0
    ];

    $this->db->insert('users', $send_data);
    lasq($this->db->last_query(), 2);

    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.email = ? AND a.uid = ?", [$param->email, $param->uid])->row();

    $this->db->update('users', [
      'created_at' => $now,
      'created_by' => $user->id
    ], ['uid' => $user->uid, 'id' => $user->id]);
    lasq($this->db->last_query(), 3);

    $user->redirectTo       = base_url();
    $user->default_password = $param->password;
    $user->isNewUser        = true;
    unset($user->id);

    return ['status' => true, 'message' => 'Hi ' . $param->fullname . ', thanks for joining us', 'data' => $user];
  }

  public function generate_username($username = null, $attempt = 0)
  {
    if ($attempt > 3) return $username;
    if (empty($email)) $username = substr(uuid(), 0, 4) . substr(uuid(), 0, 4);

    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.password, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.username = ?", [$username])->row();

    if (!empty($user)) {
      $username = $username . '-' . substr(uuid(), 0, 3) . substr(uuid(), 0, 3);
      return $this->generate_username($username, $attempt + 1);
    }

    return $username;
  }

  public function signin($param = [])
  {
    $param = (object) $param;
    $now   = getTimestamp();

    $email    = strpos($param->username_or_email, '@') !== false ? $param->username_or_email : null;
    $username = strpos($param->username_or_email, '@') === false ? $param->username_or_email : null;
    
    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.password, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.email = ? OR a.username = ?", [$email, $username])->row();
    lasq($this->db->last_query(), 1);

    if (empty($user)) return ['status' => false, 'message' => 'Username/email or password is wrong'];

    if (!verify_password($param->password, $user->password)) return ['status' => false, 'message' => 'Username/email or password is wrong'];

    if ($user->is_active == 0) return ['status' => false, 'message' => 'Your account is not active'];
    if ($user->is_deleted == 1) return ['status' => false, 'message' => 'Your account is deleted'];

    $this->db->update('users', [
      'last_login' => $now,
      'token'      => base64_encode($user->uid . '-' . $user->email . '-' . $now),
      'updated_at' => $now,
      'updated_by' => $user->id
    ], ['uid' => $user->uid, 'id' => $user->id]);
    lasq($this->db->last_query(), 2);

    unset($user->password);
    unset($user->id);
    $user->redirectTo = base_url();

    return ['status' => true, 'message' => 'Welcome back ' . $user->fullname, 'data' => $user];
  }

  public function signInWithGoogleAccount($param = [])
  {
    $param = (object) $param;
    $now   = getTimestamp();

    $user = $this->db->query("SELECT a.id, a.uid, a.username, a.email, a.phone, a.fullname, a.profile_image, a.last_login, a.is_verified_email, a.token, a.is_active, a.is_deleted, a.created_at, a.created_by FROM users AS a WHERE a.email = ?", [$param->email])->row();
    lasq($this->db->last_query(), 1);

    if (empty($user)) {
      // * Register dengan google
      $param->uid = uuid();
      $send = [
        'fullname'          => $param->displayName,
        'email'             => $param->email,
        'password'          => textUppercase(substr(uuid(), 0, 6)),
        'is_verified_email' => 1,
        'phone'             => $param->phoneNumber,
        'profile_image'     => $param->photoURL
      ];
      $register = $this->register($send);
      return $register;
    }
    
    // * Login dengan google
    $this->db->update('users', [
      'last_login' => $now,
      'token'      => base64_encode($user->uid . '-' . $user->email . '-' . $now),
      'updated_at' => $now,
      'updated_by' => $user->id
    ], ['uid' => $user->uid, 'id' => $user->id]);
    lasq($this->db->last_query(), 2);

    $user->redirectTo = base_url();
    unset($user->id);

    return ['status' => true, 'message' => 'Welcome back ' . $param->displayName, 'data' => $user];
  }
}