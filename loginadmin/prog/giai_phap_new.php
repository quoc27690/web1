<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_tin.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">HÀNH TRÌNH<img src="images/bl3.gif" border="0" /> THÊM BÀI VIẾT</strong>
    </div>
    <div class="border"></div>
    <center>
	<?php
		include "templates/giai_phap.php";
		if (empty($func)) $func = "";
		$OK = false;
		if ($submit)
		{
			if (empty($txt_ten))
				$error = "Vui lòng nhập tên bài viết.";
			else if (empty($txt_noi_dung))
				$error = "Vui lòng nhập nội dung bài viết.";
			else
			{
				$OK = true;
				if ($OK)
				{
					$db->insert("goon_giai_phap_lang","id_lang,tour,ten,noi_dung","'".$lang."','".$tour."','".$db->escape($txt_ten)."','".$txt_noi_dung."'");
					admin_load("Đã thêm Bài viết vào CSDL","?act=giai_phap_list&tour=".($tour+0)."&txt_cat=".($txt_cat+0)."&id_lang=".$lang);
				}
			}
		}
		else
		{
			$txt_ten		= "";
			$txt_noi_dung	= "";
		}
		if (!$OK)
			template_edit("?act=giai_phap_new", "new",$id,$txt_cat,$txt_ten,$txt_noi_dung,$tour,$error,$lang)
	?>
	</center>
</div>