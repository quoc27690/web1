<?php
	$c = $db->select("goon_product","id =".$_GET["id"],"");
	$product = $db->fetch($c);
	$file = explode(";",$product["photos"]);
	$get_file = array($_GET["file"]);
	$full	  = array_diff($file, $get_file);
	$luu = '';
	foreach($full as $value)
	{
		$luu = $luu.';'.$value;
	}
	$db->update("goon_product","photos",substr($luu,1),"id =".$_GET["id"]);
	admin_load("Đã xóa ảnh ".$_GET["file"]." !","?act=product_edit&id=".$_GET["id"]."&txt_cat=".$product["cat"]."&id_lang=1");
?>