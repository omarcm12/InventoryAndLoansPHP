<div class="modal fade" id="modal-deliver-<?= $loan->ID()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="move-modal-title" class="modal-title">Entregar Materiales</h4>        
      </div>
      <div id="move-response-message" class="api-message label-danger" style="display:none;">Error</div>
      <div class="modal-body">
      
      		<table class="table table-hover">
            <thead>
            <tr>
          		<th></th>
                <th>Material</th>            	
            	<th>Cantidad</th>
            
            </tr>
        	</thead>
            <tbody>
            	<?php foreach ($loan->LoanMaterials() as $loan_material): ?>    

                <tr>    
                	<td style="width: 20px;"><input type="checkbox" value="" style="width: 20px;padding: 0;"></td>
                	<td>                		
                		<?= $loan_material->Material()->CatalogNumber() . " - " . $loan_material->Material()->Name()?>		
                	</td>
                	<td><?= $loan_material->Amount() ?></td>                	                	
                	               	    
                </tr>

      			<?php endforeach ?>                       

            <?php if (count($loan->LoanMaterials()) == 0): ?>
               <tr><td colspan="3"><h4 class="text-center">Agrega los materiales de la lista.</h4></td></tr>
            <?php endif ?>
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <a id="btn-create-move" class="btn btn-info btn-sm btn-fill btn-uabc-green">Entregar</a>
        <button type="button" class="btn btn-info btn-sm " data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>