<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SỬA PHONG CÁCH</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/khoihanh.php";
        if (empty($func)) $func = "";
		$txt_cat = $txt_cat+0;
		$r	= $db->select("goon_khoihanh","id = '".$txt_cat."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại Mục này.","?act=phongcach_new&id_lang=".$lang);
        $OK = false;
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên.";
            else
            {
                $db->query("update goon_khoihanh set ten = '".$db->escape($txt_ten)."' where id = '".$txt_cat."' and id_lang = '".$lang."'");
                admin_load("Đã cập nhật thành công.","?act=phongcach_new&id_lang=".$lang);
                $OK = true;
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên.";
            else
            {
                $db->query("update goon_khoihanh set ten = '".$db->escape($txt_ten)."' where id = '".$txt_cat."' and id_lang = '".$lang."'");
                admin_load("Đã cập nhật thành công.","?act=phongcach_edit&txt_cat=".$txt_cat."&id_lang=".$lang);
                $OK = true;
            }
        }
        else
        {
            $r2	= $db->select("goon_khoihanh","id = '".$txt_cat."' and id_lang = '".$lang."'");
            $row2 = $db->fetch($r2);
                $txt_ten		=	$row2["ten"];
				$txt_cat		=	$row2["id"];
        }
        if (!$OK)
            template_edit("?act=phongcach_edit","update",$txt_cat,$txt_ten,$error,$lang);
    ?>
    </center>
</div>