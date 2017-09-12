<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

define('BASE_RESPONSE_OK', 200);

define('BASE_RESPONSE_REDIRECT_MOVED', 301);
define('BASE_RESPONSE_REDIRECT_FOUND', 302);
define('BASE_RESPONSE_REDIRECT_OTHER', 303);

define('BASE_RESPONSE_BAD_REQUEST', 400);
define('BASE_RESPONSE_NOT_FOUND', 404);

define('BASE_RESPONSE_ERROR', 500);

class Response {

  public function ExitWithError($message, $detail, $code = BASE_RESPONSE_ERROR) {
    $vars = [
      'code' => $code,
      'message' => $message,
      'detail' => $detail
    ];
    $this->Render($this->Template("errors/$code"), $vars, $code);
    exit();
  }

  public function ExitWithNotFound($message, $detail) {
    $this->ExitWithError($message, $detail, BASE_RESPONSE_NOT_FOUND);
  }

  public function RedirectAndExit($location, $type = BASE_RESPONSE_REDIRECT_FOUND) {
    global $BASE;

    $BASE->Session()->Close();
    if ($type !== BASE_RESPONSE_REDIRECT_FOUND) {
      $this->setHTTPHeader($type);
    }
    header('Location: ' . $location);
    exit();
  }

  public function Redirect($location, $type = BASE_RESPONSE_REDIRECT_FOUND) {
    if ($type !== BASE_RESPONSE_REDIRECT_FOUND) {
      $this->setHTTPHeader($type);
    }
    header('Location: ' . $location);
    exit();
  }

  public function Render($_template, $_vars = [], $_code = BASE_RESPONSE_OK) {
    global $BASE;

    $protected_keys = ['_template', '_vars', '_code'];
    foreach ($_vars as $key => $value) {
      if (array_search($key, $protected_keys) !== false) { continue; }

      $$key = $value;
    }

    $this->setHTTPHeader($_code);
    $this->setHTTPContentType();
    require($_template);
  }

  public function RenderBlockWithKey($block_key, $vars = null) {
    global $BASE;

    $block = FetchBlockWithKey($block_key);
    if (empty($block)) { return ''; }

    if (is_array($vars)) { $block->MergeVars($vars); }

    return $block->Value();
  }

  public function RenderJSON($data, $code = BASE_RESPONSE_OK) {
    $this->setHTTPHeader($code);
    $this->setJSONContentType();

    echo json_encode($data);
  }

  public function RenderText($text, $code = BASE_RESPONSE_OK) {
    $this->setHTTPHeader($code);
    $this->setHTTPContentType();

    echo $text;
  }

  public function RenderXML($xml) {
    $this->setHTTPHeader();
    $this->setXMLContentType();

    echo $xml;
  }

  public function Template($template) {
    
    $path = BASE_SECTION_TEMPLATES_FOLDER . $template . '.php';
    if (empty($template) || !file_exists($path)) {
      $this->ExitWithError('Template Missing', 'Missing template: ' . $template);
    }
    return $path;
  }

  private function setHTTPContentType() {
    header('Content-Type: text/html');
  }

  private function setJSONContentType() {
    header('Content-Type: application/json');
  }

  private function setXMLContentType() {
    header('Content-Type: application/rss+xml; charset=utf-8');
  }

  private function setHTTPHeader($code = BASE_RESPONSE_OK) {
    if ($code == BASE_RESPONSE_OK) { return; }
    $header = null;

    switch ($code) {
      case BASE_RESPONSE_REDIRECT_MOVED:  // 301
        $header = 'Moved Permanently';
        break;
      case BASE_RESPONSE_REDIRECT_FOUND:  // 302;
        $header = 'Found';
        break;
      case BASE_RESPONSE_REDIRECT_OTHER:  // 303
        $header = 'See Other';
        break;
      case BASE_RESPONSE_BAD_REQUEST:     // 400
        $header = 'Bad Request';
        break;
      case BASE_RESPONSE_NOT_FOUND:       // 404
        $header = 'Not Found';
        break;
      case BASE_RESPONSE_ERROR:           // 500
        $header = 'Internal Server Error';
        break;
      default:
        break;
    }
    if (empty($header)) { $this->Response()->ExitWithError('Unknown HTTP Code', 'Code: ' . $code); }

    header("HTTP/1.1 $code $header");
  }

}

?>
