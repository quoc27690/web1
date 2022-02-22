<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SỬA LOẠI SẢN PHẨM</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/noiden.php";
        if (empty($func)) $func = "";
		$txt_cat = $txt_cat+0;
		$r	= $db->select("goon_noiden","id = '".$txt_cat."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại Mục này.","?act=chatlieu_new&id_lang=".$lang);
        $OK = false;
		$max_file_size	=	2048000;
        $up_dir			=	"../uploads/icon/";
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên.";
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
					$db->query("update goon_noiden set san_pham = '".$txt_san_pham."' where id = '".$txt_cat."'");
					$db->query("update goon_noiden set ten = '".$db->escape($txt_ten)."' where id = '".$txt_cat."' and id_lang = '".$lang."'");
					if ($hinh)
					{
						$txt_hinh_1	= "icon_".$txt_cat.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"");
						$txt_hinh_5	= $txt_cat.".".$file_type;
						$db->update("goon_noiden","hinh",$txt_hinh_5,"id = '".$txt_cat."'");
					}
					admin_load("Đã cập nhật thành công.","?act=chatlieu_new&id_lang=".$lang);
				}
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên.";
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
					$db->query("update goon_noiden set san_pham = '".$txt_san_pham."' where id = '".$txt_cat."'");
					$db->query("update goon_noiden set ten = '".$db->escape($txt_ten)."' where id = '".$txt_cat."' and id_lang = '".$lang."'");
					if ($hinh)
					{
						$txt_hinh_1	= "icon_".$txt_cat.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"");
						$txt_hinh_5	= $txt_cat.".".$file_type;
						$db->update("goon_noiden","hinh",$txt_hinh_5,"id = '".$txt_cat."'");
					}
					admin_load("Đã cập nhật thành công.","?act=chatlieu_edit&txt_cat=".$txt_cat."&id_lang=".$lang);
				}
            }
        }
        else
        {
            $r2	= $db->select("goon_noiden","id = '".$txt_cat."' and id_lang = '".$lang."'");
            $row2 = $db->fetch($r2);
			$txt_ten		=	$row2["ten"];
			$txt_cat		=	$row2["id"];
			$txt_san_pham	=	$row2["san_pham"];
        }
        if (!$OK)
            template_edit("?act=chatlieu_edit","update",$txt_cat,$txt_ten,$txt_san_pham,$txt_hinh,$error,$lang);
    ?>
    </center>
</div>