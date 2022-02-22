<?
function	template_edit($url,$func,$txt_cat,$cat,$txt_ten,$txt_hien_thi,$error,$lang)
{
	$lang=$_SESSION['lang'];
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post"/>
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<input type="hidden" name="lang" value="<?=$lang?>" />
	<table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin danh mục</td></tr>
        <tr>
            <td width="20%">Tên mục : </td>
            <td width="80%">
                <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Nhóm :</td>
            <td>
                <div class="selectbox_form_chung">
                    <span></span>
                    <select name="cat">
                	<?php
                    global $db;
                    $r = $db->select("goon_cat","_tron_goi = 1","order by thu_tu asc");
                    while ($row = $db->fetch($r))
                    {
                        echo "<option value='".$row["id"]."'";
						if ($cat == $row["id"]) echo " selected ";
						echo ">".$row["ten"]."</option>";
                        $d = $db->select("goon_tron_goi_menu_lang","id_lang = '".$_SESSION['lang']."' and cat = '".$row["id"]."' and id <> '".$txt_cat."'","order by id");
                        while ($rowd = $db->fetch($d))
                        {
                            echo "<option value='".$rowd["id"]."'";
							if ($cat == $rowd["id"]) echo " selected ";
							echo ">&nbsp;&nbsp;&nbsp;".$rowd["ten"]."</option>";
                        }
                    }
                	?>
                    </select>
                </div>
            </td>
        </tr>
        <tr class="radio">
            <td>
                Hiển thị :
            </td>
            <td>
                <input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Tắt
                <input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> Mở *
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
function	cat_count($txt_cat)
{
	global $db;
	$r	=	$db->select("goon_tron_goi_menu_lang","cat = '".$txt_cat."'");
	return $db->num_rows($r);
}
?>