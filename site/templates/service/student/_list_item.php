<tr>
  <td><?= $student->Enrollment()?></td>
  <td><?= $student->FullName()?></td>  
  <td><?= $student->Email()?></td>
  <td><?= $student->Carrer()?></td>
  <?php   if ( ($var = CountWithIDStudent($student->ID()) ) > 1) {?>  
  
  <td> <?= $var ?> </td>
  
  <?php } else { ?>
  	<td> 0 </td>
	<?php } ?>
  <td><span class="label label-<?= $student->StatusLabel() ?>"><?= $student->StatusName() ?></span></td>   
    
  <td><a type="button" href="/servicio/prestamos/?s=<?= $student->Enrollment()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Ver Prestamos</a>
  </td>
</tr>


