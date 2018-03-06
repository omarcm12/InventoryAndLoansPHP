<input type="hidden" name="utf8" value="✓" />
<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Núm. Catálogo</label>
            <input type="text" class="form-control" name="material[catalog_number]" id="material_catalog_number" value="<?= $material->CatalogNumber() ?>" >
        </div>
    </div>  
    <div class="col-md-6">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" name="material[name]" id="material_name" value="<?= $material->Name() ?>" >
        </div>
    </div>                           
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Cantidad 
              <?php if (isset($is_edit)): ?>
                <a href="/admin/movimientos?s=<?= $material->CatalogNumber() ?>"><small>(Ver Movimientos)</small></a>
              <?php endif ?>              
            </label>
            <input type="number" class="form-control" name="material[total_count]" id="material_total_count" value="<?= $material->TotalCount() ?>" >
        </div>
    </div>                            
    <div class="col-md-6">
        <div class="form-group">
            <label>Costo</label>
            <input type="text" class="form-control" name="material[price_per_unit]" id="material_price_per_unit" value="<?= $material->PricePerUnit() / 100 ?>" >
        </div>
    </div>                            
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Minimo</label>
            <input type="number" class="form-control" name="material[stock_min]" id="material_count_min" value="<?= $material->StockMin() ?>" >
        </div>
    </div>                            
    <div class="col-md-6">
        <div class="form-group">
            <label>Maximo</label>
            <input type="text" class="form-control" name="material[stock_max]" id="material_count_min" value="<?= $material->StockMax() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Dias de prestamo</label>
            <input type="text" class="form-control" name="material[days]" id="material_type" value="<?= $material->Days() ?>" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea rows="5" class="form-control" name="material[description]" id="material_description" value="" ><?= $material->Description() ?></textarea>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-md-3">Imagen</label>
            <div class="col-md-9">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width:300px;height:100px;">
                  <img src="<?= $material->Path() ?>" data-toggle="modal" data-target="#myModal">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="maxwidth:300px;maxheight:100px;">
                </div>
                <div>
                  <span class="btn default btn-file">
                  <span class="fileinput-new">Seleccionar Imagen</span>
                  <span class="fileinput-exists">Cambiar Imagen</span>
                  <input type="file" accept="image/*" name="image[filename]" id="image_filename">
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $material->image_path ?></h4>
        </div>
        <div class="modal-body" style="text-align:center">
          <img src="<?= $material->Path() ?>" style="max-width:100%;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
