<?php
ob_start();
@session_start();
include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");
$THANHVIEN["id"] = 0;
if($_SESSION['cart'] == "") $_SESSION['cart'] = "";
include("z_includes/dem_online.php");
if (empty($act)) $act = "home";
if ( !in_array($act, array(
		'home','lien_he','gioi_thieu','tin_tuc','tin_tuc_xem','bac_si','bac_si_xem','dich_vu_xem','khach_hang','bang_gia','album_xem'
	) ) )
{
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
    	$s = $db->select("goon_lang","id='".$_SESSION['id_lang']."'");
    	$rs = $db->fetch($s);
    	$iso = strtolower($rs["iso_code"]);
    ?>
		<div class="icon-right">
			<a href="#" class="icon1"></a>
			<a href="/<?=$iso?>/dat-lich-hen<?=lg_string::get_link($txt)?>" class="icon2"></a>
			<a href="/<?=$iso?>/bang-gia<?=lg_string::get_link($txt)?>" class="icon5"></a>
			<a href="#" class="icon3"></a>
			<a href="#" class="icon4"></a>
		</div>
		<div class="hotline-right"><?=get_page("hotline","noi_dung")?></div>
    <div class="wrapper">
			<header>
				<div class="header-container">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<div class="content">
									<div class="add hidden-xs">
										<img src="/images/img/add.png">
										<?=get_page("add","noi_dung")?>
									</div>
									<a class="login" href="/<?=$iso?>/dang-nhap<?=lg_string::get_link($txt)?>">
										<img src="/images/img/login.png" alt="<?=$lang["dang_nhap"]?>">
										<?=$lang["dang_nhap"]?>
									</a>
									<div class="lang">
	                  <?
	                  $url = $_SERVER["REQUEST_URI"];
	                  $start_url = explode('/', $url);
	                  $end_url = explode('/'.$start_url[1].'/', $url);
	                  $s1 = $db->select("goon_lang");
	                  while($rs1=$db->fetch($s1))
	                  {
	                      if($end_url[1]=="") $end_url[1] = 'trang-chu'.lg_string::get_link($txt);
	                      ?>
												<a href="/<?=$rs1["iso_code"]?>/<?=$end_url[1]?>">&nbsp;<img src="/images/lang/<?=$rs1["iso_code"]?>.jpg" align="absmiddle"/></a>
	                      <?
	                  }
	                  ?>
	                </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include "z_includes/menu.php"; ?>
				<? if($act == "home") include "z_modules/slide.php";?>
			</header>
      <div class="main">
        <?php include "z_modules/".$act.".php"; ?>
        <div class="copyright" <?if($act!="home") echo 'style="margin-top:50px"';?>>
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-7 col-md-7">
								<div class="copyright-left">
									<?=get_page("copyright","noi_dung")?>
								</div>
              </div>
							<div class="col-xs-12 col-sm-5 col-md-5">
								<div class="copyright-right">
									<a href="http://www.mtkdanang.vn/" target="_blank">Powered by MTK Solution</a>
									<?=get_page("social","noi_dung")?>
								</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include "z_includes/script.php"; ?>
</body>
</html>
