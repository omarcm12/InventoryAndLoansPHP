
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?= BASE_PLUGIN_ASSETS_PATH ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?= BASE_PLUGIN_ASSETS_PATH ?>theme/js/light-bootstrap-dashboard.js"></script>

<?php
  if (empty($custom_js_plugins)) { $custom_js_plugins = []; }  
?>
<?php foreach ($custom_js_plugins as $js) { ?>
<script src="<?= BASE_PLUGIN_ASSETS_PATH . $js ?>" type="text/javascript"></script>
<?php } ?>

</body>
</html>
