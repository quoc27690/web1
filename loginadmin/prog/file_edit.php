<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_file.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">FILE <img src="images/bl3.gif" border="0" /> SỬA BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/file.php";
        if (empty($func)) $func = "";
        //	Kiểm tra sự tồn tại của ID
        $id = $id + 0;
        $r	= $db->select("goon_file","id = '".$id."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại tài liệu này.","?act=file_list&id_lang=".$_SESSION['lang']);
        $max_file_size	=	20480000;
        $up_dir			=	"../uploads/file/";
        $OK = false;
        $txt_gia		= '0';
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên tài liệu.";
            else
            {
                // kiểm tra file uploads.
                $file_type = $_FILES['txt_file']['type'];
                $file_name = $_FILES['txt_file']['name'];
                $file_size = $_FILES['txt_file']['size'];
                $file_full_name = "tmp_".time().".".$file_type;
                $file = false;
                if ($file_size > 0) 
                {
                            if ( @move_uploaded_file($_FILES['txt_file']['tmp_name'],$up_dir.$file_name) )
                            {
                                $OK = true;
                                $file = true;
                            }
                            else
                                $error = "Không thể upload tài liệu.";
                }
                else
                {
                    if ($file_size == 0)
                    {
                        $OK		= true;
                        $file	= false;
                    }
                
                }
                // Process xong
                if ($OK)
                {
                    $db->query("update goon_file set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."' where id = '".$id."'");
                    $db->query("update goon_file_lang set ten = '".$db->escape($txt_ten)."' where id = '".$id."' and id_lang='".$lang."'");
                    if ($file)
                    {
                        $txt_file_2	= $file_name;
                        if (file_exists($up_dir.$txt_file_2))
                        {
                            @unlink($up_dir.$txt_file_2);
                        }
                        @rename($up_dir.$file_name,$up_dir.$txt_file_2);
                        $db->update("goon_file","file",$txt_file_2,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","?act=file_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
                }			
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên tài liệu.";
            else
            {
                // kiểm tra file uploads.
                $file_type = $_FILES['txt_file']['type'];
                $file_name = $_FILES['txt_file']['name'];
                $file_size = $_FILES['txt_file']['size'];
                $file_full_name = "tmp_".time().".".$file_type;
                $file = false;
                if ($file_size > 0) 
                {
                            if ( @move_uploaded_file($_FILES['txt_file']['tmp_name'],$up_dir.$file_name) )
                            {
                                $OK = true;
                                $file = true;
                            }
                            else
                                $error = "Không thể upload tài liệu.";
                }
                else
                {
                    if ($file_size == 0)
                    {
                        $OK		= true;
                        $file	= false;
                    }
                
                }
                // Process xong
                if ($OK)
                {
                    $db->query("update goon_file set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."' where id = '".$id."'");
                    $db->query("update goon_file_lang set ten = '".$db->escape($txt_ten)."' where id = '".$id."' and id_lang='".$lang."'");
                    if ($file)
                    {
                        $txt_file_2	= $file_name;
                        if (file_exists($up_dir.$txt_file_2))
                        {
                            @unlink($up_dir.$txt_file_2);
                        }
                        @rename($up_dir.$file_name,$up_dir.$txt_file_2);
                        $db->update("goon_file","file",$txt_file_2,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thành công.","");
                }			
            }
        }
        else
        {
            $r	= $db->select("goon_file","id = '".$id."'");
            $row = $db->fetch($r);
            $r3	= $db->select("goon_file_lang","id = '".$id."' and id_lang='".$lang."'");
            $row3 = $db->fetch($r3);
                $txt_cat		= $row["cat"];
                $txt_ten		= str_replace("\\","",$row3["ten"]);
                $txt_file_note	= $row["hinh_note"];
                $txt_hien_thi	= $row["hien_thi"];
                $txt_noi_bat	= $row["noi_bat"];
        }
        if (!$OK)
            template_edit("?act=file_edit","update",$id,$txt_cat,$txt_ten,$txt_file,$txt_hien_thi,$txt_noi_bat,$error,$lang)
    ?>
    </center>
</div>