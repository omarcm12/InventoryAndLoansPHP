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
                    <form>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control"  >
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="text" class="form-control"  >
                                </div>
                            </div>                            
                        </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea rows="5" class="form-control"  ></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Crear material</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>        

    </div>
</div>
</div>


<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>