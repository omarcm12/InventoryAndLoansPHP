<tr>
  <td><?= $loan->ID()?></td>
  <td><?= $loan->Student()->Enrollment() ?></td>   
  <td><?= $loan->Student()->FullName() ?></td>
    
  
  	<?php if ($loan->Status() == LOAN_STATUS_WAITING): ?>
          <td><?= $loan->AgeRequest()?></td>
          <td>
  		  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Entregar</a>
          <a class="btn btn-info btn-sm btn-fill btn-uabc-green" href="/servicio/prestamos/borrar/<?= $loan->ID()?>">Eliminar</a>
          </td>
  	<?php endif ?>

  	<?php if ($loan->Status() == LOAN_STATUS_IN_PROGRESS): ?>
  		  	<td><?= $loan->DeliverAt() ?></td>
          <td> 
          <a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Regresar</a>
          </td>
  	<?php endif ?>

    <?php if ($loan->Status() == LOAN_STATUS_ENDED): ?>
         <td><?= date("d-m-Y",$loan->UpdatedAt()) ?></td>
          <!--<td>
          <a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Editar</a>
          </td>-->
    <?php endif ?>
  
</tr>

