<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php'); ?>
<body class="page-404-full-page">
<div class="row">
	<div class="col-sm-2 col-sm-offset-5 page-404">
		<img src="/assets/imgs/sadflask.png" class="img-responsive" >
		<div class=" details" style="text-align: center;">
			<h3><?= $message ?></h3>
			<p>
				<?= $detail ?>
        <br/><br/>
			</p>
		</div>
	</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>
