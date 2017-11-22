<tr>
  <td><?= $loan->ID()?></td>
  <td><?= $loan->Student()->FullName() ?></td>   
  <td><a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-deliver-<?= $loan->ID()?>">Entregar</a>    </td>
</tr>

