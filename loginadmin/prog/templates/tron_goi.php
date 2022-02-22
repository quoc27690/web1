<?
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$txt_giam_gia,$txt_cap_sao,$photos,$error,$lang)
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
                    $r		= $db->select("goon_tron_goi","id = '".$id."'");
                    $row 	= $db->fetch($r);
                ?>
                <input type="file" name="txt_hinh" class="inputbox" style="width:50%;float:left; margin-right:15px;" />
                <?=$row["hinh"]!="no"?"<img src='../../uploads/tron_goi/admin_".$row['hinh']."' style='width:150px; height:90px;float:left' align='absmiddle' />":"<img src=\"images/false.gif\" />"?>
                    
                <?
                    }
                    if ($func == "new")
                    echo '<input type="file" name="txt_hinh" class="inputbox" style="width:90%" />';
                ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Sơ lược sản phẩm :</td>
            <td><textarea name="txt_chu_thich" class="inputbox" style="width:90%" rows="3"><?=$txt_chu_thich?></textarea></td>
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
            <td colspan="2" align="center">
            <?php
                $file = explode(";",$photos);
                if ( $file[0] != NULL )
                {
                    foreach($file as $img)
                    {
                        echo	'<span style="padding:5px; display:block; float:left"><a href="/uploads/tron_goi/lon_'.$img.'" target="_blank"><img src="/uploads/tron_goi/nho_'.$img.'" border="0" style="border:1px #999999 solid;" width="125" height="95"></a><br><a href="?act=tron_goi_img_del&id='.$id.'&txt_cat='.$txt_cat.'&id_lang='.$lang.'&file='.$img.'">delete</a></span>';
                    }
                }
            ?>
            </td>
        </tr>
        
    <?php 
        if ($func == "update")
        {
    ?>
        <tr>
            <td colspan="2">
            <center>
    <script type="text/javascript">
    function startUpload(id, conditional)
    {
        if(conditional.value.length != 0) {
            $('#'+id).fileUploadStart();
        } else
            alert("You must enter your name. Before uploading");
    }
    </script>		
    <script type="text/javascript">
    $(document).ready(function() {
    
        $("#fileUploadname2").fileUpload({
            'uploader': 'uploadify/uploader.swf',
            'cancelImg': 'uploadify/cancel.png',
            'script': 'uploadify/uploadify_tron_goi.php',
            'folder': '../uploads/tron_goi',
            'multi': true,
            'removeCompleted':false,
            'scriptData': {'id':'<?=$id?>'}, // If the value is known to php you can also enter it here ie < ?= $value ?> or < ?= $_RESULT['value'] ?>
            onComplete: function (evt, queueID, fileObj, response, data) {
                alert("Successfully uploaded: "+response);
            },
            onAllComplete: function () {
                window.location.reload();
            }
        });
    
    });
    </script>
                    <style type="text/css">
                    .fileUploadQueueItem {
                    font: 11px Verdana, Geneva, sans-serif;
                    background-color: #F5F5F5;
                    border: 3px solid #E5E5E5;
                    margin-top: 5px;
                    padding: 10px;
                    width: 300px;
                    }
                    .fileUploadQueueItem .cancel {
                    float: right;
                    }
                    .fileUploadProgress {
                    background-color: #FFFFFF;
                    border-top: 1px solid #808080;
                    border-left: 1px solid #808080;
                    border-right: 1px solid #C5C5C5;
                    border-bottom: 1px solid #C5C5C5;
                    margin-top: 10px;
                    width: 100%;
                    }
                    .fileUploadProgressBar {
                    background-color: #0099FF;
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
                    }
                                </style>
    
                <div id="fileUploadname2">You have a problem with your javascript</div>
                <a class="upload" href="javascript:$('#fileUploadname2').fileUploadStart();">Upload Files</a>
    
    </center>
    
    </td>
        </tr>	
    <?php
    }
    ?>
        <tr>
        <tr>
            <td>Giá :</td>
            <td>
                <input type="text" name="txt_gia" dir="ltr" value="<?=$txt_gia?>" class="inputbox" style="width:45%" /> (=0, nếu CALL)
            </td>
        </tr>
        <tr>
            <td>Giảm giá:</td>
            <td>
                <input type="text" name="txt_giam_gia" value="<?=$txt_giam_gia?>" class="inputbox" style="width:45%" /> % (=0 nếu không giảm)
            </td>
        </tr>
        <tr>
            <td>Cấp sao:</td>
            <td>
                <div class="selectbox_form_chung">
                    <span></span>
                    <select name="txt_cap_sao">
                    <?php
						for($i=1; $i<=5; $i++)
						{
							echo "<option value='".$i."'";
							if ($txt_cap_sao==$i) echo "selected";
							echo ">$i</option>";
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
        <tr class="radio">
            <td>
                Nổi bật :
            </td>
            <td>
                <input name="txt_noi_bat" type="radio" value="0" <?=$txt_noi_bat==0?"checked":""?> /> Tắt *
                <input name="txt_noi_bat" type="radio" value="1" <?=$txt_noi_bat==1?"checked":""?> /> Mở 
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
	$r2 = $db->select("goon_cat","_tron_goi = 1","order by thu_tu asc");
	?>
	<div class="selectbox_form_chung">
		<span></span>
		<select name="<?=$name?>">
		<?php
		while ($row2 = $db->fetch($r2))
		{
			echo "<optgroup label='".$row2["ten"]."'>";
			$r	=	$db->select("goon_tron_goi_menu_lang","cat = '".$row2["id"]."' and id_lang='".$_SESSION['lang']."'","order by thu_tu asc");
			while ($row = $db->fetch($r))
			{
				echo "<option value='".$row["id"]."'";
				if ($id == $row["id"]) echo " selected ";
				echo ">".$row["ten"]."</option>";
				$r3	=	$db->select("goon_tron_goi_menu_lang","cat = '".$row["id"]."' and id_lang = '".$_SESSION["lang"]."'","order by thu_tu");
				while ($row3 = $db->fetch($r3))
				{
					echo "<option value='".$row3["id"]."'";
					if ($id == $row3["id"]) echo " selected ";
					echo ">".$row3["ten"]."</option>";
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