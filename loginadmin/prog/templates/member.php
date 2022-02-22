<?
function	template_edit($url, $func, $id,$txt_hinh,$txt_ten,$txt_level,$txt_trang_thai,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin tài khoản</td></tr>
	<tr>
		<td width="20%">Name :</td>
		<td width="80%"><input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" /></td>
	</tr>
    <tr>
		<td>Avatar :</td>
		<td>
        	<?
				global $db;
				$r		= $db->select("goon_user","id = '".$id."'");
				$row 	= $db->fetch($r);
			?>
            <?=$row["hinh"]!="no"?"<img src='../../uploads/admin/hinhadmin_".$row['hinh']."' style='width:150px; height:90px;float:left' />":"<img src=\"images/false.gif\" />"?>
        		<input type="file" name="txt_hinh" class="inputbox" style="width:65%;float:right; margin-right:65px" />
        </td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td>Site Level :
		</td>
		<td>
        	<div class="selectbox_form_chung" style="width:172px;">
            	<span></span>
                <select name="txt_level" style="width:180px;">
                    <option value="2" <?=$txt_level==2?"selected":""?>>Super Moderator</option>
                    <option value="3" <?=$txt_level==3?"selected":""?>>Moderator</option>
                    <option value="4" <?=$txt_level==4?"selected":""?>>Member</option>
                </select>
            </div>
		</td>
	</tr>
	<tr class="radio">
		<td>
			Active :
		</td>
		<td>
			<input name="txt_trang_thai" type="radio" value="0" <?=$txt_trang_thai==0?"checked":""?> /> Tắt
			<input name="txt_trang_thai" type="radio" value="1" <?=$txt_trang_thai==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center" class="form_bot">
        	<div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button_4" value="Cập nhật" /></div>
		</td>
	</tr>
	</table>
</form>
<?
}
?>