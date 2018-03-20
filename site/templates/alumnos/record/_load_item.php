<tr>
  <td><?= $loan->ID()?></td>
  <td>
    <?php if ($loan->Status() ==1): ?> <?= $loan->RequestAt() ?> <?php endif ?>
    <?php if ($loan->Status() ==2): ?> <?= $loan->DeliverAt() ?> <?php endif ?>
    <?php if ($loan->Status() ==3): ?> <?= $loan->ReturnAt() ?> <?php endif ?>


  </td>
  <td>	
  	<?php if ($loan->Status() ==1): ?>Solicitud<?php endif ?>
	 <?php if ($loan->Status() ==2): ?>En proceso<?php endif ?>
	 <?php if ($loan->Status() ==3): ?>Entregado<?php endif ?>
  </td>  
  
  <td>
  	<button class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-loan-<?= $loan->ID()?>">Ver Detalles</button>
	<?php if ($loan->Status() ==1): ?>
  	<a href="/alumnos/historial/borrar/<?= $loan->ID()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green">Borrar</a>
  <?php endif ?>
  </td>
  

	

</tr>