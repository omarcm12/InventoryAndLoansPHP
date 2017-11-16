<tr>
  <td><?= $move->NoOrder() ?></td>   
  <td>
    <a href="/admin/inventario/<?= $move->Material()->ID()?>">
      <?= $move->Material()->Name() ?>
    </a>
  </td>   
  <td><?= $move->Pieces() ?></td>
  <td><?= $move->TypeName() ?></td>
  <td><?= $move->User()->FullName() ?></td>  
  <td><?= $move->Description() ?></td>
  <td><?= $move->CreatedAtFormatted() ?></td>


</tr>