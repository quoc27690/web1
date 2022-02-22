<?php
session_start();
@error_reporting(0);
@set_time_limit(0);
if($_SESSION['login_admin_user']==""){
	echo"<script type='text/javascript'>window.location='login.php'</script>";
}
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "function.php";
$thanh_vien["id"]	=	$level;
if (empty($act)) $act = "home";
include "tpl/skin/header.php";
	echo'<table cellpadding="0" cellspacing="0" style="background:#ebebeb; margin-left:20px;">';
		echo'<tr>';
			echo'<td width="310" valign="top">';
				include "tpl/skin/menu.php";
			echo'</td>';
			echo'<td width="100%" valign="top">';
				echo "<div id=\"main_frame\">";
				if (is_file("prog/".$act.".php"))
					include "prog/".$act.".php";
				else
					echo "<b>Chức năng này đã bị Khóa.</b>";
				echo "</div>";
			echo'</td>';
		echo'</tr>';
	echo'</table>';
?>