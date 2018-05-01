<tr>
  <td><?= $move->ID() ?></td>   
  <td><?= $move->Loan()->ID() ?> </td>   
  <td><?= $move->User()->FullName() ?></td>
  <td><?= $move->Student()->FullName() ?></td>
  <!--<td><?= $move->TypeName() ?></td> --> 
  <td style="color: <?= $move->Type() == MOVE_TYPE_RETURN ? '#109853' : '#d9534f' ?>">
      <?= $move->TypeName() ?> 
      <i class="fa fa-arrow-<?= $move->Type() == MOVE_TYPE_RETURN ? 'up' : 'down' ?>" aria-hidden="true"></i>
  </td>

  <td><?= $move->CreatedAtFormatted() ?></td>
  <td>

   <!-- <button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#modal-move-<?= $move->ID() ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></button>-->
  
  <!--<button class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-move-<?= $move->ID()?>">Ver Detalles</button>-->
  <button href="#myModal-move-<?= $move->ID()?>" id="openBtn" data-toggle="modal" class="btn btn-info btn-sm btn-fill btn-uabc-green">Ver detalles</button>

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
</tr>


