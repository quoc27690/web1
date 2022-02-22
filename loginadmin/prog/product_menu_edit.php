<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> SỬA MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/product_menu.php";
	if (empty($func)) $func = "";
	$txt_cat = $txt_cat+0;
	$max_file_size	=	20480000;
	$up_dir			=	"../uploads/product/";
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("goon_product_menu_lang","id = '".$txt_cat."' and id_lang = '".$_SESSION['lang']."'");
	if ($db->num_rows($r) == 0)
        admin_load("Không tồn tại Mục này.","?act=product_list&id_lang=".$lang);
	$OK = false;
	if ($capnhat)
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
				$db->query("update goon_product_menu_lang set ten = '".$txt_ten."', cat = '".$cat."',hien_thi = '".($txt_hien_thi+0)."',noi_bat = '".($txt_noi_bat+0)."' where id = '".$txt_cat."' and id_lang = '".$_SESSION['lang']."'");
				if ($hinh)
				{
					$txt_hinh	= $txt_cat.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."cat_".$txt_hinh,"w=150&h=150&zc=1");
					$db->update("goon_product_menu_lang","hinh",$txt_hinh,"id = '".$txt_cat."'");
				}
				admin_load("Đã cập nhật thành công.","?act=product_menu_edit&txt_cat=".$txt_cat."&id_lang=".$lang);
			}
		}
	}
	if ($luu)
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
				$db->query("update goon_product_menu_lang set ten = '".$txt_ten."', cat = '".$cat."',hien_thi = '".($txt_hien_thi+0)."',noi_bat = '".($txt_noi_bat+0)."' where id = '".$txt_cat."' and id_lang = '".$_SESSION['lang']."'");
				if ($hinh)
				{
					$txt_hinh	= $txt_cat.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."cat_".$txt_hinh,"w=150&h=150&zc=1");
					$db->update("goon_product_menu_lang","hinh",$txt_hinh,"id = '".$txt_cat."'");
				}
				admin_load("Đã cập nhật thành công.","?act=product_list&txt_cat=".$txt_cat."&id_lang=".$lang);
			}
		}
	}
	else
	{
		$r2	= $db->select("goon_product_menu_lang","id = '".$txt_cat."' and id_lang= '".$lang."'");
		$row2 = $db->fetch($r2);
		$txt_ten		=	$row2["ten"];
		$txt_cat		=	$row2["id"];
		$cat			=	$row2["cat"];
		$txt_hien_thi	=	$row2["hien_thi"];
		$txt_noi_bat	=	$row2["noi_bat"];
	}
	if (!$OK)
		template_edit("?act=product_menu_edit","update",$txt_cat,$cat,$txt_ten,$txt_hien_thi,$txt_noi_bat,$txt_hinh,$error,$lang);
?>
</center>