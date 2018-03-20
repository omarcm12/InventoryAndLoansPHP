<tr>
  <td><?= $move->NoOrder() ?></td>   
  <td>
    <a href="/admin/inventario/<?= $move->Material()->ID()?>" style="color:#607d8b">
      <?= $move->Material()->CatalogNumber() ?> - <?= $move->Material()->Name() ?>
    </a>
  </td>   
  <td><?= $move->Pieces() ?></td>
  <td style="color: <?= $move->Type() == MOVE_TYPE_ADD ? '#109853' : '#d9534f' ?>">
      <?= $move->TypeName() ?> 
      <i class="fa fa-arrow-<?= $move->Type() == MOVE_TYPE_ADD ? 'up' : 'down' ?>" aria-hidden="true"></i>
  </td>
  <td><?= $move->User()->FullName() ?></td>  
  <td><?= $move->Age() ?></td>
  <td><button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-search" aria-hidden="true"></button></td>
  


</tr>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $move->NoOrder() ?>-<?= $move->Material()->Name() ?></h4>
        </div>
        <div class="modal-body">
          <p><?= $move->Description() ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<!-- Modal -->
  <div class="modal fade" id="modal-move-<?= $move->ID()?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Descripcion</h4>
        </div>
        <div class="modal-body">
        <br>
          <?= $move->Description() ?>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>
