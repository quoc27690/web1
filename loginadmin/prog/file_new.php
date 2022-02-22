<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_file.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">FILE <img src="images/bl3.gif" border="0" /> THÊM BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
    <?php
        include "templates/file.php";
        $max_file_size	=	20480000;
        $up_dir			=	"../uploads/file/";
        $OK = false;
        if ($func == "new")
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập tên tài liệu.";
            else
            {
                // kiểm tra file uploads.
                $file_type = $_FILES['txt_file']['type'];
                $file_name = $_FILES['txt_file']['name'];
                $file_size = $_FILES['txt_file']['size'];
                $file_full_name = "tmp_".time().".".$file_type;
                $file = false;
                if ($file_size > 0) 
                {
                    
                            if ( @move_uploaded_file($_FILES['txt_file']['tmp_name'],$up_dir.$file_name) )
                            {
                                $OK = true;
                                $file = true;
                            }
                            else
                                $error = "Không thể upload tài liệu.";
                }
                else
                {
                    if ($file_size == 0)
                    {
                        $OK		= true;
                        $file	= false;
                    }
                }
                // Process xong
                if ($OK)
                {
                    $select = "select Max(id) AS max from goon_file";
                    $sql=mysql_query($select) or die ("khong ket noi duoc");
                    $row1=mysql_fetch_array($sql);
                    $id = $row1["max"] + 1;
                    $lang1 = array();
                    $stt = 0;
                    $r5 = $db->select("goon_lang");
                    while ($row5 = $db->fetch($r5))
                    {
                        $lang1[$stt] = $row5["id"];
                        $stt++;
                    }
                    $time = time($txt_date);
                    $db->insert("goon_file","id,cat,hien_thi,noi_bat,time,user,file_size","'".$id."','".($txt_cat+0)."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".time()."','".$thanh_vien["id"]."', '".$file_size."'");
                    foreach ($lang1 as $value)
                    {
                        $db->insert("goon_file_lang","id,id_lang,ten","'".$id."','".$value."','".$db->escape($txt_ten)."'");
                    }
                    if ($file)
                    {
                        $txt_file_2	= $file_name;
                        @rename($up_dir.$file_full_name,$up_dir.$txt_file_2);
                        $db->update("goon_file","file",$txt_file_2,"id = '".$id."'");
                    }
                    admin_load("Đã thêm Tài liệu vào CSDL","?act=file_list&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
                }
            }
        }
        else
        {
            $txt_ten		= "";
            $txt_file_note	= "";
            $txt_hien_thi	= 1;
            $txt_noi_bat	= 0;
        }
        if (!$OK)
            template_edit("?act=file_new", "new", $id , $txt_cat,$txt_ten,$txt_file,$txt_hien_thi,$txt_noi_bat,$error,$lang)
    ?>
    </center>
</div>