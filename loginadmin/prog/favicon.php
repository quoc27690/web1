<?php 
$r1 = $db->select("goon_user","username='".$_SESSION["login_admin_user"]."'");
$row1 = $db->fetch($r1);
$r2 = $db->select("goon_phanquyen","quyen='".$row1["level"]."'");
$row2 = $db->fetch($r2);
$ktra = $row2["favicon"]+0;
if ($ktra == 0)
	echo'Bạn không có quyền truy cập vào mục này.<a href="?act=home">Bấm vào đây để quay về</a>';
if ($ktra == 1)
{
?>
<font size="2" face="Tahoma"><b>Quản lý logo công ty</b></font>
<hr size="1" color="#cadadd" />

<form name="frm_edit" id="frm_edit" action="?act=favicon" enctype="multipart/form-data" method="post" style="margin:0px;">
	<table>
        <tr>
        	<td width="15%" align="right">File gif</td>
            <td width="55%" align="left"><input type="file" name="hinh_gif" class="inputbox" style="width:100%;" /></td>
            <td width="25%" align="center"><img src="../favicon.gif"></td>
        </tr>
        <tr>
        	<td align="right">File ico</td>
            <td align="left"><input type="file" name="hinh_ico" class="inputbox" style="width:100%;" /></td>
            <td align="center"><img src="../favicon.ico"></td>
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
	move_uploaded_file($_FILES["hinh_gif"]["tmp_name"],
      "../" . $_FILES["hinh_gif"]["name"]);
	  move_uploaded_file($_FILES["hinh_ico"]["tmp_name"],
      "../" . $_FILES["hinh_ico"]["name"]);
}
}
?>