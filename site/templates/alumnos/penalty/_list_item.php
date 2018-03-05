<tr>
  <td><?= $penalty->ID() ?></td> 
  <td><?= $penalty->LoanMaterial()->ID() ?></td>  
  <td><?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?></td>
  <td><?= $penalty->Pieces() ?></td>
  <td>$<?= $penalty->Amount() ?></td>
  <td><?= $penalty->CreatedAtFormatted()?></td>
    <td>   
  </td>
</tr>