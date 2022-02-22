<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
    	<img src="images/icon_danhmuc.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">DANH MỤC <img src="images/bl3.gif" border="0" /> SỬA DANH MỤC</strong>
    </div>
    <div class="border"></div>
    <center>
<?php
	$r = $db->select("goon_cat","id_alias='".$id_alias."'");
	$row = $db->fetch($r);
?>
	<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
	<form action="?act=cat_edit" enctype="multipart/form-data" method="post">
    	<input type="hidden" name="id_alias" value="<?=$row["id_alias"]?>" />
        <input type="hidden" name="lang" value="<?=$_SESSION['lang']?>" />
        <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
            <tr>
                <td class="khung_title" colspan="2">
                	<img src="images/icon_thongtin.jpg" align="absmiddle"/> Thông tin danh mục
                </td>
            </tr>
            <tr>
                <td width="20%">ID</td>
                <td width="80%"><input type="text" name="id" class="inputbox" style="width:90%;" value="<?=$row["id"]?>"></td>
            </tr>
            <tr>
                <td>Tên danh mục</td>
                <td><input type="text" name="ten" class="inputbox" style="width:90%;" value="<?=$row["ten"]?>"></td>
            </tr>
            <tr>
                <td width="100%" colspan="2" align="center" class="form_bot">
                    <div class="khung_button" style="width:90px;"><input name="submit" type="submit" class="button" value="Cập nhật" /></div>
                </td>
            </tr>
        </table>
    </form>
<?php
	$id_alias = $_POST["id_alias"];
	$id = $_POST["id"];
	$ten = $_POST["ten"];
	$lang = $_POST["lang"];
	if($submit)
	{
		if (empty($id))
			$error = "Vui lòng nhập id.";
		else if (empty($ten))
			$error = "Vui lòng nhập tên.";	
		else
		{	
			$db->query("update goon_cat set ten='".$ten."', id = '".$id."' where id_alias = '".$id_alias."'");
			admin_load("Đã sửa danh mục","?act=cat_manager&id_lang=".$lang);
		}
	}		
?>
	</center>
</div>