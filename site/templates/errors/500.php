<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'errors/_header.php'); ?>
<body class="page-500-full-page">
<div class="row">
	<div class="col-md-12 page-500">
		<div class=" number">500</div>
		<div class=" details">
			<h3>Oops! Something went wrong.</h3>
			<p>
				<strong><?= $message ?></strong>
        <br/>
				<?= $detail ?>
        <br/><br/>
			</p>
		</div>
	</div>
</div>
<?php require_once(BASE_SECTION_TEMPLATES_FOLDER . 'errors/_footer.php'); ?>
