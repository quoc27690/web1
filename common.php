<?php
session_start();
header('Cache-control: private'); // IE 6 FIX
$id_lang = $_GET['id_lang'];
// register the session and set the cookie
if ($id_lang=="") {$id_lang = 1;}
$_SESSION['id_lang'] = $id_lang;
setcookie("id_lang", $id_lang, time() + (3600 * 24 * 30));
 if(isSet($_SESSION['id_lang']))
{
$id_lang = $_SESSION['id_lang'];
}
else if(isSet($_COOKIE['id_lang']))
{
$id_lang = $_COOKIE['id_lang'];
}
else
{
$id_lang = 1;
}

switch ($id_lang) {
  case 1:
  $lang_file = 'lang.vn.php';
  break;

  case 2:
  $lang_file = 'lang.en.php';
  break;

  default:
  $lang_file = 'lang.vn.php';

}
include_once 'languages/'.$lang_file;
?>
