<section>
  <div class="container mt150">
    <div class="row">
        <div class="col-sm-12">
          <h2 class="lined-heading"><span><?=$lang['menu_khach_hang']?></span></h2>
        </div>
    </div>
    <div class="row">
      <?
      $q  =   $db->select("goon_cms","hien_thi=1 and cat = 5","ORDER BY id");
      while($r1 = $db->fetch($q))
      {
        $q2 = $db->select("goon_cms_lang","id='".$r1['id']."' AND id_lang='".$_SESSION['id_lang']."'");
        $r2 = $db->fetch($q2);
        ?>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="customer">
            <div class="icon"></div>
            <div class="desc"><?=$r2["noi_dung"]?></div>
            <div class="info">
              <div class="title">
                <div><?=$r2["ten"]?></div>
                <?=$r2["chu_thich"]?>
              </div>
              <div class="img"><img src="/uploads/cms/new_<?=$r2["id_lang"]?>_<?=$r2["hinh"]?>" alt="<?=$r2["ten"]?>"/></div>
            </div>
          </div>
        </div>
        <?
      }
      ?>
    </div>
  </div>
</section>
