<?
	$a1		=	$db->select("goon_user");
	$tong	=	$db->num_rows($a1);
	$a3 	= 	$db->select("goon_user","and hien_thi = 0");
	$hienthi = 0;
	while ($ra3=$db->fetch($a3))
	{
		$hienthi++;
	}
?>
<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
        <img src="images/icon_taikhoan.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">THỐNG KÊ TÀI KHOẢN</strong> 
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Tổng tài khoản : <span class="so_thongke"><?=$tong?></span>
        <img src="images/thong_ke.jpg" align="absmiddle" style="margin-left:50px"/>&nbsp;Không active : <span class="so_thongke"><?=$hienthi?></span>
    </div>
    <div class="border"></div>
	<?
		if ($func == "del")
		{
			for ($i = 0; $i < count($tik); $i++)
			{
				$db->delete("goon_user","id = '".$tik[$i]."'");
			}
			admin_load("Đã xóa các Username đã chọn.","?act=member_list");
			die();
		}
	?>
	<form action="?act=member_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
	<input type="hidden" name="func" value="del" />
	<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr class="tb_head">
		<td>STT</td>
		<td>Hình</td>
		<td>Username</td>
		<td>Họ tên</td>
		<td>Active</td>
		<td>Site Level</td>
		<td>Sửa thông tin</td>
		<td>Đổi mật khẩu</td>
		<td>Xóa</td>
	</tr>
	<?
	$level_arr	=	array("","Administrator","Super Moderator","Moderator","Member");
	$count	=	0;
	$r		=	$db->select("goon_user","level<>1","order by username asc");
	while ($row = $db->fetch($r))
	{
		$dem++;
	?>
		<tr class="tb_content">
			<td><?=$dem?></td>
			<td><?=$row["hinh"]!="no"?"<img src='../../uploads/admin/hinhadmin_".$row['hinh']."' style='width:40px; height:40px;' />":"<img src=\"images/false.gif\" />"?></td>
			<td><?=$row["username"]?></td>
			<td><?=$row["ten"]?></td>
			<td><?=$row["trang_thai"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
			<td><?=$level_arr[$row["level"]]?></td>
			<td><a href="?act=member_edit&id=<?=$row["id"]?>"><img src="images/sua_big.png"/></a></td>
			<td><a href="?act=pass_edit&id=<?=$row["id"]?>"><img src="images/mat_khau.png"/></a></td>
			<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
		</tr>
	<?
	}
	?>
	<tr class="tb_foot">
		<td colspan="8">&nbsp;</td>
		<td><input type="submit" value="Delete" class="button_2" style="width:80%;" /></td>
	</tr>
	</table>
	</form>
</div>