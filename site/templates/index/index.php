<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<div class="wrapper wrapper-login">
<!-- BEGIN LOGIN FORM -->
<div class="login-form">
	<div class="content">
	   	<div class="login">
			<div class="login-screen">
				<div class="app-title">
					<h1>Iniciar Sesión</h1>
				</div>
				<img src="<?= BASE_IMAGE_ASSETS_PATH ?>logo.png" width="50">
				<br>
				<div class="login-form">
					<div class="control-group">
					<input type="text" class="login-field" value="" placeholder="Correo @uabc.edu.mx" id="login-name">
					<label class="login-field-icon fui-user" for="login-name"></label>
					</div>

					<div class="control-group">
					<input type="password" class="login-field" value="" placeholder="Contraseña" id="login-pass">
					<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>

					<a class="btn btn-primary btn-large btn-block" href="/menu">Iniciar</a>
						
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>