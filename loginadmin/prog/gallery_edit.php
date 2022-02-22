<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_list_img2.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">HÌNH ẢNH <img src="images/bl3.gif" border="0" /> SỬA HÌNH</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/gallery.php";
        if (empty($func)) $func = "";
        //	Kiểm tra sự tồn tại của ID
        $id = $id + 0;
        $r	= $db->select("goon_gallery","id = '".$id."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại bài viết này.","?act=gallery_manager");

        $max_file_size	=	10000000;
        $up_dir			=	"../uploads/gal/";

        $OK = false;

        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên bài viết.";
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
                    $db->query("update goon_gallery set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."', link = '".$db->escape($txt_link)."' where id = '".$id."'");
                    $db->query("update goon_gallery_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."' where id = '".$id."' and id_lang = '".$lang."'");
                    if ($hinh)
                    {
                        if ($txt_cat==1)
            						{
            							$txt_hinh_1	= "slide_".$id.".".$file_type;
            							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"");
            						}
            						else
            						{
            							$txt_hinh_3	= "image_".$id.".".$file_type;
            							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"");
            						}
                        $txt_hinh_2	= $id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=500&h=350&zc=1");
                        $txt_hinh_4	= "hinhadmin_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"w=138&h=100&zc=1");
                        $db->update("goon_gallery","hinh",$txt_hinh_2,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công","?act=gallery_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
                }
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên bài viết.";
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
                    $db->query("update goon_gallery set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."', link = '".$db->escape($txt_link)."' where id = '".$id."'");
                    $db->query("update goon_gallery_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."' where id = '".$id."' and id_lang = '".$lang."'");
                    if ($hinh)
                    {
                        if ($txt_cat==1)
            						{
            							$txt_hinh_1	= "slide_".$id.".".$file_type;
            							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"");
            						}
            						else
            						{
            							$txt_hinh_3	= "image_".$id.".".$file_type;
            							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"");
            						}
                        $txt_hinh_2	= $id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=500&h=350&zc=1");
                        $txt_hinh_4	= "hinhadmin_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"w=138&h=100&zc=1");
                        $db->update("goon_gallery","hinh",$txt_hinh_2,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công","");
                }
            }
        }
        else
        {
            $r	= $db->select("goon_gallery","id = '".$id."'");
            $row = $db->fetch($r);
            $r2	= $db->select("goon_gallery_lang","id = '".$id."' and id_lang = '".$lang."'");
            $row2 = $db->fetch($r2);
                $txt_cat		= $row["cat"];
                $txt_ten		= str_replace("\\","",$row2["ten"]);
                $txt_chu_thich	= str_replace("\\","",$row2["chu_thich"]);
                $txt_hien_thi	= $row["hien_thi"];
                $txt_noi_bat	= $row["noi_bat"];
                $txt_link		= $row["link"];
        }
        if (!$OK)
            template_edit("?act=gallery_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hien_thi,$txt_noi_bat,$txt_link,$error,$lang)
    ?>
    </center>
</div>
