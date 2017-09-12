<?php /* templates/admin/sessions/new */
require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php');
?>
<!-- BEGIN LOGIN FORM -->
<div class="login-form">
	<div class="content">
	   	<div class="box-colored bg-white">
	    	<h3 class="sesion-title text-center">Prueba</h3>
			<form  action="/create" method="post" accept-charset="UTF-8">
		  		<div class="form-body">
		  			<div class="row">
			    		 <div class="col-xs-12">
							<div class="form-group">
							  <input type="text" class="inputMaterial form-control" name="register[name]" value="<?= $register->Name() ?>"  required/>
					        <label class="magic-placeholder">Nombre</label>
							</div>
						</div>
					</div>
					<div class="row">
			    		 <div class="col-xs-12">
							<div class="form-group">
							  <input type="text" class="inputMaterial form-control" name="register[last_name]" value="<?= $register->LastName() ?>"  required/>
					        <label class="magic-placeholder">Apellidos</label>
							</div>
						</div>
					</div>
				    <div class="row">
			    		 <div class="col-xs-12">
							<div class="form-group">
							<input type="text" class="inputMaterial form-control" name="register[email]" value="<?= $register->Email() ?>"  required/>
					        <label class="magic-placeholder"><?= faIconGreen('envelope');?> Email</label>
							</div>
						</div>
					</div>												       
	      		</div>  
			</form>
	   </div>	   
	</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>