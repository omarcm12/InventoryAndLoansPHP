 <div class="modal fade" id="myModal-move-<?= $move->ID()?>">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Materiales <?= $move->TypeName() ?> - <?= $move->ID()?></h3>
        </div>
        <div class="modal-body">
      
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
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  </td>