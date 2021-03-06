<div class="modal fade" id="modal-deliver-<?= $loan->ID()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="move-modal-title" class="modal-title">Entregar Materiales</h4>        
      </div>
      <div id="move-response-message" class="api-message label-danger" style="display:none;">Error</div>
      
      <div class="modal-body" style="overflow: scroll;height: 400px;">      
      		<table class="table table-hover">
            <thead>
            <tr>
          		<th>Entregado</th>
              <th>Material</th>            	
            	<th>Cantidad</th>
              <th>Observacion</th>               
            </tr>
        	</thead>
            <tbody>
              <form id="form-loan-<?= $loan->ID() ?>" method="post" action="/admin/prestamos/entregar/<?= $loan->ID() ?>" accept-charset="UTF-8">
            	<?php foreach ($loan->LoanMaterials() as $loan_material): ?>
                <tr>    
                	<td style="width: 20px;">                                        
                    <input name="loan-material[<?= $loan_material->ID() ?>][deliver]" type="hidden" class="list-checkbox" value="0">
                    <input name="loan-material[<?= $loan_material->ID() ?>][deliver]" type="checkbox" class="list-checkbox" value="1" checked>
                  </td>
                	<td>                		
                		<?= $loan_material->Material()->CatalogNumber() . " - " . $loan_material->Material()->Name()?>		
                	</td>                	
                	<td><input name="loan-material[<?= $loan_material->ID() ?>][amount]" type="number" class="form-control in-table" value="<?= $loan_material->Amount() ?>" style="width: 58px;"></td>        
                  <td>
                    <input name="loan-material[<?= $loan_material->ID() ?>][description]" type="text" class="form-control in-table" value="<?= $loan_material->Description() ?>"></td>
                  </td>
                </tr>
      			<?php endforeach ?>  
            <?php if (count($loan->LoanMaterials()) == 0): ?>
               <tr><td colspan="3"><h4 class="text-center">Agrega los materiales de la lista.</h4></td></tr>
            <?php endif ?>
            </tbody>
            </form>
        </table>
      </div>

      <div class="modal-footer">
        <a id="btn-create-move" class="btn btn-info btn-sm btn-fill btn-uabc-green" onclick="$('#form-loan-<?= $loan->ID() ?>').submit()">Entregar</a>
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>