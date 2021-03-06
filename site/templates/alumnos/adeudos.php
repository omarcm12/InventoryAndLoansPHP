<?php /* templates/admin/sessions/new */

$js_assets = [
  "moves/create_api.js",
  "report.js"
];

require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">
      
    <div class="col-md-12"> 
        <a href="/admin/movimientos" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin: 10px 5px;">Mis Pagos</a>

        <form id="search-form" action="/alumnos/adeudos/" method="get">
          <div class="input-group"> 
            <input type="text" id="penalty_search" name="s" placeholder="Buscar" value="<?= $search_default_value ?>" class="form-control" style="border: 1px solid #ddd !important; border-right: 0 none !important; width: auto; background-color: #fff !important;"> 
            <div class="input-group-btn"> 
              <button type="button" class="btn btn-default" onclick="$('#search-form').submit()">
                <span class="glyphicon glyphicon-search"></span>
              </button>
              <button type="button" class="btn btn-default" onclick="$('#penalty_search').val('');$('#search-form').submit();">
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
                    <h3 class="title">Mis multas</h3>                       
                </div>
                <div class="content table-responsive table-full-width stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>Id</th>
                          <th>Prestamo</th>
                          <th>Material</th>
                          <th>Piezas/Dias</th>
                          <th>Monto</th>
                          <th>Fecha</th>
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($penaltys) == 0) { ?>
                            <tr><td colspan="7"><h4 class="text-center">No hay multas disponible.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($penaltys as $penalty) {                              
                                include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/penalty/_list_item.php');
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

<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'stock/_modal_moves.php'); ?>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>