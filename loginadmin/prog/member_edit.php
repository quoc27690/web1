<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_taikhoan.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TÀI KHOẢN <img src="images/bl3.gif" border="0" /> SỬA THÔNG TIN TÀI KHOẢN</strong>
    </div>
    <div class="border"></div>
    <center>
    <?
        include "templates/member.php";
        if (empty($func)) $func = "";
        $max_file_size	=	2048000;
        $up_dir			=	"../uploads/admin/";
        $OK = false;
        $id =	$id+0;
        $r	=	$db->select("goon_user","id = '".$id."'");
        if ($db->num_rows($r) == 0)
        {
            Admin_Load("Không tồn tại username này.","?act=member_list");
            $OK = true;
        }
        if ($func == "update")
        {
            // kiểm tra email
            if (kt_email_dung($txt_email))
                $error = "Email của bạn không hợp lệ";
            // kiểm tra tên thành viên
            else if (empty($txt_ten))
                $error = "Vui lòng nhập Tên Thành viên.";
            // kiểm tra số điện thoại
            else if (empty($txt_dien_thoai))
                $error = "Vui lòng nhập Số điện thoại.";
            // kiểm tra địa chỉ
            else if (empty($txt_dia_chi))
                $error = "Vui lòng nhập Địa chỉ.";
            // OK all
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
                    $db->query("update goon_user set ten = '".$db->escape($txt_ten)."', email = '".$db->escape($txt_email)."', dien_thoai = '".$db->escape($txt_dien_thoai)."', dia_chi = '".$db->escape($txt_dia_chi)."', level = '".($txt_level+0)."', trang_thai = '".($txt_trang_thai+0)."' where id = '".$id."'");
                    if ($hinh)
                    {
                        $txt_hinh_1	= "admin_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=125&h=90&zc=1");
                        $txt_hinh_2	= "hinhadmin_".$id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=60&h=40&zc=1");
                        $txt_hinh_3	= $id.".".$file_type;
                        img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"w=50&h=50&zc=1");
                        $db->update("goon_user","hinh",$txt_hinh_3,"id = '".$id."'");
                    }
                    admin_load("Đã cập nhật thông tin cho User đó.","?act=member_list&id_lang=".$lang);
                }
            }
        }
        else
        {
            $r	=	$db->select("goon_user","id = '".$id."'");
            while ($row = $db->fetch($r))
            {
                $txt_username	=	$row["username"];
                $txt_ten 		=	$row["ten"];
                $txt_level		=	$row["level"];
                $txt_trang_thai	=	$row["trang_thai"];
            }
            $error			=	"";
        }
        if (!$OK)
            template_edit("?act=member_edit", "update", $id , $txt_username,$txt_hinh  , $txt_ten  , $txt_level , $txt_trang_thai , $error);
    ?>
    </center>
</div>