<tr>
  <td><?= $penalty->ID() ?></td> 
  <td><?= $penalty->LoanMaterial()->ID() ?></td>  
  <td><?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?></td>
  <td><?= $penalty->Pieces() ?> / <?= $penalty->Days() ?></td>
  <td>$<?= $penalty->Amount() ?></td>
  <td>$<?= $penalty->Material()->PricePerUnit() / 100 ?></td>
  <td><?= $penalty->LoanMaterial()->AgeReturnAt()?></td>
    <td>   
  </td>
</tr>