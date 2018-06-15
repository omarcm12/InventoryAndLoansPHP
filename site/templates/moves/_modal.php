<div class="modal fade" id="modal-<?= $move->ID()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="move-modal-title" class="modal-title">Regresar Materiales</h4>        
      </div>
      <div id="move-response-message" class="api-message label-danger" style="display:none;">Error</div>
      
      <div class="modal-body" style="overflow: scroll;height: 400px;">      
          <p><?= $move->Description() ?></p>

      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>