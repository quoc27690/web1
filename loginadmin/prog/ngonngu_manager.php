<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
        <img src="images/icon_ngonngu.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ NGÔN NGỮ</strong> 
    </div>
    <div class="border"></div>
    <div class="function" style="width:150px">
        <a href="?act=ngonngu_new"><img src="images/add_new.jpg"/> Thêm ngôn ngữ mới</a>
    </div>
	<?php
		$delete = $delete + 0;
		if ($delete != 0)
		{
			$db->delete("goon_lang","id = '".$delete."'");
			admin_load("Đã xóa thành công.","?act=ngonngu_manager&id_lang=".$lang);
		}
    ?>
<center>
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td>STT</td>
	<td>PIC</td>
	<td>Ngôn ngữ</td>
    <td>Iso code</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?php
$count	=	0;
$r		=	$db->select("goon_lang","","order by id");
while ($row = $db->fetch($r))
{
	$count++;
?>
<tr class="tb_content">
	<td><?=$count?></td>
    <td><?=$row["hinh"]!="no"?"<img src='../../uploads/lang/admin_".$row['hinh']."' style='width:40px; height:20px;' />":"<img src=\"images/false.gif\" />"?></td>
    <td><?=$row["lang"]?></td>
    <td><?=$row["iso_code"]?></td>
	<td><a href="?act=ngonngu_edit&id=<?=$row["id"]?>"><img src="images/sua_big.png"/></a></td>
	<td><a href="?act=ngonngu_manager&delete=<?=$row["id"]?>" onClick="return confirm('Bạn có chắc chắn không ?');"><img src="images/xoa.png"/></a></td>
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="6"> </td>
</tr>
</table>
</center>
</div>