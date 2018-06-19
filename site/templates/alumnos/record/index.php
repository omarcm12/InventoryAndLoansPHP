<?php /* templates/admin/sessions/new */

require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
  <div class="row">

    <div class="col-md-12"> 
      <form id="search-form" action="/alumnos/historial/" method="get">
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
        <input name="f" value="<?= $filter?>" type="hidden">
      </form>
    </div>

    <div class="col-xs-12">                      
      <div class="card">                        
        <div class="header">
          <h3 class="title">Mis Prestamos</h3>                       
        </div>
        <ul class="nav nav-tabs nav-tabs-right">
          <li role="presentation" id="loan_tabs" <?= $filter == LOAN_STATUS_ENDED ? 'class=" active"' : ''?>">
            <a href="/alumnos/historial?s=<?= $search_default_value?>&f=<?= LOAN_STATUS_ENDED ?>">Finalizados</a>
          </li>
          <li role="presentation" <?= $filter == LOAN_STATUS_IN_PROGRESS ? 'class=" active"' : ''?>>
            <a href="/alumnos/historial?s=<?= $search_default_value?>&f=<?= LOAN_STATUS_IN_PROGRESS ?>">En Curso</a>
          </li>
          <li role="presentation" <?= $filter == LOAN_STATUS_WAITING ? 'class=" active"' : ''?>>
            <a href="/alumnos/historial?s=<?= $search_default_value?>&f=<?= LOAN_STATUS_WAITING ?>">Pendientes</a>
          </li>
        </ul>
        <div class="content table-responsive table-full-width stock-list">
          <table class="table table-hover table-striped">
            <thead>
              <th>ID de Prestamo</th>
              <th>Fecha</th>
              <th>Estado</th>                          
              <th></th>
              <th></th>
            </thead>
            <tbody>
              <?php if (count($loans) == 0) { ?>
              <tr><td colspan="6"><h4 class="text-center">No hay prestamos disponibles.</h4></td></tr>
              <?php } else { ?>
              <?php                              
              foreach ($loans as $loan) {                              
                include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/record/_load_item.php');
              }
              ?>
              <?php } ?>                            
            </tbody>
          </table>

        </div>
      </div>
      <?php 
      for( $i = 1; $i<=ceil(($total_items)/$item_per_page); $i++)
        echo "<a href='/alumnos/historial?page=$i&f=$filter' class='btn btn-info btn-sm btn-fill btn-uabc-green pag_button'>".$i."</a>";
      ?>
    </div>
  </div>
  <!-- The paginator -->
</div>

<?php if ($filter == LOAN_STATUS_WAITING): ?>
  <?php                              
  foreach ($loans as $loan) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/record/_modal_request.php');
  }
  ?>
<?php endif ?>

<?php if ($filter == LOAN_STATUS_IN_PROGRESS): ?>
  <?php                              
  foreach ($loans as $loan) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/record/_modal_process.php');
  }
  ?>
<?php endif ?>

<?php if ($filter == LOAN_STATUS_ENDED): ?>
  <?php                              
  foreach ($loans as $loan) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/record/_modal_finish.php');
  }
  ?>
<?php endif ?>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>