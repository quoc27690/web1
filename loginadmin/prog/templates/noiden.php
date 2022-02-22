<?
function	template_edit($url,$func,$txt_cat,$txt_ten,$txt_san_pham,$txt_hinh,$error,$lang)
{
	$lang=$_SESSION['lang'];
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post"/>
<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<input type="hidden" name="lang" value="<?=$lang?>" />
	<table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Form</td></tr>
        <tr>
            <td width="20%">Tên :</td>
            <td width="80%">
                <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Dành cho :</td>
            <td>
                <div class="selectbox_form_chung">
					<span></span>
					<select name="txt_san_pham">
					<?php
					global $db;
					$r	=	$db->select("goon_product_menu_lang","hien_thi = 1 and id_lang='".$_SESSION['lang']."'","order by thu_tu");
					while($row = $db->fetch($r))
					{
						echo "<option value='".$row["id"]."'";
						if ($txt_san_pham==$row["id"]) echo ' selected="selected"';
						echo ">".$row["ten"]."</option>";
					}
					?>
					</select>
				</div>
            </td>
        </tr>
        <tr>
            <td>Icon :</td>
            <td>
                <?
                    if ($func == "update")
                    {
						global $db;
						$r		= $db->select("goon_noiden","id = '".$id."'");
						$row 	= $db->fetch($r);
						?>
						<input type="file" name="txt_hinh" class="inputbox" style="width:50%;float:left; margin-right:15px;" />
						<?=$row["hinh"]!="no"?"<img src='../../uploads/icon/icon_".$row['hinh']."' style='float:left' align='absmiddle' />":"<img src=\"images/false.gif\" />"?>
						<?
                    }
                    else echo '<input type="file" name="txt_hinh" class="inputbox" style="width:90%" />';
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