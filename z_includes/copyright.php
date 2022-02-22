<?
$r = $db->select("goon_page","alias like 'copyright'","");
$r2 = $db->fetch($r);
$r3 = $db->select("goon_page_lang","id='".$r2["id"]."' and id_lang='".$_SESSION['id_lang']."'","");
$r4 = $db->fetch($r3);
?>
	<div class="title_right" style="height:30px;color:#fff"><?=$r4["ten"]?></div>
    <div><?=$r4["noi_dung"]?></div>