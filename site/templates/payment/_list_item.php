<tr>
  <td><?= $payment->ID() ?></td>  
  <td><?= $payment->Penalty()->ID()?></td>
  <td><?= $payment->Student()->FullName()?></td>
  <td><?= $payment->Employee()->FullName()?></td>
  <td>$ <?= $payment->Amount() ?></td>
  <td>$ <?= $payment->AmountPayd() ?></td>
  <td><?= $payment->CreatedAtFormatted()?></td>
  <td><?= $payment->Description() ?></td>
    <td>
    
  </td>
</tr>
