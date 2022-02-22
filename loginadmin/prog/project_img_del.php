<?php
	$c = $db->select("goon_project","id =".$_GET["id"],"");
	$project = $db->fetch($c);
	if (strpos($project["photos"],$_GET["file"].";")==true)	$deleted = str_replace($_GET["file"].";","",$project["photos"]);
	else if (strpos($project["photos"],$_GET["file"].";")==false&&strpos($project["photos"],";".$_GET["file"])==true)	$deleted = str_replace(";".$_GET["file"],"",$project["photos"]);
	else $deleted = str_replace($_GET["file"],"",$project["photos"]);
	
	$db->update("goon_project","photos",$deleted,"id =".$_GET["id"]);
	admin_load("Đã xóa ảnh ".$_GET["file"]." !","?act=project_edit&id=".$_GET["id"]);
?>