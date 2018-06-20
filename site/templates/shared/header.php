  <!doctype html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Almacen FCQI</title>
    <link rel="stylesheet" href="<?=BASE_PLUGIN_ASSETS_PATH ?>bootstrap/css/bootstrap.min.css">
    <link href="<?= BASE_PLUGIN_ASSETS_PATH ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>  
    <link href="<?= BASE_PLUGIN_ASSETS_PATH ?>theme/css/light-bootstrap-dashboard.css" rel="stylesheet" type="text/css"/>
    <?php if (empty($custom_css_plugins)) { $custom_css_plugins = []; } ?>
    <?php foreach ($custom_css_plugins as $css) { ?>
    <link href="<?= BASE_PLUGIN_ASSETS_PATH . $css ?>" type="text/css" rel="stylesheet" />
    <?php } ?>
    <link rel="stylesheet" href="<?=BASE_ASSETS_PATH?>/css/custom.css">
    <link rel="stylesheet" href="<?=BASE_ASSETS_PATH?>/css/styles.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  </head>
  <body>

    <!-- From here -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Rigth here the elements are grouped for a better mobile display -->
        <div class="navbar-header">
          <?php if(adminCurrentUser()->IsAdmin()):?>
            <a class="navbar-brand" href="/admin">
          <?php  elseif (adminCurrentUser()->IsStudent()): ?>
            <a class="navbar-brand" href="/alumnos">
          <?php  else: ?>
            <a class="navbar-brand" href="/servicio">                      
          <?php endif ?>
              <img class="logo-nav" src="<?= BASE_IMAGE_ASSETS_PATH ?>logo-small2.png" >
            </a>
          </div>
          <div class="logout">
            <a class="visible-xs visible-sm" href="/logout">                                
              Cerrar Sesión
              <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
          </div>

        <!-- Collect the nav links, froms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigationMenu">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <p>
                  <?= adminCurrentUser()->FullName() ?>
                  <b class="caret"></b>
                </p>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <?php if(adminCurrentUser()->IsAdmin()): ?>
                    <a href="/admin/configuraciones">Configuraciones</a>
                  <?php else: ?>
                    <a href="#">Configuraciones</a>
                    <?php endif ?>
                </li>                                  
              </ul>
            </li>
            <li>
              <a href="/logout">                                
                Cerrar Sesión
                <i class="fa fa-sign-out" aria-hidden="true"></i>
              </a>
            </li>
            <li class="separator hidden-lg hidden-md"></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/_flash.php'); ?>