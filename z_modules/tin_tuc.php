<?php
	$id = $_GET["id"] ;
	$r4	=	$db->select("goon_cms_menu_lang","id = '".$id."' and id_lang='".$_SESSION['id_lang']."'");
	$row4 = $db->fetch($r4);
?>
<section>
  <div class="container mt150">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="lined-heading"><span><?=$row4['ten']?></span></h2>
      </div>
    </div>
    <div class="row">
        <?php
		$page		=	$page + 0;
		$perpage	=	1;
		$r_all		=	$db->select("goon_cms","hien_thi=1 AND cat = '".$id."'");
		$sum		=	$db->num_rows($r_all);
		$pages		=	($sum-($sum%$perpage))/$perpage;
		if ($sum % $perpage <> 0 )
			{
				$pages = $pages + 1;
			}
		$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
		$min 		= 	abs($page-1) * $perpage;
		$max 		= 	$perpage;
		$q	=	$db->select("goon_cms","hien_thi=1 AND cat = '".$id."'","ORDER BY time DESC LIMIT ".$min.", ".$max);
		if($db->num_rows($q) != 0)
		{
			while($r1 = $db->fetch($q))
			{
				$q2	=	$db->select("goon_cms_lang","id='".$r1['id']."' and id_lang='".$_SESSION['id_lang']."'","");
				$r2 = $db->fetch($q2);
			?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="khung_cms_page">
					<div class="img_cms_page">
						<a href="/<?=$iso?>/tin-<?=$r1["link"]?><?=lg_string::get_link($txt)?>"><img src="/uploads/cms/new_<?=$r2["id_lang"]?>_<?=$r2["hinh"]?>" alt="<?=$r2["ten"]?>"/></a>
					</div>
					<div class="info_cms_page">
						<div class="ten_cms_page"><a href="/<?=$iso?>/tin-<?=$r1["link"]?><?=lg_string::get_link($txt)?>"><?=$r2["ten"]?></a></div>
						<div class="chu_thich_cms_page"><?=$r2["chu_thich"]?></div>
						<a class="chi_tiet_cms_page" href="/<?=$iso?>/tin-<?=$r1["link"]?><?=lg_string::get_link($txt)?>"><?=$lang["chi_tiet"]?></a>
					</div>
				</div>
			</div>
			<?
			}
			showPageNavigation($page, $pages, '/'.$iso.'/tin-tuc-');
		}
		else
		{
		?>
			<div style="text-align:center; font-size:15px; color:#ff0000;" >Dữ liệu đang updated...</div>
		<?
		}
		?>
    </div>
  </div>
</section>
