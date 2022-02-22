<?php
function	template_edit($url,$func,$txt_cat,$cat,$txt_ten,$txt_hien_thi,$error,$lang)
{
	$lang=$_SESSION['lang'];
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post" style="margin:0px;" />
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
                <? show_cat("cat",$cat); ?>
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
function	show_cat($name,$id)
{
	global $db;
	
$r = $db->select("goon_cat","_file = 1","order by thu_tu asc");
?>
<div class="selectbox_form_chung" >
	<span></span>
    <select name="<?=$name?>">
    <?php
    while ($row = $db->fetch($r))
    {
        echo "<option value='".$row["id"]."'";
        if ($cat == $row["id"]) echo " selected ";
        echo ">".$row["ten"]."</option>";
    }
    ?>
    </select>
</div>
<?php
}
function	cat_count($txt_cat)
{
	global $db;
	$r	=	$db->select("goon_file_menu","cat = '".$txt_cat."'");
	return $db->num_rows($r);
}
?>