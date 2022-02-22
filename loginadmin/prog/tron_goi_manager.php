<script>
	$(document).ready(function(){
		$("#firstpane div.sanpham").click(function()
		{  
			$(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");	
		});	
		$("#firstpane div.tb_foot").click(function()
		{  
			$(this).next("div.menu_body2").slideToggle(300).siblings("div.menu_body2").slideUp("slow");	
		});	
	});
</script>
<style>
div.tb_foot
{
	padding:5px 0;
	border-bottom:solid 1px #dcdfe0;
	float:left;
	width:200px;
	cursor:pointer;
}
div.tb_foot div.tb_foot_ten
{
	text-transform:uppercase;
	float:left;
	width:120px;
	font-weight:bold;
}
div.tb_foot div.tb_foot_xep
{
	float:left;
	width:70px; 
	margin-top:-5px
}
.sanpham
{
	border-bottom:solid 1px #dcdfe0;
	padding:5px 0;
	float:left;
	width:200px;
	cursor:pointer;
}
.sanpham_hang
{
	border-bottom:solid 1px #dcdfe0;
	padding:5px 0;
	float:left;
	padding-left:15px;
	width:185px;
}
.sanpham a,.sanpham_hang a
{
	font-weight:normal
}
.sanpham a:hover,.sanpham a.active,.sanpham_hang a:hover,.sanpham_hang a.active
{
	font-weight:bold;
	color:#41afda;
	text-decoration:none;
}
.ten_sanpham
{
	width:105px;
	float:left;
	margin-left:10px;
}
.xep_sanpham,.xep_sanpham_hang
{
	width:45px;
	float:left;
	margin-top:-5px
}
.sua_sanpham,.sua_sanpham_hang
{
	width:20px;
	float:left;
}
.xoa_sanpham,.xoa_sanpham_hang
{
	width:15px;
	float:left;
}
.ten_sanpham_hang
{
	width:100px;
	float:left;
	margin-left:5px;
}
.menu_body
{
	display:none;
	float:left;
	width:200px;
	background:#FFF;
}
.menu_body.active,
.menu_body2.active
{
	display:block;
}
.menu_body2
{
	display:none;
	width:200px;
	float:left;
}
</style>
<?
$d	=	$db->select("goon_cat","_tron_goi = 1","");
$rowd = $db->fetch($d);
?>
<div class="function" style="margin-left:30px">
	<a href="?act=tron_goi_menu_new&cat=<?=$rowd["id"]?>&id_lang=<?=$lang?>">
    	<img src="images/add_new.jpg"/> Tạo danh mục mới
    </a>
</div>
<div class="quan_ly" style="text-indent:20px;"><img src="images/quan_ly.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ DANH MỤC</strong></div>
<div class="border"></div>
<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
		$r = $db->select("goon_tron_goi_lang","cat = '".$delete."'");
		while ($row = $db->fetch($r))
		{
			$db->delete("goon_tron_goi","id = '".$row["id"]."'");
			$db->delete("goon_tron_goi_lang","id = '".$row["id"]."'");
		}
		$db->delete("goon_tron_goi_menu_lang","id = '".$delete."'");
		admin_load("Đã xóa thành công.","?act=tron_goi_list&id_lang=$lang");
	}
	if ($func == "sort")
	{
		$r	=	$db->select("goon_cat","_tron_goi=1");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("goon_cat","thu_tu",$order_[$id],"id = '".$id."'");
		}
		$r	=	$db->select("goon_tron_goi_menu_lang");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("goon_tron_goi_menu_lang","thu_tu",$order__[$id],"id = '".$id."'");
		}
		admin_load("Đã sắp xếp thành công.","?act=tron_goi_list&id_lang=$lang");
	}
?>
<form action="?act=tron_goi_manager" method="post">
    <input type="hidden" name="func" value="sort" />
    	<div id="firstpane">
        <?
			$r	=	$db->select("goon_cat","_tron_goi = 1","order by thu_tu asc");
			while ($row = $db->fetch($r))
			{
		?>
            	<div class="tb_foot">
                    <div class="tb_foot_ten"><img src="images/icon_sp.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row["ten"]?></div>
                    <div class="tb_foot_xep"><?=show_order("order_[".$row["id"]."]",$db->num_rows($r),$row["thu_tu"],"100%");?></div>
                </div>
			<?
                $t1	=	$db->select("goon_tron_goi_menu_lang","id='".$txt_cat."' and id_lang = '".$lang."'");
                $rt1 = $db->fetch($t1);
                $t2	=	$db->select("goon_tron_goi_menu_lang","id='".$rt1["cat"]."' and id_lang = '".$lang."'");
                $rt2 = $db->fetch($t2);
            ?>
                <div class="menu_body2 <?=(($rt1["cat"]==$row["id"])||($rt2["cat"]==$row["id"]))?'active':''?>">
            <?
				$r2	=	$db->select("goon_tron_goi_menu_lang","cat = '".$row["id"]."' and id_lang = '".$_SESSION["lang"]."'","order by thu_tu");
				while ($row2 = $db->fetch($r2))
				{
			?>
                    <div class="sanpham">
                        <div class="ten_sanpham"><a href="?act=tron_goi_list&txt_cat=<?=$row2["id"]?>&id_lang=<?=$lang?>" class=" <?=($txt_cat==$row2["id"])?'active':''?>"><img src="images/icon_sp.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row2["ten"]?></a></div>
                        <div class="xep_sanpham"><?=show_order("order__[".$row2["id"]."]",$db->num_rows($r2),$row2["thu_tu"],"90%",0);?></div>
                        <?
							if($xoa==1)
							{
						?>
                        <div class="sua_sanpham"><a href="?act=tron_goi_menu_edit&txt_cat=<?=$row2["id"]?>&id_lang=<?=$lang?>"><img src="images/sua.png" /></a></div>
                        <div class="xoa_sanpham"><a href="?act=tron_goi_manager&delete=<?=$row2["id"]?>&id_lang=<?=$lang?>" onclick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');"><img src="images/xoa.png" /></a></div>
                        <?
							}
							else echo'<div class="sua_sanpham">&nbsp;</div><div class="xoa_sanpham">&nbsp;</div>';
						?>
                    </div>
                    <div class="menu_body <?=(($rt1["cat"]==$row2["id"])||($txt_cat==$row2["id"]))?'active':''?>">
                <?
					$r3	=	$db->select("goon_tron_goi_menu_lang","cat='".$row2["id"]."' and id_lang = '".$lang."'","order by thu_tu");
					while ($row3 = $db->fetch($r3))
					{	
				?>    
                    	<div class="sanpham_hang">
                            <div class="ten_sanpham_hang"><a href="?act=tron_goi_list&txt_cat=<?=$row3["id"]?>&id_lang=<?=$lang?>" class=" <?=($txt_cat==$row3["id"])?'active':''?>"><img src="images/icon_sp.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row3["ten"]?></a></div>
                            <div class="xep_sanpham_hang"><?=show_order("order__[".$row3["id"]."]",$db->num_rows($r3),$row3["thu_tu"],"90%",0);?></div>
                            <?
								if($xoa==1)
								{
							?>
                            <div class="sua_sanpham_hang"><a href="?act=tron_goi_menu_edit&txt_cat=<?=$row3["id"]?>&id_lang=<?=$lang?>"><img src="images/sua.png"/></a></div>
                            <div class="xoa_sanpham_hang"><a href="?act=tron_goi_manager&delete=<?=$row3["id"]?>&id_lang=<?=$lang?>" onclick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');"><img src="images/xoa.png" /></a></div>
                            <?
								}
								else echo'<div class="sua_sanpham_hang">&nbsp;</div><div class="xoa_sanpham_hang">&nbsp;</div>';
							?>
                        </div>
				<?
					}
				?>
                    </div>
                <?
				}
				?>
                </div>
                <?
			}
		?>
        </div>
    <input type="submit" value="Sắp xếp" class="button_2" style="margin:20px 0 15px 120px"/>
</form>
