<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> SỬA MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/tron_goi_menu.php";
	if (empty($func)) $func = "";
	$txt_cat = $txt_cat+0;
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("goon_tron_goi_menu_lang","id = '".$txt_cat."' and id_lang = '".$_SESSION['lang']."'");
	if ($db->num_rows($r) == 0)
        admin_load("Không tồn tại Mục này.","?act=tron_goi_list&id_lang=".$lang);
	$OK = false;
	if ($capnhat)
	{
		$db->query("update goon_tron_goi_menu_lang set ten = '".$txt_ten."', cat = '".$cat."',hien_thi = '".($txt_hien_thi+0)."' where id = '".$txt_cat."' and id_lang = '".$_SESSION['lang']."'");
		admin_load("Đã cập nhật thành công.","?act=tron_goi_menu_edit&txt_cat=".$txt_cat."&id_lang=".$lang);
		$OK = true;
	}
	if ($luu)
	{
		$db->query("update goon_tron_goi_menu_lang set ten = '".$txt_ten."', cat = '".$cat."',hien_thi = '".($txt_hien_thi+0)."' where id = '".$txt_cat."' and id_lang = '".$_SESSION['lang']."'");
		admin_load("Đã cập nhật thành công.","?act=tron_goi_list&txt_cat=".$txt_cat."&id_lang=".$lang);
		$OK = true;
	}
	else
	{
		$r2	= $db->select("goon_tron_goi_menu_lang","id = '".$txt_cat."' and id_lang= '".$lang."'");
		$row2 = $db->fetch($r2);
		$txt_ten		=	$row2["ten"];
		$txt_cat		=	$row2["id"];
		$cat			=	$row2["cat"];
		$txt_hien_thi	=	$row2["hien_thi"];
	}
	if (!$OK)
		template_edit("?act=tron_goi_menu_edit","update",$txt_cat,$cat,$txt_ten,$txt_hien_thi,$error,$lang);
?>
</center>