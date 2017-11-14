<?php /* templates/admin/sessions/new */

require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">
      
    <div class="col-md-12"> 
        <form action="/admin/inventario/movimientos/" method="get">
          <input type="text" id="move_search" name="s" placeholder="Buscar" value="<?= $search_default_value ?>" style="background-color:black;">
          <input type="submit" class="btn btn-info btn-fill btn-uabc-green" value="Buscar">
        </form>
    </div>
     
        <div class="col-md-12">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Movimientos</h3>                       
                </div>
                <div class="content table-responsive table-full-width stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>Num orden</th>
                          <th>Material</th>
                          <th>Tipo</th>
                          <th>Usuario</th>
                          <th>Descripcion</th>
                          <th>Fecha</th>
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($moves) == 0) { ?>
                            <tr><td colspan="6"><h4 class="text-center">No hay movimientos disponible.</h4></td></tr>
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
        </div>
    </div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>