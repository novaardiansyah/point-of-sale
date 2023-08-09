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

    if (!empty($user)) {
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
    
    // * Register dengan google
    $param->uid = uuid();
    $param->default_password = textUppercase(substr($param->uid, 0, 6));

    $send_data = [
      'uid'               => $param->uid ?? null,
      'username'          => explode('@', $param->email)[0] ?? null,
      'email'             => $param->email ?? null,
      'phone'             => $param->phoneNumber ?? null,
      'fullname'          => $param->displayName ?? null,
      'profile_image'     => $param->photoURL ?? null,
      'last_login'        => $now,
      'is_verified_email' => 1,
      'password'          => hash_password($param->default_password),
      'token'             => base64_encode($param->uid . '-' . $param->email . '-' . $now),
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

    $user->redirectTo       = base_url();
    $user->isNewUser        = true;
    $user->default_password = $param->default_password;

    unset($user->id);

    return ['status' => true, 'message' => 'Hi ' . $param->displayName . ', thanks for joining us', 'data' => $user];
  }
}