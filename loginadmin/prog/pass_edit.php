<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_taikhoan.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TÀI KHOẢN <img src="images/bl3.gif" border="0" /> ĐỔI MẬT KHẨU</strong>
    </div>
    <div class="border"></div>
    <center>
        <form method="post" style="margin:0px;">
            <input type="hidden" name="id" value="<?=$id?>" />
            <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        		<tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Đổi mật khẩu</td></tr>
                <tr>
                    <td width="20%">Mật khẩu cũ :</td>
                    <td width="80%"><input type="password" name="txt_password_cu" class="inputbox" style="width:90%" /></td>
                </tr>
                <tr>
                    <td>Mật khẩu mới :</td>
                    <td><input type="password" name="txt_password" class="inputbox" style="width:90%" /></td>
                </tr>
                <tr>
                    <td>Xác nhận mật khẩu mới :</td>
                    <td><input type="password" name="txt_password2" class="inputbox" style="width:90%" /></td>
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
	$OK = false;
	$id_user = $_POST['id'];
	$txt_password_cu = $_POST['txt_password_cu'];
	$txt_password = $_POST['txt_password'];
	$txt_password2 = $_POST['txt_password2'];
	$r1 = $db->select("goon_user","id='".$id."'");
	$row1 = $db->fetch($r1);
	$sosanh = md5($txt_password_cu.$row1['username']);
	if($submit)
	{
		if ($sosanh!=$row1['password'])
		{
	?>
			<script type="text/javascript">
                alert("Sai mật khẩu cũ");
            </script>
    <?
    	}
		else if ($txt_password != $txt_password2)
			{
				?>
					<script type="text/javascript">
						alert("Mật khẩu mới không trùng khớp");
					</script>
				<?
			}
		else
		{
			$db->query("update goon_user set password = '".md5($txt_password.$row1['username'])."' where id = '".$id."'");
			$OK = true;
			admin_load("Đã thay đổi mật khẩu cho User đó.","?act=member_list");
		}
	}
?>