<tr>
  <td><?= $material->CatalogNumber() ?></td>  
  <td><?= $material->Name() ?></td>
  <td><?= $material->TotalCount() ?> </td>
  <td>0</td>  

  <td>
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-delete-foto">Ver foto</a> 
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-delete-<?= $material->ID()?>">Agregar</a>    
  </td>
</tr>

<!-- Modal -->
  <div class="modal fade" id="modal-delete-foto" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $material->Name()?></h4>
        </div>
        <div class="modal-body">
        <br>
        <img src="<?= $material->Path() ?>" style="width:100%; margin-bottom:15px;">  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
