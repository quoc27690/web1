<?php

	$c = $db->select("goon_tron_goi","id =".$_GET["id"],"");
	$product = $db->fetch($c);
	//tim kiem chuoi strpos
	//$chuoi="lý hoàng thông";
	// str_replace("thông","dung",$chuoi); thì sẽ ra kết quả là "lý hoàng dung"


	if (strpos($product["photos"],$_GET["file"].";")==true)	$deleted = str_replace($_GET["file"].";","",$product["photos"]);
	else if (strpos($product["photos"],$_GET["file"].";")==false&&strpos($product["photos"],";".$_GET["file"])==true)	$deleted = str_replace(";".$_GET["file"],"",$product["photos"]);
	else $deleted = str_replace($_GET["file"],"",$product["photos"]);
	
	$db->update("goon_tron_goi","photos",$deleted,"id =".$_GET["id"]);
	admin_load("Đã xóa ảnh ".$_GET["file"]." !","?act=tron_goi_edit&id=".$_GET["id"]."&txt_cat=".$_GET["txt_cat"]."&id_lang=".$_GET["id_lang"]);
?>