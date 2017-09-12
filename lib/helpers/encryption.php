<?php

if(count(get_included_files()) == 1) exit("Direct access not permitted.");

class EncryptionHelper {
  public static function Decrypt($data, $key, $iv) {
    return EncryptionHelper::PKCS7UnpadData(openssl_decrypt($data, 'AES-256-CBC', base64_decode($key), 0, base64_decode($iv)));
  }

  public static function Encrypt($data, $key, $iv) {
    return openssl_encrypt(EncryptionHelper::PKCS7PadData($data, 16), 'AES-256-CBC', base64_decode($key), 0, base64_decode($iv));
  }

  public static function GenerateIV($iv_size = 16) { // 128 bits
    return base64_encode(openssl_random_pseudo_bytes($iv_size, $strong));
  }

  public static function GenerateKey($key_size = 32) { // 256 bits
    return base64_encode(openssl_random_pseudo_bytes($key_size, $strong));
  }

  public static function GenerateRandomHexString($length = 32) {
    $length = intval($length / 2);
    return bin2hex(openssl_random_pseudo_bytes($length));
  }

  public static function PKCS7PadData($data, $size) {
    $length = $size - strlen($data) % $size;
    return $data . str_repeat(chr($length), $length);
  }

  public static function PKCS7UnpadData($data) {
    return substr($data, 0, -ord($data[strlen($data) - 1]));
  }
}

?>
