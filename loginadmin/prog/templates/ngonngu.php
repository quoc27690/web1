<?
function	template_edit($url,$func,$id,$txt_ten,$txt_iso_code,$txt_hinh,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post" style="margin:0px;" />
    <input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="func" value="<?=$func?>" />
    <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin danh mục</td></tr>
        <tr>
            <td width="20%">Tên ngôn ngữ : </td>
            <td width="80%">
                <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td valign="top">Iso_code :</td>
            <td><input type="text" name="txt_iso_code" value="<?=$txt_iso_code?>" class="inputbox" style="width:90%" /></td>
        </tr>
        <tr>
            <td valign="top">Hình ảnh :</td>
            <td>
            	<?
                    if ($func == "update")
                    {
                    global $db;
                    $r		= $db->select("goon_lang","id = '".$id."'");
                    $row 	= $db->fetch($r);
                ?>
                <?=$row["hinh"]!="no"?"<img src='../../uploads/lang/admin_".$row['hinh']."' style='width:80px; height:50px;float:left' />":"<img src=\"images/false.gif\" />"?>
                    <input type="file" name="txt_hinh" class="inputbox" style="width:75%;float:right; margin-right:65px" />
                <?
                    }
                    if ($func == "new")
                    echo '<input type="file" name="txt_hinh" class="inputbox" style="width:90%" />';
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        
        <tr>
            <?
                if ($func=="new")
                {
                ?>
                    <td width="100%" colspan="2" align="center" class="form_bot">
                        <div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button" value="Tạo mới" /></div>
                    </td>
                <?
                }
                if ($func=="update")
                {
                ?>
                    <td class="form_bot"></td>
                    <td class="form_bot">
                        <div class="khung_button" style="width:95px; float:left; margin:0 20px 0 150px">
                            <input name="capnhat" type="submit" class="button_4" value="Cập nhật" />
                        </div>
                        <div class="khung_button" style="width:115px; float:left">
                            <input name="luu" type="submit" class="button_4" value="Lưu và thoát" />
                        </div>
                    </td>
                <?
                }
            ?>
        </tr>
	</table>
</form>
<?
}
?>