<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_danhmuc.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">DANH MỤC <img src="images/bl3.gif" border="0" /> THÊM DANH MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/cat.php";
?>
<?php
	$id = $_POST["id"];
	$ten = $_POST["ten"];
	$kieu = $_POST["kieu"];
	$lang = $_POST["lang"];
	if($submit)
	{
	if (empty($ten))
			$error = "Vui lòng nhập tên.";
		else
		{		
			if($kieu == 1)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _cms = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_cms","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
			if($kieu == 2)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _product = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_product","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
			if($kieu == 3)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _gallery = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_gallery","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
			if($kieu == 4)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _project = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_project","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
			if($kieu == 5)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _doc = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_doc","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
			if($kieu == 6)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _file = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_file","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
			if($kieu == 7)
			{
				$select = "select Max(thu_tu) AS max from goon_cat where _media = 1";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$thu_tu = $row1["max"] + 1;
				$db->insert("goon_cat","thu_tu,id,ten,_media","'".$thu_tu."','".$id."','".$ten."',1");
				admin_load("Đã thêm danh mục vào CSDL","?act=cat_manager&id_lang=".$lang);
			}
		}
	}
?>
    </center>
</div>