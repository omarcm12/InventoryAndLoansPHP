<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">  
        <div class="col-md-12">
        <form id="search-form" action="/alumnos/prestamos/" method="get">
          <div class="input-group"> 
            <input type="text" id="material_search" name="s" placeholder="Buscar" value="" class="form-control"> 
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
    </div>
     
     <div class="row">
     	<div class="col-xs-12 col-md-8">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Inventario</h3>                       
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
            <!-- The paginator -->
            <?php 
              for( $i = 1; $i<=ceil(($total_items)/$item_per_page); $i++)
                echo "<a href='/alumnos/prestamos/?page=$i' class='btn btn-info btn-sm btn-fill btn-uabc-green pag_button'>".$i."</a>";
            ?>
            <br><br>
        </div>

		<div class="col-xs-12 col-md-4">
			<?php include(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/loan_list.php'); ?>
		</div>
     </div>
    </div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>