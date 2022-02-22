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
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$photos,$txt_title,$txt_description,$txt_khoa,$thoi_gian,$tin_to,$ban_chay,$hanh_trinh,$error,$lang)
{
	$lang=$_SESSION['lang'];
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
<input type="hidden" name="lang" value="<?=$lang?>" />
	<table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
        <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin sản phẩm</td></tr>
        <tr>
            <td width="20%">Tên sản phẩm : </td>
            <td width="80%">
                <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Nhóm :</td>
            <td>
                <? show_cat("txt_cat",$txt_cat);?>
            </td>
        </tr>
        <tr>
            <td valign="top">Hình ảnh :</td>
            <td>
                <?
                    if ($func == "update")
                    {
                    global $db;
                    $r		= $db->select("goon_product","id = '".$id."'");
                    $row 	= $db->fetch($r);
                ?>
                <input type="file" name="txt_hinh" class="inputbox" style="width:50%;float:left; margin-right:15px;" />
                <?=$row["hinh"]!="no"?"<img src='../../uploads/product/admin_".$row['hinh']."' style='width:150px; height:90px;float:left' align='absmiddle' />":"<img src=\"images/false.gif\" />"?>
                    
                <?
                    }
                    if ($func == "new")
                    echo '<input type="file" name="txt_hinh" class="inputbox" style="width:90%" />';
                ?>
            </td>
        </tr>
        <!--<tr>
            <td valign="top">Sơ lược sản phẩm :</td>
            <td><textarea name="txt_chu_thich" class="inputbox" style="width:90%" rows="3"><?=$txt_chu_thich?></textarea></td>
        </tr>-->
        <tr>
            <td>Hành trình :</td>
            <td>
                <input type="text" name="hanh_trinh" value="<?=$hanh_trinh?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Chú thích:</td>
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
        <?php 
        if ($func == "update")
        {
        ?>
        <tr>
            <td colspan="2" align="center">
            <?php
                $file = explode(";",$photos);
                if ( $file[0] != NULL )
                {
                    foreach($file as $img)
                    {
                        echo    '<span style="padding:5px; display:block; float:left"><a href="/uploads/product/lon_'.$img.'" target="_blank"><img src="/uploads/product/nho_'.$img.'" border="0" style="border:1px #999999 solid;"></a><br><a href="?act=product_img_del&id='.$id.'&file='.$img.'">delete</a></span>';
                    }
                }
            ?>
            </td>
        </tr>
        <tr>
            <td>Slide Image</td>
            <td>
                <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple/>
                <div id="image_preview"></div>
                <input type="submit" name='submit_image' class="upload" value="Upload Image"/>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td>Giá :</td>
            <td>
                <input type="text" name="txt_gia" dir="ltr" value="<?=$txt_gia?>" class="inputbox" style="width:45%" /> (=0, nếu CALL)
            </td>
        </tr>
        <tr>
            <td>Thời gian : </td>
            <td>
                <input type="text" name="thoi_gian" value="<?=$thoi_gian?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Thẻ title : </td>
            <td>
                <input type="text" name="txt_title" value="<?=$txt_title?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Thẻ description : </td>
            <td>
                <input type="text" name="txt_description" value="<?=$txt_description?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr>
            <td>Thẻ keyword : </td>
            <td>
                <input type="text" name="txt_khoa" value="<?=$txt_khoa?>" class="inputbox" style="width:90%" />
            </td>
        </tr>
        <tr class="radio">
            <td>
                Sản phẩm mới:
            </td>
            <td>
                <input name="tin_to" type="radio" value="0" <?=$tin_to==0?"checked":""?> /> Tắt
                <input name="tin_to" type="radio" value="1" <?=$tin_to==1?"checked":""?> /> Mở *
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
        <tr class="radio">
            <td>
                Nổi bật :
            </td>
            <td>
                <input name="txt_noi_bat" type="radio" value="0" <?=$txt_noi_bat==0?"checked":""?> /> Tắt *
                <input name="txt_noi_bat" type="radio" value="1" <?=$txt_noi_bat==1?"checked":""?> /> Mở 
            </td>
        </tr>
        <tr class="radio">
            <td>
                Bán chạy :
            </td>
            <td>
                <input name="ban_chay" type="radio" value="0" <?=$ban_chay==0?"checked":""?> /> Tắt *
                <input name="ban_chay" type="radio" value="1" <?=$ban_chay==1?"checked":""?> /> Mở 
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
function show_cat($name,$id)
{
	global $db;
	$r2 = $db->select("goon_cat","_product = 1","order by thu_tu asc");
	?>
	<div class="selectbox_form_chung">
		<span></span>
		<select name="<?=$name?>">
		<?php
		while ($row2 = $db->fetch($r2))
		{
			echo "<optgroup label='".$row2["ten"]."'>";
			$r	=	$db->select("goon_product_menu_lang","cat = '".$row2["id"]."' and id_lang='".$_SESSION['lang']."'","order by thu_tu");
			while ($row = $db->fetch($r))
			{
				echo "<option value='".$row["id"]."'";
				if ($id == $row["id"]) echo " selected ";
				echo ">".$row["ten"]."</option>";
				$r3	=	$db->select("goon_product_menu_lang","cat = '".$row["id"]."' and id_lang = '".$_SESSION["lang"]."'","order by thu_tu");
				while ($row3 = $db->fetch($r3))
				{
					echo "<option value='".$row3["id"]."'";
					if ($id == $row3["id"]) echo " selected ";
					echo ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row3["ten"]."</option>";
				}
			}
			echo "</optgroup>";
		}
		?>
		</select>
	</div>
	<?php
}
?>