<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">FILE <img src="images/bl3.gif" border="0" /> THÊM MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
	<?php
        include "templates/file_menu.php";
        if (empty($func)) $func = "";
        $cat = $db->escape($cat);
        //	Kiểm tra sự tồn tại của ID
        $r	= $db->select("goon_cat","id = '".$cat."' and _file = 1");
        if ($db->num_rows($r) == 0)
            admin_load("Không tồn tại Nhóm này.","?act=file_list&id_lang=".$lang);
        $OK = false;
        if ($submit)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên mục.";
            else
            {
                $select = "select Max(id) AS max from goon_file_menu";
                $sql=mysql_query($select) or die ("khong ket noi duoc");
                $row1=mysql_fetch_array($sql);
                $txt_cat = $row1["max"] + 1;
                $db->insert("goon_file_menu","id,cat,thu_tu,hien_thi","'".$txt_cat."','".$db->escape($cat)."','".(cat_count($txt_cat)+1)."','".($txt_hien_thi+0)."'");
                $lang1 = array();
                $stt = 0;
                $r5 = $db->select("goon_lang");
                while ($row5 = $db->fetch($r5))
                {
                    $lang1[$stt] = $row5["id"];
                    $stt++;
                }
                foreach ($lang1 as $value)
                {
                    $db->insert("goon_file_menu_lang","id,id_lang,ten","'".$txt_cat."','".$value."','".$db->escape($txt_ten)."'");
                }
                admin_load("Đã thêm Mục đó vào CSDL","?act=file_list&txt_cat=".$txt_cat."&id_lang=".$lang);
                $OK = true;
            }
        }
        else
        {
            $txt_ten		=	"";
            $txt_hien_thi	=	1;
        }
        if (!$OK)
            template_edit("?act=file_menu_new","new",$txt_cat,$cat,$txt_ten,$txt_hien_thi,$error,$lang);
    ?>
    </center>
</div>