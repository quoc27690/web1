<?php
	$id = $_GET["id"] ;
	$r2	=	$db->select("goon_cms","id = '".$id."'");
	$row2 = $db->fetch($r2);
	$r3	=	$db->select("goon_cms_lang","id = '".$row2['id']."' and id_lang='".$_SESSION['id_lang']."'");
	$row3 = $db->fetch($r3);
	$r4	=	$db->select("goon_cms_menu_lang","id = '".$row2['cat']."' and id_lang='".$_SESSION['id_lang']."'");
	$row4 = $db->fetch($r4);
?>
<section>
  <div class="container mt150">
      <div class="row">
          <div class="col-sm-12">
            <h2 class="lined-heading"><span><?=$row4['ten']?></span></h2>
          </div>
      </div>
      <div class="row">
      	<div class="col-xs-12 font_normal ten_tin"><?=str_replace("\\","",$row3["ten"])?></div>
				<div class="col-xs-12 noidung_tin"><?=str_replace("\\","",$row3["noi_dung"])?></div>
      </div>
      <div class="row mt150">
          <div class="col-sm-12">
            <h2 class="lined-heading"><span><?=$lang["bac_si_khac"]?></span></h2>
          </div>
      </div>
      <div class="row">
      <?php
		  $r = $db->select("goon_cms","cat = '".$row2["cat"]."'  and hien_thi = 1 AND id <> ".$row2['id'],"order by time desc limit 7");
		  while ($row = $db->fetch($r))
		  {
				$r4	=	$db->select("goon_cms_lang","id = '".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'");
				$row4 = $db->fetch($r4);
				?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<figure class="effect-apollo">
						<a href="/<?=$iso?>/bac-si-xem-<?=$row["id"]?>/<?=(lg_string::get_link(lg_string::crop($row4["ten"],20)))?>">
							<img src="/uploads/cms/new_<?=$row4["id_lang"]?>_<?=$row4["hinh"]?>" alt="<?=$row4["ten"]?>"/>
							<figcaption>
								<p><span><?=$row4["ten"]?></span><br><?=$row4["chu_thich"]?>
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
