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
				<img src="<?= BASE_IMAGE_ASSETS_PATH ?>logo-small.png" width="50">
				<br>
				<br>
				<br>
				<h3>Bienvenido</h3>					
				<a href="<?= $url ?>"> 
					<img src="<?= BASE_IMAGE_ASSETS_PATH ?>1x.png" style="display: block;width: 210px;margin: 40px auto;">
				 </a>  
				
			</div>
		</div>
	</div>
</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>