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
					<h1>Iniciar Sesión</h1>
				</div>
				<img src="<?= BASE_IMAGE_ASSETS_PATH ?>logo.png" width="50">
				<br>
				<form method="post" action="/login" accept-charset="UTF-8">
				<div class="login-form">
					<div class="control-group">
					<input type="text" class="login-field" name="login[email]" placeholder="Correo @uabc.edu.mx" id="login-name">
					<label class="login-field-icon fui-user" for="login-name"></label>
					</div>

					<div class="control-group">
					<input type="password" class="login-field" name="login[pass]" placeholder="Contraseña" id="login-pass">
					<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>

					<button type="submit" id="btn-login" class="btn btn-primary btn-large btn-block">Iniciar</button>						
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>