<tr>
  <td><?= $student->Enrollment()?></td>
  <td><?= $student->FullName()?></td>  
  <td><?= $student->Email()?></td>
  <td><?= $student->Carrer()?></td>
  <?php   if ( ($var = CountWithIDStudent($student->ID()) ) > 1) {?>  
  
  <td> <?= $var ?> </td>
  
  <?php } else { ?>
  	<td> 0 </td>
	<?php } ?>
  <td><span class="label label-<?= $student->StatusLabel() ?>"><?= $student->StatusName() ?></span></td>   
    
  <td><a type="button" href="/admin/prestamos/?s=<?= $student->Enrollment()?>" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Ver Prestamos</a>
<a class="btn btn-info btn-sm btn-fill btn-uabc-green" data-toggle="modal" data-target="#modal-pay-<?= $student->ID()?>">Editar</a>
  </td>
</tr>


<!-- Modal -->
  <div class="modal fade" id="modal-pay-<?= $student->ID()?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar informacion Alumno</h4>
        </div>
        <div class="modal-body">
        <form id="create-move-form" method="post" action="/admin/alumnos/actualizar/<?= $student->ID() ?>" >
          <div class="row">
          <label>Alumno</label>
            <input id="material-name" type="text" class="form-control" value="<?= $student->FullName() ?>" disabled>
          </div>

          <div class="row">
          <label>Carrera - Semestre</label>
            <input id="material-name" type="text" class="form-control" value="<?= $student->Carrer() ?> - <?= $student->Semester() ?>" disabled>
          </div>
          <div class="row">
            <label>Estado</label>
          </div>
          <div class="row">
            <div class="col-md-3">
            <label>Dado de baja</label>
              <input name="student[baja]" type="hidden" class="list-checkbox" value="0">
                  <?php if ($student->Status() == 0 ):?>
                    <input id="baja-<?= $student->ID()?>" onclick="fun1(<?= $student->ID()?>)" name="student[baja]" type="checkbox" class="list-checkbox" value="1" checked>
                  <?php else: ?>
                  <input id="baja-<?= $student->ID()?>" onclick="fun1(<?= $student->ID()?>)" name="student[baja]" type="checkbox" class="list-checkbox" value="1">
                    <?php endif ?>
            </div>
            <div class="col-md-3">
              <label>Alumno activo</label>
              <input name="student[active]" type="hidden" class="list-checkbox" value="0">
                    <?php if ($student->Status() == 1 ):?>
                    <input id="activo-<?= $student->ID()?>" onclick="fun2(<?= $student->ID()?>)" name="student[active]" type="checkbox" class="list-checkbox" value="1" checked>
                    <?php else: ?>
                      <input id="activo-<?= $student->ID()?>" onclick="fun2(<?= $student->ID()?>)" name="student[active]" type="checkbox" class="list-checkbox" value="1">
                    <?php endif ?>
            </div>
            <div class="col-md-3">
              <label>EP</label>
              <input name="student[ep]" type="hidden" class="list-checkbox" value="0">
                    <?php if ($student->Status() == 2 ):?>
                    <input id="ep-<?= $student->ID()?>" onclick="fun3(<?= $student->ID()?>)" name="student[ep]" type="checkbox" class="list-checkbox" value="1" checked>
                    <?php else: ?>
                      <input id="ep-<?= $student->ID()?>" onclick="fun3(<?= $student->ID()?>)" name="student[ep]" type="checkbox" class="list-checkbox" value="1">
                    <?php endif ?>
            </div>
          </div>
          <div class="row">
            <label>Servicio social</label>
          </div>
          <div class="row">
          <div class="col-md-3">
            <label>Si</label>
              <input name="student[service]" type="hidden" class="list-checkbox" value="0">
                    <?php if ($student->IsStudent() == 0 ):?>
                    <input id="yes-<?= $student->ID()?>" onclick="serv1(<?= $student->ID()?>)" name="student[service]" type="checkbox" class="list-checkbox" value="1" checked>
                  <?php else: ?>
                  <input id="yes-<?= $student->ID()?>" onclick="serv1(<?= $student->ID()?>)" name="student[service]" type="checkbox" class="list-checkbox" value="1">
                    <?php endif ?>
            </div>
            <div class="col-md-3">
              <label>No</label>
              <input name="student[notService]" type="hidden" class="list-checkbox" value="0">
                    <?php if ($student->IsStudent() == 1 ):?>
                    <input id="no-<?= $student->ID()?>" onclick="serv2(<?= $student->ID()?>)" name="student[notService]" type="checkbox" class="list-checkbox" value="1" checked>
                    <?php else: ?>
                      <input id="no-<?= $student->ID()?>" onclick="serv2(<?= $student->ID()?>)" name="student[notService]" type="checkbox" class="list-checkbox" value="1">
                    <?php endif ?>
            </div>  
          </div>
          <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin-left: 5px; margin-top:15px;">Guardar Cambios</button>
        </form>
        </div>
        
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-info btn-sm btn-fill btn-uabc-green" data-dismiss="modal">Cancelar</button>-->
      </div>
      
    </div>
  </div>
</div>