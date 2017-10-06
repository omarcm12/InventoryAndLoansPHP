<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/header.php'); ?>
<body class="page-404-full-page">
<div class="row">
	<div class="col-md-12 page-404">
		<div class=" number">404</div>
		<div class=" details">
			<h3><?= $message ?></h3>
			<p>
				<?= $detail ?>
        <br/><br/>
			</p>
		</div>
	</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'shared/footer.php'); ?>
