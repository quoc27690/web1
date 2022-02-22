<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> THÊM SẢN PHẨM</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/product.php";
	if (empty($func)) $func = "";
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("goon_product","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Sản phẩm này.","?act=product_manager");

	$max_file_size	=	20480000;
	$up_dir			=	"../uploads/product/";
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
				$db->query("update goon_product set gia = '".$txt_gia."', cat = '".$db->escape($txt_cat)."' , hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."', title = '".$txt_title."', description = '".$txt_description."', khoa = '".$txt_khoa."', tin_to = '".$tin_to."', ban_chay = '".$ban_chay."' where id = '".$id."'");
				$db->query("update goon_product_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."', thoi_gian = '".$thoi_gian."', hanh_trinh = '".$hanh_trinh."' where id = '".$id."' and id_lang = '".$lang."'");
				if ($hinh)
				{
					$txt_hinh	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."sp_".$txt_hinh,"w=538&h=348&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir."admin_".$txt_hinh,"w=40&h=40&zc=1");
					$db->update("goon_product","hinh",$txt_hinh,"id = '".$id."'");
				}
				admin_load("Đã update Sản phẩm vào CSDL","?act=product_list&txt_cat=$txt_cat&id_lang=$lang");
			}
		}
	}
	else if ($capnhat)
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
				$db->query("update goon_product set gia = '".$txt_gia."' , cat = '".$db->escape($txt_cat)."' , hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."', title = '".$txt_title."', description = '".$txt_description."', khoa = '".$txt_khoa."', tin_to = '".$tin_to."', ban_chay = '".$ban_chay."' where id = '".$id."'");
				$db->query("update goon_product_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."', thoi_gian = '".$thoi_gian."', hanh_trinh = '".$hanh_trinh."' where id = '".$id."' and id_lang = '".$lang."'");
				if ($hinh)
				{
					$txt_hinh	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."sp_".$txt_hinh,"w=538&h=348&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir."admin_".$txt_hinh,"w=40&h=40&zc=1");
					$db->update("goon_product","hinh",$txt_hinh,"id = '".$id."'");
				}
				admin_load("Đã update Sản phẩm vào CSDL","");
			}
		}
	}
	else if ($submit_image) {
		for($i=0;$i<count($_FILES["upload_file"]["name"]);$i++)
		{
			$tempFile = $_FILES["upload_file"]["tmp_name"][$i];
			$targetPath = $up_dir;
			$dinh_dang = strrchr($_FILES['upload_file']['name'][$i],".");
			$time=rand(0,time());
			$targetFile = str_replace('//','/',$targetPath).$id."_".$time.$dinh_dang;
			$filename = $_GET['id']."_".$time.$dinh_dang;
			$thumb = "nho_".$filename ;
			$bigc = "lon_".$filename ;
			img_resize($tempFile,$targetPath.$thumb,"w=125&h=75&zc=1");
			img_resize($tempFile,$targetPath.$bigc,"");
			img_resize($tempFile,$targetPath.$filename,"h=480");
			$p = $db->select("goon_product","id = ".$_GET['id'],"LIMIT 1");
			$photo = $db->fetch($p);
			if ( $photo["photos"] == NULL ) $photos = $filename;
			else $photos = $photo["photos"].";".$filename;
			$db->update("goon_product","photos",$photos,"id = ".$_GET['id']);
		}
		admin_load("Đã update hình vào CSDL","");
	}
	else
	{
		$s1 = $db->select("goon_product","id='".$id."'","");
		$r1 = $db->fetch($s1);
		$s2 = $db->select("goon_product_lang","id='".$id."' and id_lang='".$lang."'","");
		$r2 = $db->fetch($s2);
		$txt_ten		= str_replace("\\","",$r2["ten"]);
		$txt_chu_thich	= str_replace("\\","",$r2["chu_thich"]);
		$txt_hinh_note	= $row["hinh_note"];
		$txt_noi_dung	= str_replace("\\","",$r2["noi_dung"]);
		$txt_gia		= $r1["gia"];
		$txt_hien_thi	= $r1["hien_thi"];
		$txt_noi_bat	= $r1["noi_bat"];
		$photos 		= $r1["photos"];
		$txt_title		= 	$r1["title"];
		$txt_description= 	$r1["description"];
		$txt_khoa		= 	$r1["khoa"];
		$thoi_gian		= 	$r2["thoi_gian"];
		$tin_to			= 	$r1["tin_to"];
		$ban_chay		= 	$r1["ban_chay"];
		$hanh_trinh		= 	$r2["hanh_trinh"];
	}
	if (!$OK)
		template_edit("?act=product_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$photos,$txt_title,$txt_description,$txt_khoa,$thoi_gian,$tin_to,$ban_chay,$hanh_trinh,$error,$lang)
?>
</center>
