<nav class="social-navbar navbar navbar-default">
	<div class="container">
		<div class="navbar-header	fixed-top">
			<div class="container">
				<div class="d-flex justify-content-between">
					<!-- logo -->
					<div class="logo d-flex align-items-center"><a href="/<?= $iso ?>/trang-chu<?= lg_string::get_link($txt) ?>"><img src="/images/img/logo.png"></a></div>
					<ul class="nav navbar-nav">
						<button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</ul>
				</div>
			</div>
		</div>
		<div class="navbar-collapse collapse fixed-top">
			<div class="container">
				<div class="navbar-collapse-container">
					<ul class="nav navbar-nav">
						<li><a href="/<?= $iso ?>/trang-chu<?= lg_string::get_link($txt) ?>" class=" <?= $act == 'home' ? 'active' : '' ?>"><?= $lang['MENU_HOME'] ?></a></li>
						<li><a href="/<?= $iso ?>/gioi-thieu<?= lg_string::get_link($txt) ?>" class=" <?= $act == 'gioi_thieu' ? 'active' : '' ?>"><?= $lang['MENU_GIOI_THIEU'] ?></a></li>
						<li><a href="#" data-toggle="dropdown" data-delay="0" class="dropdown-toggle <?= ($act == 'dich_vu_xem') ? 'active' : '' ?>"><span><?= $lang['menu_dich_vu'] ?></span></a>
							<ul class="dropdown-menu">
								<?
								$q  =   $db->select("goon_cms", "hien_thi=1 and cat = 3", "ORDER BY thu_tu");
								while ($r1 = $db->fetch($q)) {
									$q2 = $db->select("goon_cms_lang", "id='" . $r1['id'] . "' AND id_lang='" . $_SESSION['id_lang'] . "'");
									$r2 = $db->fetch($q2);
								?>
									<li><a href="/<?= $iso ?>/dich-vu-<?= $r1["id"] ?>/<?= (lg_string::get_link(lg_string::crop($r2["ten"], 20))) ?>"><?= $r2["ten"] ?></a></li>
								<?
								}
								?>
							</ul>
						</li>
						<li><a href="/<?= $iso ?>/khach-hang<?= lg_string::get_link($txt) ?>" class=" <?= $act == 'khach_hang' ? 'active' : '' ?>"><?= $lang["MENU_DU_AN"] ?></a></li>
					</ul>
					<!-- logo -->
					<div class="logo-center"><a href="/<?= $iso ?>/trang-chu<?= lg_string::get_link($txt) ?>"><img src="/images/img/logo.png"></a></div>
					<ul class="nav navbar-nav">
						<li><a href="/<?= $iso ?>/tin-tuc<?= lg_string::get_link($txt) ?>" class=" <?= ($act == 'tin_tuc' || $act == 'tin_tuc_xem') ? 'active' : '' ?>"><?= $lang["menu_tin_tuc"] ?></a></li>
						</li>
						<li><a href="/<?= $iso ?>/lien-he<?= lg_string::get_link($txt) ?>" class=" <?= $act == 'lien_he' ? 'active' : '' ?>"><?= $lang["MENU_LIEN_HE"] ?></a></li>
						<?
						$url = $_SERVER["REQUEST_URI"];
						$start_url = explode('/', $url);
						$end_url = explode('/' . $start_url[1] . '/', $url);
						$s1 = $db->select("goon_lang");
						while ($rs1 = $db->fetch($s1)) {
							if ($end_url[1] == "") $end_url[1] = 'trang-chu' . lg_string::get_link($txt);
						?>
							<li><a href="/<?= $rs1["iso_code"] ?>/<?= $end_url[1] ?>"><img src="/images/lang/<?= $rs1["iso_code"] ?>.jpg" align="absmiddle" /></a></li>
						<?
						}
						?>
						<li> <a href="#" class="search_btn" data-toggle="dropdown" data-delay="0">
								<img src=" /images/img/bt_tk.png" alt="Tìm kiếm">
							</a>
							<ul class="dropdown-menu dropdown-menu-search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="<?= $lang['tim_kiem_san_pham'] ?>">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><a href="/<?= $iso ?>/tim-kiem<?= lg_string::get_link($txt) ?>" class="search_btn">
												<img src="/images/img/bt_tk.png" alt="Tìm kiếm">
											</a></button>
									</span>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>