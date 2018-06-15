<tr>
  <td><?= $payment->ID() ?></td> 
  <td><?= $payment->Penalty()->ID() ?></td>  
  <td><?= $payment->Penalty()->Material()->ID() ?>-<?= $payment->Penalty()->Material()->Name() ?></td>
  <td><?= $payment->Amount() ?> / <?= $payment->Penalty()->Days() ?></td>
  <td><?= $payment->AmountPayd() ?></td>
  <td><?= date("d-m-Y",$payment->CreatedAt())?></td>
  <td>
    <button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#myModal-<?= $payment->ID() ?>"><span class="glyphicon glyphicon-search" aria-hidden="true">
  </td>

</tr>

<!-- Modal -->
  <div class="modal fade" id="myModal-<?= $payment->ID() ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Descriocion Pago - <?= $payment->ID() ?></h4>
        </div>
        <div class="modal-body">
          <p><?= $payment->Description() ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>