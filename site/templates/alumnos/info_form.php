<input type="hidden" name="utf8" value="✓" />
<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nombre(s)</label>
            <input type="text" class="form-control" name="student[full_name]" id="student_catalog_number" value="<?= $student->Name() ?>" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" class="form-control" name="student[full_name]" id="student_catalog_number" value="<?= $student->LastName() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Correo UABC</label>
            <input type="text" class="form-control" name="student[email]" id="student_name" value="<?= $student->Email() ?>" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Matricula</label>
            <input type="text" class="form-control" name="student[enrollment]" id="student_name" value="<?= $student->Enrollment() ?>" >
        </div>
    </div>                            
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Carrera</label>
            <input type="text" class="form-control" name="student[carrer]" id="student_carrer" value="<?= $student->Carrer() ?>" >
        </div>
    </div>                            
    <div class="col-md-6">
        <div class="form-group">
            <label>Semestre</label>
            <input type="number" class="form-control" name="student[semester]" id="student_semester" value="<?= $student->Semester() ?>" >
        </div>
    </div>                            
</div>

