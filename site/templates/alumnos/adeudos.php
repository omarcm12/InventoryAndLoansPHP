<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>

<div class="col-xs-6">
	<div class="card">                        
                <div class="header">
                    <h3 class="title">Materiales</h3>                       
                </div>
                <div class="content table-responsive stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>Prestamo</th>
           				  <th>Fecha</th>                    
                          <th>Material</th>
                          <th>Solicitados/devueltos</th>
                          <th>Cantidad</th>
                          <th>Costo unitario ($)</th>
                          <th>Total ($)</th>                            
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($materials) == 0) { ?>
                            <tr><td colspan="7"><h4 class="text-center">No hay materiales disponible.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($materials as $material) {                              
                                if(!$loan->isInMaterials($material)){
                                  include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/_debtsMaterial_item.php');
                                }
                              }
                              ?>
                            <?php } ?>                            
                        </tbody>
                       	<!-- Aqui se despliegan los materiales -->
                    </table>

                </div>
            </div>

</div>

<div class="col-xs-6">
	<div class="card">                        
                <div class="header">
                    <h3 class="title">Multas</h3>                       
                </div>
                <div class="content table-responsive stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>Núm catalogo</th>
                          <th>Nombre</th>
                          <th>Cantidad</th>                        
                          <th></th>
                        </thead>
                        <tbody>
                            <?php if (count($materials) == 0) { ?>
                            <tr><td colspan="7"><h4 class="text-center">No hay materiales disponible.</h4></td></tr>
                            <?php } else { ?>
                              <?php                              
                              foreach ($materials as $material) {                              
                                if(!$loan->isInMaterials($material)){
                                  include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/_list_item.php');
                                }
                              }
                              ?>
                            <?php } ?>                            
                        </tbody>
                       	<!-- Aqui se despliegan los materiales -->
                    </table>

                </div>
            </div>

</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>