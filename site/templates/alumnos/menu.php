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
          <a href="alumnos/infopersonal">
            <img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>personalInfo.png" alt="" width = "100%" href = "#" >
          <div class="caption">
            <p>Información personal</p>
          </div>
          </a>
        </div>

        <div class=" options col-lg-6" style="position:relative;">
          <a href="alumnos/prestamos">
            <img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>prestamo.png" alt="" width = "100%" href = "#" >
          <div class="caption">
            <p>Préstamo de material</p>
          </div>
          </a>
        </div>

      </div>
      <!-- fin de la Matriz del menu -->
  </div>    
</div>    
</div>    
  
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>