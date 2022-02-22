<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_media.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">MEDIA <img src="images/bl3.gif" border="0" /> SỬA VIDEO</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/media.php";
        if (empty($func)) $func = "";
        //	Kiểm tra sự tồn tại của ID
        $id = $id + 0;
        $r	= $db->select("goon_media","id = '".$id."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại bài viết này.","?act=media_list&id_lang=".$_SESSION['lang']);
        $max_file_size	=	2048000;
        $up_dir			=	"../uploads/media/";
        $OK = false;
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên video";
            else if (empty($txt_link))
                $error = "Vui lòng nhập link video";
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
                    $time = strtotime(str_replace("/","-",$txt_date));
                    $db->query("update goon_media set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', time = '".$time."', link = '".htmlspecialchars($txt_link)."', noi_bat = '".$txt_noi_bat."' where id = '".$id."'");
                    $db->query("update goon_media_lang set ten = '".$db->escape($txt_ten)."' where id = '".$id."' and id_lang='".$lang."'");
                    if ($hinh)
                    {
                        $txt_hinh_1	= "video_".$id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=175&h=140&zc=1");
						$txt_hinh_2	= "hinhadmin_".$id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=60&h=40&zc=1");
						$txt_hinh_5	= $id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_5,"w=50&h=50&zc=1");
                        $db->update("goon_media","hinh",$txt_hinh_5,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","?act=media_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
                }			
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên bài viết.";
             else if (empty($txt_link))
                $error = "Vui lòng nhập link video";
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
                    $time = strtotime(str_replace("/","-",$txt_date));
                	$db->query("update goon_media set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', time = '".$time."', link = '".htmlspecialchars($txt_link)."', noi_bat = '".$txt_noi_bat."' where id = '".$id."'");
                    $db->query("update goon_media_lang set ten = '".$db->escape($txt_ten)."' where id = '".$id."' and id_lang='".$lang."'");
                    if ($hinh)
                    {
                        $txt_hinh_1	= "video_".$id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=175&h=140&zc=1");
						$txt_hinh_2	= "hinhadmin_".$id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=60&h=40&zc=1");
						$txt_hinh_5	= $id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_5,"w=50&h=50&zc=1");
                        $db->update("goon_media","hinh",$txt_hinh_5,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","");
                }			
            }
        }
        else
        {
            $r	= $db->select("goon_media","id = '".$id."'");
            $row = $db->fetch($r);
            $r3	= $db->select("goon_media_lang","id = '".$id."' and id_lang='".$lang."'");
            $row3 = $db->fetch($r3);
                $txt_cat		= $row["cat"];
                $txt_ten		= str_replace("\\","",$row3["ten"]);
                $txt_hien_thi	= $row["hien_thi"];
                $txt_link		= $row["link"];
                $txt_date		= lg_date::vn_other($row["time"],"d/m/Y");
        }
        if (!$OK)
            template_edit("?act=media_edit","update",$id ,$txt_cat,$txt_ten,$txt_link,$txt_hinh,$txt_hien_thi,$txt_noi_bat,$txt_date,$error,$lang);
    ?>
    </center>
</div>