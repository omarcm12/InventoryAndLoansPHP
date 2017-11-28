<tr>
  <td><?= $material->CatalogNumber() ?></td>  
  <td><?= $material->Name() ?></td>
  <td><?= $material->TotalCount() ?> </td>
  <td><?= $material->BorrowedCount() ?> </td>
  <td>
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-ver-foto-<?= $material->ID()?>">Ver foto</a> 
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" onclick="$('#add-material-<?= $material->ID() ?>').submit()" <?= $loan->isInMaterials($material) ? 'disabled' : ''?>>Agregar</a>    
    
    <form id="add-material-<?= $material->ID() ?>" action="/alumnos/prestamo/agregar-material" method="post" style="display:none">
      <input id="move-id-loan" name="loan_material[id-loan]" type="hidden" value="<?= $loan->ID()?>">
      <input id="move-id-material" name="loan_material[id-material]" type="hidden" value="<?= $material->ID()?>">
      <input id="move-amount" name="loan_material[amount]" type="hidden" value="1">
      <br>
    </form>
  </td>
</tr>

<!-- Modal -->
  <div class="modal fade" id="modal-ver-foto-<?= $material->ID()?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $material->Name()?></h4>
        </div>
        <div class="modal-body">
        <br>
        <img src="<?= $material->Path() ?>" style="width:100%; height:400px;  margin-bottom:15px;">  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div> 
