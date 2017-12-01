<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 
        <a href="/alumnos/adeudos" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin: 10px 14px;">Mis adeudos</a>
        <a href="/alumnos/historial_prestamos" class="btn btn-info btn-fill pull-right btn-uabc-green" style="margin: 10px 5px;">Mis prestamos</a>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="header">
                    <h4 class="title">Mi informacion</h4>
                </div>
                <div class="content">
                    <form method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                        <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'alumnos/info_form.php'); ?>
                        <a type="button" href="/alumno/inventario" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px;" >Cancelar</a>
                        <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin: 10px;">Actualizar </button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>        

    </div>
</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>