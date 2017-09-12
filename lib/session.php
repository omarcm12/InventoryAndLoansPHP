<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class Session {
  private $session_name;
  private $session_user;

  public function __construct($session) {
    if (empty($session)) {
      $session = '_base_cms';
    }
    $this->session_name = $session;

    $this->Start();
  }

  public function Close() {
    session_commit();
  }

  public function CurrentAuthor() {
    if (is_null($this->session_user)) {
      $aid = $this->SessionParam('aid');
      if (is_null($aid)) {
        $this->session_user = 0;
      } else {
        $this->session_user = FetchUserWithID($aid);
        if (is_null($this->session_user)) { $this->session_user = 0; }
      }
    }
    if ($this->session_user === 0) { return null; }    
    return $this->session_user;
  }

  public function Flash($keep = false) {
    $flash = $this->SessionParam('_flash');
    if (!$keep) { $this->SetSessionParam('_flash', null); }

    return $flash;
  }

  public function LogIn($user) {
    $this->session_user = $user;
    $this->SetSessionParam('aid', $user->ID());
  }

  public function LoggedIn() {
    return !!$this->CurrentAuthor();
  }

  public function LoggedOut() {
    return !$this->LoggedIn();
  }

  public function Reset() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );
    }
    session_destroy();
  }

  public function SessionParam($param) {
    return array_key_exists($param, $_SESSION) ? $_SESSION[$param] : null;
  }

  public function SetFlash($value) {
    $this->SetSessionParam('_flash', $value);
  }

  public function SetSessionParam($param, $value) {
    if ($value === null) {
      unset($_SESSION[$param]);
    } else {
      $_SESSION[$param] = $value;
    }
  }

  public function Start() {
    session_name($this->session_name);
    session_start();
  }
}

?>
