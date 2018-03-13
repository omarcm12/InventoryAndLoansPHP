<?php /* templates/admin/sessions/new */


require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>


<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="header">
                    <h4 class="title">Configuraiones</h4>
                </div>
                <div class="content">
                    <form method="post" action="configuraciones/actualizar" accept-charset="UTF-8" enctype="multipart/form-data">
                        <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'configuration/_formEdit.php'); ?>
                        <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green">Actualizar Configuraciones</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>        

    </div>
</div>
</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>