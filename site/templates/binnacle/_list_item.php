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
  
  <button class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-move-<?= $move->ID()?>">Ver Detalles</button>

  </td>
</tr>


