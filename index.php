<?php
ob_start();
@session_start();
include("config.php");
$db		=	new	lg_mysql($host, $dbuser, $dbpass, $csdl);
include("func.php");
$THANHVIEN["id"] = 0;
if ($_SESSION['cart'] == "") $_SESSION['cart'] = "";
include("z_includes/dem_online.php");
if (empty($act)) $act = "home";
if (!in_array($act, array(
	'home', 'lien_he', 'gioi_thieu', 'tin_tuc', 'tin_tuc_xem', 'bac_si', 'bac_si_xem', 'dich_vu_xem', 'khach_hang', 'bang_gia', 'album_xem'
))) {
	$act = "home";
}
include("func_lang.php");
include_once 'common.php';
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php include "z_includes/_html_head.php"; ?>
</head>

<body>
	<?
	$s = $db->select("goon_lang", "id='" . $_SESSION['id_lang'] . "'");
	$rs = $db->fetch($s);
	$iso = strtolower($rs["iso_code"]);
	?>
	<div class="icon-right">
		<a href="#" class="icon1"></a>
		<a href="#" class="icon3"></a>
		<a href="#" class="icon4"></a>
	</div>
	<div class="hotline-right"><?= get_page("hotline", "noi_dung") ?></div>
	<div class="wrapper">
		<header>
			<?php include "z_includes/menu.php"; ?>
			<? if ($act == "home") include "z_modules/slide.php"; ?>
		</header>
		<div class="main">
			<?php include "z_modules/" . $act . ".php"; ?>
		</div>
		<footer class="footer">
			<div class="contract">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<h5 class="heading dash">T.M.N ARCHITECTURE</h5>
							<p class="content">T.M.N mãi luôn là đơn vị tiên phong trong lĩnh vực công nghệ về kiến trúc , xây dựng và công nghệ vật liệu mới</p>
						</div>
						<div class="col-sm-3">
							<h5 class="heading dash">ĐIỆN THOẠI</h5>
							<p class="content">(0084) 0935513113</p>
						</div>
						<div class="col-sm-3">
							<h5 class="heading dash">EMAIL</h5>
							<p class="content">tmn@tmn.vn</p>
						</div>
						<div class="col-sm-3">
							<h5 class="heading dash">ĐỊA CHỈ</h5>
							<p class="content">Đ/c 1 : 443 Tây Sơn TP Quy Nhơn , Tỉnh Bình Định</p>
							<p class="content">Đ/c 2 : 427 Tây Sơn TP Quy Nhơn , Tỉnh Bình Định</p>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="container">
					<span class="content"><?= get_page("copyright", "noi_dung") ?></span>
				</div>
			</div>
		</footer>
	</div>
	<?php include "z_includes/script.php"; ?>
</body>

</html>