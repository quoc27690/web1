<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.easing-1.4.pack.js"></script>	
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script>
$(document).ready(function() {
	$("a#single_image").fancybox();
});
</script>
<?
	$a1		=	$db->select("goon_gallery","cat = '".$txt_cat."'");
	$tong	=	$db->num_rows($a1);
	$a2 	= 	$db->select("goon_gallery","cat = '".$txt_cat."' and noi_bat = 1");
	$noibat = 0;
	while ($ra2 = $db->fetch($a2))
	{
		$noibat++;
	}
	$a3 	= 	$db->select("goon_gallery","cat = '".$txt_cat."' and hien_thi = 0");
	$hienthi = 0;
	while ($ra3=$db->fetch($a3))
	{
		$hienthi++;
	}
?>
<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
        <img src="images/icon_list_img2.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">THỐNG KÊ HÌNH ẢNH</strong> 
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Tổng hình ảnh : <span class="so_thongke"><?=$tong?></span>
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Nổi bật : <span class="so_thongke"><?=$noibat?></span>
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Không hiển thị : <span class="so_thongke"><?=$hienthi?></span>
    </div>
    <div class="border"></div>
    <center>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td width="40%">
            <div class="function">
                <a href="?act=gallery_new&txt_cat=<?=$txt_cat?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/add_new.jpg"/> Tạo hình ảnh mới</a>
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
            <form method="post" action="?act=gallery_list" class="form_tk">
            	<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
                <input type="hidden" name="search" value="timkiem" />
                <input type="text" name="txt_search" class="khung_tk" placeholder="Nhập tên hình ảnh cần tìm..." />
                <input type="submit" value="Search"  class="button_tk"  />
            </form>
        </td>
      </tr>
    </table>
    </center>
    <?php
		$delete1 = $delete1 + 0;
		if ($delete1 != 0)
		{
			$db->delete("goon_gallery","id = '".$delete1."'");
			$db->delete("goon_gallery_lang","id = '".$delete1."'");
			admin_load("Đã xóa thành công.","?act=gallery_list&txt_cat=".$txt_cat."&id_lang=".$lang);
		}
    ?>
    <center>
    <form action="" method="post">
    	<input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
        <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr class="tb_head">
                <td style="text-align:left; text-indent:10px"><img src="images/icon_list_img2.png" align="absmiddle"/>&nbsp;&nbsp;THƯ VIỆN HÌNH ẢNH</td>
            </tr>
            <tr>
                <td style="background:#FFF; padding-left:25px">
            <?php
            $page		=	$page + 0;
            $perpage	=	$_SESSION['sotin']+0;
            $r_all		=	$db->select("goon_gallery","cat = '".$txt_cat."'");
            $sum		=	$db->num_rows($r_all);
            $pages		=	($sum-($sum%$perpage))/$perpage;
            if ($sum % $perpage <> 0 )	$pages = $pages+1;
            $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
            $min 		= 	abs($page-1) * $perpage;
            $max 		= 	$perpage;
            $count	=	$min;
            if (empty($_POST['txt_search']))
                {
                    $r		=	$db->select("goon_gallery","cat = '".$txt_cat."'","order by time desc limit $min, $max");
                    while ($row = $db->fetch($r))
                    {
                        $count++;
                        $s = $db->select("goon_gallery_lang","id='".$row["id"]."' and id_lang='".$_SESSION["lang"]."'");
                        $rows = $db->fetch($s);
                    ?>
                        <div class="khung_img">
                            <div class="img">
                                <?=$row["hinh"]!="no"?"<a id='single_image' href='../../uploads/gal/".$row['hinh']."'><img src='../../uploads/gal/hinhadmin_".$row['hinh']."' style='width:138px; height:100px;'/></a>":"<img src=\"images/false.gif\" />"?>
                            </div>
                            <div class="ten_img">
                                <div style="float:left; width:100px;line-height:18px"><?=lg_string::crop(str_replace("\\","",$rows["ten"]),2)?></div>
                                <div style="float:right">
                                    <a href="?act=gallery_edit&id=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>&txt_cat=<?=$txt_cat?>"><img src="images/sua.png" style="margin-right:5px"/></a>
                                    <a href="?act=gallery_list&delete1=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>&id=<?=$id?>&txt_cat=<?=$txt_cat?>" onsubmit="return confirm('Bạn có chắc chắn không ?');"><img src="images/xoa.png"/></a>
                                </div>
                            </div>
                        </div>
                    <?
                    }
                }
            if (!empty($_POST['txt_search']))
                {
                    $txt_search = 	$_POST['txt_search'];
					$txt_cat = 	$_POST['txt_cat'];
                    $r	=	$db->select("goon_gallery_lang","ten like '%".$txt_search."%' and id_lang='".$_SESSION["lang"]."'","");
                    while ($rows = 	$db->fetch($r))
                    {
                        $count++;
                        $s = $db->select("goon_gallery","id='".$rows["id"]."'");
                        $row = $db->fetch($s);
                    ?>
                        <div class="khung_img">
                            <div class="img">
                                <?=$row["hinh"]!="no"?"<img src='../../uploads/gal/hinhadmin_".$row['hinh']."' style='width:138px; height:100px;'/>":"<img src=\"images/false.gif\" />"?>
                            </div>
                            <div class="ten_img">
                                <div style="float:left"><?=str_replace("\\","",$rows["ten"])?></div>
                                <div style="float:right">
                                    <a href="?act=gallery_edit&id=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>&txt_cat=<?=$txt_cat?>"><img src="images/sua.png" style="margin-right:5px"/></a>
                                    <a href="?act=gallery_list&delete1=<?=$row["id"]?>&id_lang=<?=$_SESSION["lang"]?>&txt_cat=<?=$txt_cat?>" onsubmit="return confirm('Bạn có chắc chắn không ?');"><img src="images/xoa.png"/></a>
                                </div>
                            </div>
                        </div>
                    <?
                    }
                }
            ?>
                </td>
            </tr>
            <tr class="tb_foot">
                <td style="text-align:left;">
                    <?php
                        if ($pages==0) echo "";
                        for($i=1;$i<=$pages;$i++) {
                            echo "<a href='?act=gallery_list&txt_cat=".$txt_cat."&id_lang=".$_SESSION["lang"]."&page=$i'";
                            if ($i==$page) echo "class='active'";
                            echo ">$i</a>";
                        }
                    ?>
                </td>
            </tr>
        </table>
    </form>
    </center>
</div>