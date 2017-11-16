<div class="modal fade" id="create-move-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="move-modal-title" class="modal-title">Añadir Piezas</h4>        
      </div>
      <div id="move-response-message" class="api-message label-danger" style="display:none;">Error</div>
      <div class="modal-body">
        <form id="create-move-form" method="post">
          <label>Material</label>
          <input id="material-name" type="text" class="form-control" disabled>                            
          <label>Número de orden</label>
          <input name="move[no-order]" type="text" class="form-control">
          <label>Número de piezas</label>
          <input name="move[pieces]" type="text" class="form-control">
          <label>Descripción</label>
          <textarea class="form-control" type="text" name="move[description]" placeholder="(Opcional)" class="form-control"></textarea>          
          <input id="move-material-id" name="move[id_material]" type="hidden" value="">
          <input id="move-type" name="move[type]" type="hidden">
        </form>

      </div>
      <div class="modal-footer">
        <a id="btn-create-move" class="btn btn-info btn-sm btn-fill btn-uabc-green" onclick="createMove()">Guardar Movimiento</a>
        <button type="button" class="btn btn-info btn-sm " data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>