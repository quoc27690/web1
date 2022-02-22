<style>
.tab_dm tr td
{
	border-bottom:solid 1px #dcdfe0;
	padding:10px 0;
}
</style>
<div class="quan_ly" style="text-indent:20px;"><img src="images/quan_ly.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ BÀI VIẾT</strong></div>
<div class="border"></div>
<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
		$db->delete("goon_page","id = '".$delete."'");
		$db->delete("goon_page_lang","id = '".$delete."'");
		admin_load("Đã xóa trang thông tin đã chọn.","?act=page_new&id_lang=".$_SESSION['lang']);
		die();
	}
?>
<form action="" method="post">
    <table class="tab_dm" width="100%" border="0" cellspacing="0" cellpadding="0">
    <?php
		$r		=	$db->select("goon_page","","order by alias asc");
		while ($row = $db->fetch($r))
		{
			$r2		=	$db->select("goon_page_lang","id='".$row["id"]."' and id_lang = '".$lang."'");
			$row2 = $db->fetch($r2);
		?>
            <tr>
                <td width="185px"><a href="?act=page_edit&id=<?=$row["id"]?>&id_lang=<?=$lang?>" class=" <?=(($id==$row["id"]))?'active':''?>"><img src="images/icon_list.png"/>&nbsp;&nbsp;<?=str_replace("\\","",$row2["ten"])?></a></td>
                <td width="15px"><a href="?act=page_list&delete=<?=$row["id"]?>&id_lang=<?=$lang?>" onclick="return confirm('Bạn có chắc chắn không?');"><img src="images/xoa.png" /></a></td>
            </tr>
		<?php
		}
    ?>
    </table>
</form>