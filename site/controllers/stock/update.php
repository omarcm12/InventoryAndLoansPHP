<?php /* controllers/site/stock/update */

if ($BASE->Session()->LoggedOut()) {
  $BASE->Response()->RedirectAndExit('/', BASE_RESPONSE_REDIRECT_OTHER);
}

$material = FetchMaterialWithID($BASE->RouteParam(0));
if (empty($material)) {
  $BASE->Response()->ExitWithNotFound('Material no encontrado.', 'Material: ' . $BASE->RouteParam(0));
}

$postParams = $BASE->PostParam('material');
if (empty($postParams)) { $postParams = []; }

$material->name = $postParams['name'];
$material->description = $postParams['description'];
$material->stock_count = $postParams['stock_count'];
$material->stock_min = $postParams['stock_min'];
$material->stock_max = $postParams['stock_max'];
$material->catalog_number = $postParams['catalog_number'];
$material->price_per_unit = $postParams['price_per_unit'] * 100;

$has_image = false;  
if (array_key_exists('image', $_FILES) && array_key_exists('filename', $_FILES['image']['name'])) {
	if (!imagesUploadFolderIsWriteable()) {
	  $BASE->Session()->SetFlash(['danger' => 'Uploads folder must be writeable for images to be uploaded.']);
	  $BASE->Response()->RedirectAndExit('/admin/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
	}

	$has_image = $_FILES['image']['error']['filename'] == 0;
}

if($has_image){    
	$found = false;
	$whitelist = array(".jpg", ".jpeg", ".png", ".gif");
	foreach ($whitelist as $ext) {
	  if(preg_match("/$ext\$/i", $_FILES['image']['name']['filename'])) {
	    $found = true;
	    break;
	  }
	}

	if (!$found || !getimagesize($_FILES['image']['tmp_name']['filename'])) {
	  $BASE->Session()->SetFlash(['warning' => 'Los formatos de imagen permitidos solo son (jpeg, png, gif).']);
	  $BASE->Response()->RedirectAndExit('/admin/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
	}

	$name = $_FILES['image']['name']['filename'];
	$material->image_path = $name;

	$components = explode('/', $material->Folder());
	$upload_folder = rtrim(BASE_UPLOADS_FOLDER, '/');
	foreach ($components as $component) {
	  if (empty($component)) { continue; }

	  $upload_folder = join('/', [$upload_folder, $component]);
	  if (!is_dir($upload_folder . '/')) {
	    mkdir($upload_folder . '/', BASE_UPLOADS_FOLDER_PERMISSION, true);
	  }
	  chmod($upload_folder . '/', BASE_UPLOADS_FOLDER_PERMISSION);
	}

	if (!move_uploaded_file($_FILES['image']['tmp_name']['filename'], $material->LocalPath())) {
	  $BASE->Session()->SetFlash(['danger' => 'Error guardando imagen. Revise los permisos del folder']);
	  $BASE->Response()->RedirectAndExit('/admin/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
	} else {      
	  chmod($material->LocalPath(), BASE_UPLOADS_IMAGE_PERMISSION);
	  $material->Update();
	}
}

if ($material->Valid() && $material->Update()) {
  $BASE->Session()->SetFlash(['success' => 'Material actualizado.']);
} else {
  $BASE->Session()->SetFlash(['danger' => 'Error actualizando Material.']);
}

$BASE->Response()->RedirectAndExit('/admin/inventario/' . $material->ID(), BASE_RESPONSE_REDIRECT_OTHER);

?>
