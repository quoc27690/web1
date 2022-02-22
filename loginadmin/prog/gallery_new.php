<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_list_img2.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">HÌNH ẢNH <img src="images/bl3.gif" border="0" /> THÊM HÌNH </strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/gallery.php";
        if (empty($func)) $func = "";
        $max_file_size	=	10000000;
        $up_dir			=	"../uploads/gal/";
        $OK = false;
        if ($submit)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên Hình ảnh.";
            else
            {
                for($i=0;$i<count($_FILES["upload_file"]["name"]);$i++)
                {
                    $file_type = $_FILES["upload_file"]["type"][$i];
                    $file_name = $_FILES["upload_file"]["name"][$i];
                    $file_size = $_FILES["upload_file"]["size"][$i];
                    $file_full_name = "tmp_".time().".".$file_type;
                    switch ($file_type)
                    {
                        case "image/pjpeg"  : $file_type = "jpg"; break;
                        case "image/jpeg"   : $file_type = "jpg"; break;
                        case "image/gif"    : $file_type = "gif"; break;
                        case "image/x-png"  : $file_type = "png"; break;
                        case "image/png"    : $file_type = "png"; break;
                        default : $file_type = "unk"; break;
                    }
                    $file_full_name = "tmp_".time().".".$file_type;
                    if ( ($file_size > 0) && ($file_size <= $max_file_size) )
                        if ($file_type != "unk")
                                if ( @move_uploaded_file($_FILES['upload_file']['tmp_name'][$i],$up_dir.$file_full_name) )
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
                            $OK     = true;
                            $hinh   = false;
                        }
                        else
                            $error = "Hình của bạn chọn vượt quá kích thước cho phép.";
                    }
                    // Process xong
                    if ($OK)
                    {
                        $db->insert("goon_gallery","cat,hien_thi,noi_bat,link,time,user","'".($txt_cat+0)."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".$db->escape($txt_link)."','".time()."','".$thanh_vien["id"]."'");
                        $select = "select Max(id) AS max from goon_gallery";
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
                            $db->insert("goon_gallery_lang","id,id_lang,ten,chu_thich","'".$id."','".$value."','".$db->escape($txt_ten)."','".$txt_chu_thich."'");
                        }
                        if ($hinh)
                        {
                            if ($txt_cat==1)
                            {
                                $txt_hinh_1 = "slide_".$id.".".$file_type;
                                img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"");
                            }
                            else
                            {
                                $txt_hinh_3 = "image_".$id.".".$file_type;
                                img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"");
                            }
                            $txt_hinh_2 = $id.".".$file_type;
                            img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=500&h=350&zc=1");
                            $txt_hinh_4 = "hinhadmin_".$id.".".$file_type;
                            img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"w=138&h=100&zc=1");
                            $db->update("goon_gallery","hinh",$txt_hinh_2,"id = '".$id."'");
                        }

                    }
                }
                admin_load("Đã thêm Hình ảnh vào CSDL","?act=gallery_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
            }
        }
        else
        {
            $txt_ten		= "";
            $txt_chu_thich	= "";
            $txt_hinh_note	= "";
            $txt_noi_dung	= "";
            $txt_hien_thi	= 1;
            $txt_link	= "";
        }
        if (!$OK)
            template_edit("?act=gallery_new", "new", 0 , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hien_thi,$txt_noi_bat,$txt_link,$error,$lang)
    ?>
    </center>
</div>
