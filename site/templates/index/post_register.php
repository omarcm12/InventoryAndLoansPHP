
<?php /* templates/admin/sessions/new */
$custom_css_plugins = [
  'bootstrap-fileinput/bootstrap-fileinput.css'
];
$custom_js_plugins = [
  'bootstrap-fileinput/bootstrap-fileinput.js',
];
$js_assets = [
  "tablesorter/main.js",
  "jquery.tablesorter.js"
];

require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="content">
        <div class="col-md-12">                      
            <div class="card">      
            	<br>          
            	<h2 class="text-center">Bienvenido</h2>        
                <div class="header text-center">                    
					<h1>Completa el siguiente formulario para finalizar con el registro</h1>                
                </div>
        
          <div class="tab-content">
            <div class="tab-pane fade in active" id="datos" >       
             <form method="post" action="/post-registro/guardar" accept-charset="UTF-8" enctype="multipart/form-data">
                <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/info_form.php'); ?>                
                <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px">Confirmar Informacion</button>
                <div class="clearfix"></div>
              </form>

            </div>          
        	</div>
        </div>
    </div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>