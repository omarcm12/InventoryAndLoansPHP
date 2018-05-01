<div class="modal fade" id="modal-move-<?= $move->ID()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="move-modal-title" class="modal-title">
          Materialas - <?= $move->ID() ?>
        </h4>        
      </div>
      <div id="move-response-message" class="api-message label-danger" style="display:none;">Error</div>

        
      <div class="modal-body" style="overflow: scroll;height: 400px;">  
       Material - piezas <br>
      <?php foreach ($move->Materials() as $loan_material): ?>
                                   
        <?= $loan_material->Material()->CatalogNumber() . " - " . $loan_material->Material()->Name() . " - " . $loan_material->Amount()?>  <br>  
                                  
                                   
                
            <?php endforeach ?>  
            <?php if (count($move->Materials()) == 0): ?>
               <h4 class="text-center">Agrega los materiales de la lista.</h4>
            <?php endif ?>
      </div>
      <div class="modal-footer">
       <!-- <a id="btn-create-move" class="btn btn-info btn-sm btn-fill btn-uabc-green" onclick="$('#form-move-<?= $move->ID() ?>').submit()">Entregar</a>-->
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Aceptar</button>
      </div>
    </div>

  </div>
</div>


