<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TIN TỨC <img src="images/bl3.gif" border="0" /> THÊM BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
	<?php
		include "templates/cms.php";
		if (empty($func)) $func = "";
		$max_file_size	=	2048000;
		$up_dir			=	"../uploads/cms/";

		$OK = false;

		if ($submit)
		{
			if (empty($txt_ten))
				$error = "Vui lòng nhập tên bài viết.";
			else if (empty($txt_noi_dung))
				$error = "Vui lòng nhập nội dung bài viết.";
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
					$selecta = "select Max(thu_tu) AS thu_tu from goon_cms where cat = '".$txt_cat."'";
					$sqla=mysql_query($selecta) or die ("khong ket noi duoc");
					$rowa=mysql_fetch_array($sqla);
					$thu_tu = $rowa["thu_tu"] + 1;
					$time = time($txt_date);
					$db->insert("goon_cms","cat,hinh_note,hien_thi,noi_bat,time,user,thu_tu,title,description,khoa,link,thong_bao","'".($txt_cat+0)."','".$db->escape($txt_hinh_note)."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".$time."','".$thanh_vien["id"]."','".$thu_tu."','".$txt_title."', '".$txt_description."','".$txt_khoa."','".lg_string::get_link2($txt_ten)."','".$txt_thong_bao."'");
					$select = "select Max(id) AS max from goon_cms";
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
						$db->insert("goon_cms_lang","id,id_lang,ten,chu_thich,noi_dung","'".$id."','".$value."','".$db->escape($txt_ten)."','".$txt_chu_thich."','".$txt_noi_dung."'");
						if ($hinh)
						{
							$size = "w=410&h=243&zc=1";
							if ($txt_cat == 3) {
								$size = "w=74&h=74&zc=1";
							} else if ($txt_cat == 5) {
								$size = "w=123&h=123&zc=1";
							} else if ($txt_cat == 7) {
								$size = "w=390&h=500&zc=1";
							}
							$txt_hinh_1	= "new_".$value."_".$id.".".$file_type;
							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,$size);
							$txt_hinh_4	= "hinhadmin_".$value."_".$id.".".$file_type;
							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"w=40&h=40&zc=1");
							$txt_hinh_5	= $id.".".$file_type;
							$db->update("goon_cms_lang","hinh",$txt_hinh_5,"id = '".$id."'");
						}
					}
					admin_load("Đã thêm Bài viết vào CSDL","?act=cms_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
				}
			}
		}
		else
		{
			$txt_ten		= "";
			$txt_chu_thich	= "";
			$txt_hinh_note	= "";
			$txt_noi_dung	= "";
			$txt_hien_thi	= 1;
			$txt_date		= lg_date::vn_other(time(),"d/m/Y");
		}
		if (!$OK)
			template_edit("?act=cms_new", "new", $id , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$txt_title,$txt_description,$txt_khoa,$txt_link,$txt_thong_bao,$error,$lang)
	?>
	</center>
</div>
