<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
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

<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/menu">
                      <img class="logo-nav" src="<?= BASE_IMAGE_ASSETS_PATH ?>logo-small.png" >
                      <h3>Almacen de Química</h3><br>
                      <span>FACULTAD DE CIENCIAS QUÍMICAS E INGENIERÍA</span>
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                   

                    <ul class="nav navbar-nav navbar-right">                                                
                        <li>
                            <a href="/">                                
                                Cerrar Sesión
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/_flash.php'); ?>