<?php
	$lang				=	$_GET["id_lang"];
	$_SESSION["lang"]	=	$lang;
	if ($_SESSION["lang"]=="")
	{
		$_SESSION["lang"]	=	1;
	}
	if ($_POST["sotin"])
	{
		$_SESSION["sotin"]	=	$_POST["sotin"];
	}
	if ($_SESSION["sotin"] == "")
	{
		$_SESSION["sotin"]	=	20;
	}
?>
<div class="khung_avatar">
    <?
        $a = $db->select("goon_user","username = '".$_SESSION["login_admin_user"]."'");
        $ra = $db->fetch($a);
    ?>
    <div style="width:274px; height:80px; float:left; margin-top:5px; line-height:20px; padding: 0 10px;">
    	Welcome, <span style="font-weight:bold"><?=$ra['ten'];?></span><br />
        <?
			$date = lg_date::vn_other(time(),"-d-m-Y");
			echo date('D');echo $date ;
		?>
        	<div id="clock" style="float:right"></div>
        <?
			$url = $_SERVER['QUERY_STRING'];
			$start = 'act';
			$end = 'id_lang=';
			$ex_url = explode($start, $url);
			$ex_url = explode($end, $ex_url[1]);
			$ex_url = $start.$ex_url[0].$end;
		?>
        <div style="margin-top:20px">
        	<a style="text-decoration:none; color:#FFF; cursor:pointer;" onclick="Forward('?act=logout');">
                <img border="0" src="images/icon/logout.jpg" style="float:left" />
                Logout
            </a>
            <div style="float:right" class="lang">
			<?
                $s1 = $db->select("goon_lang");
                while($rs1=$db->fetch($s1))
                {
					$a=$ex_url.$rs1["id"];
            ?>
                    <a href="?<?=$a?>" style="text-decoration:none" class="<?=$lang!=$rs1["id"]?'active':''?>">
                        <?=$rs1["hinh"]!="no"?"<img src='../../uploads/lang/lang_".$rs1['hinh']."' style='width:30px; height:22px;' />":"<img src=\"images/false.gif\" />"?>
                    </a>
            <?
                }
            ?>
        </div>
        </div>
    </div>
</div>
<div id="fw_menu">
	<ul id="menu_1">
		<li class="home <?=$act=='home'?'active':''?>" onclick="Forward('?act=home&id_lang=<?=$_SESSION["lang"]?>');" style="border:0">Trang chủ</li>
        <? if($tin_tuc==1) {?><li class="cms <?=(($act=='cms_list')||($act=='cms_edit')||($act=='cms_new')||($act=='cms_menu_edit')||($act=='cms_menu_new'))?'active':''?>" onclick="Forward('?act=cms_list&id_lang=<?=$_SESSION["lang"]?>');">Tin tức</li><? }?>
        <? if($san_pham==1) {?><li class="duct <?=(($act=='giai_phap_list')||($act=='giai_phap_edit')||($act=='giai_phap_new')||($act=='product_list')||($act=='product_edit')||($act=='product_new')||($act=='product_menu_edit')||($act=='product_menu_new'))?'active':''?>" onclick="Forward('?act=product_list&id_lang=<?=$_SESSION["lang"]?>');">Dự án</li><? }?>
        <? if($hinh_anh==1) {?><li class="gal <?=(($act=='gallery_list')||($act=='gallery_edit')||($act=='gallery_new')||($act=='gallery_menu_edit')||($act=='gallery_menu_new'))?'active':''?>" onclick="Forward('?act=gallery_list&id_lang=<?=$_SESSION["lang"]?>');">Hình ảnh</li><? }?>
        <? if($du_an==1) {?><li class="ject <?=(($act=='project_list')||($act=='project_edit')||($act=='project_new')||($act=='project_menu_edit')||($act=='project_menu_new'))?'active':''?>" onclick="Forward('?act=project_list&id_lang=<?=$_SESSION["lang"]?>');">Sản phẩm</li><? }?>
        <? if($bai_viet==1) {?><li class="page <?=(($act=='page_edit')||($act=='page_new'))?'active':''?>" onclick="Forward('?act=page_new&id_lang=<?=$_SESSION["lang"]?>');">Bài viết</li><? }?>
        <? if($file==1) {?><li class="file <?=(($act=='file_list')||($act=='file_edit')||($act=='file_new')||($act=='file_menu_edit')||($act=='file_menu_new'))?'active':''?>" onclick="Forward('?act=file_list&id_lang=<?=$_SESSION["lang"]?>');">File</li><? }?>
        <? if($media==1) {?><li class="media <?=(($act=='media_list')||($act=='media_edit')||($act=='media_new')||($act=='media_menu_edit')||($act=='media_menu_new'))?'active':''?>" onclick="Forward('?act=media_list&id_lang=<?=$_SESSION["lang"]?>');">Media</li><? }?>
        <? if($tai_khoan==1) {?><li class="mem <?=(($act=='member_list')||($act=='member_edit')||($act=='pass_edit')||($act=='phanquyen_manager')||($act=='phanquyen_edit')||($act=='phanquyen_new'))?'active':''?>" onclick="Forward('?act=member_list&id_lang=<?=$_SESSION["lang"]?>');">Tài khoản</li><? }?>
        <? if($cau_hinh==1) {?><li class="config <?=(($act=='cat_manager')||($act=='cat_new')||($act=='cat_edit')||($act=='other')||($act=='backup')||($act=='ngonngu_manager')||($act=='ngonngu_new')||($act=='ngonngu_edit'))?'active':''?>" onclick="Forward('?act=other&id_lang=<?=$_SESSION["lang"]?>');">Cấu hình</li><? }?>
        <img src="images/bg_bot_menu.jpg" style="float:left; margin-left:-13px;" />
	</ul>
    <div id="fw_menu_2">
		<?
            if(($act=='cms_list')||($act=='cms_edit')||($act=='cms_new')||($act=='cms_menu_edit')||($act=='cms_menu_new'))
            {
                include "prog/cms_manager.php";
            }
			if(($act=='project_list')||($act=='project_edit')||($act=='project_new')||($act=='project_menu_edit')||($act=='project_menu_new'))
            {
                include "prog/project_manager.php";
            }
			if(($act=='file_list')||($act=='file_edit')||($act=='file_new')||($act=='file_menu_edit')||($act=='file_menu_new'))
            {
                include "prog/file_manager.php";
            }
			if(($act=='media_list')||($act=='media_edit')||($act=='media_new')||($act=='media_menu_edit')||($act=='media_menu_new'))
            {
                include "prog/media_manager.php";
            }
			if(($act=='giai_phap_list')||($act=='giai_phap_edit')||($act=='giai_phap_new')||($act=='product_list')||($act=='product_edit')||($act=='product_new')||($act=='product_menu_edit')||($act=='product_menu_new')||($act=='khoihanh_new')||($act=='khoihanh_edit')||($act=='noiden_new')||($act=='noiden_edit'))
            {
                include "prog/product_manager.php";
            }
			if(($act=='gallery_list')||($act=='gallery_edit')||($act=='gallery_new')||($act=='gallery_menu_edit')||($act=='gallery_menu_new'))
            {
                include "prog/gallery_manager.php";
            }
			if(($act=='page_edit')||($act=='page_new'))
            {
                include "prog/page_list.php";
            }
			if(($act=='member_edit')||($act=='member_list')||($act=='phanquyen_manager')||($act=='phanquyen_edit')||($act=='phanquyen_new')||($act=='pass_edit'))
            {
			?>
            	<div class="quan_ly" style="text-indent:22px; padding:10px 0">
                	<img src="images/quan_ly.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN TRỊ TÀI KHOẢN</strong>
                </div>
				<div class="border"></div>
            	<div class="quan_ly" style="text-indent:22px">
                	<a class="<?=(($act=='member_edit')||($act=='member_list')||($act=='pass_edit'))?'active':''?>" href="?act=member_list&id_lang=<?=$_SESSION["lang"]?>">
                    	<img src="images/icon_taikhoan.png" align="absmiddle"/>&nbsp;&nbsp;Quản lý tài khoản
                    </a>
                </div>
                <div class="quan_ly" style="text-indent:22px">
                	<a class="<?=(($act=='phanquyen_manager')||($act=='phanquyen_edit')||($act=='phanquyen_new'))?'active':''?>" href="?act=phanquyen_manager&id_lang=<?=$_SESSION["lang"]?>">
                    	<img src="images/icon_phanquyen.png" align="absmiddle"/>&nbsp;&nbsp;Phân quyền sử dụng
                    </a>
                </div>
			<?
				if(($act=='member_list')||($act=='pass_edit'))
				{
                	include "prog/member_new.php";
				}
            }
			if(($act=='cat_manager')||($act=='cat_new')||($act=='cat_edit')||($act=='favicon')||($act=='yahoo')||($act=='other')||($act=='backup')||($act=='ngonngu_manager')||($act=='ngonngu_new')||($act=='ngonngu_edit'))
            {
			?>
            	<div class="quan_ly" style="text-indent:22px; padding:10px 0">
                	<img src="images/quan_ly.png"/>&nbsp;<strong style="font-size:14px">CẤU HÌNH WEBSITE</strong>
                </div>
				<div class="border"></div>
                <div class="quan_ly" style="text-indent:22px">
                	<a class="<?=$act=='other'?'active':''?>" href="?act=other&id_lang=<?=$_SESSION["lang"]?>">
                    	<img src="images/icon_cauhinh.png" align="absmiddle"/>&nbsp;&nbsp;Cấu hình chung
                    </a>
                </div>
                <div class="quan_ly" style="text-indent:22px">
                	<a class="<?=$act=='backup'?'active':''?>" href="?act=backup&id_lang=<?=$_SESSION["lang"]?>">
                    	<img src="images/icon_backup.png" align="absmiddle"/>&nbsp;&nbsp;Backup Database
                    </a>
                </div>
                <div class="quan_ly" style="text-indent:22px">
                	<a class="<?=(($act=='cat_manager')||($act=='cat_new')||($act=='cat_edit'))?'active':''?>" href="?act=cat_manager&id_lang=<?=$_SESSION["lang"]?>">
                    	<img src="images/icon_danhmuc.png" align="absmiddle"/>&nbsp;&nbsp;Quản lý danh mục
                    </a>
                </div>
                <div class="quan_ly" style="text-indent:22px">
                	<a class="<?=(($act=='ngonngu_manager')||($act=='ngonngu_new')||($act=='ngonngu_edit'))?'active':''?>" href="?act=ngonngu_manager&id_lang=<?=$_SESSION["lang"]?>">
                    	<img src="images/icon_ngonngu.png" align="absmiddle"/>&nbsp;&nbsp;Quản lý ngôn ngữ
                    </a>
                </div>
			<?
            }
        ?>
    </div>
</div>
