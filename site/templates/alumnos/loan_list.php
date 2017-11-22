<div class="card leftBar">
  <h3>Material solicitado</h3>
  <br>
  	<div class="content table-responsive table-full-width">
        <table class="table table-hover">
            <thead>
                <tr><th>Material</th>            	
            	<th>Cantidad</th>
            	<th></th>
            </tr></thead>
            <tbody>
            	<?php foreach ($loan->Materials() as $loan_material): ?>                  	
                <tr>                	
                	<td><?= $loan_material->Material()->CatalogNumber() . " - " . $loan_material->Material()->Name()?></td>
                	<td><?= $loan_material->Amount() ?></td>                	                	
                	<td>
                		<a href="#" onclick="$('#delete-material-<?= $loan_material->ID() ?>').submit()">
                			<i class="fa fa-times-circle" aria-hidden="true"></i>
                		</a>            
                	</td>                	    
                </tr>

                <form id="delete-material-<?= $loan_material->ID() ?>" action="/alumnos/prestamo/eliminar-material/<?= $loan_material->ID()?>" method="post" style="display:none">		         		           
                	<input type="hidden" name="test">
		          </form>
      			<?php endforeach ?>                       
            </tbody>
        </table>
	</div>
    <?php if (count($loan->Materials())): ?>
      <a href="#" class="btn btn-info btn-fill pull-right" onclick="$('#confirm-loan').submit()">Solicitar Prestamo</a>  
    <?php endif ?>
  	

  	<div class="clearfix"></div>
    <form id="confirm-loan" action="/alumnos/prestamo/confirmar/<?= $loan->ID()?>" method="post" style="display:none">                           
        
    </form>
</div>