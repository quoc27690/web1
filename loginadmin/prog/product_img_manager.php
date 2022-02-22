<?php 
$sid += 0;
?>
<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Quản lý Hình tin tức</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=gallery_new&producti=1"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=gallery_new&producti=1">Thêm hình mới</a>
    <div style="display:inline; float:right;">
    <a href="?act=product_img_manager"><img src="images/true.gif" align="absmiddle" border="0" /></a> <a href="?act=product_img_manager">Xem tất cả</a>
    </div>
</div>
<div class="function">
<img src="images/bl3.gif" align="absmiddle" border="0"  /> Click vào tiêu đề tin để tìm tất cả các hình thuộc tin đã chọn
</div>
<center>
<?php
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$g = $db->select("goon_product_img", "id = '".$tik[$i]."'");
			if ($gr = $db->fetch($g)) $gid = $gr["gal_id"];
			
			$db->delete("goon_product_img","id = '".$tik[$i]."'");
			$db->delete("goon_gallery","id = '".$gid."'");
		}
		admin_load("Đã xóa các hình đã chọn.","?act=product_img_manager");
		die();
	}
?>
<form action="?act=product_img_manager" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td>STT</td>
	<td>Tên bản tin</td>
	<td>Tên hình</td>
    <td>Hiển thị</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?php
if ($sid != 0)
{
	$r		=	$db->select("goon_product_img","product_id = ".$sid,"order by product_id desc");
}
else
{
	$r		=	$db->select("goon_product_img","","order by product_id desc");
}
while ($row = $db->fetch($r))
{
	$count++;
?>
<tr class="tb_content">
	<td><?=$count?></td>
	<?php
	$tnq = $db->select("goon_product","id = ".$row["product_id"],"");
	if ($rtin = $db->fetch($tnq)) $ten_tin = $rtin["ten"];
	?>
	<td><a href="?act=product_img_manager&sid=<?=$row["product_id"]?>"><?=$ten_tin?></a></td>
    <?php
	$tnh = $db->select("goon_gallery","id = ".$row["gal_id"],"");
	if ($rhih = $db->fetch($tnh)) $ten_hinh = $rhih["ten"];
	?>
	<td><?=$ten_hinh?></td>
    <?php
	$tnh = $db->select("goon_gallery","id = ".$row["gal_id"],"");
	if ($rhih = $db->fetch($tnh)) $hthi = $rhih["hien_thi"];
	?>
    <td><?=$hthi==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><a href="?act=gallery_edit&producti=1&id=<?=$row["gal_id"]?>">Sửa</a></td>
	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="5" style="text-align:left;">&nbsp;</td>
	<td><input type="submit" value="Xóa" class="button_2" style="width:80%;" /></td>
</tr>
</table>
</table>
</form>
</center>
<div class="function">
	<a href="?act=gallery_new&producti=1"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=gallery_new&producti=1">Thêm hình mới</a>
</div>