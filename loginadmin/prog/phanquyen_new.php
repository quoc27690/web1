<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_phanquyen.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">PHÂN QUYỀN</strong>
    </div>
    <div class="border"></div>
    <center>
        <form action="?act=phanquyen_new" method="post">
             <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        		<tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Phân quyền</td></tr>
                <tr>
                    <td width="20%">Cấp :</td>
                    <td width="80%">
                    	<div class="selectbox_form_chung">
                            <select name="cap">
                                <option value="">Chọn cấp</option>
                                <option value="1">Super Mod</option>
                                <option value="2">Mod</option>
                                <option value="3">Member</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Phân quyền :</td>
                    <td>
                    	<div class="inputbox" style="width:90%">
                        	<input type="checkbox" name="xoa" value="1">Quyền xóa<br>
                            <input type="checkbox" name="tintuc" value="1">Quản lý tin tức<br>
                            <input type="checkbox" name="hinhanh" value="1">Quản lý hình ảnh<br>
                            <input type="checkbox" name="sanpham" value="1">Quản lý sản phẩm<br>
                            <input type="checkbox" name="duan" value="1">Quản lý dự án<br>
                            <input type="checkbox" name="baiviet" value="1">Quản lý bài viết<br>
                            <input type="checkbox" name="file" value="1">Quản lý file<br>
                            <input type="checkbox" name="media" value="1">Quản lý media<br>
                            <input type="checkbox" name="taikhoan" value="1">Quản lý tài khoản<br>
                            <input type="checkbox" name="cauhinh" value="1">Quản lý cấu hình<br>
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
	$db->insert("goon_phanquyen","quyen,tin_tuc,hinh_anh,san_pham,du_an,bai_viet,file,tai_khoan,cau_hinh,xoa,media","'".$cap."','".$tintuc."','".$hinhanh."','".$sanpham."','".$duan."','".$baiviet."','".$file."','".$taikhoan."','".$cauhinh."','".$xoa."','".$media."'");
	admin_load("Đã cập nhật thành công.","?act=phanquyen_manager");
	}
?>