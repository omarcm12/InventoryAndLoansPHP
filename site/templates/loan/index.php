<?php /* templates/admin/sessions/new */
$js_assets = [
  "report.js"
];
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">
      
    <div class="col-md-12"> 
      <!--<button class="btn btn-info btn-fill pull-right btn-uabc-green" onclick="exportTableToCSV('datos.csv')" style="margin: 10px 5px;">Generar reporte</button>-->
        <form id="search-form" action="/admin/prestamos" method="get">
          <div class="input-group"> 
            <input type="text" id="material_search" name="s" placeholder="Buscar" value="<?= $search_default_value?>" class="form-control"> 
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
          <input name="f" value="<?= $filter?>" type="hidden">
          <br>
        </form>
    </div>
     
        <div class="col-md-12">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Prestamos</h3>                       
                </div>
                <ul class="nav nav-tabs nav-tabs-right">
                  <li role="presentation" <?= $filter == LOAN_STATUS_ENDED ? 'class="active"' : ''?> style="margin-right: 20px;">
                    <a href="/admin/prestamos?s=<?= $search_default_value?>&f=<?= LOAN_STATUS_ENDED ?>">Finalizados</a>
                  </li>
                  <li role="presentation" <?= $filter == LOAN_STATUS_IN_PROGRESS ? 'class="active"' : ''?>>
                    <a href="/admin/prestamos?s=<?= $search_default_value?>&f=<?= LOAN_STATUS_IN_PROGRESS ?>">En Curso</a>
                  </li>
                  <li role="presentation" <?= $filter == LOAN_STATUS_WAITING ? 'class="active"' : ''?>>
                    <a href="/admin/prestamos?s=<?= $search_default_value?>&f=<?= LOAN_STATUS_WAITING ?>">Pendientes</a>
                  </li>
                </ul>
                <div class="content table-responsive table-full-width stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>ID de Prestamo</th>
                          <th>Matrícula</th>
                          <th>Alumno</th>
                          <th>Fecha</th>                          
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($loans) == 0) { ?>
                            <tr><td colspan="6"><h4 class="text-center">No hay prestamos disponibles.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($loans as $loan) {                              
                                include(BASE_SECTION_TEMPLATES_FOLDER . 'loan/_list_item.php');
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

<?php if ($filter == LOAN_STATUS_WAITING): ?>
<?php                              
  foreach ($loans as $loan) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'loan/_modal_deliver.php');
  }
?>
<?php endif ?>

<?php if ($filter == LOAN_STATUS_IN_PROGRESS): ?>
<?php                              
  foreach ($loans as $loan) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'loan/_modal_return.php');
  }
?>
<?php endif ?>

<?php if ($filter == LOAN_STATUS_ENDED): ?>
<?php                              
  foreach ($loans as $loan) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'loan/_modal_view.php');
  }
?>
<?php endif ?>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>