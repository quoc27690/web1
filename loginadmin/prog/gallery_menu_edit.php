<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_list_img2.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">HÌNH ẢNH <img src="images/bl3.gif" border="0" /> SỬA DANH MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/gallery_menu.php";
        if (empty($func)) $func = "";
        $txt_cat = $txt_cat+0;
        //	Kiểm tra sự tồn tại của ID
        $r	= $db->select("goon_gallery_menu","id = '".$txt_cat."'");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại Mục này.","?act=gallery_list&id_lang=".$lang);
        $OK = false;
        if ($luu)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên mục.";
            else
            {
                $db->query("update goon_gallery_menu set cat = '".$db->escape($cat)."', hien_thi = '".($txt_hien_thi+0)."' where id = '".$txt_cat."'");
                $db->query("update goon_gallery_menu_lang set ten = '".$db->escape($txt_ten)."' where id = '".$txt_cat."' and id_lang = '".$lang."'");
                admin_load("Đã cập nhật danh mục vào CSDL","?act=gallery_list&txt_cat=".$txt_cat."&id_lang=".$lang);
                $OK = true;
            }
        }
        if ($capnhat)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên mục.";
            else
            {
               $db->query("update goon_gallery_menu set cat = '".$db->escape($cat)."', hien_thi = '".($txt_hien_thi+0)."' where id = '".$txt_cat."'");
                $db->query("update goon_gallery_menu_lang set ten = '".$db->escape($txt_ten)."' where id = '".$txt_cat."' and id_lang = '".$lang."'");
                admin_load("Đã cập nhật danh mục vào CSDL","?act=gallery_menu_edit&txt_cat=".$txt_cat."&id_lang=".$lang);
                $OK = true;
            }
        }
        else
        {
            $r	= $db->select("goon_gallery_menu","id = '".$txt_cat."'");
            $row = $db->fetch($r);
            $r2	= $db->select("goon_gallery_menu_lang","id = '".$txt_cat."' and id_lang = '".$lang."'");
            $row2 = $db->fetch($r2);
				$txt_ten		=	$row2["ten"];
                $txt_cat		=	$row2["id"];
                $cat			=	$row["cat"];
                $txt_hien_thi	=	$row["hien_thi"];
        }
        if (!$OK)
            template_edit("?act=gallery_menu_edit","update",$txt_cat,$cat,$txt_ten,$txt_hien_thi,$error,$lang);
    ?>
    </center>
</div>