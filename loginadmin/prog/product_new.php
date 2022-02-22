<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SẢN PHẨM <img src="images/bl3.gif" border="0" /> THÊM SẢN PHẨM</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/product.php";
	if (empty($func)) $func = "";
	$max_file_size	=	20480000;
	$up_dir			=	"../uploads/product/";

	$OK = false;
	if ($submit)
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
				$selecta = "select Max(thu_tu) AS thu_tu from goon_product where cat = '".$txt_cat."'";
				$sqla=mysql_query($selecta) or die ("khong ket noi duoc");
				$rowa=mysql_fetch_array($sqla);
				$thu_tu = $rowa["thu_tu"] + 1;
				$db->insert("goon_product","cat,hien_thi,gia,noi_bat,time,user,thu_tu,title,description,khoa,tin_to,ban_chay","'".$txt_cat."','".($txt_hien_thi+0)."','".$txt_gia."','".($txt_noi_bat+0)."','".time()."','".$thanh_vien["id"]."','".$thu_tu."','".$txt_title."', '".$txt_description."','".$txt_khoa."','".$tin_to."','".$ban_chay."'");
				$select = "select Max(id) AS max from goon_product";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$id = $row1["max"];
				$lang1 = array();
				$stt = 0;
				$r5 = $db->select("goon_lang");
				while ($row5 = $db->fetch($r5))
				{
					$lang1[$stt] = $row5["id"];
					$stt++;
				}
				foreach ($lang1 as $value)
				{
					$db->insert("goon_product_lang","id, id_lang, ten, chu_thich, noi_dung, thoi_gian, hanh_trinh","'".$id."','".$value."','".$db->escape($txt_ten)."','".$txt_chu_thich."','".$txt_noi_dung."','".$thoi_gian."','".$hanh_trinh."'");
				}
				if ($hinh)
				{
					$txt_hinh	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."sp_".$txt_hinh,"w=538&h=348&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir."admin_".$txt_hinh,"w=40&h=40&zc=1");
					$db->update("goon_product","hinh",$txt_hinh,"id = '".$id."'");
				}
				admin_load("Đã thêm Bài viết vào CSDL","?act=product_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
			}
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_chu_thich	= "";
		$txt_hinh_note	= "";
		$txt_noi_dung	= "";
		$txt_gia		= 0;
		$txt_hien_thi	= 1;
		$txt_noi_bat	= 0;
	}
	if (!$OK)
		template_edit("?act=product_new", "new", $id , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$photos,$txt_title,$txt_description,$txt_khoa,$thoi_gian,$tin_to,$ban_chay,$hanh_trinh,$error,$lang)
?>
</center>
