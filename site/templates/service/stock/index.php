<?php /* templates/admin/sessions/new */

$js_assets = [
  "moves/create_api.js",
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
      <form id="search-form" action="/servicio/inventario/" method="get">
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
      </form>
    </div>

    <div class="col-md-12">                      
      <div class="card">                        
        <div class="header">
          <h3 class="title">Inventario</h3>                       
        </div>
        <div class="content table-responsive table-full-width stock-list">
          <table id="myTable" class="table table-hover table-striped">
            <thead>
              <th>
                No. catalogo                        
                <a href="/servicio/inventario?o=<?= (MATERIAL_SORT_CATALOG << 1) + ($sort_type == 1 ? 0 : 1)?>&s=<?= $search_default_value ?>">
                  <i class="fa fa-sort<?= $sort_id == MATERIAL_SORT_CATALOG ? ($sort_type == 1 ? '-desc' : '-asc') : '' ?>" aria-hidden="true"></i>
                </a>                           
              </th>
              <th>                            
                Nombre 
                <a href="/servicio/inventario?o=<?= (MATERIAL_SORT_NAME << 1) + ($sort_type == 1 ? 0 : 1)?>&s=<?= $search_default_value ?>">
                  <i class="fa fa-sort<?= $sort_id == MATERIAL_SORT_NAME ? ($sort_type == 1 ? '-desc' : '-asc') : '' ?>" aria-hidden="true"></i>
                </a>                           
              </th>
              <th>Total</th>
              <th>En prestamo</th>
              <th>Costo</th>
              <th>
                Estatus
                <a href="/servicio/inventario?o=<?= (MATERIAL_SORT_STATUS << 1) + ($sort_type == 1 ? 0 : 1)?>&s=<?= $search_default_value ?>">
                  <i class="fa fa-sort<?= $sort_id == MATERIAL_SORT_STATUS ? ($sort_type == 1 ? '-desc' : '-asc') : '' ?>" aria-hidden="true"></i>
                </a>                           
              </th>
              <th></th>
            </thead>
            <tbody>
              <?php if (count($materials) == 0) { ?>
              <tr><td colspan="7"><h4 class="text-center">No hay materiales disponible.</h4></td></tr>
              <?php } else { ?>
              <?php                              
              foreach ($materials as $material) {                              
                include(BASE_SECTION_TEMPLATES_FOLDER . 'service/stock/_list_item.php');
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
          echo "<a href='/servicio/inventario/?page=$i' class='btn btn-info btn-sm btn-fill btn-uabc-green pag_button'>".$i."</a>";
      ?>
    </div>
  </div>
</div>

<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'stock/_modal_moves.php'); ?>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>