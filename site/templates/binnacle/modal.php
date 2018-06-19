<div class="modal fade" id="modal-deliver-<?= $move->ID()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="move-modal-title" class="modal-title">Regresar Materiales</h4>        
      </div>
      <div id="move-response-message" class="api-message label-danger" style="display:none;">Error</div>
      
      <div class="modal-body" style="overflow: scroll;height: 400px;">      
          <table class="table table-striped" id="tblGrid">
            <thead id="tblHead">
              <tr>
                <th>Material</th>
                <th>Prestamo</th>
                <th>Piezas</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($move->Materials() as $loan_material): ?>
                <tr>                      
                  <td>                    
                    <?= $loan_material->Material()->CatalogNumber() . " - " . $loan_material->Material()->Name()?>    
                  </td>                 
                  <td>
                    <?= $move->Loan()->ID() ?>
                  </td>
                  <td>
                    <?= $loan_material->Amount() ?>
                  </td>
                </tr>
            <?php endforeach ?>
            </tbody>
          </table>

      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>