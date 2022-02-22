<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> THÊM SẢN PHẨM</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/tron_goi.php";
	if (empty($func)) $func = "";
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("goon_tron_goi","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Sản phẩm này.","?act=tron_goi_manager");
	
	$max_file_size	=	20480000;
	$up_dir			=	"../uploads/tron_goi/";
	$OK = false;
	if ($luu)
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên sản phẩm.";
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
				$bodau=	strtolower(lg_string::bo_dau($txt_ten));
				$db->query("update goon_tron_goi set gia = '".$txt_gia."', cat = '".$db->escape($txt_cat)."' , hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."', giam_gia = '".$txt_giam_gia."', cap_sao = '".$txt_cap_sao."' where id = '".$id."'");
				$db->query("update goon_tron_goi_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang = '".$lang."'");
				if ($hinh)
				{
					$txt_hinh	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."sp_".$txt_hinh,"w=220&h=120&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir."admin_".$txt_hinh,"w=40&h=40&zc=1");
					$db->update("goon_tron_goi","hinh",$txt_hinh,"id = '".$id."'");
				}
				admin_load("Đã update Sản phẩm vào CSDL","?act=tron_goi_list&txt_cat=$txt_cat&id_lang=$lang");
			}			
		}
	}
	if ($capnhat)
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên sản phẩm.";
		
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
				$bodau=	strtolower(lg_string::bo_dau($txt_ten));
				$db->query("update goon_tron_goi set gia = '".$txt_gia."' , cat = '".$db->escape($txt_cat)."' , hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."', giam_gia = '".$txt_giam_gia."', cap_sao = '".$txt_cap_sao."' where id = '".$id."'");
				$db->query("update goon_tron_goi_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang = '".$lang."'");
				if ($hinh)
				{
					$txt_hinh	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."sp_".$txt_hinh,"w=220&h=120&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir."admin_".$txt_hinh,"w=40&h=40&zc=1");
					$db->update("goon_tron_goi","hinh",$txt_hinh,"id = '".$id."'");
				}
				admin_load("Đã update Sản phẩm vào CSDL","");
			}			
		}
	}
	else
	{
		$s1 = $db->select("goon_tron_goi","id='".$id."'","");
		$r1 = $db->fetch($s1);
		$s2 = $db->select("goon_tron_goi_lang","id='".$id."' and id_lang='".$lang."'","");
		$r2 = $db->fetch($s2);
		$txt_ten		= str_replace("\\","",$r2["ten"]);
		$txt_chu_thich	= str_replace("\\","",$r2["chu_thich"]);
		$txt_hinh_note	= $row["hinh_note"];
		$txt_noi_dung	= str_replace("\\","",$r2["noi_dung"]);
		$txt_gia		= $r1["gia"];
		$txt_hien_thi	= $r1["hien_thi"];
		$txt_noi_bat	= $r1["noi_bat"];
		$photos 		= $r1["photos"];
		$txt_giam_gia	= $r1["giam_gia"];
		$txt_cap_sao	= $r1["cap_sao"];
	}
	if (!$OK)
		template_edit("?act=tron_goi_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$txt_giam_gia,$txt_cap_sao,$photos,$error,$lang)
?>
</center>