<section class="section_about fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="dich_vu_container">
          <div class="title"><?= $lang["he_thong_dich_vu"] ?></div>
          <div class="content">
            <?php
            $r = $db->select("goon_cms", "cat = 3 and hien_thi = 1", "order by thu_tu");
            while ($row = $db->fetch($r)) {
              $r4  =  $db->select("goon_cms_lang", "id = '" . $row["id"] . "' and id_lang='" . $_SESSION['id_lang'] . "'");
              $row4 = $db->fetch($r4);
            ?>
              <div class="dich_vu">
                <div class="img">
                  <a href="/<?= $iso ?>/dich-vu/<?= $row["link"] ?><?= lg_string::get_link($txt) ?>">
                    <img src="/uploads/cms/new_<?= $row4["id_lang"] ?>_<?= $row4["hinh"] ?>" alt="<?= $row4["ten"] ?>">
                  </a>
                </div>
                <div class="desc">
                  <div class="desc_1">
                    <a href="/<?= $iso ?>/dich-vu/<?= $row["link"] ?><?= lg_string::get_link($txt) ?>"><?= $row4["ten"] ?></a>
                  </div>
                  <?= $row4["chu_thich"] ?>
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
        <div class="img_home"><?= get_page("img_gt_home", "noi_dung") ?></div>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        <div class="title_home"><?= get_page("gt_home", "ten") ?></div>
        <div class="gt_home"><?= get_page("gt_home", "noi_dung") ?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="facilities">
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_1.png" alt="">
            </div>
            <div class="desc"><?= $lang["facility_1"] ?></div>
          </div>
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_2.png" alt="">
            </div>
            <div class="desc"><?= $lang["facility_2"] ?></div>
          </div>
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_3.png" alt="">
            </div>
            <div class="desc"><?= $lang["facility_3"] ?></div>
          </div>
          <div class="facility">
            <div class="img">
              <img src="/images/img/about_4.png" alt="">
            </div>
            <div class="desc"><?= $lang["facility_4"] ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="arrow hidden-xs"></div>
<section class="section_company fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <div class="left_container col-md-4">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="/images/img/slide_53.png" alt="" width="600" height="1000">
              <div class="carousel-caption">
                Ảnh 1
              </div>
            </div>
            <div class="item">
              <img src="/images/img/slide_54.png" alt="" width="600" height="1000">
              <div class="carousel-caption">
                Ảnh 2
              </div>
            </div>
          </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="right_container col-md-8">
        <div class="intro">
          <h5 class="heading">
            GIỚI THIỆU VỀ<strong> CÔNG TY</strong> </h5>
          <div class="content">
            <p>Là một trong những doanh nghiệp có bề dày kinh nghiệm thi công hàng đầu trong ngành xây dựng. Chúng tôi đã được các nhà đầu tư trong nước cũng như nước ngoài đánh giá cao về khả năng và kinh nghiệm thiết kế. </p>
            <p>Với kinh nghiệm dày dặn và đội ngũ nhân viên chuyên nghiệp, chúng tôi sẽ mang tới cho quý khách dịch vụ tốt nhất .Tôn chỉ hoạt động ”Ngôi nhà của bạn là niềm hạnh phúc của chúng tôi”, nhóm kiến trúc sư – kỹ sư của&nbsp;Monolit sẽ mang đến cho bạn một không gian sống đích thực,biến mơ ước của bạn trở thành hiện thực.</p>
          </div>
        </div>
        <div class="name_company">
          <h4 class="heading">Monolit</h4>
          <ul>
            <li><a class="dash-black" href="/<?= $iso ?>/trang-chu<?= lg_string::get_link($txt) ?>"><?= $lang['MENU_HOME'] ?></a></li>
            <li><a class="dash-black" href="/<?= $iso ?>/gioi-thieu<?= lg_string::get_link($txt) ?>"><?= $lang['MENU_GIOI_THIEU'] ?></a></li>
            <li><a class="dash-black" href="/<?= $iso ?>/lien-he<?= lg_string::get_link($txt) ?>"><?= $lang["MENU_LIEN_HE"] ?></a></li>
          </ul>
        </div>
        <div class="project_company">
          <a class="button_arrow" href="/<?= $iso ?>/khach-hang<?= lg_string::get_link($txt) ?>">Dự án của Monolit</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>