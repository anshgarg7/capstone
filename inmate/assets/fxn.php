<?php
require 'config.php';
// Encryption Decryption script;
//  e_d('e', $string) -- Encryption
//  e_d('d', $string) -- Decryption

class abCrypt
{
  /** @var string $key Hex encoded binary key for encryption and decryption */
  public $key = '';

  /** @var string $encrypt_method Method to use for encryption */
  public  $encrypt_method = 'AES-256-CBC';

  /**
   * Construct our object and set encryption key, if exists.
   *
   * @param string $encryption_key Users binary encryption key in HEX encoding
   */
  function __construct($encryption_key = false)
  {
    if ($key = hex2bin($encryption_key)) {
      $this->key = $key;
    } else {
      echo "Key in construct does not appear to be HEX-encoded...";
    }
  }

  public function encrypt($string)
  {
    // $new_iv = substr(bin2hex ( random_bytes ( openssl_cipher_iv_length ( $this->encrypt_method ) ) ),0,16);
    $new_iv = substr($GLOBALS['SecretIV'], 0, 16);

    if ($encrypted = base64_encode(openssl_encrypt($string, $this->encrypt_method, $this->key, 0, $new_iv))) {
      return $new_iv . ':' . $encrypted;
    } else {
      return false;
    }
  }

  public function decrypt($string)
  {
    $parts     = explode(':', $string);
    $iv        = $parts[0];
    $encrypted = $parts[1];

    if ($decrypted = openssl_decrypt(base64_decode($encrypted), $this->encrypt_method, $this->key, 0, $iv)) {
      return $decrypted;
    } else {
      return false;
    }
  }
}

function e_d($action, $string)
{
  if($string==''){
    return $string;
  }else{
    $hex_key = substr($GLOBALS['SecretIV'], 0, 16);
    # Initiate a new class object
    $abCrypt = new abCrypt($hex_key);
    if ($action == 'e') {
      return $abCrypt->encrypt($string);
    } else if ($action == 'd') {
      return $abCrypt->decrypt($string);
    }  
  }

}
// Databse Access functions
// Get Data from Database
function getThis($query, $log = TRUE)
{
  global $con, $_SESSION;
  $temp_q = $con->query($query);
  $result = [];
  $count = 0;
  while ($temp = $temp_q->fetch_assoc()) {
    $rs = [];
    foreach ($temp as $r => $value) {
      $rs[$r] = $value;
    }
    $result[$count] = $rs;
    $count++;
  }
  return $result;
}
// Perform Action on Databes
function doThis($query, $log = TRUE)
{
  global $con, $_SESSION;
  $con->query($query);
  $l = substr($query, 0, 1);
  $r = TRUE;
  if ($l == 'I') {
    $r = $con->insert_id;
  }
  return $r;
}
// Get Customer's Public IP
function get_client_ip()
{
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if (isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}
// get Config Property Value
function getConfigData($property)
{
  $temp = getThis("SELECT `value` FROM `ConfigData` WHERE `property`='$property'");
  return e_d('d', $temp[0]['value']);
}
//convert number to indian format
function IND_Number_format($num)
{
  $len = strlen($num);
  $m = '';
  $num = strrev($num);
  for ($i = 0; $i < $len; $i++) {
    if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $len) {
      $m .= ',';
    }
    $m .= $num[$i];
  }
  return strrev($m);
}
