<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../boot.php');
require_once(BASE_INSTALL_FOLDER . 'site.php');

$routes = [  
  'GET:/' => 'index/index',
  'GET:/menu' => 'index/menu',
  'GET:/inventario' => 'stock/index',
  'GET:/inventario/nuevo' => 'stock/new',
  'GET:/inventario/buscar' => 'stock/search',
  'GET:/inventario/movimientos' => 'stock/indexMovs',
  'POST:/inventario' => 'stock/create',
  'GET:/inventario/(\d+)' => 'stock/edit',
  'POST:/inventario/(\d+)' => 'stock/update',
  'POST:/inventario/borrar/(\d+)' => 'stock/delete',
  'POST:/login' => 'index/login',
];

$BASE = new BaseCMS($config, $routes);

if (!$BASE->Connect()) {
  $BASE->Response()->ExitWithError('Error Connecting to DB', 'Verify configuration.');
}

require_once($BASE->Controller());

?>
