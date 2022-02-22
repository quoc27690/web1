<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/quan_ly.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">DỰ ÁN <img src="images/bl3.gif" border="0" /> SỬA BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/project.php";
        if (empty($func)) $func = "";
        //	Kiểm tra sự tồn tại của ID
        $id = $id + 0;
            $r	= $db->select("goon_project","id = '".$id."'");
            if ($db->num_rows($r) == 0)
                admin_load("Không tồn tại bài viết này.","?act=project_list");
        $max_file_size	=	2048000;
        $up_dir			=	"../uploads/project/";
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
                    $time = strtotime(str_replace("/","-",$txt_date));
                    $db->query("update goon_project set hien_thi = '".($txt_hien_thi+0)."', cat = '".$db->escape($txt_cat)."' , noi_bat = '".($txt_noi_bat+0)."', time = '".$time."' where id = '".$id."'");
                    $db->query("update goon_project_lang set ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang = '".$lang."'");
                    if ($hinh)
                    {
                        $txt_hinh_1	= "duan_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=263&h=195&zc=1");
                        $txt_hinh_2	= "hinhadmin_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=60&h=40&zc=1");
                        $db->update("goon_project","hinh",$id.".".$file_type,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","?act=project_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
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
                    $time = strtotime(str_replace("/","-",$txt_date));

                    $db->query("update goon_project set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."', time = '".$time."' where id = '".$id."'");
                    $db->query("update goon_project_lang set ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang = '".$lang."'");
                    if ($hinh)
                    {
                        $txt_hinh_1	= "duan_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=263&h=195&zc=1");
                        $txt_hinh_2	= "hinhadmin_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=60&h=40&zc=1");
                        $db->update("goon_project","hinh",$id.".".$file_type,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","");
                }
            }
        }
        else
        {
            $r	= $db->select("goon_project","id = '".$id."'");
            $row = $db->fetch($r);
            $r3	= $db->select("goon_project_lang","id = '".$id."' and id_lang='".$lang."'");
            $row3 = $db->fetch($r3);
                $txt_cat		= $row["cat"];
                $txt_ten		= $row3["ten"];
                $txt_noi_dung	= $row3["noi_dung"];
                $txt_hien_thi	= $row["hien_thi"];
                $txt_noi_bat	= $row["noi_bat"];
                $txt_date		= lg_date::vn_other($row["time"],"d/m/Y");
                $photos = $row["photos"];
        }
        if (!$OK)
            template_edit("?act=project_edit","update",$id,$txt_cat,$txt_ten,$txt_hinh,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$photos,$error,$lang);
    ?>
    </center>
</div>
