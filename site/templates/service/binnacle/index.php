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
      <form id="search-form" action="/servicio/prestamos/bitacora" method="get">
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
          <h3 class="title">Bitacora Prestamos</h3>                       
        </div>
        <div class="content table-responsive table-full-width stock-list">
          <table id="myTable" class="table table-hover table-striped">
            <thead>
              <th>ID</th>
              <th>Prestamo</th>
              <th>Usuario</th>
              <th>Alumno</th>
              <th>Tipo</th>                      
              <th>Fecha</th>
              <th>Materiales</th>

            </thead>
            <tbody>
              <?php if (count($moves) == 0) { ?>
              <tr><td colspan="6"><h4 class="text-center">No hay movimientos disponibles.</h4></td></tr>
              <?php } else { ?>
              <?php                              
              foreach ($moves as $move) {                              
                include(BASE_SECTION_TEMPLATES_FOLDER . 'service/binnacle/_list_item.php');
                include(BASE_SECTION_TEMPLATES_FOLDER . 'service/binnacle/_modal.php');
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
          echo "<a href='/servicio/prestamos/bitacora/?page=$i' class='btn btn-info btn-sm btn-fill btn-uabc-green pag_button'>".$i."</a>";
      ?>
    </div>
  </div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>