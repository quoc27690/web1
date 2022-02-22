<?
$d	=	$db->select("goon_cat","_project = 1","");
$rowd = $db->fetch($d);
?>
<div class="function" style="margin-left:30px">
	<a href="?act=project_menu_new&cat=<?=$rowd["id"]?>&id_lang=<?=$lang?>">
    	<img src="images/add_new.jpg"/> Tạo danh mục mới
    </a>
</div>
<div class="quan_ly" style="text-indent:20px;"><img src="images/quan_ly.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ DANH MỤC</strong></div>
<div class="border"></div>
<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
		$r = $db->select("goon_project","cat = '".$delete."'");
		$row = $db->fetch($r);
		$db->delete("goon_project_lang","id = '".$row["id"]."'");
		$db->delete("goon_project","cat = '".$delete."'");
		$db->delete("goon_project_menu","id = '".$delete."'");
		$db->delete("goon_project_menu_lang","id = '".$delete."'");
		admin_load("Đã xóa thành công.","?act=project_list&id_lang=".$_SESSION['lang']);
	}
	if ($func == "sort")
	{
		$r	=	$db->select("goon_cat","_project=1");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("goon_cat","thu_tu",$order_[$id],"id = '".$id."'");
		}
		$r	=	$db->select("goon_project_menu");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("goon_project_menu","thu_tu",$order__[$id],"id = '".$id."'");
		}
		admin_load("Đã sắp xếp thành công.","?act=project_list&id_lang=".$_SESSION['lang']);
	}
?>
<form action="?act=project_manager" method="post">
    <input type="hidden" name="func" value="sort" />
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_dm" id="firstpane">
		<?php
        $r	=	$db->select("goon_cat","_project = 1","order by thu_tu asc");
        while ($row = $db->fetch($r))
        {
        ?>
            <tr class="tb_foot">
                <td width="120px" style="text-transform:uppercase"><img src="images/icon_duan.png" align="absmiddle"/>&nbsp;&nbsp;<b><?=$row["ten"]?></b></td>
                <td width="80px"><?=show_order("order_[".$row["id"]."]",$db->num_rows($r),$row["thu_tu"],"70%");?></td>
            </tr>
		<?
            $t1	 = $db->select("goon_project_menu","id='".$txt_cat."'");
            $rt1 = $db->fetch($t1);
        ?>
            <tr class="menu_body2 <?=($rt1["cat"]==$row["id"])?'active':''?>">
            	<td colspan="2">
                	<table border="0" cellspacing="0" cellpadding="0" class="tab_con">
						<?
                        $r2	=	$db->select("goon_project_menu","cat = '".$row["id"]."'","order by thu_tu asc");
                        while ($row2 = $db->fetch($r2))
                        {
                            $r3 = $db->select("goon_project_menu_lang","id='".$row2["id"]."' and id_lang='".$lang."'");
                            $row3 = $db->fetch($r3);
                        ?>
                            <tr>
                            	<td width="10px"></td>
                                <td width="110px"><a href="?act=project_list&txt_cat=<?=$row2["id"]?>&id_lang=<?=$lang?>" class=" <?=($txt_cat==$row2["id"])?'active':''?>"><img src="images/icon_duan.png" align="absmiddle"/>&nbsp;&nbsp;<?=$row3["ten"]?></a></td>
                                <td width="45px"><?=show_order("order__[".$row2["id"]."]",$db->num_rows($r2),$row2["thu_tu"],"90%",0);?></td>
                                <?
									if($xoa==1)
									{
								?>
                                <td width="20px"><a href="?act=project_menu_edit&txt_cat=<?=$row2["id"]?>&id_lang=<?=$lang?>"><img src="images/sua.png"/></a></td>
                                <td width="15px"><a href="?act=project_manager&delete=<?=$row2["id"]?>&id_lang=<?=$lang?>" onclick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');"><img src="images/xoa.png" /></a></td>
                                 <?
									}
									else echo'<td colspan="2" width="35px">&nbsp;</td>';
								 ?>
                            </tr>
                        <?
                        }
                        ?>
            		</table>
            	</td>
            </tr>
            <?
        }
        ?>
        </table>
    <input type="submit" value="Sắp xếp" class="button_2" style="margin:20px 0 15px 120px"/>
</form>
