<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_page.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TRANG NỘI DUNG <img src="images/bl3.gif" border="0" /> SỬA TRANG</strong>
    </div>
    <div class="border"></div>
    <center>
    <?
    function template_edit($url,$func,$id,$txt_alias,$txt_ten,$txt_noi_dung,$error,$lang)
    {
    ?>
    <?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
    <form name="frm_edit" id="frm_edit" action="" enctype="multipart/form-data" method="post" style="margin:0px;" />
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="hidden" name="func" value="<?=$func?>" />
        <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
            <tr><td class="khung_title" colspan="2"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin bài viết</td></tr>
            <tr>
                <td width="20%">Alias :</td>
                <td width="80%">
                    <input type="text" name="txt_alias" value="<?=$txt_alias?>" class="inputbox" style="width:90%" />
                </td>
            </tr>
            <tr>
                <td>Tên trang :</td>
                <td>
                    <input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
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
                <td class="form_bot"></td>
                <td class="form_bot">
                	<div class="khung_button" style="width:95px; float:left; margin:0 20px 0 150px">
                    	<input name="capnhat" type="submit" class="button_4" value="Cập nhật" />
                    </div>
                    <div class="khung_button" style="width:115px; float:left">
                    	<input name="luu" type="submit" class="button_4" value="Lưu và thoát" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <?
    }
    ?>
    <?php
        //	Kiểm tra sự tồn tại của ID
        $id = $id + 0;
        $r	= $db->select("goon_page","id = '".$id."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại trang này.","?act=page_list");
    
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên trang.";
            else if (empty($txt_noi_dung))
                $error = "Vui lòng nhập nội dung.";
            else
            {
                $db->query("update goon_page set alias = '".$db->escape($txt_alias)."', time = '".time()."' where id = '".$id."'");
                $db->query("update goon_page_lang set ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang= '".$lang."'");
                admin_load("Đã cập nhật thành công.","?act=page_new&id_lang=".$lang);	
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên trang.";
            else if (empty($txt_noi_dung))
                $error = "Vui lòng nhập nội dung.";
            else
            {
                $db->query("update goon_page set alias = '".$db->escape($txt_alias)."', time = '".time()."' where id = '".$id."'");
                $db->query("update goon_page_lang set ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang= '".$lang."'");
                admin_load("Đã cập nhật thành công.","");	
            }
        }
        else
        {
            $r	= $db->select("goon_page","id = '".$id."'");
            $row = $db->fetch($r);
            $r2	= $db->select("goon_page_lang","id = '".$id."' and id_lang = '".$lang."'");
            $row2 = $db->fetch($r2);
            
            $txt_alias		= $row["alias"];
            $txt_ten		= str_replace("\\","",$row2["ten"]);
            $txt_noi_dung	= str_replace("\\","",$row2["noi_dung"]);
        }
        if (!$OK)
            template_edit("?act=page_edit","update",$id,$txt_alias,$txt_ten,$txt_noi_dung,$error,$lang);
    ?>
    </center>
</div>