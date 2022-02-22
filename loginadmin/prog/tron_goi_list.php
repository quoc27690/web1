<?
	$a1		=	$db->select("goon_tron_goi","cat = '".$txt_cat."'");
	$tong	=	$db->num_rows($a1);
	$a2 	= 	$db->select("goon_tron_goi","cat = '".$txt_cat."' and noi_bat = 1");
	$noibat = 0;
	while ($ra2 = $db->fetch($a2))
	{
		$noibat++;
	}
	$a3 	= 	$db->select("goon_tron_goi","cat = '".$txt_cat."' and hien_thi = 0");
	$hienthi = 0;
	while ($ra3=$db->fetch($a3))
	{
		$hienthi++;
	}
?>
<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
        <img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">THỐNG KÊ SẢN PHẨM</strong> 
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Tổng sản phẩm : <span class="so_thongke"><?=$tong?></span>
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Nổi bật : <span class="so_thongke"><?=$noibat?></span>
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Không hiển thị : <span class="so_thongke"><?=$hienthi?></span>
    </div>
    <div class="border"></div>
    <center>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td width="40%">
            <div class="function">
                <a href="?act=tron_goi_new&txt_cat=<?=$txt_cat?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/add_new.jpg"/> Tạo sản phẩm mới</a>
            </div>
        </td>
        <td width="25%">
            <form method="post">
                <strong>Hiển thị : </strong>
                <select name="sotin" class="inputbox">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                </select>
                <input type="submit" name="soluongtin" value="OK" class="hien_thi" />
            </form>
        </td>
        <td width="35%" style="text-align:right;">
            <form method="post" action="?act=tron_goi_list" class="form_tk">
            	<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
                <input type="hidden" name="search" value="timkiem" />
                <input type="text" name="txt_search" class="khung_tk" placeholder="Nhập tên bài viết cần tìm..." />
                <input type="submit" value="Search"  class="button_tk"  />
            </form>
        </td>
      </tr>
    </table>
    </center>
    <?php
        //	Kiểm tra sự tồn tại của ID
        if ($_POST['delete'])
        {
            for ($i = 0; $i < count($tik); $i++)
            {
                $db->delete("goon_tron_goi","id = '".$tik[$i]."'");
                $db->delete("goon_tron_goi_lang","id = '".$tik[$i]."'");
            }
            admin_load("Đã xóa các Bài viết đã chọn.","?act=tron_goi_list&txt_cat=".$txt_cat."&id_lang=".$_SESSION['lang']);
            die();
        }
		if ($_POST['sap_xep'])
        {
            for ($i = 0; $i < count($id); $i++)
            {
				$db->update("goon_tron_goi","thu_tu",$thu_tu[$i],"id = '".$id[$i]."'");
            }
			admin_load("Đã cập nhật thứ tự các Bài viết đã chọn.","?act=tron_goi_list&txt_cat=".$txt_cat."&id_lang=".$_SESSION['lang']);
            die();
        }
    ?>
    <center>
    <form action="?act=tron_goi_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
        <input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
        <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr class="tb_head">
                <td width="50px">STT</td>
                <td>PIC</td>
                <td>Tên</td>
                <td>Hiển thị</td>
                <td>Nổi bật</td>
                <td>Ngày đăng</td>
                <td>Người đăng</td>
                <td>Chỉnh sửa</td>
                <td>Xóa</td>
            </tr>
            <?php
            $page		=	$page + 0;
            $perpage	=	$_SESSION['sotin']+0;
            $r_all		=	$db->select("goon_tron_goi","cat = '".$txt_cat."'");
            $sum		=	$db->num_rows($r_all);
            $pages		=	($sum-($sum%$perpage))/$perpage;
            if ($sum % $perpage <> 0 )	$pages = $pages+1;
            $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
            $min 		= 	abs($page-1) * $perpage;
            $max 		= 	$perpage;
            $count	=	$min;
            if (empty($_POST['txt_search']))
                {
                    $s=$db->select("goon_tron_goi","cat = '".$txt_cat."'","order by thu_tu limit $min, $max");
                    while ($rows = $db->fetch($s))
                    {
                        $count++;
                        $r = $db->select("goon_tron_goi_lang","id='".$rows["id"]."' and id_lang='".$_SESSION["lang"]."'");
                        $row = $db->fetch($r);
                    ?>
                        <tr class="tb_content">
                            <td>
                                <input type="text" name="thu_tu[]" value="<?=$rows["thu_tu"]?>" class="thu_tu" />
                                <input type="hidden" name="id[]" value="<?=$rows["id"]?>"/>
                            </td>
                            <td><?=$rows["hinh"]!="no"?"<img src='../../uploads/tron_goi/admin_".$rows['hinh']."' style='width:40px; height:40px;'/>":"<img src=\"images/false.gif\" />"?></td>
                            <td><?=str_replace("\\","",$row["ten"])?></td>
                            <td><?=$rows["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
                            <td><?=$rows["noi_bat"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
                            <td><?=lg_date::vn_time($rows["time"])?></td>
                            <td><?=get_user($rows["user"],"username")?></td>
                            <td><a href="?act=tron_goi_edit&id=<?=$rows["id"]?>&txt_cat=<?=$txt_cat?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/sua_big.png"/></a></td>
                            <td><input name="tik[]" type="checkbox" value="<?=$rows["id"]?>" /></td>
                        </tr>
                    <?
                    }
                }
            if (!empty($_POST['txt_search']))
                {
                    $txt_search = 	$_POST['txt_search'];
					$txt_cat = 	$_POST['txt_cat'];
                    $r	=	$db->select("goon_tron_goi_lang","ten like '%".$txt_search."%' and id_lang='".$_SESSION["lang"]."'","");
                    while ($row = 	$db->fetch($r))
                    {
                        $count++;
                        $s = $db->select("goon_tron_goi","id='".$row["id"]."'");
                        $rows = $db->fetch($s);
                    ?>
                        <tr class="tb_content">
                            <td><?=$count?></td>
                            <td><?=$rows["hinh"]!="no"?"<img src='../../uploads/tron_goi/hinhadmin_".$rows['hinh']."' style='width:40px; height:40px;'/>":"<img src=\"images/false.gif\" />"?></td>
                            <td><?=str_replace("\\","",$row["ten"])?></td>
                            <td><?=$rows["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
                            <td><?=$rows["noi_bat"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
                            <td><?=lg_date::vn_time($rows["time"])?></td>
                            <td><?=get_user($rows["user"],"username")?></td>
                            <td><a href="?act=tron_goi_edit&id=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>&txt_cat=<?=$txt_cat?>"><img src="images/sua_big.png"/></a></td>
                            <td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                        </tr>
                    <?
                    }
                }
            ?>
            <tr class="tb_foot">
            	<td><input type="submit" value="Sắp xếp" name="sap_xep" class="button_3"/></td>
                <td colspan="7" style="text-align:left;">
                    <?php
                        if ($pages==0) echo "";
                        for($i=1;$i<=$pages;$i++) {
                            echo "<a href='?act=tron_goi_list&txt_cat=".$txt_cat."&id_lang=".$_SESSION["lang"]."&page=$i'";
                            if ($i==$page) echo "class='active'";
                            echo ">$i</a>";
                        }
                    ?>
                </td>
                <td><input type="submit" value="Delete" name="delete" class="button_3"/></td>
            </tr>
        </table>
    </form>
    </center>
</div>