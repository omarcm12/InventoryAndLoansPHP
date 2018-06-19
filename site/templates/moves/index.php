<?php /* templates/admin/sessions/new */
$js_assets = [
  "report.js",
  "tablesorter/jquery-3.3.1.min.js",
  "tablesorter/jquery.tablesorter.js",
  "tablesorter/main.js"
];
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
  <div class="row">

    <div class="col-md-12"> 
      <button class="btn btn-info btn-fill pull-right btn-uabc-green" onclick="exportTableToCSV('datos.csv')" style="margin: 10px 5px;">Generar reporte</button>
      <form id="search-form" action="/admin/movimientos/" method="get">
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
          <h3 class="title">Movimientos</h3>                       
        </div>
        <div class="content table-responsive table-full-width stock-list">
          <table id="myTable" class="table table-hover table-striped">
            <thead>
              <th>Num orden</th>
              <th>Material</th>
              <th>Piezas</th>
              <th>Tipo</th>
              <th>Usuario</th>                      
              <th>Fecha</th>
              <th>Descripcion</th>

            </thead>
            <tbody>
              <?php if (count($moves) == 0) { ?>
              <tr><td colspan="6"><h4 class="text-center">No hay movimientos disponibles.</h4></td></tr>
              <?php } else { ?>
              <?php                              
              foreach ($moves as $move) {                              
                include(BASE_SECTION_TEMPLATES_FOLDER . 'moves/_list_item.php');
              }
              ?>
              <?php } ?>                            
            </tbody>
          </table>
        </div>
      </div>
      <!-- The paginator -->
      <?php 
        for( $i = 1; $i<=ceil(($total_items)/$item_per_page); $i++)
          echo "<a href='/admin/movimientos/?page=$i' class='btn btn-info btn-sm btn-fill btn-uabc-green pag_button'>".$i."</a>";
      ?>
    </div>
  </div>
</div>

<?php                              
  foreach ($moves as $move) {                              
    include(BASE_SECTION_TEMPLATES_FOLDER . 'moves/_modal.php');
  }
?>

<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>