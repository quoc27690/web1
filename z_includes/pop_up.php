<?
$km=get_bien("hien_thi");
if ($km == 1)
	{
?>
<div class="modal fade" id="myModal">
  <div class="modal-dialog" style="z-index: 9999;">
    <div class="modal-content">
      <div class="modal-body">
        <div id="owl-popup" class="owl-carousel">
          <?
            $q  =   $db->select("goon_gallery","hien_thi=1 and cat = 5","ORDER BY id desc");
            while($r1 = $db->fetch($q))
            {
              $q2 = $db->select("goon_gallery_lang","id='".$r1["id"]."' and id_lang='".$_SESSION['id_lang']."'");     
              $r2 = $db->fetch($q2);
              ?>
              <div class="popup">
                <a href="<?=$r1["link"]?>"><img src="/uploads/gal/image_<?=$r1["hinh"]?>" class="img-responsive" alt="<?=$r2["ten"]?>" /></a>
                <div class="title_popup"><?=$r2["ten"]?></div>
              </div>
              <?
            }
          ?>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<?
}
?>