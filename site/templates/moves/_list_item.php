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
  <td>
    <a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-<?= $move->ID()?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></a>
 </td>
</tr>

