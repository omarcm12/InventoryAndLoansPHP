<?php /* templates/admin/sessions/new */

require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">
      
    <div class="col-md-12"> 
        <form id="search-form" action="/admin/alumnos/" method="get">
          <div class="input-group"> 
            <input type="text" id="material_search" name="s" placeholder="Buscar" value="<?= $search_default_value ?>" class="form-control"> 
            <div class="input-group-btn"> 
              <button type="button" class="btn btn-default" onclick="$('#search-form').submit()">
                <span class="glyphicon glyphicon-search"></span>
              </button>
              <button type="button" class="btn btn-default" onclick="$('#material_search').val('');$('#search-form').submit();">
                <span class="glyphicon glyphicon-remove"></span>
              </button> 
            </div> 
          </div>          
          <input type="submit" style="display: none" />
          <br>
        </form>
    </div>
     
        <div class="col-md-12">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Alumnos</h3>                       
                </div>
                <div class="content table-responsive table-full-width stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>
                            Matricula                                                     
                          </th>
                          <th>                            
                            Nombre 
                                                 
                          </th>
                          <th>Correo</th>
                          <th>Carrera</th>
                          <th>Semestre</th>
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($students) == 0) { ?>
                            <tr><td colspan="7"><h4 class="text-center">No hay alumnos disponibles.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($students as $student) {                              
                                include(BASE_SECTION_TEMPLATES_FOLDER . 'student/_list_item.php');
                              }
                              ?>
                            <?php } ?>                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>