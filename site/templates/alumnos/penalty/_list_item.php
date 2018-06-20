<tr>
  <td><?= $penalty->ID() ?></td> 
  <td><?= $penalty->LoanMaterial()->Loan()->ID()?></td>
  <td><?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?></td>
  <td><?= $penalty->Pieces() ?> / <?= $penalty->Days() ?></td>
  <td>$<?= $penalty->Amount() ?></td>
  <td>$<?= $penalty->Material()->PricePerUnit() / 100 ?></td>
  <td><?= date("d-m-Y",$penalty->LoanMaterial()->ReturnUnix()-100) ?></td>
    <td>   
  </td>
</tr>