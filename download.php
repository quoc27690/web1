<?php
include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");

$secret = $_GET['secret'];
$id = $_GET['id'] + 0;
$hash = $_GET['hash'];


if ($secret != 'qweasdzxc' || !$id || $id < 0 || hashString($id) != $hash)
{
	header('Location: /');
	exit();
}


$q = $db->select('goon_file', 'id = '.$id);
if ($r = $db->fetch($q))
{
	header('Location: /uploads/file/'.$r['file']);
	exit();
}
else
{
	header('Location: /');
	exit();
}
?>