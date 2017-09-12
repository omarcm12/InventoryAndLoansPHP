<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class Request {
  private $routes;

  private $controller_name;
  private $params;
  private $path;

  public function __construct($routes) {
    $this->params = [];
    $this->routes = [];

    $this->RegisterRoutes($routes);
  }

  public function RegisterRoutes($routes) {
    if (is_null($routes)) {
      $routes = [];
    }

    $this->routes = array_merge($this->routes, $this->parseRoutes($routes));
  }

  public function ControllerName() {
    if (empty($this->controller_name)) {
      $this->setControllerFromRoute();
    }

    return $this->controller_name;
  }

  public function GetParams() {
    if (!array_key_exists('get', $this->params)) {
      $this->params['get'] = $this->filteredGETValues();
    }
    return $this->params['get'];
  }

  public function Host() {
    return $_SERVER['HTTP_HOST'];
  }

  public function HostMatches($match) {
    return mb_strtolower($this->Host()) === mb_strtolower($match);
  }

  public function IsGET() {
    return $this->Method() === 'GET';
  }

  public function IsPOST() {
    return $this->Method() === 'POST';
  }

  public function Method() {
    return $_SERVER['REQUEST_METHOD'];
  }

  // PHP_QUERY_RFC3986 = with%20space
  // PHP_QUERY_RFC1738 = with+space
  public function Path($query = null, $query_enc = PHP_QUERY_RFC3986) {
    if (empty($this->path)) {
      if (array_key_exists('SCRIPT_URL', $_SERVER)) {
        $this->path = $_SERVER['SCRIPT_URL'];
      } else {
        $this->path = explode('?', $_SERVER['REQUEST_URI'])[0];
      }
    }

    if ($query === null) { return $this->path; }

    if ($query === true) { $query = $this->RawQuery(); }
    if (!is_string($query)) { $query = http_build_query($query, $query_enc); }    
    return join('?', [$this->path, $query]);
  }

  public function PostParams() {
    if (!array_key_exists('post', $this->params)) {
      $this->params['post'] = $this->filteredPOSTValues();
    }
    return $this->params['post'];
  }

  public function Query() {
    parse_str($_SERVER['QUERY_STRING'], $output);
    return $output;
  }

  public function RawQuery() {
    return $_SERVER['QUERY_STRING'];
  }

  public function Route() {
    return $this->Method() . ':' . $this->Path();
  }

  public function RouteParams() {
    return $this->params['route'];
  }

  public function Scheme() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  }

  public function URI() {
    return $_SERVER['REQUEST_URI'];
  }

  public function URL($query = null) {
    return $this->Scheme() . '://' . $this->Host() . $this->Path($query);
  }

  private function parseRoutes($new_routes) {
    $routes = [];
    foreach ($new_routes as $path => $controller) {
      $path = str_replace('/', '\/', $path);
      $routes["/\A$path\z/i"] = $controller;
    }
    return $routes;
  }

  private function setControllerFromRoute() {
    $request_route = $this->Route();
    foreach ($this->routes as $route => $controller) {
      if (preg_match($route, $request_route)) {
        preg_match($route, $request_route, $matches);
        array_shift($matches);

        $this->controller_name = $controller;
        $this->params['route'] = $matches;
        break;
      }
    }    
  }

  private function filteredGETValues() {
    array_filter($_GET, 'arrayTrim');
    return filter_var_array($_GET, FILTER_SANITIZE_STRING);
  }

  private function filteredPOSTValues() {
    array_filter($_POST, 'arrayTrim');
    return filter_var_array($_POST, FILTER_SANITIZE_STRING);
  }
}

?>
