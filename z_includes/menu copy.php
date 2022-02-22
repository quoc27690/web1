<nav id="navbar" role="navigation" class="social-navbar navbar navbar-default <?=$act!="home" ? 'navbar-page' : ''?>">
	<div class="container">
      <div class="row">
          <div class="col-xs-12">
              <div class="logo"><a href="/<?=$iso?>/trang-chu<?=lg_string::get_link($txt)?>"><img src="/images/img/logo.png"></a></div>
							<div class="navbar-header">
								<button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li><a href="/<?=$iso?>/trang-chu<?=lg_string::get_link($txt)?>" class=" <?=$act=='home'?'active':''?>"><?=$lang['MENU_HOME']?></a></li>
									<li><a href="/<?=$iso?>/gioi-thieu<?=lg_string::get_link($txt)?>" class=" <?=$act=='gioi_thieu' ? 'active' : ''?>"><?=$lang['MENU_GIOI_THIEU']?></a></li>
									<li><a href="/<?=$iso?>/bac-si<?=lg_string::get_link($txt)?>" class=" <?=($act=='bac_si' || $act=='bac_si_xem') ? 'active' : ''?>"><?=$lang['menu_bac_si']?></a></li>
									<li class="dropdown"><a href="#" data-hover="dropdown" data-delay="0" class="dropdown-toggle <?=($act=='dich_vu_xem')?'active':''?>"><span><?=$lang['menu_dich_vu']?></span></a>
											<ul class="dropdown-menu">
											<?
											$q  =   $db->select("goon_cms","hien_thi=1 and cat = 3","ORDER BY thu_tu");
											while($r1 = $db->fetch($q))
											{
													$q2 = $db->select("goon_cms_lang","id='".$r1['id']."' AND id_lang='".$_SESSION['id_lang']."'");
													$r2 = $db->fetch($q2);
											?>
													<li><a href="/<?=$iso?>/dich-vu-<?=$r1["id"]?>/<?=(lg_string::get_link(lg_string::crop($r2["ten"],20)))?>"><?=$r2["ten"]?></a></li>
											<?
											}
											?>
											</ul>
									</li>
									<li><a href="/<?=$iso?>/khach-hang<?=lg_string::get_link($txt)?>" class=" <?=$act=='khach_hang'?'active':''?>"><?=$lang["menu_khach_hang"]?></a></li>
									<li><a href="/<?=$iso?>/tin-tuc<?=lg_string::get_link($txt)?>" class=" <?=($act=='tin_tuc' || $act=='tin_tuc_xem')?'active':''?>"><?=$lang["menu_tin_tuc"]?></a></li>
									</li>
									<li><a href="/<?=$iso?>/lien-he<?=lg_string::get_link($txt)?>" class=" <?=$act=='lien_he'?'active':''?>"><?=$lang["MENU_LIEN_HE"]?></a></li>
								</ul>
								<!-- <a href="/<?=$iso?>/tim-kiem<?=lg_string::get_link($txt)?>" class="search_btn">
									<img src="/images/img/bt_tk.png" alt="Tìm kiếm">
								</a> -->
							</div>
          </div>
      </div>
    </div>
</nav>
