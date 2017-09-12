<?php

function uploadedFileMimeType($path) {
  $path = escapeshellarg($path);

  $mime = exec('file -b --mime-type ' . $path, $output, $returnCode);
  if ($returnCode === 0 && !empty($mime)) { return $mime; }

  return 'application/octet-stream';
}

function uploadedUserFilePath($path) {
  if (preg_match('/^\/admin\/uploads\/users\/\d+\//', $path)) {
    $path = preg_replace('/^\/admin\/uploads\/users\/(\d+)\/([\d\w\W]+)/', '/admin/visitors/${1}/uploads/${2}', $path);
  }
  return $path;
}

?>
