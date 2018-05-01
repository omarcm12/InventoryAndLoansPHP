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
        <button class="btn btn-info btn-fill pull-right btn-uabc-green" onclick="exportTableToCSV('datos.csv')" style="margin: 10px 5px;">Generar reporte</button>

        <form id="search-form" action="/admin/pagos/" method="get">
          <div class="input-group"> 
            <input type="text" id="payment_search" name="s" placeholder="Buscar" value="<?= $search_default_value ?>" class="form-control" style="border: 1px solid #ddd !important; border-right: 0 none !important; width: auto; background-color: #fff !important;"> 
            <div class="input-group-btn"> 
              <button type="button" class="btn btn-default" onclick="$('#search-form').submit()">
                <span class="glyphicon glyphicon-search"></span>
              </button>
              <button type="button" class="btn btn-default" onclick="$('#payment_search').val('');$('#search-form').submit();">
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
                    <h3 class="title">Pagos</h3>                       
                </div>
                <div class="content table-responsive table-full-width stock-list">
                    <table id="myTable" class="table table-hover table-striped">
                        <thead>
                          <th>Id</th>
                          <th>Multa</th>
                          <th>Alumno</th>
                          <th>Almacenista</th>
                          <th>Monto</th>
                          <th>Monto Pagado</th>     <th>Fecha</th>
                          
                          <th>Descripcion</th>
                        </thead>
                        <tbody>
                            <?php if (count($payments) == 0) { ?>
                            <tr><td colspan="7"><h4 class="text-center">No hay Pagos disponible.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($payments as $payment) {                              
                                include(BASE_SECTION_TEMPLATES_FOLDER . 'payment/_list_item.php');
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