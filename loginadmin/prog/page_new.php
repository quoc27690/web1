<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_page.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TRANG NỘI DUNG <img src="images/bl3.gif" border="0" /> THÊM TRANG</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/page.php";
        if (empty($func)) $func = "";
        if ($submit)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên trang.";
            else if (empty($txt_noi_dung))
                $error = "Vui lòng nhập nội dung.";
            else
            {
                $select = "select Max(id) AS max from goon_page";
                $sql=mysql_query($select) or die ("khong ket noi duoc");
                $row1=mysql_fetch_array($sql);
                $id = $row1["max"] + 1;
                $db->insert("goon_page","id,alias,time,user","'".$id."','".$db->escape($txt_alias)."','".time()."','".$thanh_vien["id"]."'");
                $lang1 = array();
                $stt = 0;
                $r2 = $db->select("goon_lang");
                while ($row2 = $db->fetch($r2))
                {
                    $lang1[$stt] = $row2["id"];
                    $stt++;
                }
                foreach ($lang1 as $value)
                {
                    $db->insert("goon_page_lang","id,id_lang,ten,noi_dung","'".$id."','".$value."','".$db->escape($txt_ten)."','".$txt_noi_dung."'");
                }
                admin_load("Đã thêm Trang vào CSDL","?act=page_new&id_lang=".$lang);
            }
        }
        else
        {
            $txt_alias		= "";
            $txt_ten		= "";
            $txt_noi_dung	= "";
        }
        if (!$OK)
            template_edit("?act=page_new","new",$id,$txt_alias,$txt_ten,$txt_noi_dung,$error,$lang)
    ?>
    </center>
</div>