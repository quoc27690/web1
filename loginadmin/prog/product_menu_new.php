<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> THÊM MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
<?
	include "templates/product_menu.php";
	if (empty($func)) $func = "";
	$max_file_size	=	20480000;
	$up_dir			=	"../uploads/product/";
	$OK = false;
	if ($submit)
	{	 
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên.";
		else
		{
			// kiểm tra file uploads.
			$file_type = $_FILES['txt_hinh']['type'];
			$file_name = $_FILES['txt_hinh']['name'];
			$file_size = $_FILES['txt_hinh']['size'];
			switch ($file_type)
			{
				case "image/pjpeg"	: $file_type = "jpg"; break;
				case "image/jpeg"	: $file_type = "jpg"; break;
				case "image/gif" 	: $file_type = "gif"; break;
				case "image/x-png" 	: $file_type = "png"; break;
				case "image/png" 	: $file_type = "png"; break;
				default : $file_type = "unk"; break;
			}
			$file_full_name = "tmp_".time().".".$file_type;
			if ( ($file_size > 0) && ($file_size <= $max_file_size) )
				if ($file_type != "unk")
						if ( @move_uploaded_file($_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
						{
							$OK = true;
							$hinh = true;
						}
						else
							$error = "Không thể upload hình ảnh.";
				else
				{
					$error = "Sai định dạng file - Không thể upload hình ảnh.";
				}
			else
			{
				if ($file_size == 0)
				{
					$OK		= true;
					$hinh	= false;
				}
				else
					$error = "Hình của bạn chọn vượt quá kích thước cho phép.";
			}
			// Process xong
			if ($OK)
			{
				$lang=$_POST['lang'];
				$select = "select Max(id) AS max from goon_product_menu_lang";
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
					$db->insert("goon_product_menu_lang","id,id_lang,cat,ten,thu_tu,hien_thi,noi_bat","'".$txt_cat."','".$value."','".$db->escape($cat)."','".$db->escape($txt_ten)."',1,'".($txt_hien_thi+0)."','".$txt_noi_bat."'");
				}
				if ($hinh)
				{
					$txt_hinh	= $txt_cat.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."cat_".$txt_hinh,"w=150&h=150&zc=1");
					$db->update("goon_product_menu_lang","hinh",$txt_hinh,"id = '".$txt_cat."'");
				}
				admin_load("Đã thêm Mục đó vào CSDL","?act=product_list&txt_cat=".$txt_cat."&id_lang=".$lang);
			}
		}
	}
	else
	{
		$txt_ten		=	"";
		$txt_hien_thi	=	1;
		$txt_noi_bat	=	0;
	}
	
	if (!$OK)
		template_edit("?act=product_menu_new","new",$txt_cat,$cat,$txt_ten,$txt_hien_thi,$txt_noi_bat,$txt_hinh,$error,$lang);
?>
</center>