<tr>
  <td><?= $material->CatalogNumber() ?></td>  
  <td><?= $material->Name() ?></td>
  <td class="total-material">
    <span><?= $material->TotalCount() ?></span>   
  </td>
  <td><?= $material->Borrowedcount() ?></td>  
  <td><?= '$'. $material->PricePerUnit() / 100 ?></td>  
  <td>    
    <span class="label label-<?= $material->StatusLabel() ?>"><?= $material->StatusName() ?></span>
  </td>
  <td> 
      
  </td>

</tr>