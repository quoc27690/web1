<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> THÊM MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
<?
	include "templates/tron_goi_menu.php";
	if (empty($func)) $func = "";
	$OK = false;
	if ($submit)
	{	 
		$lang=$_POST['lang'];
		if (empty($txt_ten))
			$error = "Vui lòng nhập Tên mục.";
		else
		{ 
			$select = "select Max(id) AS max from goon_tron_goi_menu_lang";
			$sql=mysql_query($select) or die ("khong ket noi duoc");
			$row1=mysql_fetch_array($sql);
			$txt_cat = $row1["max"] + 1;
			$lang1 = array();
			$stt = 0;
			$r2 = $db->select("goon_lang");
			while ($row2 = $db->fetch($r2))
			{
				$lang1[$stt] = $row2["id"];
				$stt++;
			}
			foreach ($lang1 as $value)
			{
				$db->insert("goon_tron_goi_menu_lang","id,id_lang,cat,ten,thu_tu,hien_thi","'".$txt_cat."','".$value."','".$db->escape($cat)."','".$db->escape($txt_ten)."',1,'".($txt_hien_thi+0)."'");
			}
			admin_load("Đã thêm Mục đó vào CSDL","?act=tron_goi_list&txt_cat=".$txt_cat."&id_lang=".$lang);
			$OK = true;
		}
	}
	else
	{
		$txt_ten		=	"";
		$txt_hien_thi	=	1;
	}
	
	if (!$OK)
		template_edit("?act=tron_goi_menu_new","new",$txt_cat,$cat,$txt_ten,$txt_hien_thi,$error,$lang);
?>
</center>