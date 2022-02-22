	<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
	<form action="?act=cat_new" method="post">
    	<input type="hidden" name="lang" value="<?=$_SESSION['lang']?>" />
        <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
            <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin danh mục</td></tr>
            <tr>
                <td width="20%">ID : </td>
                <td width="80%"><input type="text" name="id" class="inputbox" style="width:90%;"></td>
            </tr>
            <tr>
                <td>Tên danh mục :</td>
                <td><input type="text" name="ten" class="inputbox" style="width:90%;"></td>
            </tr>
            <tr>
                <td>Kiểu danh mục :</td>
                <td>
                	<div class="selectbox_form_chung">
                    	<span></span>
                        <select name="kieu">
                            <option value="">Chọn kiểu</option>
                            <option value="1">CMS</option>
                            <option value="2">Product</option>
                            <option value="3">Gallery</option>
                            <option value="4">Project</option>
                            <option value="5">Doc</option>
                            <option value="6">File</option>
                            <option value="7">Media</option>
                        </select>
                    </div>
              </td>
            </tr>
            <tr>
                <td width="100%" colspan="2" align="center" class="form_bot">
                    <div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button" value="Tạo mới" /></div>
                </td>
            </tr>
        </table>
    </form>
