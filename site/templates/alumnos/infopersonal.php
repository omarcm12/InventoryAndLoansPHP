<?php /* templates/admin/sessions/new */
$custom_css_plugins = [
  'bootstrap-fileinput/bootstrap-fileinput.css'
];
$custom_js_plugins = [
  'bootstrap-fileinput/bootstrap-fileinput.js',
];


require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="content">

        <div class="col-md-12">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Mi informacion</h3>                       
                </div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#datos" data-toggle="tab">Mis datos</a></li>
              <li><a href="#prestamos" data-toggle="tab">Mis prestamos</a></li>
              <li><a href="#adeudos" data-toggle="tab">Mis adeudos</a></li>
            </ul>
          
          <div class="tab-content">
            <div class="tab-pane fade in active" id="datos" >       
             <form method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/info_form.php'); ?>
                <a type="button" href="/alumnos" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px" >Cancelar</a>
                <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px">Actualizar Informacion</button>
                <div class="clearfix"></div>
              </form>
            </div>

            <div class="tab-pane fade" id="prestamos" class="card">
                <div class="content table-responsive table-full-width stock-list">
                  <table class="table table-hover table-striped">
                      <thead>
                        <th>
                          Fecha                                                       
                        </th>
                        <th>                            
                          Estado                       
                        </th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php if (count($loads) == 0) { ?>
                          <tr><td colspan="7"><h4 class="text-center">No hay prestamos disponibles.</h4></td></tr>
                          <?php } else { ?>
                            <?php                              
                            foreach ($loads as $load) {                              
                              include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/_load_item.php');
                            }
                            ?>
                          <?php } ?>                     
                      </tbody>
                  </table>

                </div>
            </div>

            <div class="tab-pane fade" id="adeudos">
              adeudos
            </div>
        </div>

            </div>
        </div>

      

</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>