<tr>
  <td><?= $move->NoOrder() ?></td> 
  <td><?= $move->CatalogNumberMaterial() ?></td>  
  <td><?= $move->Type() ?></td>
  <td><?= $move->IdUser() ?></td>
  <td>0</td>
  <td><?= '$'. $move->PricePerUnit() / 100 ?></td>  
  <td>
  	<a href="/admin/inventario/movimientos/<?= $move->ID()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green">Editar</a>
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-delete-<?= $move->ID()?>">Eliminar</a>
  </td>

  <!-- Modal -->
  <div class="modal fade" id="modal-delete-<?= $move->ID()?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Desea eliminar <?= $move->Name()?>?</h4>
        </div>
        <div class="modal-body">
        <br>
        <img src="<?= $move->Path() ?>" style="width:100%; margin-bottom:15px;">
          <form action="/admin/inventario/movimientos/borrar/<?= $move->ID()?>" method="post">
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