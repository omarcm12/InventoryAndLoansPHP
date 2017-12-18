<input type="hidden" name="utf8" value="✓" />
<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nombre(s)</label>
            <input type="text" class="form-control" name="user[full_name]" id="user_catalog_number" value="<?= $user->Name() ?>" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" class="form-control" name="user[full_name]" id="user_catalog_number" value="<?= $user->LastName() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Correo UABC</label>
            <input type="text" class="form-control" name="user[email]" id="user_name" value="<?= $user->Email() ?>" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Matricula</label>
            <input type="text" class="form-control" name="user[email]" id="user_name" value="<?= $user->Name() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Carrera</label>
            <input type="text" class="form-control" name="user[carrer]" id="user_carrer" value="<?= $user->Carrer() ?>" >
        </div>
    </div>                            
    <div class="col-md-6">
        <div class="form-group">
            <label>Semestre</label>
            <input type="number" class="form-control" name="user[semester]" id="user_semester" value="<?= $user->Semester() / 100 ?>" >
        </div>
    </div>                            
</div>

