<?php
session_start();
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$login_admin_user = $_POST['log_admin_user'];
$login_admin_pass = $_POST['log_admin_pass'];
$ktra	=	"false";
if ($login_admin_user!="" && $login_admin_pass!="") {
	$r	=	$db->select("goon_user","trang_thai = 1");
	while($row=$db->fetch($r))
	{
		$name=$row['username'];
		$pass=$row['password'];
		if(($db->escape($login_admin_user)==$name)&&(md5($login_admin_pass.$login_admin_user)==$pass)){
			$_SESSION['login_admin_user']= $name;
			$ktra="true";
			break;
		}
	}
	if($ktra=="true"){
		echo "<script type='text/javascript'>
				$(document).ready(function(){
					Login();
				});
			  </script>";
	}
	else echo "<script type='text/javascript'>
				$(document).ready(function(){
					 thongbao();
				});
			  </script>";
}
?>