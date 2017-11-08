<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">
      
    <div class="col-md-12"> 
        <a href="/admin/inventario/nuevo" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin: 10px 14px;">Crear material</a>
        <a href="/admin/inventario/movimientos" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin: 10px 5px;">Movimientos</a>
       
        <form action="/admin/inventario/" method="get">
          <input type="text" id="material_search" name="s" placeholder="Buscar" value="<?= $search_default_value ?>" style="background-color:black;">
          <input type="submit" class="btn btn-info btn-fill btn-uabc-green" value="Buscar">
        </form>
    </div>
     
        <div class="col-md-12">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Inventario</h3>                       
                </div>
                <div class="content table-responsive table-full-width stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>Num catalogo</th>
                          <th>Nombre</th>
                          <th>En almacen</th>
                          <th>En prestamo</th>
                          <th>costo</th>
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($materials) == 0) { ?>
                            <tr><td colspan="6"><h4 class="text-center">No hay materiales disponible.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($materials as $material) {                              
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