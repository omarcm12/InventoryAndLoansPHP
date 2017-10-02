<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

require_once(BASE_LIB_FOLDER . 'vendor/inflector.php');
require_once(BASE_LIB_FOLDER . 'vendor/password.php');
require_once(BASE_LIB_FOLDER . 'vendor/normalizer.php');
require_once(BASE_LIB_FOLDER . 'helpers/site.php');
require_once(BASE_LIB_FOLDER . 'db.php');
require_once(BASE_LIB_FOLDER . 'model.php');
require_once(BASE_LIB_FOLDER . 'request.php');
require_once(BASE_LIB_FOLDER . 'response.php');
require_once(BASE_LIB_FOLDER . 'session.php');
require_once(BASE_LIB_FOLDER . 'upload.php');
require_once(BASE_LIB_FOLDER . 'user_session.php');

require_once(BASE_MODELS_FOLDER . 'user.php');
require_once(BASE_MODELS_FOLDER . 'material.php');

class BaseCMS {
  private $config;
  private $admin;
  private $db;
  private $db_config;
  private $db_type;
  private $purifier;
  private $request;
  private $response;
  private $session;
  private $upload;
  private $user_session;
  private $tz_offset;

  public function __construct($config, $routes) {
    $this->applyDefaults($config);

    $this->checkRequiredFeatures();
    
    $this->request = new Request($routes);
    $this->session = new Session($this->Config('session'));
    $this->upload = new Upload();
    $this->user_session = new UserSession($this->Config('user_session'));

    $this->checkOptionalFeatures();
  }

  private function applyDefaults($config) {
    
    $defaults = [
      'db_auth' => '',
      'db_host' => '',
      'db_user' => '',
      'db_pass' => '',
      'db_name' => '',
      'domain'  => '',
      'env'     => 'debug',
      'locale'  => 'en_US',
      'section' => 'site',
      'session' => '_base_cms',
      'user_session' => '_user_base_cms',
      'site_name' => 'BaseCMS',
      'timezone' => 'America/Los_Angeles'
    ];

    $this->config = array_merge($defaults, $config);

    $this->setLocale($this->Config('locale'));
    
    if ($this->IsAdmin()) {
      require_once(BASE_LIB_FOLDER . 'helpers/admin.php');
      $this->admin = new AdminHelpers();
    }

    if ($this->IsProduction()) {
      error_reporting(0);
      ini_set('display_errors', 0);
    } else {
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
    }

    define('BASE_SECTION_TEMPLATES_FOLDER', BASE_INSTALL_FOLDER . '/' . $this->Section() . '/templates/');
    define('BASE_SECTION_CONTROLLERS_FOLDER', BASE_INSTALL_FOLDER . '/' . $this->Section() . '/controllers/');
  }

  public function Admin() {
    return $this->admin;
  }

  public function Config($key, $auth = '') {
    if (!array_key_exists($key, $this->config)) { return null; }
    return empty($auth) ? $this->config[$key] : EncryptionHelper::Decrypt($this->config[$key], getenv('BASE_CONFIG_KEY'), $auth);
  }

  public function Connect() {
    $this->db = null;

    $db_auth = $this->Config('db_auth');
    $db_host = $this->Config('db_host', $db_auth);
    $db_name = $this->Config('db_name', $db_auth);
    $db_user = $this->Config('db_user', $db_auth);
    $db_pass = $this->Config('db_pass', $db_auth);

    if (empty($db_host) || empty($db_name) || empty($db_user)) {
      return false;
    }

    $this->db = $this->DBConfig()->Connect($db_host, $db_name, $db_user, $db_pass);

    return !is_null($this->db);
  }

  public function Close() {
    $this->DBConfig()->Close();
    $this->db = null;
  }

  public function Controller() {
    $controller = $this->ControllerName();    
    if (empty($controller)) {
      $this->Response()->ExitWithNotFound('Not Found', 'Page not Found: ' . $this->request->Path());
    }

    $path = BASE_SECTION_CONTROLLERS_FOLDER . $controller . '.php';
    if (!file_exists($path)) {
      $this->Response()->ExitWithError('Controller Missing', 'Missing controller: ' . $controller);
    }

    return $path;
  }

  public function ControllerMatches($controller) {
    return $this->ControllerName() === $controller;
  }

  public function ControllerName() {
    return $this->request->ControllerName();
  }

  public function DB() {
    return $this->db;
  }

  public function DBConfig() {
    if (empty($this->db_config)) {
      $this->db_config = new DBConfig($this->Config('timezone'));
    }
    return $this->db_config;
  }

  public function GetParam($param) {
    $params = $this->request->GetParams();
    return array_key_exists($param, $params) ? $params[$param] : null;
  }

  public function IsAdmin() {
    return $this->Config('section') === 'admin';
  }

  public function IsDebug() {
    return $this->Config('env') === 'debug';
  }

  public function IsProduction() {
    return $this->Config('env') === 'production';
  }

  public function ModuleName() {
    return moduleFromController($this->ControllerName());
  }

  public function ModuleMatches($controller) {
    return $this->ModuleName() === moduleFromController($controller);
  }

  public function PagePath($pages = []) {
    return (is_array($pages)) ? '/' . join('/', $pages) : $pages;
  }

  public function PageURL($pages = []) {
    return $this->request->Scheme() . '://' . $this->request->Host() . $this->PagePath($pages);
  }

  public function PostParam($param) {
    $params = $this->request->PostParams();
    return array_key_exists($param, $params) ? $params[$param] : null;
  }

  public function Purifier() {
    if (empty($this->purifier)) {
      require_once(BASE_LIB_FOLDER . 'vendor/HTMLPurifier/HTMLPurifier.standalone.php');
      $config = HTMLPurifier_Config::createDefault();
      $config->set('HTML.DefinitionID', 'BaseCMS');
      $config->set('HTML.DefinitionRev', 1);
      if ($def = $config->maybeGetRawHTMLDefinition()) {
        $def->addAttribute('a', 'target', 'Enum#_blank,_self,_target,_top');
        $def->addAttribute('a', 'rel', 'Enum#nofollow');
      }
      $this->purifier = new HTMLPurifier($config);
    }
    return $this->purifier;
  }

  public function Request() {
    return $this->request;
  }

  public function Response() {
    if (empty($this->response)) {
      $this->response = new Response();
    }

    return $this->response;
  }

  public function RouteParam($param) {
    $params = $this->request->RouteParams();
    return array_key_exists($param, $params) ? $params[$param] : null;;
  }

  public function Section() {
    return $this->Config('section');
  }

  public function Session() {
    return $this->session;
  }

  public function Upload() {
    return $this->upload;
  }

  public function UserSession() {
    return $this->user_session;
  }

  public function SessionParam($param) {
    return $this->session->SessionParam($param);
  }

  public function SetSessionParam($param, $value) {
    $this->session->SetSessionParam($param, $value);
  }

  public function Template($template = '') {
    if (empty($template)) { $template = $this->ControllerName(); }    
    return $this->Response()->Template($template);
  }

  public function URL($query = null) {
    return $this->request->URL($query);
  }

  private function checkOptionalFeatures() {
    if ($this->IsAdmin()) {
      if (!BASE_INTL_AVAILABLE) {
        $flash = $this->session->Flash();
        if (!is_array($flash)) { $flash = []; }

        $flash = array_merge([
          'warning' => 'Internationalization support unavailable. Verify PHP module <strong>intl</strong>.'
        ], $flash);
        $this->session->SetFlash($flash);
      }

      if (!$this->request->HostMatches($this->Config('domain'))) {
        $flash = $this->session->Flash();
        if (!is_array($flash)) { $flash = []; }

        $flash = array_merge([
          'warning' => 'Domain configuration mismatch.<br>Config: <strong>' . $this->Config('domain') . '</strong><br>Host: <strong>' . $this->request->Host() . '</strong>'
        ], $flash);
        $this->session->SetFlash($flash);
      }
    }
  }

  private function checkRequiredFeatures() {
    if (!BASE_MB_AVAILABLE) {
      $this->Response()->ExitWithError('Multibyte Extension Unavailable', 'Multibyte string support for PHP is required.');
    }
    if (!BASE_MOD_REWRITE_AVAILABLE) {
      $this->Response()->ExitWithError('Apache Module mod_rewrite Unavailable', 'Apache mod_rewrite support is required.');
    }
    if (!BASE_PDO_AVAILABLE) {
      $this->Response()->ExitWithError('PDO Extension Unavailable', 'Ensure that the PDO extension for PHP is enabled.');
    }
  }

  private function setLocale($locale = null) {
    if (is_null($locale)) {
      $locale = $this->Config('locale');
    }

    list($lang, $region) = explode('_', $locale);

    // if (setlocale(LC_TIME, "$locale.UTF8", "$lang.UTF8", "$locale.UTF-8", "$lang.UTF-8") === FALSE) {
    //   $this->Response()->ExitWithError('Locale Unavailable', 'Locale <strong>' . $locale . '</strong> is unsupported.');
    // }

    if (function_exists('locale_set_default')) {
      locale_set_default("$lang-$region");
    }
  }

  public function setRoutes($routes){
    $this->request = new Request($routes);
  }
}

?>
