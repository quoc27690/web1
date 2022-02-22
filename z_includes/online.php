<?
	$r = $db->select("goon_online","");
	$gia_tri = $db->num_rows($r);
?>
	<?=$lang["TITLE_ONLINE_1"]?>: <?= $gia_tri?> - <?=$lang["TITLE_ONLINE_2"]?>:&nbsp;
	 <?php
		$gia_tri	= 190000;
		$r			=	$db->select("goon_online_daily","");
		while ($row = $db->fetch($r))
			$gia_tri += (int)$row["bo_dem"];
		$x = 7 - strlen($gia_tri);
		for ($i = 1; $i <= $x; $i++)
		{
			$gia_tri = "0" . $gia_tri;
		}
		for ($i = 0; $i < strlen($gia_tri); $i++)
		{
			echo $gia_tri[$i]; 
		}
	?>