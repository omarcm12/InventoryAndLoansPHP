<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header_login.php');
?>
<div class="wrapper wrapper-login">
	<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/_flash.php'); ?>
<!-- BEGIN LOGIN FORM -->
<div class="login-form">
	<div class="content">
	   	<div class="login">
			<div class="login-screen">
				<div class="app-title">
					<h1>Registro</h1>
				</div>
				<img src="<?= BASE_IMAGE_ASSETS_PATH ?>logo.png" width="50">
				<br>
				<form  method="post" action="/admin/alumnos" class="singupform" style="padding: 20px;">
                    <div class="form-group float-label-control">
                        <input type="text" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group float-label-control">
                        <input type="text" class="form-control" placeholder="Carrera">
                    </div>
                    <div class="form-group float-label-control">
                        <input type="text" class="form-control" placeholder="Apellido">
                    </div>
                    <div class="form-group float-label-control">
                        <input type="password" class="form-control" placeholder="correo@uabc.edu.com">
                    </div>
                    <div class="form-group float-label-control">
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" id="btn-login" class="btn btn-primary btn-large btn-block" >Registrar</button>
                </form>
			</div>
		</div>
	</div>
</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>