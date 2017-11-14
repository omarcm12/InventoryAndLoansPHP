<div class="modal fade" id="create-move-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Añadir Piezas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="create-move-form" method="post">
          <label>Material</label>
          <input type="text" placeholder="Title" class="form-control" value="<?= $material->CatalogNumber(). " - " .$material->Name()?>" disabled>                            
          <label>Número de orden</label>
          <input id="txtTitleEdit" name="move[no-order]" type="text" class="form-control">
          <label>Número de piezas</label>
          <input id="txtTitleEdit" name="move[]" type="text" class="form-control">
          <label>Descripción</label>
          <textarea class="form-control" id="txtMesEdot" type="text" placeholder="(Opcional)" class="form-control"></textarea>          
          <input id="move-material-id" name="move[id_material]" type="hidden" value="">
          <input id="move-type" name="move[type]" type="hidden">
        </form>

      </div>
      <div class="modal-footer">
        <a class="btn btn-info btn-sm btn-fill btn-uabc-green" onclick="createMove()">Guardar Movimiento</a>
        <button type="button" class="btn btn-info btn-sm " data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>