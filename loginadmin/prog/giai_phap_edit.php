<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">HÀNH TRÌNH <img src="images/bl3.gif" border="0" /> SỬA BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/giai_phap.php";
        if (empty($func)) $func = "";
        $OK = false;
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên bài viết.";
            else if (empty($txt_noi_dung))
                $error = "Vui lòng nhập nội dung bài viết.";
            else
            {
                $OK     = true;
                // Process xong
                if ($OK)
                {
                    $db->query("update goon_giai_phap_lang set ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang='".$lang."'");
                    admin_load("Đã cập nhật thành công.","?act=giai_phap_list&tour=".($tour+0)."&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
                }			
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên bài viết.";
            else if (empty($txt_noi_dung))
                $error = "Vui lòng nhập nội dung bài viết.";
            else
            {
                $OK     = true;
                // Process xong
                if ($OK)
                {
                    $db->query("update goon_giai_phap_lang set ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."' where id = '".$id."' and id_lang='".$lang."'");
                    admin_load("Đã cập nhật thành công.","");
                }			
            }
        }
        else
        {
            $r3	= $db->select("goon_giai_phap_lang","id = '".$id."'");
            $row3 = $db->fetch($r3);
            $txt_ten		= str_replace("\\","",$row3["ten"]);
            $txt_noi_dung	= str_replace("\\","",$row3["noi_dung"]);
        }
        
        if (!$OK)
            template_edit("?act=giai_phap_edit","update",$id,$txt_cat,$txt_ten,$txt_noi_dung,$tour,$error,$lang);
    ?>
    </center>
</div>