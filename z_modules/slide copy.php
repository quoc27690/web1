<section class="revolution-slider">
  <div class="bannercontainer">
    <div class="banner">
      <ul>
        <?
        $q  = $db->select("goon_gallery","hien_thi=1 AND cat = 1","order by id");
        while($r = $db->fetch($q))
        {
            $q2 = $db->select("goon_gallery_lang","id='".$r['id']."' AND id_lang='".$_SESSION['id_lang']."'");
            $r2 = $db->fetch($q2);
        ?>
            <li data-slotamount="7" data-masterspeed="500" data-transition="boxfade">
              <img src="/uploads/gal/slide_<?=$r['hinh']?>" alt="<?=$r2['ten']?>" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
              <div class="tp-caption tp-caption-1 skewfromleft customout"
    						data-x="104"
    						data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
    						data-speed="800"
    						data-start="1500"
    						data-easing="Power4.easeOut"
    						data-endspeed="300"
    						data-endeasing="Power1.easeIn"
    						data-captionhidden="on"
    						style="z-index: 6"><?=$lang["caption_1"]?>
    					</div>

              <div class="tp-caption tp-caption-2-container skewfromleft customout"
    						data-x="104"
    						data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
    						data-speed="800"
    						data-start="1600"
    						data-easing="Power4.easeOut"
    						data-endspeed="300"
    						data-endeasing="Power1.easeIn"
    						data-captionhidden="on"
    						style="z-index: 6">
                <div class="tp-caption-2"><?=$lang["caption_2"]?></div>
                <div class="tp-caption-3">
                  <?=$lang["caption_3"]?>
                  <span class="tp-caption-4"><?=$lang["caption_4"]?></span>
                </div>
    					</div>
              <div class="tp-caption tp-caption-5 lfb skewtoleft hidden-xs"
    						data-x="104"
    						data-speed="2000"
    						data-start="1400"
    						data-easing="Power4.easeOut"
    						data-endspeed="400"
    						data-endeasing="Power1.easeIn"
    						style="z-index: 6">
                <a href="/<?=$iso?>/dat-lich-hen<?=lg_string::get_link($txt)?>"><?=$lang["caption_5"]?></a>
    					</div>
            </li>
        <?
        }
        ?>
      </ul>
    </div>
    <div class="time_container">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="time_content">
              <div class="hotline_home">
                <div class="top">
                  <img src="/images/img/hotline.png" alt="">
                  <div class="text">
                    <div class="text_1"><?=get_page("hotline_home_1","ten")?></div>
                    <div class="text_2"><?=get_page("hotline_home_1","noi_dung")?></div>
                  </div>
                </div>
                <div class="middle"><?=get_page("hotline_home_2","noi_dung")?></div>
                <div class="bottom">
                  <a href="/<?=$iso?>/dat-lich-hen<?=lg_string::get_link($txt)?>"><?=$lang["dat_lich_kham"]?></a>
                  <a href="/<?=$iso?>/bang-gia<?=lg_string::get_link($txt)?>"><?=$lang["bang_gia"]?></a>
                </div>
              </div>
              <div class="time_home">
                <div class="video">
                  <div class="video_1"><?=get_page("video","noi_dung")?></div>
                  <div class="video_2"><?=get_page("video","ten")?></div>
                </div>
                <div class="time">
                  <div class="title">
                    <img src="/images/img/time.png" alt="">
                    <?=$lang["gio_lam_viec"]?>
                  </div>
                  <div class="content">
                    <div class="content_1"><?=get_page("time_1","ten")?></div>
                    <div class="content_2"><?=get_page("time_1","noi_dung")?></div>
                  </div>
                  <div class="content">
                    <div class="content_1"><?=get_page("time_2","ten")?></div>
                    <div class="content_2"><?=get_page("time_2","noi_dung")?></div>
                  </div>
                  <div class="content">
                    <div class="content_1"><?=get_page("time_3","ten")?></div>
                    <div class="content_2"><?=get_page("time_3","noi_dung")?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
