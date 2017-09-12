<?php

$flash_keys = $BASE->Session()->Flash();

if (!empty($flash_keys)) {
?>
<!-- BEGIN PAGE FLASH-->
<div class="row">
	<div class="col-md-12">
    <?php foreach ($flash_keys as $flash_key => $flash_value) { ?>
		<div class="alert alert-<?= $flash_key ?>" role="alert"><?= $flash_value ?></div>
    <?php } ?>
	</div>
</div>
<!-- END PAGE FLASH-->
<?php
}

unset($flash_keys);
unset($flash_key);
unset($flash_value);
?>
