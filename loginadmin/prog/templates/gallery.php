<script type="text/javascript">
function preview_image() 
{
 var total_file=document.getElementById("upload_file").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
 }
}
</script>
<style type="text/css">
#image_preview img {
    margin: 5px;
    width: 150px;
    height: 90px;
}
.upload {
    display:block;
    color:#FFFFFF;
    line-height:30px;
    font-weight:bold;
    text-decoration:none;
    background:url(images/upload.jpg) no-repeat;
    width:120px;
    height:30px;
    margin-top:10px;
    border: 0;
    cursor: pointer;
}
</style>
<?
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hien_thi,$txt_noi_bat,$txt_link,$error,$lang)
{
	$lang=$_SESSION['lang'];
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<input type="hidden" name="lang" value="<?=$lang?>" />
	<table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin hình ảnh</td></tr>
        <tr>
            <td width="20%">Tên hình ảnh :</td>
            <td width="80%">
                <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Nhóm :</td>
            <td>
                <? show_cat("txt_cat",$txt_cat); ?>
            </td>
        </tr>
        <?php 
        if ($func == "new")
        {
        ?>
        <tr>
            <td>Up nhiều hình(10 hình): </td>
            <td>
                <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple class="inputbox" style="width:90%"/>
                <div id="image_preview"></div>
            </td>
        </tr>   
        <?php
        }
        if ($func == "update")
        {
            global $db;
            $r      = $db->select("goon_gallery","id = '".$id."'");
            $row    = $db->fetch($r);
        ?>
        <tr>
            <td>Hình ảnh: </td>
            <td>
                <input type="file" name="txt_hinh" class="inputbox" style="width:50%;float:left; margin-right:15px;" />
                <?=$row["hinh"]!="no"?"<img src='../../uploads/gal/hinhadmin_".$row['hinh']."' style='width:150px; height:90px;float:left' align='absmiddle' />":"<img src=\"images/false.gif\" />"?>
            </td>
        </tr>   
        <?php
        }
        ?>
        <tr>
            <td>Ghi chú :</td>
            <td> </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-right:30px">
                <textarea name="txt_chu_thich"><?=$txt_chu_thich?></textarea>
                <script>
                    CKEDITOR.replace( 'txt_chu_thich' );
                </script>
            </td>
        </tr>
        <tr>
          <td>Link :</td>
          <td><input type="text" name="txt_link" value="<?=$txt_link?>" class="inputbox" style="width:90%" /></td>
          </tr>
        <tr class="radio">
            <td>
                Hiển thị :</td>
            <td>
                <input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Tắt
                <input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> Mở *
            </td>
        </tr>
        <tr class="radio">
            <td>
                Nổi bật :</td>
            <td>
                <input name="txt_noi_bat" type="radio" value="0" <?=$txt_noi_bat==0?"checked":""?> /> Tắt
                <input name="txt_noi_bat" type="radio" value="1" <?=$txt_noi_bat==1?"checked":""?> /> Mở *
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
	
$r2 = $db->select("goon_cat","_gallery = 1","order by thu_tu asc");
?>
<div class="selectbox_form_chung">
	<span></span>
    <select name="<?=$name?>">
    <?php
    while ($row2 = $db->fetch($r2))
    {
        echo "<optgroup label='".$row2["ten"]."'>";
        $r	=	$db->select("goon_gallery_menu","cat = '".$row2["id"]."'","order by thu_tu asc");
        while ($row = $db->fetch($r))
        {
			$r5	=	$db->select("goon_gallery_menu_lang","id = '".$row["id"]."' and id_lang='".$_SESSION['lang']."'");
            $row5 = $db->fetch($r5);
            echo "<option value='".$row["id"]."'";
            if ($id == $row["id"]) echo " selected ";
            echo ">";
            echo"".$row5["ten"]."</option>";
        }
        echo "</optgroup>";
    }
    ?>
    </select>
</div>
<?php
}
?>