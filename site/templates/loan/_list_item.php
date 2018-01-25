<tr>
  <td><?= $loan->ID()?></td>
  <td><?= $loan->Student()->Enrollment() ?></td>   
  <td><?= $loan->Student()->FullName() ?></td>
  <td><?= $loan->CreatedAtFormatted()?></td>   
  <td>
  	<?php if ($loan->Status() == LOAN_STATUS_WAITING): ?>
  		  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Entregar</a>
  	<?php endif ?>

  	<?php if ($loan->Status() == LOAN_STATUS_IN_PROGRESS): ?>
  		  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Regresar</a>
  	<?php endif ?>

    <?php if ($loan->Status() == LOAN_STATUS_ENDED): ?>
          <a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Editar</a>
    <?php endif ?>
  </td>
</tr>

