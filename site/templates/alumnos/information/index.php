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
                <div class="header">
                    <h3 class="title">Mi informacion</h3>                       
                </div>
        
          <div class="tab-content">
            <div class="tab-pane fade in active" id="datos" >       
             <form method="post" action="/alumnos/infopersonal/update/<?=$student->ID()?>" accept-charset="UTF-8" enctype="multipart/form-data">
                <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/info_form.php'); ?>
                <a type="button" href="/alumnos" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px" >Cancelar</a>
                <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px">Actualizar Informacion</button>
                <div class="clearfix"></div>
              </form>

            </div>
            
         

            
          

         
        </div>

            </div>
        </div>

      

</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>