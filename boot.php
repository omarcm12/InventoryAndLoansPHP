<?php

define('BASE_VERSION', '1.0');

define('BASE_INSTALL_FOLDER', str_replace(basename(__FILE__), '', __FILE__));
define('BASE_LIB_FOLDER', BASE_INSTALL_FOLDER . 'lib/');
define('BASE_WWW_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/');

define('BASE_MODELS_FOLDER', BASE_LIB_FOLDER . 'models/');
define('BASE_PERMISSIONS_FOLDER', BASE_LIB_FOLDER . 'permissions/');
define('BASE_TEMPLATES_FOLDER', BASE_INSTALL_FOLDER . 'site/templates/');

define('BASE_UPLOADS_FOLDER', BASE_WWW_FOLDER . 'uploads/');
define('BASE_PRIVATE_UPLOADS_FOLDER', BASE_INSTALL_FOLDER . 'uploads/');
define('BASE_UPLOADS_FOLDER_PERMISSION', 0775); // 750
define('BASE_UPLOADS_IMAGE_PERMISSION', 0664); // 640

define('BASE_ASSETS_PATH', '/assets/');
define('BASE_CSS_ASSETS_PATH', BASE_ASSETS_PATH . 'css/');
define('BASE_IMAGE_ASSETS_PATH', BASE_ASSETS_PATH . 'imgs/');
define('BASE_JS_ASSETS_PATH', BASE_ASSETS_PATH . 'js/');
define('BASE_PLUGIN_ASSETS_PATH', BASE_ASSETS_PATH . 'plugins/');
define('BASE_THEMES_ASSETS_PATH', BASE_ASSETS_PATH . 'themes/');

define('BASE_ASSETS_MICARTERA_PATH', '/articulos/');
define('BASE_WPCONTENT_ASSETS_PATH', BASE_ASSETS_MICARTERA_PATH . 'wp-content');
define('BASE_WIDGETSINFO_ASSETS_PATH', '/widgets-info/');

define('BASE_UPLOADS_PATH', '/uploads/');
define('BASE_PRIVATE_UPLOADS_PATH', '/admin/uploads/');

define('BASE_ADMIN_ASSETS_PATH', '/admin/assets/');
define('BASE_ADMIN_CSS_ASSETS_PATH', BASE_ADMIN_ASSETS_PATH . 'css/');
define('BASE_ADMIN_IMAGE_ASSETS_PATH', BASE_ADMIN_ASSETS_PATH . 'img/');
define('BASE_ADMIN_JS_ASSETS_PATH', BASE_ADMIN_ASSETS_PATH . 'js/');
define('BASE_ADMIN_PLUGIN_ASSETS_PATH', BASE_ADMIN_ASSETS_PATH . 'plugins/');
define('BASE_ADMIN_THEMES_ASSETS_PATH', BASE_ADMIN_ASSETS_PATH . 'themes/');

define('BASE_INTL_AVAILABLE', class_exists("Normalizer", false));
define('BASE_MB_AVAILABLE', function_exists('mb_internal_encoding'));
define('BASE_MOD_REWRITE_AVAILABLE', array_key_exists('HTTP_MOD_REWRITE', $_SERVER));
define('BASE_PDO_AVAILABLE', class_exists('PDO', false));

ini_set('default_charset', 'UTF-8');
if (BASE_MB_AVAILABLE) {
  mb_internal_encoding('UTF-8');
  mb_regex_encoding('UTF-8');
}

require_once(BASE_LIB_FOLDER . 'base.php');

?>
