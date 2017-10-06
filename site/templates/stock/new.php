<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>


<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="header">
                    <h4 class="title">Nuevo material</h4>
                </div>
                <div class="content">
                    <form method="post" action="/inventario" accept-charset="UTF-8">
                        <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'stock/_form.php'); ?>         
                        <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green">Crear material</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>        

    </div>
</div>
</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>