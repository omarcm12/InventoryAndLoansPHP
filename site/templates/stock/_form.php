<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Núm. Catálogo</label>
            <input type="text" class="form-control" name="material[catalog_number]" id="material_catalog_number" value="<?= $material->CatalogNumber() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" name="material[name]" id="material_name" value="<?= $material->Name() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Cantidad</label>
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
    <div class="col-md-12">
        <div class="form-group">
            <label>Descripción</label>
            <textarea rows="5" class="form-control" name="material[description]" id="material_description" value="" ><?= $material->Description() ?></textarea>
        </div>
    </div>
</div>
