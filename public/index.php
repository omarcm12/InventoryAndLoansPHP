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
  'GET:/admin/prestamos/bitacora' => 'binnacle/index',
  'POST:/admin/prestamos/entregar/(\d+)' => 'loan/deliver',
  'POST:/admin/prestamos/regresar/(\d+)' => 'loan/return',
  'GET:/admin/prestamos/borrar/(\d+)' => 'loan/delete',
  'GET:/admin/alumnos' => 'student/index',
  'POST:/admin/alumnos/actualizar/(\d+)' => 'student/update',
  'GET:/admin/adeudos' => 'penalty/index',
  'GET:/admin/pagos' => 'payment/index',
  'POST:/admin/pagos/nuevo/(\d+)' => 'payment/new',
  'GET:/admin/configuraciones' => 'configuration/index',
  'POST:/admin/configuraciones/actualizar' => 'configuration/update',

  'GET:/alumnos' => 'alumnos/menu',
  'GET:/alumnos/infopersonal' => 'alumnos/information/index',
  'GET:/alumnos/historial' => 'alumnos/record/index',
  'GET:/alumnos/prestamos' => 'alumnos/loan/index',
  'POST:/alumnos/infopersonal/update/(\d+)' => 'alumnos/update',
  'GET:/alumnos/historial/borrar/(\d+)' => 'alumnos/record/delete',
  'GET:/alumnos/historial/editar/(\d+)' => 'alumnos/record/edit',
  'POST:/alumnos/prestamo/agregar-material' => 'alumnos/loan/add',
  'POST:/alumnos/prestamo/eliminar-material/(\d+)' => 'alumnos/loan/remove',
  'POST:/alumnos/prestamo/confirmar/(\d+)' => 'alumnos/loan/confirm',
  'GET:/alumnos/adeudos' => 'alumnos/penalty/index',
  'GET:/alumnos/pagos' => 'alumnos/payment/index',
  'GET:/alumnos/historial_prestamos' => 'alumnos/historial',

  'GET:/logout' => 'index/logout',
  'GET:/post-registro' => 'index/post_register',  
  'POST:/post-registro/guardar' => 'index/save_post_register',  
  'GET:/login' => 'index/login',

  'GET:/servicio' => 'service/menu',
  'GET:/servicio/inventario' => 'service/stock/index',
  'GET:/servicio/alumnos' => 'service/student/index',
  'GET:/servicio/prestamos' => 'service/loan/index',
  'GET:/servicio/prestamos/bitacora' => 'service/binnacle/index',
  'POST:/servicio/prestamos/entregar/(\d+)' => 'service/loan/deliver',
  'POST:/servicio/prestamos/regresar/(\d+)' => 'service/loan/return',
  'GET:/servicio/prestamos/borrar/(\d+)' => 'service/loan/delete',
  'GET:/servicio/pagos' => 'service/payment/index',
  'POST:/servicio/pagos/nuevo/(\d+)' => 'service/payment/new',
  'GET:/servicio/adeudos' => 'service/penalty/index',

];

$BASE = new BaseCMS($config, $routes);

if (!$BASE->Connect()) {
  $BASE->Response()->ExitWithError('Error Connecting to DB', 'Verify configuration.');
}

require_once($BASE->Controller());

?>
