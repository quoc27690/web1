<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include("../config.php");
	$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
	include("../func.php");
	
	$r = $db->select("goon_cms_menu","rss_link is not null and rss_link <> ''");
	while ($row = $db->fetch($r))
	{
		echo $row["ten"]." : ";
		$rss = new lg_rss($row["rss_link"]);
		$max_time = 0;
		if (@$rss->solve())
		{
			$x = $rss->rss_channel;
			for ($i = 0; $i < count($x["ITEMS"]); $i ++)
			{
				$y = $x["ITEMS"][$i];
				$time = strtotime($y["PUBDATE"]);
				if ($time == 0)
					continue;
				
				$r2 = $db->select("goon_cms","ten like '".$db->escape($y["TITLE"])."'");
				if ($db->num_rows($r2) == 0)
				{
					$noi_dung = "Xem chi tiết tại đường dẫn sau :<br /><a href=\"".$y["LINK"]."\" target=\"_blank\">".$y["TITLE"]."</a>";
					$id = $db->insert("goon_cms","id,cat,ten,chu_thich,hinh_note,noi_dung,hien_thi,time,user,luot_xem,noi_bat",
								"0,'".$row["id"]."','".$y["TITLE"]."','".$db->escape($y["DESCRIPTION"])."',' ','".$noi_dung."','1','".$time."','1','101','0'");
					echo $id." ";
				}
				if ($time > $max_time) $max_time = $time;
			}
			$db->update("goon_cms_menu","rss_time",$max_time,"id = '".$row["id"]."' and rss_time < '".$max_time."'");
			echo " OK";
		}
		echo "<br />";
	}
?>