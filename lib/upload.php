<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class Upload {
  public $filename;
  public $folder;

  public $prefix;

  public $private;
  public $whitelist;

  public $validate_image;

  public function BaseFolder() {
    return $this->isPrivate() ? BASE_PRIVATE_UPLOADS_FOLDER : BASE_UPLOADS_FOLDER;
  }

  public function BasePath() {
    return $this->isPrivate() ? BASE_PRIVATE_UPLOADS_PATH : BASE_UPLOADS_PATH;
  }

  public function CreateFolders() {
    $upload_folder = rtrim($this->BaseFolder(), '/');

    $components = explode('/', $this->Folder());
    foreach ($components as $component) {
      if (empty($component)) { continue; }

      $upload_folder = join('/', [$upload_folder, $component]);
      if (!is_dir($upload_folder . '/')) {
        mkdir($upload_folder . '/', BASE_UPLOADS_FOLDER_PERMISSION, true);
      }
      chmod($upload_folder . '/', BASE_UPLOADS_FOLDER_PERMISSION);
    }
  }

  public function isPrivate() {
    return (bool) $this->private;
  }

  public function Filename() {
    return $this->filename;
  }

  public function Folder() {
    if (empty($this->folder)) {
      $this->folder = strftime('%Y/%m/%d/', time());
      if (!empty($this->prefix)) { $this->folder = $this->prefix . '/' . $this->folder; }
    }

    return $this->folder;
  }

  public function LocalPath() {
    return $this->BaseFolder() . $this->Folder() . $this->Filename();
  }

  public function Path() {
    if (empty($this->filename)) { return ''; }

    return $this->BasePath() . $this->Folder() . rawurlencode($this->Filename());
  }

  public function UploadFile($scope, $identifier, $prefix = '') {
    $this->private = false;
    return $this->performFileUpload($scope, $identifier, $prefix);
  }

  public function UploadPrivateFile($scope, $identifier, $prefix = '') {
    $this->private = true;
    return $this->performFileUpload($scope, $identifier, $prefix);
  }

  public function ValidateImage() {
    if (is_null($this->validate_image)) { $this->SetValidateImage(true); }

    return !!$this->validate_image;
  }

  public function SetValidateImage($validate) {
    $this->validate_image = !!$validate;
  }

  public function Whitelist() {
    if (empty($this->whitelist) || !is_array($this->whitelist)) {
      $this->SetWhitelist($this->defaultWhitelist());
    }

    return $this->whitelist;
  }

  public function SetWhitelist($list) {
    $this->whitelist = $list;
  }

  function defaultWhitelist() {
    return array(".jpg", ".jpeg", ".png", ".gif");
  }

  function performFileUpload($scope, $identifier, $prefix = '') {
    $this->prefix = $prefix . '';

    if (!$this->uploadFolderIsWriteable()) { return -1; }
    if (!array_key_exists($scope, $_FILES) || !array_key_exists($identifier, $_FILES[$scope]['name'])) { return -2; }
    if ($_FILES[$scope]['error'][$identifier] > 0) { return -3; }

    $found = false;
    foreach ($this->Whitelist() as $ext) {
      if(preg_match("/$ext\$/i", $_FILES[$scope]['name'][$identifier])) {
        $found = true;
        break;
      }
    }
    if (!$found) { return -4; }

    if ($this->ValidateImage()) {
      if (!getimagesize($_FILES[$scope]['tmp_name'][$identifier])) { return -5; }
    }

    $this->filename = $_FILES[$scope]['name'][$identifier];

    $this->CreateFolders();

    if (!move_uploaded_file($_FILES[$scope]['tmp_name'][$identifier], $this->LocalPath())) { return -6; }
    chmod($this->LocalPath(), BASE_UPLOADS_IMAGE_PERMISSION);

    return $this->Path();
  }

  function uploadFolderIsWriteable() {
    return is_writable($this->BaseFolder());
  }

}

require_once(BASE_LIB_FOLDER . 'helpers/upload.php');
?>
