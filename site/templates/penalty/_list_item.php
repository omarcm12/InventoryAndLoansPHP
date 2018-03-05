<tr>
  <td><?= $penalty->ID() ?></td> 
  <td><?= $penalty->LoanMaterial()->ID() ?></td>  
  <td><?= $penalty->Student()->Enrollment()?> - <?= $penalty->Student()->FullName() ?></td>
  <td><?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?></td>
  <td><?= $penalty->Pieces() ?></td>
  <td>$<?= $penalty->Amount() ?></td>
  <td><?= $penalty->CreatedAtFormatted()?></td>
    <td>
    <a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-pay-<?= $penalty->ID()?>">Pagar</a>   
  </td>
</tr>

 <!-- Modal -->
  <div class="modal fade" id="modal-pay-<?= $penalty->ID()?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Saldar multa</h4>
        </div>
        <div class="modal-body">
        <form id="create-move-form" method="post">
          <label>Material</label>
          <input id="material-name" type="text" class="form-control" value="<?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?>">                            
          <label>Alumno</label>
          <input name="move[no-order]" type="text" class="form-control" value="<?= $penalty->Student()->Enrollment()?> - <?= $penalty->Student()->FullName() ?>">
          <label>Número de piezas</label>
          <input name="move[pieces]" type="text" class="form-control" value="<?= $penalty->Pieces() ?>">
          <label>Multa $</label>
          <input name="move[pieces]" type="text" class="form-control" value="<?= $penalty->Amount() ?>">
          <label>Pagar $</label>
          <input name="move[pieces]" type="text" class="form-control" value="<?= $penalty->Amount() ?>">
          <label>Descripción</label>
          <textarea class="form-control" type="text" name="move[description]" placeholder="(Opcional)" class="form-control"></textarea>          
          <input id="move-material-id" name="move[id_material]" type="hidden" value="">
          <input id="move-type" name="move[type]" type="hidden">
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>