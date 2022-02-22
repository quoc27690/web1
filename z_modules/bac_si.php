<?php
	$id = 7;
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
			$q	=	$db->select("goon_cms","hien_thi=1 AND cat = '".$id."'","ORDER BY id");
			while($r1 = $db->fetch($q))
			{
				$q2	=	$db->select("goon_cms_lang","id='".$r1['id']."' and id_lang='".$_SESSION['id_lang']."'","");
				$r2 = $db->fetch($q2);
			?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<figure class="effect-apollo">
					<a href="/<?=$iso?>/bac-si-xem-<?=$r1["id"]?>/<?=(lg_string::get_link(lg_string::crop($r2["ten"],20)))?>">
						<img src="/uploads/cms/new_<?=$r2["id_lang"]?>_<?=$r2["hinh"]?>" alt="<?=$r2["ten"]?>"/>
						<figcaption>
							<p><span><?=$r2["ten"]?></span><br><?=$r2["chu_thich"]?>
						</figcaption>
					</p>
				</figure>
			</div>
			<?
			}
			?>
    </div>
  </div>
</section>
