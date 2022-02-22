<?php include "z_includes/pop_up.php"; ?>
<section class="section_about fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="dich_vu_container">
          <div class="title"><?=$lang["he_thong_dich_vu"]?></div>
          <div class="content">
            <?php
            $r = $db->select("goon_cms","cat = 3 and hien_thi = 1","order by thu_tu");
            while ($row = $db->fetch($r))
            {
              $r4	=	$db->select("goon_cms_lang","id = '".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'");
              $row4 = $db->fetch($r4);
              ?>
              <div class="dich_vu">
                <div class="img">
                  <a href="/<?=$iso?>/dich-vu/<?=$row["link"]?><?=lg_string::get_link($txt)?>">
                    <img src="/uploads/cms/new_<?=$row4["id_lang"]?>_<?=$row4["hinh"]?>" alt="<?=$row4["ten"]?>">
                  </a>
                </div>
                <div class="desc">
                  <div class="desc_1">
                    <a href="/<?=$iso?>/dich-vu/<?=$row["link"]?><?=lg_string::get_link($txt)?>"><?=$row4["ten"]?></a>
                  </div>
                  <?=$row4["chu_thich"]?>
                </div>
              </div>
            <?
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 hidden-sm hidden-xs">
        <div class="img_home"><?=get_page("img_gt_home","noi_dung")?></div>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        <div class="title_home"><?=get_page("gt_home","ten")?></div>
        <div class="gt_home"><?=get_page("gt_home","noi_dung")?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="facilities">
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_1.png" alt="">
            </div>
            <div class="desc"><?=$lang["facility_1"]?></div>
          </div>
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_2.png" alt="">
            </div>
            <div class="desc"><?=$lang["facility_2"]?></div>
          </div>
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_3.png" alt="">
            </div>
            <div class="desc"><?=$lang["facility_3"]?></div>
          </div>
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_4.png" alt="">
            </div>
            <div class="desc"><?=$lang["facility_4"]?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="arrow hidden-xs"></div>
<section class="section_lua_chon fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="title_lua_chon title_lua_chon_1"><?=get_page("khach_hang_lua_chon","ten")?></div>
        <div class="title_lua_chon title_lua_chon_2"><?=get_page("khach_hang_lua_chon","noi_dung")?></div>
        <div class="progress-container">
          <div class="progress-bar-custom" data-percentage="80%">
            <h4 class="progress-title-holder">
              <span class="progress-title"><?=$lang["progress_1"]?></span>
              <span class="progress-number-wrapper">
                <span class="progress-number-mark">
                  <span class="percent"></span>
                  <span class="down-arrow"></span>
                </span>
              </span>
            </h4>
            <div class="progress-content-outter">
              <div class="progress-content"></div>
            </div>
          </div>
          <div class="progress-bar-custom" data-percentage="50%">
            <h4 class="progress-title-holder clearfix">
              <span class="progress-title"><?=$lang["progress_2"]?></span>
              <span class="progress-number-wrapper">
                <span class="progress-number-mark">
                  <span class="percent"></span>
                  <span class="down-arrow"></span>
                </span>
              </span>
            </h4>
            <div class="progress-content-outter">
              <div class="progress-content"></div>
            </div>
          </div>
          <div class="progress-bar-custom" data-percentage="90%">
            <h4 class="progress-title-holder clearfix">
              <span class="progress-title"><?=$lang["progress_3"]?></span>
              <span class="progress-number-wrapper">
                <span class="progress-number-mark">
                  <span class="percent"></span>
                  <span class="down-arrow"></span>
                </span>
              </span>
            </h4>
            <div class="progress-content-outter">
              <div class="progress-content"></div>
            </div>
          </div>
          <div class="progress-bar-custom" data-percentage="80%">
            <h4 class="progress-title-holder clearfix">
              <span class="progress-title"><?=$lang["progress_4"]?></span>
              <span class="progress-number-wrapper">
                <span class="progress-number-mark">
                  <span class="percent"></span>
                  <span class="down-arrow"></span>
                </span>
              </span>
            </h4>
            <div class="progress-content-outter">
              <div class="progress-content"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-sm hidden-xs">
        <div class="img_lua_chon"><img src="/images/img/bg_quy_trinh_2.jpg" alt=""></div>
      </div>
    </div>
  </div>
  <div class="quy_trinh_container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="quy_trinh">
            <div class="img">
              <img src="/images/img/img_quy_trinh_1.jpg" alt="">
              <span>01</span>
            </div>
            <div class="title"><?=$lang["quy_trinh_1_1"]?></div>
            <div class="desc"><?=$lang["quy_trinh_1_2"]?></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="quy_trinh">
            <div class="img">
              <img src="/images/img/img_quy_trinh_2.jpg" alt="">
              <span>02</span>
            </div>
            <div class="title"><?=$lang["quy_trinh_2_1"]?></div>
            <div class="desc"><?=$lang["quy_trinh_2_2"]?></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="quy_trinh">
            <div class="img">
              <img src="/images/img/img_quy_trinh_3.jpg" alt="">
              <span>03</span>
            </div>
            <div class="title"><?=$lang["quy_trinh_3_1"]?></div>
            <div class="desc"><?=$lang["quy_trinh_3_2"]?></div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="quy_trinh">
            <div class="img">
              <img src="/images/img/img_quy_trinh_4.jpg" alt="">
              <span>04</span>
            </div>
            <div class="title"><?=$lang["quy_trinh_4_1"]?></div>
            <div class="desc"><?=$lang["quy_trinh_4_2"]?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="slogan_quy_trinh"><?=$lang["slogan_quy_trinh"]?></div>
</section>
<section class="section_customer fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="title_1"><?=get_page("khach_hang_home","ten")?></div>
        <div class="title_2"><?=get_page("khach_hang_home","noi_dung")?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div id="owl-customer">
          <?
          $q  =   $db->select("goon_cms","hien_thi=1 and cat = 5","ORDER BY id");
          while($r1 = $db->fetch($q))
          {
            $q2 = $db->select("goon_cms_lang","id='".$r1['id']."' AND id_lang='".$_SESSION['id_lang']."'");
            $r2 = $db->fetch($q2);
            ?>
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
            <?
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section_news fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <h2 class="lined-heading">
          <span><?=$lang['title_tin_1']?></span>
        </h2>
        <div class="row">
          <?php
          $r = $db->select("goon_cms","cat = 6 and hien_thi = 1 AND noi_bat = 1 ","order by id desc limit 1");
          while ($row = $db->fetch($r))
          {
            $r4	=	$db->select("goon_cms_lang","id = '".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'");
            $row4 = $db->fetch($r4);
            ?>
            <div class="col-xs-12">
              <div class="khung_cms_page2">
                <div class="img_cms_page2">
                  <a href="/<?=$iso?>/tin-<?=$row["link"]?><?=lg_string::get_link($txt)?>"><img src="/uploads/cms/new_<?=$row4["id_lang"]?>_<?=$row4["hinh"]?>" alt="<?=$row4["ten"]?>"/></a>
                </div>
                <div class="ten_cms_page2"><a href="/<?=$iso?>/tin-<?=$row["link"]?><?=lg_string::get_link($txt)?>"><?=$row4["ten"]?></a></div>
                <div class="chu_thich_cms_page2"><?=$row4["chu_thich"]?></div>
                <a class="chi_tiet_cms_page2" href="/<?=$iso?>/tin-<?=$row["link"]?><?=lg_string::get_link($txt)?>"><?=$lang["chi_tiet"]?></a>
              </div>
            </div>
          <?
          }
          ?>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        <h2 class="lined-heading">
          <span><?=$lang['tin_tuc_su_kien']?></span>
        </h2>
        <div class="row">
          <?php
          $r = $db->select("goon_cms","cat = 1 and hien_thi = 1 AND noi_bat = 1 ","order by id desc limit 3");
          while ($row = $db->fetch($r))
          {
            $r4	=	$db->select("goon_cms_lang","id = '".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'");
            $row4 = $db->fetch($r4);
            ?>
            <div class="col-xs-12">
              <div class="khung_cms_page">
                <div class="img_cms_page">
                  <a href="/<?=$iso?>/tin-<?=$row["link"]?><?=lg_string::get_link($txt)?>"><img src="/uploads/cms/new_<?=$row4["id_lang"]?>_<?=$row4["hinh"]?>" alt="<?=$row4["ten"]?>"/></a>
                </div>
                <div class="info_cms_page">
                  <div class="ten_cms_page"><a href="/<?=$iso?>/tin-<?=$row["link"]?><?=lg_string::get_link($txt)?>"><?=$row4["ten"]?></a></div>
                  <div class="chu_thich_cms_page"><?=$row4["chu_thich"]?></div>
                  <a class="chi_tiet_cms_page" href="/<?=$iso?>/tin-<?=$row["link"]?><?=lg_string::get_link($txt)?>"><?=$lang["chi_tiet"]?></a>
                </div>
              </div>
            </div>
          <?
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section_lien_he_home">
  <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8451700324986!2d108.21100331528879!3d16.073522343591303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142184832162453%3A0x6fcce0bc0f4c4a43!2zTmhhIEtob2EgTMOqIFbEg24gSMOg!5e0!3m2!1svi!2s!4v1642236152883!5m2!1svi!2s" allowfullscreen="" loading="lazy"></iframe>
  </div>
  <div class="mask">
    <div class="lien_he_home_container">
      <div class="title_lh_home"><?=get_page("dang_ki_tu_van","ten")?></div>
      <div><?=get_page("dang_ki_tu_van","noi_dung")?></div>
      <form class="form_dang_ki" role="form" onSubmit="return send_nhantin(this)" method="post" action="#" name="form_nhantin" id="form_nhantin">
        <input type="text" name="name" class="form-control" placeholder="<?=$lang["HO_TEN"]?>">
        <input type="text" name="phone" class="form-control" placeholder="<?=$lang["DIEN_THOAI"]?>">
        <select class="form-control" name="message">
          <option value="0"><?=$lang["form_dich_vu"]?></option>
          <?php
          $r = $db->select("goon_cms","cat = 3 and hien_thi = 1","order by thu_tu");
          while ($row = $db->fetch($r))
          {
            $r4	=	$db->select("goon_cms_lang","id = '".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'");
            $row4 = $db->fetch($r4);
            ?>
            <option value="<?=$row4["ten"]?>"><?=$row4["ten"]?></option>
          <?
          }
          ?>
        </select>
        <div class="btn-container">
          <button type="submit" class="btn btn-default btn-submit"><?=$lang["form_btn_1"]?></button>
          <button type="submit" class="btn btn-default btn-xem"><?=$lang["form_btn_2"]?></button>
        </div>
      </form>
      <div class="lh_home_content">
        <div class="lh_home"><img src="/images/img/icon_footer_1.png"><?=get_page("lien_he_footer_1","noi_dung")?></div>
        <div class="lh_home"><img src="/images/img/icon_footer_2.png"><?=get_page("lien_he_footer_2","noi_dung")?></div>
        <div class="lh_home"><img src="/images/img/icon_footer_3.png"><?=get_page("lien_he_footer_3","noi_dung")?></div>
      </div>
    </div>
  </div>
</section>
