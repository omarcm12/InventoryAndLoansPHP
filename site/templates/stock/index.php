<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">
      <a href="/inventario/nuevo" class="btn btn-info btn-fill pull-right" style="margin: 10px 14px;">Crear material</a>
        <div class="col-md-12">                      
            <div class="card">                        
                <div class="header">
                    <h4 class="title">Inventario</h4>
                                                
                </div>
                <div class="content table-responsive table-full-width stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>En almacen</th>
                          <th>En prestamo</th>
                          <th>Costo</th>                                      
                        </thead>
                        <tbody>
                            <?php if (count($materials) == 0) { ?>
                            <tr><td colspan="5"><h4 class="text-center">No tags available.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($materials as $material) {                              
                                error_log(print_r($material, true));
                                include(BASE_SECTION_TEMPLATES_FOLDER . 'stock/_list_item.php');
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