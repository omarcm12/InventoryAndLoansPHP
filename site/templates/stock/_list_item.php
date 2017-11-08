<tr>
  <td><?= $material->CatalogNumber() ?></td>  
  <td><?= $material->Name() ?></td>
  <td><?= $material->TotalCount() ?></td>
  <td>0</td>
  <td><?= '$'. $material->PricePerUnit() / 100 ?></td>  
  <td>
  	<a href="/admin/inventario/<?= $material->ID()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green">Editar</a>
  	<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-delete-<?= $material->ID()?>">Eliminar</a>
    
    <a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#AddMaterial" data-toggle="tooltip" title="Añadir piezas">
    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
    </a>
     
     <a type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#deleteMaterial" data-toggle="tooltip" title="Quitar piezas">
    <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
    </a>

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

<!-- Modal add material -->

<div class="modal fade" id="AddMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Añadir piezas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/inventario/movimientos/new/<?= $material->ID()?>" method="post">
        <label>Material</label>
        <input id="txtTitleEdit" name="move[]" type="text" placeholder="Title" class="form-control" value="<?= $material->Name()?>" disabled>
        <label>Numero de catalogo</label>
        <input id="txtTitleEdit" name="move[catalog_number_material]" type="text" placeholder="Title" class="form-control" value="<?= $material->CatalogNumber()?>" disabled>
        <label>Usuario</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Title" class="form-control" value="El brayan" disabled>
        <label>Tipo</label>
        <input id="txtTitleEdit" name="type" type="text" placeholder="Title" class="form-control" value="Alta" disabled>
        <label>Numero de orden</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Numero de orden" class="form-control">
        <label>Numero de piezas</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Numero de piezas" class="form-control">
        <label>Descripcion</label>
        <textarea class="form-control" id="txtMesEdot" type="text" placeholder="Descripcion (opcional)" class="form-control"></textarea>
        <br>
        <input type="submit" class="btn btn-info btn-sm btn-fill btn-uabc-green" value="Guardar movimiento" style="float:right">
        <br>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal delete material -->

<div class="modal fade" id="deleteMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Eliminar piezas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/inventario/movimientos/new/<?= $material->ID()?>" method="post">
        <label>Material</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Title" class="form-control" value="<?= $material->Name()?>" disabled>
        <label>Numero de catalogo</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Title" class="form-control" value="<?= $material->CatalogNumber()?>" disabled>
        <label>Tipo</label>
        <label>Usuario</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Title" class="form-control" value="El Brayan" disabled>
        <label>Tipo</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Title" class="form-control" value="Baja" disabled>
        <label>Numero de orden</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Numero de orden" class="form-control">
        <label>Numero de piezas</label>
        <input id="txtTitleEdit" name="name" type="text" placeholder="Numero de piezas" class="form-control">
        <label>Descripcion</label>
        <textarea class="form-control" id="txtMesEdot" type="text" placeholder="Descripcion (opcional)" class="form-control"></textarea>
        <br>
        <input type="submit" class="btn btn-info btn-sm btn-fill btn-uabc-green" value="Guardar movimiento" style="float:right">
        <br>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-sm btn-fill btn-uabc-green" onClick="updateMessage()" data-dismiss="modal" >Guardar movimiento</button>
        <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

</tr>