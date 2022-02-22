<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TIN TỨC <img src="images/bl3.gif" border="0" /> SỬA BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/cms.php";
        if (empty($func)) $func = "";
        //	Kiểm tra sự tồn tại của ID
        $id = $id + 0;
        $r	= $db->select("goon_cms","id = '".$id."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại bài viết này.","?act=cms_list&id_lang=".$_SESSION['lang']);
        $max_file_size	=	2048000;
        $up_dir			=	"../uploads/cms/";
        $OK = false;
        if ($luu)
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
                    $time = strtotime(str_replace("/","-",$txt_date));
                    $db->query("update goon_cms set cat = '".$db->escape($txt_cat)."', hinh_note = '".$db->escape($txt_hinh_note)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."', time = '".$time."', title = '".$txt_title."', description = '".$txt_description."', khoa = '".$txt_khoa."', link = '".$txt_link."', thong_bao = '".$txt_thong_bao."' where id = '".$id."'");
                    $db->query("update goon_cms_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang='".$lang."'");
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
                        $txt_hinh_1 = "new_".$lang."_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,$size);
            						$txt_hinh_4	= "hinhadmin_".$lang."_".$id.".".$file_type;
            						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"w=40&h=40&zc=1");
            						$txt_hinh_5	= $id.".".$file_type;
            						$db->update("goon_cms_lang","hinh",$txt_hinh_5,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","?act=cms_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
                }
            }
        }
        if ($capnhat)
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
                    $time = strtotime(str_replace("/","-",$txt_date));
                    $db->query("update goon_cms set cat = '".$db->escape($txt_cat)."', hinh_note = '".$db->escape($txt_hinh_note)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."', time = '".$time."', title = '".$txt_title."', description = '".$txt_description."', khoa = '".$txt_khoa."', link = '".$txt_link."', thong_bao = '".$txt_thong_bao."' where id = '".$id."'");
                    $db->query("update goon_cms_lang set ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang='".$lang."'");
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
                        $txt_hinh_1 = "new_".$lang."_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,$size);
            						$txt_hinh_4	= "hinhadmin_".$lang."_".$id.".".$file_type;
            						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"w=40&h=40&zc=1");
            						$txt_hinh_5	= $id.".".$file_type;
            						$db->update("goon_cms_lang","hinh",$txt_hinh_5,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","");
                }
            }
        }
        else
        {
            $r	= $db->select("goon_cms","id = '".$id."'");
            $row = $db->fetch($r);
            $r3	= $db->select("goon_cms_lang","id = '".$id."' and id_lang='".$lang."'");
            $row3 = $db->fetch($r3);
            $txt_cat		= $row["cat"];
            $txt_ten		= str_replace("\\","",$row3["ten"]);
            $txt_chu_thich	= str_replace("\\","",$row3["chu_thich"]);
            $txt_hinh_note	= $row["hinh_note"];
            $txt_noi_dung	= str_replace("\\","",$row3["noi_dung"]);
            $txt_hien_thi	= $row["hien_thi"];
            $txt_noi_bat	= $row["noi_bat"];
            $txt_date		= lg_date::vn_other(time(),"d/m/Y");
    				$txt_title		= 	$row["title"];
    				$txt_description= 	$row["description"];
    				$txt_khoa		= 	$row["khoa"];
    				$txt_link		= 	$row["link"];
            $txt_thong_bao  =   $row["thong_bao"];
        }
        if (!$OK)
            template_edit("?act=cms_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$txt_title,$txt_description,$txt_khoa,$txt_link,$txt_thong_bao,$error,$lang);
    ?>
    </center>
</div>
