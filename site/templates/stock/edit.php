<?php /* templates/admin/sessions/new */

$custom_css_plugins = [
  'bootstrap-fileinput/bootstrap-fileinput.css'
];
$custom_js_plugins = [
  'bootstrap-fileinput/bootstrap-fileinput.js',
];

require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>


<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="header">
                    <h4 class="title">Editar Material - <small><?= $material->CatalogNumber() ?></small></h4>
                </div>
                <div class="content">
                    <form method="post" action="/admin/inventario/<?= $material->ID() ?>" accept-charset="UTF-8" enctype="multipart/form-data">
                        <?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'stock/_form.php'); ?>
                        <a type="button" href="/admin/inventario" class="btn btn-info btn-fill pull-right btn-uabc-green" style = "margin-left: 10px" >Cancelar</a>
                        <button type="submit" class="btn btn-info btn-fill pull-right btn-uabc-green">Actualizar Material</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>        

    </div>
</div>
</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>