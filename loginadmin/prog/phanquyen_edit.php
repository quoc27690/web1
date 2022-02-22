<?
	$r = $db->select("goon_phanquyen","quyen='".$quyen."'");
	$row = $db->fetch($r);
	$level_arr	=	array("","Admin","Super Moderator","Moderator","Member");
?>
<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_phanquyen.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">PHÂN QUYỀN <img src="images/bl3.gif" border="0" /> SỬA THÔNG TIN PHÂN QUYỀN</strong>
    </div>
    <div class="border"></div>
    <center>
        <form action="" method="post">
            <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        		<tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Phân quyền</td></tr>
                <tr>
                    <td width="20%">Cấp :</td>
                    <td width="80%">
                        <input type="text" name="cap" value="<?=$level_arr[$row["quyen"]]?>" class="inputbox" style="width:90%" >
                    </td>
                </tr>
                <tr>
                    <td valign="top">Phân quyền :</td>
                    <td>
                    	<div class="inputbox" style="width:90%">
                            <input type="checkbox" name="xoa" value="1" <?=$row["xoa"]==1?"checked":""?>>Quyền xóa<br>
                            <input type="checkbox" name="tintuc" value="1" <?=$row["tin_tuc"]==1?"checked":""?>>Quản lý tin tức<br>
                            <input type="checkbox" name="hinhanh" value="1" <?=$row["hinh_anh"]==1?"checked":""?>>Quản lý hình ảnh<br>
                            <input type="checkbox" name="sanpham" value="1" <?=$row["san_pham"]==1?"checked":""?>>Quản lý sản phẩm<br>
                            <input type="checkbox" name="duan" value="1" <?=$row["du_an"]==1?"checked":""?>>Quản lý dự án<br>
                            <input type="checkbox" name="baiviet" value="1" <?=$row["bai_viet"]==1?"checked":""?>>Quản lý bài viết<br>
                            <input type="checkbox" name="file" value="1" <?=$row["file"]==1?"checked":""?>>Quản lý file<br>
                            <input type="checkbox" name="media" value="1" <?=$row["media"]==1?"checked":""?>>Quản lý media<br>
                            <input type="checkbox" name="taikhoan" value="1" <?=$row["tai_khoan"]==1?"checked":""?>>Quản lý tài khoản<br>
                            <input type="checkbox" name="cauhinh" value="1" <?=$row["cau_hinh"]==1?"checked":""?>>Quản lý cấu hình<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100%" colspan="2" align="center" class="form_bot"> 
                        <div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button_4" value="Cập nhật" /></div>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</div>
<?
	if($submit)
	{
	$db->query("update goon_phanquyen set xoa='".$xoa."',tin_tuc='".$tintuc."',hinh_anh='".$hinhanh."',san_pham='".$sanpham."',du_an='".$duan."',bai_viet='".$baiviet."',file='".$file."',tai_khoan='".$taikhoan."',cau_hinh='".$cauhinh."',media='".$media."' where quyen='".$quyen."'");
	admin_load("Đã cập nhật thành công.","?act=phanquyen_manager");
	}
?>