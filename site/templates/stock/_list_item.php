<tr>
  <td><?= $material->CatalogNumber() ?></td>  
  <td><?= $material->Name() ?></td>
  <td class="total-material">
    <i class="fa fa-minus-circle" aria-hidden="true" onclick="showCreateMoveModal(<?=MOVE_TYPE_REMOVE?>,<?= $material->ID()?>, '<?= $material->Name()?>')"></i>
    <span><?= $material->TotalCount() ?></span>
    <i class="fa fa-plus-circle" aria-hidden="true" onclick="showCreateMoveModal(<?=MOVE_TYPE_ADD?>,<?= $material->ID()?>, '<?= $material->Name()?>')"></i>    
  </td>
  <td>0</td>  
  <td><?= '$'. $material->PricePerUnit() / 100 ?></td>  
  <td>    
    <span class="label label-<?= $material->StatusLabel() ?>"><?= $material->StatusName() ?></span>
  </td>
  <td>
  	<a style="margin-left: 10px" href="/admin/inventario/<?= $material->ID()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green">Editar</a>
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-delete-<?= $material->ID()?>">Eliminar</a>    
  </td>

  <!-- Modal -->
  <div class="modal fade" id="modal-delete-<?= $material->ID()?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Desea eliminar <?= $material->Name()?>?</h4>
        </div>
        <div class="modal-body">
        <br>
        <img src="<?= $material->Path() ?>" style="width:100%; margin-bottom:15px;">
          <form action="/admin/inventario/borrar/<?= $material->ID()?>" method="post">
          	<input type="submit" class="btn btn-info btn-sm btn-fill btn-uabc-green" value="Borrar" style="float:right">
            <br>
          </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>


</tr>