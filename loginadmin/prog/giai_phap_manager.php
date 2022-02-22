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
	width:200px;
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
	width:190px;
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
<div class="quan_ly" style="text-indent:20px;"><img src="images/quan_ly.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ DANH MỤC</strong></div>
<div class="border"></div>
<div id="firstpane">
<?
    $r	=	$db->select("goon_cat","_product = 1","order by thu_tu asc");
    while ($row = $db->fetch($r))
    {
?>
        <div class="tb_foot">
            <div class="tb_foot_ten"><img src="images/icon_sp.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row["ten"]?></div>
        </div>
    <?
        $t1	=	$db->select("goon_product_menu_lang","id='".$txt_cat."' and id_lang = '".$lang."'");
        $rt1 = $db->fetch($t1);
        $t2	=	$db->select("goon_product_menu_lang","id='".$rt1["cat"]."' and id_lang = '".$lang."'");
        $rt2 = $db->fetch($t2);
    ?>
        <div class="menu_body2 <?=(($rt1["cat"]==$row["id"])||($rt2["cat"]==$row["id"]))?'active':''?>">
    <?
        $r2	=	$db->select("goon_product_menu_lang","cat = '".$row["id"]."' and id_lang = '".$_SESSION["lang"]."'","order by thu_tu");
        while ($row2 = $db->fetch($r2))
        {
    ?>
            <div class="sanpham">
                <div class="ten_sanpham"><a href="?act=giai_phap_list&txt_cat=<?=$row2["id"]?>&id_lang=<?=$lang?>" class=" <?=($txt_cat==$row2["id"])?'active':''?>"><img src="images/icon_sp.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row2["ten"]?></a></div>
            </div>
            <div class="menu_body <?=(($rt1["cat"]==$row2["id"]))?'active':''?>">
        <?
            $r3	=	$db->select("goon_product_menu_lang","cat='".$row2["id"]."' and id_lang = '".$lang."'","order by thu_tu");
            while ($row3 = $db->fetch($r3))
            {	
        ?>    
                <div class="sanpham_hang">
                    <div class="ten_sanpham_hang"><a href="?act=giai_phap_list&txt_cat=<?=$row3["id"]?>&id_lang=<?=$lang?>" class=" <?=($txt_cat==$row3["id"])?'active':''?>"><img src="images/icon_sp.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row3["ten"]?></a></div>
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