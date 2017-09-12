<?php

require_once(BASE_LIB_FOLDER . 'helpers/encryption.php');

function arrayTrim(&$value) {
  if (is_string($value)) {
    $value = trim($value);
  } else if (is_array($value)) {
    $value = filter_var_array($value, FILTER_SANITIZE_STRING);
  }
}

function emailShareURL($path) {
  return 'mailto:?subject=' . EMAIL_SHARE_SUBJECT . '&amp;body=Compartir ' . rawurlencode($path);
}

function facebookShareURL($path, $redirect = null) {
  if (empty($redirect)) { $redirect = $path; }

  $url = 'https://www.facebook.com/dialog/share?app_id=' . FACEBOOK_APP_ID . '&amp;display=popup&amp;href=' . rawurlencode($path) . '&amp;redirect_uri=' . rawurlencode($redirect);
  return "window.open('$url','fb-share','height=400,width=600');return false;";
}

function faIcon($icon) {
  return "<i class=\"fa fa-$icon\"></i>";
}

function faIconGreen($icon) {
  return "<i class=\"fa fa-$icon font-green-sharp\"></i>";
}

function faIconRed($icon) {
  return "<i class=\"fa fa-$icon font-red-sunglo\"></i>";
}

function isFalsey($value) {
  if (is_bool($value)) return $value;
  if (is_numeric($value) && ($value === 0 || $value === '0')) return true;
  if (is_string($value) && (strtolower($value) === 'f' || strtolower($value) === 'n')) return true;

  return false;
}

function isTruthy($value) {
  if (is_bool($value)) return $value;
  if (is_numeric($value) && ($value === 1 || $value === '1')) return true;
  if (is_string($value) && (strtolower($value) === 't' || strtolower($value) === 'y')) return true;

  return false;
}

function metaTagsBuilder($title = '', $description = '', $keywords = []) {
  global $BASE;

  $meta = [
    'description' => $description,
    'title' => $title . ' - ' . $BASE->Config('site_name'),
    'keywords' => join(',', explode(' ', $title)) . ',' . $BASE->Config('site_name')
  ];
  return $meta;
}

function moduleFromController($controller) {
  $modules = explode('/', $controller);
  array_pop($modules);
  return join('/', $modules);
}

function textTrim($input, $length, $ellipses = true, $strip_html = true) {
  if ($strip_html) {
    if (!is_string($strip_html)) { $strip_html = ''; }
  	$input = strip_tags($input, $strip_html);
  }

  if (strlen($input) <= $length) {
  	return $input;
  }

  $last_space = strrpos(substr($input, 0, $length), ' ');
  $trimmed_text = substr($input, 0, $last_space);

  if ($ellipses) {
  	$trimmed_text .= '...';
  }

  return $trimmed_text;
}

function wordTrim($input, $length, $ellipses = true, $strip_html = true) {
  if ($strip_html) {
    if (!is_string($strip_html)) { $strip_html = ''; }
    $input = strip_tags($input, $strip_html);
  }

  if (strlen($input) <= $length) {
    return $input;
  }

  $trimmed_text = substr($input, 0, $length);

  if ($ellipses) {
    $trimmed_text .= '...';
  }

  return $trimmed_text;
}

function twitterShareURL($path, $title = '') {
  $url = 'https://twitter.com/share?via=' . TWITTER_USERNAME . '&amp;url=' . rawurlencode($path) . '&amp;text=' . rawurlencode($title);
  return "window.open('$url','tw-share','height=400,width=600');return false;";
}

function sanitizeEmailParam($param='') {
  return trim(mb_strtolower($param, 'UTF-8'));
}

function sanitizeNumberParam($param='') {
  return mb_ereg_replace('[^\d]', '', $param);
}

function sanitizeParam($param='') {
  return trim($param);
}

function breadcrumbItem($title = '', $link = '') {
  return [$title, $link];
}

function sidebarItem($title = '', $icon = '', $link = '', $sub_item = null) {
  return [$title, $icon, $link, $sub_item];
}

function xssafe($data,$encoding='UTF-8') {
  return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
}

function xecho($data) {
  echo xssafe($data);
}

?>
