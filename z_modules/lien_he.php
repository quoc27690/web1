<section class="section_banner">
  <div class="container">
    <div class="row">
      <div class="title">
        <div class="heading_container">
          <h3 class="heading">Liên hệ</h3>
          <div class="big_dash_white"></div>
        </div>
        <nav class="bread-crumbs">
          <ul>
            <li><a class="dash" href="/<?= $iso ?>/trang-chu<?= lg_string::get_link($txt) ?>"><?= $lang['MENU_HOME'] ?></a></li>
            <li><a class="dash" href="/<?= $iso ?>/lien-he<?= lg_string::get_link($txt) ?>"><?= $lang["MENU_LIEN_HE"] ?></a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>
<section class="fadeInUp" data-start="200">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8451700324986!2d108.21100331528879!3d16.073522343591303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142184832162453%3A0x6fcce0bc0f4c4a43!2zTmhhIEtob2EgTMOqIFbEg24gSMOg!5e0!3m2!1svi!2s!4v1642236152883!5m2!1svi!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>
<section class="section_contact fadeInUp" data-start="200">
  <div class="container">
    <div class="row">
      <!-- Contact form -->
      <div class="col-md-7">
        <h2 class="lined-heading"><span><?= $lang['LIEN_HE'] ?></span></h2>
        <form class="clearfix" role="form" onSubmit="return send_lienhe(this)" method="post" action="#" name="frmContact" id="frmContact">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name" accesskey="U"><span class="required">*</span> <?= $lang['HO_TEN'] ?></label>
                <input name="name" type="text" id="name" class="form-control" value="" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" accesskey="E"><span class="required">*</span> E-mail</label>
                <input name="email" type="text" id="email" value="" class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="subject" accesskey="S"><span class="required">*</span> <?= $lang['TIEU_DE'] ?></label>
            <input name="title" type="text" id="title" value="" class="form-control" />
          </div>
          <div class="form-group">
            <label for="comments" accesskey="C"><span class="required">*</span> <?= $lang['NOI_DUNG'] ?></label>
            <textarea name="message" rows="3" id="message" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label><span class="required">*</span> Captcha</label>
            <img src="/z_modules/random_image.php" style="margin-bottom:5px" />
            <input name="ma_xac_nhan" type="text" id="ma_xac_nhan" value="" class="form-control" onchange="check_mxn()" />
            <div id="load_ma_xac_nhan"><input type="hidden" name="check_ma_xac_nhan" id="check_ma_xac_nhan" /></div>
          </div>
          <button type="submit" class="btn btn-default btn-lienhe"><?= $lang['FORM_SUBMIT'] ?></button>
        </form>
      </div>
      <div class="col-md-5">
        <h2 class="lined-heading"><span><?= get_page("lien_he", "ten") ?></span></h2>
        <div class="content_home"><?= get_page("lien_he", "noi_dung") ?></div>
      </div>
    </div>
  </div>
</section>