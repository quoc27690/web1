<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
		$db->delete("goon_database","id = '".$delete."'");
		admin_load("Đã xóa thành công.","?act=backup&id_lang=".$lang);
	}
?>
<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
        <img src="images/icon_backup.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">SAO LƯU DỮ LIỆU - BACKUP</strong> 
    </div>
    <div class="border"></div>
	<form method="post" action="">
    	<input type="submit" name="submit"  value="Tạo database mới"  class="function"/>
        <input type="submit" name="ok"  value="OK"  class="hien_thi"/>
    </form>
    <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr class="tb_head">
            <td>STT</td>
            <td>Tên file</td>
            <td>Kích thước</td>
            <td>Ngày tạo</td>
            <td>Download</td>
            <td>Xóa</td>
        </tr>
	<?
		$count	=	0;
		$r		=	$db->select("goon_database","","order by time desc");
		while ($row = $db->fetch($r))
		{
			$count++;
    ?>
        <tr class="tb_content">
            <td><?=$count?></td>
            <td><?=$row["file"]?></td>
            <td><?=$row["file_size"]?></td>
            <td><?=lg_date::vn_time($row["time"])?></td>
            <td><a href="../backup_soft/<?=$row["file"]?>"><img alt="Kích cỡ" src="images/download.png" align="absmiddle"/></a></td>
            <td><a href="?act=backup&delete=<?=$row["id"]?>&id_lang=<?=$lang?>" onclick="return confirm('Bạn có chắc chắn không ?');"><img src="images/xoa.png" /></a></td>
        </tr>
    <?
		}
	?>
        <tr class="tb_foot">
            <td colspan="6" style="padding:0;">&nbsp;</td>
        </tr>
    </table>
    <?
		if($_POST['submit'])
		{
			echo '<iframe width="100%" height="300" src="../cron/dbBackup.php" frameborder="0" style="background:#FFF;margin-top:20px" ></iframe>';
		}
		if($_POST['ok'])
		{
			$time=time();
			$date = date("d-m-y_h-i-a"); 
			$date_2 = lg_date::vn_other(time(),"-d-m-Y");
			$ten = $csdl.$date_2.".sql.gz";
			$a = filesize('../cron/'.$ten);
			$filesize = number_format($a / 1000, 2).' Kb';
			$db->insert("goon_database","file,file_size,time","'".$ten."','".$filesize."','".$time."'");
			admin_load("Đã thêm vào CSDL","?act=backup&id_lang=".$lang);
		}
	?>
</div>