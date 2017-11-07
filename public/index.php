<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../boot.php');
require_once(BASE_INSTALL_FOLDER . 'site.php');

$routes = [  
  'GET:/' => 'index/index',
  'GET:/admin' => 'index/menu',
  'GET:/admin/inventario' => 'stock/index',
  'GET:/admin/inventario/nuevo' => 'stock/new',
  'GET:/admin/inventario/buscar' => 'stock/search',
  'GET:/admin/inventario/movimientos' => 'stock/indexMovs',
  'POST:/admin/inventario' => 'stock/create',
  'GET:/admin/inventario/(\d+)' => 'stock/edit',
  'POST:/admin/inventario/(\d+)' => 'stock/update',
  'POST:/admin/inventario/borrar/(\d+)' => 'stock/delete',

  'GET:/logout' => 'index/logout',
  'POST:/login' => 'index/login',
];

$BASE = new BaseCMS($config, $routes);

if (!$BASE->Connect()) {
  $BASE->Response()->ExitWithError('Error Connecting to DB', 'Verify configuration.');
}

require_once($BASE->Controller());

?>
