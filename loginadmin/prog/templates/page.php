<?
function	template_edit($url,$func,$id,$txt_alias,$txt_ten,$txt_noi_dung,$error,$lang)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post"/>
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin bài viết</td></tr>
        <tr>
            <td width="15%">Alias :</td>
            <td width="85%">
                <input type="text" name="txt_alias" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Tên trang :</td>
            <td>
                <input type="text" name="txt_ten" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Nội dung :</td>
            <td> </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-right:30px">
                <textarea name="txt_noi_dung"><?=$txt_noi_dung?></textarea>
				<script>
                    CKEDITOR.replace( 'txt_noi_dung' );
                </script>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="100%" colspan="2" align="center" class="form_bot">
                <div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button" value="Tạo mới" /></div>
            </td>
        </tr>
	</table>
</form>
<?
}
?>