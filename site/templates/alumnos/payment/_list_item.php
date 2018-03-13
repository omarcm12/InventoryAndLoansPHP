<tr>
  <td><?= $payment->ID() ?></td> 
  <td><?= $payment->Penalty()->ID() ?></td>  
  <td><?= $payment->Penalty()->Material()->ID() ?>-<?= $payment->Penalty()->Material()->Name() ?></td>
  <td><?= $payment->Amount() ?> / <?= $payment->Penalty()->Days() ?></td>
  <td><?= $payment->AmountPayd() ?></td>
  <td><?= $payment->CreatedAtFormatted()?></td>
    <td><?= $payment->Description()?> </td>
</tr>