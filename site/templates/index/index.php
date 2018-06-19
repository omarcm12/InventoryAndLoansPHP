<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header_login.php');
?>
<div class="wrapper wrapper-login">
	<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/_flash.php'); ?>
<!-- BEGIN LOGIN FORM -->
<br><br><br><br>
<div class="container">
	<div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
		<div class="login-screen">
			<h4>Iniciar Sesión</h4>
			<img src="<?= BASE_IMAGE_ASSETS_PATH ?>logo-small.png" width="100">
			<br>
			<h4>Bienvenido</h4>					
			<a href="<?= $url ?>"> 
				<img class="img-responsive" src="<?= BASE_IMAGE_ASSETS_PATH ?>1x.png" style="display: block;width: 210px;margin: 40px auto;">
			</a>  
			
		</div>
	</div>
</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>