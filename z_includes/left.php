<div class="hotline"><?=get_page("hot_line","noi_dung")?></div>
<div class="bg_left"></div>
<div class="menu_left">
	<?
	$s2		= $db->select("goon_product","id='".$idsp."'");
	$rs2 	= $db->fetch($s2);
	$r = $db->select("goon_product_menu_lang","cat like 'san_pham' and hien_thi = 1 and id_lang='".$_SESSION['id_lang']."'","order by thu_tu");
	while ($r2 = $db->fetch($r))
	{
		$s1 	= $db->select("goon_product_menu_lang","id='".$cat."' and id_lang='".$_SESSION['id_lang']."'","");
		$rs1 	= $db->fetch($s1);	
		?>
		<div class="sanpham"><?=str_replace("\\","",$r2["ten"])?></div>
        <ul class="menu_body">
        <?
            $r3 = $db->select("goon_product_menu_lang","cat='".$r2["id"]."' and id_lang='".$_SESSION['id_lang']."'","order by thu_tu");
            while ($r4 = $db->fetch($r3))
            {
        ?>
            <li><a href="/san-pham-<?=$r4["id"]?>/<?=(lg_string::get_link(lg_string::crop($r4["ten"],10)))?>" class="<?=($cat==$r4["id"]||$rs2['cat']==$r4["id"])?'active':''?>"><?=$r4["ten"]?></a></li>
        <?
            }
        ?>
        </ul>
	<?
	}
    ?>
    <div class="sanpham">Video</div>
    <div style="padding:10px; background:#fff"><?=get_page("video","noi_dung")?></div>
</div>