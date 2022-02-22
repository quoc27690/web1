<?php 
$r1 = $db->select("goon_user","username='".$_SESSION["login_admin_user"]."'");
$row1 = $db->fetch($r1);
$r2 = $db->select("goon_phanquyen","quyen='".$row1["level"]."'");
$row2 = $db->fetch($r2);
$ktra = $row2["yahoo"]+0;
if ($ktra == 0)
	echo'Bạn không có quyền truy cập vào mục này.<a href="?act=home">Bấm vào đây để quay về</a>';
if ($ktra == 1)
{
?>
<font size="2" face="Tahoma"><b>Quản lý biểu tượng online, offline yahoo</b> (Link: /yahoo/yahoo.php?id=nickyahoo )</font>
<hr size="1" color="#cadadd" />

<form name="frm_edit" id="frm_edit" action="?act=yahoo" enctype="multipart/form-data" method="post" style="margin:0px;">
	<table>
        <tr>
        	<td width="15%" align="right">Biểu tượng online</td>
            <td width="55%" align="left"><input type="file" name="icon_online" class="inputbox" style="width:100%;" /></td>
            <td width="25%" align="center"><img src="../yahoo/online.png"></td>
        </tr>
        <tr>
        	<td align="right">Biểu tượng offline</td>
            <td align="left"><input type="file" name="icon_offline" class="inputbox" style="width:100%;" /></td>
            <td align="center"><img src="../yahoo/offline.png"></td>
        </tr>
        <tr>
        	<td></td>
        	<td><input type="submit" name="submit" class="button" value="Lưu lại" style="width:100px"></td>
            <td></td>
        </tr>
    </table>
</form>
<?php
if($submit)
{
	move_uploaded_file($_FILES["icon_online"]["tmp_name"],
      "../yahoo/" . $_FILES["icon_online"]["name"]);
	  move_uploaded_file($_FILES["icon_offline"]["tmp_name"],
      "../yahoo/" . $_FILES["icon_offline"]["name"]);
}
}
?>