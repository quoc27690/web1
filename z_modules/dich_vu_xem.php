<?php
	$r2	=	$db->select("goon_cms","id = '".$id."'");
	$row2 = $db->fetch($r2);
	$r3	=	$db->select("goon_cms_lang","id = '".$row2['id']."' and id_lang='".$_SESSION['id_lang']."'");
	$row3 = $db->fetch($r3);
?>
<section>
    <div class="container mt150">
      <div class="row">
          <div class="col-sm-12">
            <h2 class="lined-heading"><span><?=$row3['ten']?></span></h2>
          </div>
      </div>
      <div class="row">
		<div class="col-xs-12 noidung_tin"><?=str_replace("\\","",$row3["noi_dung"])?></div>
      </div>
    </div>
</section>
