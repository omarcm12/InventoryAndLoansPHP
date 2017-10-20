<?php /* controllers/admin/transactions/create */

$material = new Material();

$postParams = $BASE->PostParam('material');
if (empty($postParams)) { $postParams = []; }

$material->name = $postParams['name'];
$material->description = $postParams['description'];
$material->total_count = $postParams['total_count'];
$material->catalog_number = $postParams['catalog_number'];
$material->price_per_unit = $postParams['price_per_unit'];


if ($material->Valid() && $material->Create()) {			

  if (array_key_exists('image', $_FILES) && array_key_exists('filename', $_FILES['image']['name'])) {
    if (!imagesUploadFolderIsWriteable()) {
      $BASE->Session()->SetFlash(['danger' => 'Uploads folder must be writeable for images to be uploaded.']);
      $BASE->Response()->RedirectAndExit('/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
    }

    if ($_FILES['image']['error']['filename'] > 0) {
      $BASE->Session()->SetFlash(['danger' => 'Error uploading image.']);
      $BASE->Response()->RedirectAndExit('/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
    }

    $found = false;
    $whitelist = array(".jpg", ".jpeg", ".png", ".gif");
    foreach ($whitelist as $ext) {
      if(preg_match("/$ext\$/i", $_FILES['image']['name']['filename'])) {
        $found = true;
        break;
      }
    }

    if (!$found || !getimagesize($_FILES['image']['tmp_name']['filename'])) {
      $BASE->Session()->SetFlash(['warning' => 'Uploaded file must be an image (jpeg, png, gif).']);
      $BASE->Response()->RedirectAndExit('/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
    }

    $name = $_FILES['image']['name']['filename'];
    //$sha1_slug = sha1_file($_FILES["image"]["tmp_name"]['filename']);    
    //$filename = $sha1_slug . '.' . pathinfo($name, PATHINFO_EXTENSION);
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
      $BASE->Session()->SetFlash(['danger' => 'Error storing uploaded image. Verify folder permissions.']);
      $BASE->Response()->RedirectAndExit('/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);
    } else {      
      chmod($material->LocalPath(), BASE_UPLOADS_IMAGE_PERMISSION);
      $material->Update();
    }
  }

  	$BASE->Session()->SetFlash(['success' => 'Material creado.']);
  	$BASE->Response()->RedirectAndExit('/inventario/', BASE_RESPONSE_REDIRECT_OTHER);
}

$BASE->Session()->SetFlash(['danger' => 'Error guardando el material.']);
$BASE->Response()->RedirectAndExit('/inventario/nuevo', BASE_RESPONSE_REDIRECT_OTHER);

?>
