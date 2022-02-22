<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">THÊM LOẠI SẢN PHẨM</strong>
    </div>
    <div class="border"></div>
    <center>
    <?
        include "templates/noiden.php";
        if (empty($func)) $func = "";
		$max_file_size	=	2048000;
        $up_dir			=	"../uploads/icon/";
        $OK = false;
        if ($submit)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên.";
            else
            {
				// kiểm tra file uploads.
                $file_type = $_FILES['txt_hinh']['type'];
                $file_name = $_FILES['txt_hinh']['name'];
                $file_size = $_FILES['txt_hinh']['size'];
                switch ($file_type)
                {
                    case "image/pjpeg"	: $file_type = "jpg"; break;
                    case "image/jpeg"	: $file_type = "jpg"; break;
                    case "image/gif" 	: $file_type = "gif"; break;
                    case "image/x-png" 	: $file_type = "png"; break;
                    case "image/png" 	: $file_type = "png"; break;
                    default : $file_type = "unk"; break;
                }
                $file_full_name = "tmp_".time().".".$file_type;
                if ( ($file_size > 0) && ($file_size <= $max_file_size) )
                    if ($file_type != "unk")
                            if ( @move_uploaded_file($_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
                            {
                                $OK = true;
                                $hinh = true;
                            }
                            else
                                $error = "Không thể upload hình ảnh.";
                    else
                    {
                        $error = "Sai định dạng file - Không thể upload hình ảnh.";
                    }
                else
                {
                    if ($file_size == 0)
                    {
                        $OK		= true;
                        $hinh	= false;
                    }
                    else
                        $error = "Hình của bạn chọn vượt quá kích thước cho phép.";
                }
                // Process xong
                if ($OK)
                {
					$select = "select Max(id) AS max from goon_noiden";
					$sql=mysql_query($select) or die ("khong ket noi duoc");
					$row1=mysql_fetch_array($sql);
					$txt_cat = $row1["max"] + 1;
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
						$db->insert("goon_noiden","id,id_lang,ten,san_pham","'".$txt_cat."','".$value."','".$db->escape($txt_ten)."','".$txt_san_pham."'");
						if ($hinh)
						{
							$txt_hinh_1	= "icon_".$txt_cat.".".$file_type;
							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"");
							$txt_hinh_5	= $txt_cat.".".$file_type;
							$db->update("goon_noiden","hinh",$txt_hinh_5,"id = '".$txt_cat."'");
						}
					}
					admin_load("Đã thêm chất liệu mới vào CSDL","?act=chatlieu_new&id_lang=".$lang);
				}
            }
        }
        else
        {
            $txt_ten		=	"";
        }
        if (!$OK)
            template_edit("?act=chatlieu_new","new",$txt_cat,$txt_ten,$txt_san_pham,$txt_hinh,$error,$lang);
    ?>
    </center>
<?php
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("goon_noiden","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các chất liệu đã chọn.","?act=chatlieu_new&id_lang=".$_SESSION['lang']);
		die();
	}
?>
<form action="?act=chatlieu_new" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
    <input type="hidden" name="func" value="del" />
    <input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
    <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="tb_head">
            <td>STT</td>
            <td>Hình</td>
            <td>Loại</td>
            <td>Dành cho</td>
            <td>Chỉnh sửa</td>
            <td>Xóa</td>
        </tr>
        <?php
        $page		=	$page + 0;
        $perpage	=	$_SESSION['sotin']+0;
        $r_all		=	$db->select("goon_noiden");
        $sum		=	$db->num_rows($r_all);
        $pages		=	($sum-($sum%$perpage))/$perpage;
        if ($sum % $perpage <> 0 )	$pages = $pages+1;
        $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
        $min 		= 	abs($page-1) * $perpage;
        $max 		= 	$perpage;
        $count	=	$min;
        $r		=	$db->select("goon_noiden","id_lang='".$_SESSION["lang"]."'","order by id limit $min, $max");
        while ($row = $db->fetch($r))
        {
			 $r2 = $db->select("goon_product_menu_lang","hien_thi=1 and id = '".$row["san_pham"]."' and id_lang = '".$_SESSION['lang']."'");
             $row2 = $db->fetch($r2);
            $count++;
        ?>
            <tr class="tb_content">
                <td><?=$count?></td>
                <td><?=$row["hinh"]!="no"?"<img src='../../uploads/icon/icon_".$row['hinh']."' style='width:40px; height:40px;'/>":"<img src=\"images/false.gif\" />"?></td>
                <td><?=$row["ten"]?></td>
                <td><?=$row2["ten"]?></td>
                <td><a href="?act=chatlieu_edit&txt_cat=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/sua_big.png"/></a></td>
                <td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
            </tr>
        <?
        }
        ?>
        <tr class="tb_foot">
            <td colspan="5" style="text-align:left;">
                <?php
                    if ($pages==0) echo "";
                    for($i=1;$i<=$pages;$i++) {
                        echo "<a href='?act=chatlieu_new&id_lang=".$_SESSION["lang"]."&page=$i'";
                        if ($i==$page) echo "class='active'";
                        echo ">$i</a>";
                    }
                ?>
            </td>
            <td><input type="submit" value="Delete" class="button_3"/></td>
        </tr>
    </table>
</form>
</div>