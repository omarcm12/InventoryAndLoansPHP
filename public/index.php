<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../boot.php');
require_once(BASE_INSTALL_FOLDER . 'site.php');

$routes = [  
  'GET:/' => 'index/index',
  'GET:/login' => 'index/indexalumnos',
  'GET:/alumnos/singup' => 'alumnos/registro',
  'GET:/admin' => 'index/menu',

  'GET:/admin/inventario' => 'stock/index',
  'GET:/admin/inventario/nuevo' => 'stock/new',
  'GET:/admin/movimientos' => 'moves/index',
  'POST:/admin/movimientos/new/(\d+)' => 'moves/create',
  'POST:/admin/movimientos/create' => 'moves/create_api',
  'POST:/admin/inventario' => 'stock/create',
  'GET:/admin/inventario/(\d+)' => 'stock/edit',
  'POST:/admin/inventario/(\d+)' => 'stock/update',
  'POST:/admin/inventario/borrar/(\d+)' => 'stock/delete',
  'GET:/admin/prestamos' => 'loan/index',
  'POST:/admin/prestamos/entregar/(\d+)' => 'loan/deliver',
  'POST:/admin/prestamos/regresar/(\d+)' => 'loan/return',

  'GET:/alumnos' => 'alumnos/menu',
  'GET:/alumnos/infopersonal' => 'alumnos/infopersonal',
  'GET:/alumnos/prestamos' => 'alumnos/prestamos',
  'POST:/alumnos/prestamo/agregar-material' => 'alumnos/loan/add',
  'POST:/alumnos/prestamo/eliminar-material/(\d+)' => 'alumnos/loan/remove',
  'POST:/alumnos/prestamo/confirmar/(\d+)' => 'alumnos/loan/confirm',
  'GET:/alumnos/adeudos' => 'alumnos/adeudos',
  'GET:/alumnos/historial_prestamos' => 'alumnos/historial',

  'GET:/logout' => 'index/logout',
  'POST:/login' => 'index/login',
];

$BASE = new BaseCMS($config, $routes);

if (!$BASE->Connect()) {
  $BASE->Response()->ExitWithError('Error Connecting to DB', 'Verify configuration.');
}

require_once($BASE->Controller());

?>
