<tr>
  <td><?= $student->Enrollment()?></td>
  <td><?= $student->FullName()?></td>  
  <td><?= $student->Email()?></td>
  <td><?= $student->Carrer()?></td>
  <td><?= $student->Semester()?></td>
  <td><a type="button" href="/admin/prestamos/?s=<?= $student->Enrollment()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Ver Prestamos</a></td>


</tr>