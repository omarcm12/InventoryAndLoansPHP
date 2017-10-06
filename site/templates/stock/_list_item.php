<tr>
  <td><?= $material->CatalogNumber() ?></td>  
  <td><?= $material->Name() ?></td>
  <td><?= $material->TotalCount() ?></td>
  <td>0</td>
  <td><?= '$'. $material->PricePerUnit() / 100 ?></td>  
  <td>
  	<a href="/inventario/<?= $material->ID()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green">Editar</a>
  </td>
</tr>