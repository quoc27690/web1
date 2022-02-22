<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_ngonngu.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">NGÔN NGỮ <img src="images/bl3.gif" border="0" /> THÊM NGÔN NGỮ</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	include "templates/ngonngu.php";
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/lang/";

	$OK = false;
	if ($submit)
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên ngôn ngữ.";
		else if (empty($txt_iso_code))
			$error = "Vui lòng nhập iso_code.";
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
				$select = "select Max(id) AS max from goon_lang";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$id = $row1["max"] + 1;
				$db->insert("goon_lang","id,lang,iso_code","'".$id."','".$txt_ten."','".$txt_iso_code."'");
				if ($hinh)
				{
					$txt_hinh	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir."lang_".$txt_hinh,"w=30&h=25&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir."admin_".$txt_hinh,"w=40&h=20&zc=1");
					$db->update("goon_lang","hinh",$txt_hinh,"id = '".$id."'");
				}
				admin_load("Đã thêm Ngôn ngữ vào CSDL","?act=ngonngu_manager&id_lang=".$_SESSION['lang']);
			}
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_iso_code	= "";
	}
	if (!$OK)
		template_edit("?act=ngonngu_new", "new", $id ,$txt_ten,$txt_iso_code,$txt_hinh,$error)
?>
</center>