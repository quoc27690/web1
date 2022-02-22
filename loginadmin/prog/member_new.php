
<style type="text/css">
.form_chung tr td{
	padding:3px 0 3px 10px;
}
</style>
<?
function template_edit($url,$func,$txt_username,$txt_ten,$txt_level,$txt_trang_thai,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" />
    <input type="hidden" name="func" value="<?=$func?>" />
	<table cellpadding="0" cellspacing="0" width="200" class="form_chung" style="background:none; border:none; font-weight:bold">
        <tr><td>Username</td></tr>
        <tr><td><input type="text" name="txt_username" class="inputbox" style="width:90%" autocomplete="off"/></td></tr>
        <tr><td>Password</td></tr>
        <tr><td><input type="password" name="txt_password" class="inputbox" style="width:90%" /></td></tr>
        <tr><td>Name</td></tr>
        <tr><td><input type="text" name="txt_ten" class="inputbox" style="width:90%" /></td></tr>
        <tr><td>Site Level</td></tr>
        <tr>
            <td>
            	<div class="selectbox_form_chung" style="width:172px;">
                	<span></span>
                	<select name="txt_level" style="width:180px;">
                    	<option value="2">Super Moderator</option>
                        <option value="3">Moderator</option>
                        <option value="4">Member</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr><td>Active</td></tr>
        <tr>
            <td>
                <input name="txt_trang_thai" type="radio" value="0" /> Tắt
				<input name="txt_trang_thai" type="radio" value="1" <?=$txt_trang_thai==1?"checked":""?> /> Mở *
            </td>
        </tr>
        <tr><td>New avatar</td></tr>
        <tr><td><input type="file" name="txt_hinh" class="inputbox" style="width:90%" /></td></tr>
        <tr>
            <td align="center">
            	<div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button" value="Tạo mới" /></div>
            </td>
        </tr>
	</table>
</form>
<?
}
?>

<?
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/admin/";
	$OK = false;
	if ($func == "new")
	{
		// kiểm tra user tồn tại
		$r = $db->select("goon_user","username = '".$db->escape($txt_username)."'");
		if ($db->num_rows($r) != 0)
			$error = "Username này đã tồn tại. Vui lòng thử lại tên khác.";
		// kiểm tra username
		else if (empty($txt_username))
			$error = "Vui lòng nhập Tên Đăng nhập.";
		// kiểm tra chuẩn username
		else if (kt_user_dung($txt_username))
			$error = "Tên đăng nhập không Chuẩn (Chỉ bao gồm các ký tự a-z và 0-9, các dấu -, _)";
		// xác thực về mật khẩu
		else if (empty($txt_password))
			$error = "Vui lòng nhập mật khẩu.";
		// kiểm tra tên thành viên
		else if (empty($txt_ten))
			$error = "Vui lòng nhập Tên Thành viên.";
		// kiểm tra số điện thoại
		// OK all
		else
		{
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
				$select = "select Max(id) AS max from goon_user";
				$sql=mysql_query($select) or die ("khong ket noi duoc");
				$row1=mysql_fetch_array($sql);
				$id = $row1["max"] + 1;
				$db->insert("goon_user","id,username,password,ten,level,trang_thai","'".$id."','".$db->escape($txt_username)."','".md5($txt_password.$txt_username)."','".$db->escape($txt_ten)."','".($txt_level+0)."','".($txt_trang_thai+0)."'");
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
				admin_load("Đã thêm user vào CSDL","?act=member_list&id_lang=".$lang);
			}
		}
	}
	else
	{
		$txt_username	=	"";
		$txt_ten 		=	"";
		$txt_level		=	2;
		$txt_trang_thai	=	1;
		$error			=	"";
	}
	if (!$OK)
		template_edit("?act=member_new", "new", $txt_username , $txt_ten , $txt_level , $txt_trang_thai , $error);
?>
