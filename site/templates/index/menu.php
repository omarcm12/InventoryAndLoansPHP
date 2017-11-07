<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<!-- BEGIN LOGIN FORM -->
 <div class="wrapper"> 	
    <div class="container-fluid">
               

    <div class="row">
    <!-- Matriz del menu -->
      <div class=" matrix container col-xs-12">

        <div class=" options col-lg-6" style="position:relative;">
          <a href="#">
            <img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>alumnos.png" alt="" width = "100%" href = "#" >
          <div class="caption">
            <p>Alumnos</p>
          </div>
          </a>
        </div>

        <div class=" options col-lg-6" style="position:relative;">
          <a href="#">
            <img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>equipo.png" alt="" width = "100%" href = "#" >
          <div class="caption">
            <p>Prestamos</p>
          </div>
          </a>
        </div>

        <div class=" options col-lg-6" style="position:relative;">
          <a href="admin/inventario">
            <img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>inventario.png" alt="" width = "100%" href = "#" >
          <div class="caption">
            <p>Inventario</p>
          </div>
          </a>
        </div>

        <div class=" options col-lg-6" style="position:relative;">
          <a href="#">
            <img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>pagos.png" alt="" width = "100%" href = "#" >
          <div class="caption">
            <p>Pagos</p>
          </div>
          </a>
        </div>

      </div>
      <!-- fin de la Matriz del menu -->
  </div>    
</div>    
</div>    
  
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>