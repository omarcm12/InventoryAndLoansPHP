<tr>
  <td><?= $penalty->ID() ?></td> 
  <td><?= $penalty->LoanMaterial()->ID() ?></td>  
  <td><?= $penalty->Student()->Enrollment()?> - <?= $penalty->Student()->FullName() ?></td>
  <td><?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?></td>
  <td><?= $penalty->Pieces() ?>/<?= $penalty->Days() ?></td>
  <td>$<?= $penalty->Amount() ?></td>
  <td><?= $penalty->LoanMaterial()->AgeReturnAt()?></td>
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
        <form id="create-move-form" method="post" action="/admin/pagos/nuevo/<?= $penalty->ID() ?>" >
          <div class="row">
          <label>Material</label>
            <input id="material-name" type="text" class="form-control" value="<?= $penalty->Material()->CatalogNumber() ?>-<?= $penalty->Material()->Name() ?>">
          </div>
          <div class="row">                            
          <label>Alumno</label>
            <input name="student" type="text" class="form-control" value="<?= $penalty->Student()->Enrollment()?> - <?= $penalty->Student()->FullName() ?>">
          </div>
          <div class="row">
            <div class="col-md-6">
            <label>Multa $</label>
            <input name="payment[amount]" type="text" class="form-control" value="<?= $penalty->Amount() ?>">
            </div>
            <div class="col-md-6">
            <label>Pagar $</label>
            <input name="payment[amount_payd]" type="text" class="form-control" value="<?= $penalty->Amount() ?>">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
            <label>Número de piezas</label>
              <input name="pieces" type="text" class="form-control" value="<?= $penalty->Pieces() ?>">
            </div>
            <div class="col-md-6">
              <label>Saldar piezas</label>
              <input name="payment[deliver]" type="hidden" class="list-checkbox" value="0">
                    <input name="payment[deliver]" type="checkbox" class="list-checkbox" value="1">
            </div>
          </div>

          <label>Descripción</label>
          <textarea class="form-control" type="text" name="payment[description]" placeholder="(Opcional)" class="form-control"></textarea>          
          <input name="payment[id_student]" type="hidden" value="<?= $penalty->Student()->ID() ?>">
          <input name="payment[id_material]" type="hidden" value="<?= $penalty->Material()->ID() ?>">
          <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin-left: 5px; margin-top:15px;">Guardar Pago</button>
        </div>
        </form>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>-->
      </div>
      
    </div>
  </div>