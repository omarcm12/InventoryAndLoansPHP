<tr>
  <td><?= $loan->ID()?></td>
  <td><?= $loan->CreatedAtFormatted()?></td>  
  <td><?= $loan->Status()?></td>
  <td>
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-loan-<?= $loan->ID()?>">Ver Materiales</a></td>


</tr>