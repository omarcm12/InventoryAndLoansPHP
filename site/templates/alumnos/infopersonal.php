<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="container-fluid">
    <div class="row">  
        <form id="search-form" action="/admin/inventario/" method="get">
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
     
     <div class="row">
     	<div class="col-xs-8">                      
            <div class="card">                        
                <div class="header">
                    <h3 class="title">Inventario</h3>                       
                </div>
                <div class="content table-responsive stock-list">
                    <table class="table table-hover table-striped">
                        <thead>
                          <th>Núm catalogo</th>
                          <th>Nombre</th>
                          <th>En almacen</th>
                          <th>En prestamo</th>
                          <th></th>
                        </thead>
                       	<!-- Aqui se despliegan los materiales -->
                    </table>

                </div>
            </div>
        </div>

		<div class="col-xs-4">
			<div class="card leftBar">
				<h3>Material solicitado</h3>
				<br><br>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat velit 	praesentium nisi natus incidunt veritatis maxime blanditiis libero modi 	ut, omnis culpa ullam repudiandae molestias beatae ea deserunt aperiam 	sint!</p>
			</div>
		</div>
     </div>
    </div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>