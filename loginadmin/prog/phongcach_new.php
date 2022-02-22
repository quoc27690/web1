<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
    	<img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">THÊM PHONG CÁCH</strong>
    </div>
    <div class="border"></div>
    <center>
    <?
        include "templates/khoihanh.php";
        if (empty($func)) $func = "";
        $OK = false;
        if ($submit)
        {
            if (empty($txt_ten))
                $error = "Vui lòng nhập Tên.";
            else
            {
                $select = "select Max(id) AS max from goon_khoihanh";
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
                    $db->insert("goon_khoihanh","id,id_lang,ten","'".$txt_cat."','".$value."','".$db->escape($txt_ten)."'");
                }
                admin_load("Đã thêm phong cách mới vào CSDL","?act=phongcach_new&id_lang=".$lang);
                $OK = true;
            }
        }
        else
        {
            $txt_ten		=	"";
        }
        if (!$OK)
            template_edit("?act=phongcach_new","new",$txt_cat,$txt_ten,$error,$lang);
    ?>
    </center>
<?php
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("goon_khoihanh","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các phong cách đã chọn.","?act=phongcach_new&id_lang=".$_SESSION['lang']);
		die();
	}
?>
<form action="?act=phongcach_new" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
    <input type="hidden" name="func" value="del" />
    <input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
    <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="tb_head">
            <td>STT</td>
            <td>Phong cách</td>
            <td>Chỉnh sửa</td>
            <td>Xóa</td>
        </tr>
        <?php
        $page		=	$page + 0;
        $perpage	=	$_SESSION['sotin']+0;
        $r_all		=	$db->select("goon_khoihanh");
        $sum		=	$db->num_rows($r_all);
        $pages		=	($sum-($sum%$perpage))/$perpage;
        if ($sum % $perpage <> 0 )	$pages = $pages+1;
        $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
        $min 		= 	abs($page-1) * $perpage;
        $max 		= 	$perpage;
        $count	=	$min;
        $r		=	$db->select("goon_khoihanh","id_lang='".$_SESSION["lang"]."'","order by id limit $min, $max");
        while ($row = $db->fetch($r))
        {
            $count++;
        ?>
            <tr class="tb_content">
                <td><?=$count?></td>
                <td><?=$row["ten"]?></td>
                <td><a href="?act=phongcach_edit&txt_cat=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/sua_big.png"/></a></td>
                <td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
            </tr>
        <?
        }
        ?>
        <tr class="tb_foot">
            <td colspan="3" style="text-align:left;">
                <?php
                    if ($pages==0) echo "";
                    for($i=1;$i<=$pages;$i++) {
                        echo "<a href='?act=phongcach_new&id_lang=".$_SESSION["lang"]."&page=$i'";
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