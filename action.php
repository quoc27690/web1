<?php
@session_start();
include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");
$THANHVIEN["id"] = 0;
include("z_includes/dem_online.php");
if (empty($act)) $act = "zzz";
if ( !in_array($act, array(
		'send_lienhe','send_book','check_ma_xac_nhan','add_to_cart','del_cart','send_nhantin'
	) ) ) 
{
	die();
}
include "z_action/".$act.".php";
?>