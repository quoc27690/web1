<?php
$rd1 = $db->select("goon_user","username = '".$db->escape($_SESSION['login_admin_user'])."'");
while ($rowd1 = $db->fetch($rd1))
{
	$thanh_vien	=	$rowd1;
	$level = $rowd1['level'];
}
$rd2 = $db->select("goon_phanquyen","quyen='".$level."'");
while ($rowd2 = $db->fetch($rd2))
{
	$xoa 		= $rowd2["xoa"]+0;
	$tin_tuc 	= $rowd2["tin_tuc"]+0;
	$hinh_anh 	= $rowd2["hinh_anh"]+0;
	$san_pham 	= $rowd2["san_pham"]+0;
	$du_an 		= $rowd2["du_an"]+0;
	$bai_viet 	= $rowd2["bai_viet"]+0;
	$cau_hinh 	= $rowd2["cau_hinh"]+0;
	$tai_khoan 	= $rowd2["tai_khoan"]+0;
	/*$media 		= $rowd2["media"]+0;*/
	/*$file 		= $rowd2["file"]+0;*/
}
function	get_user($id,$value)
{
	global $db;

	$r	=	$db->select("goon_user","id = '".$id."'");
	while ($row = $db->fetch($r))
		return $row[$value];
}

function	kt_user_dung($txt_username)
{
	return (!ereg("(^[a-z]+([a-z\_0-9\-]*))$", $txt_username));
}

function	get_bien($id)
{
	global $db;

	$r	=	$db->select("goon_bien","ten = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["gia_tri"];
}

function	kt_email_dung($txt_email)
{
	return (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txt_email));
}
function	show_order($name,$sum,$pos,$width,$style=1)
{
?>
<select name="<?=$name?>" dir="rtl" size="1" class="inputbox" style="width:<?=$width?>;<?=$style==1?"font-weight:bold;color:red;":""?>">
<?php
	for ($i = 1; $i <= $sum; $i++)
	{
		echo "<option value=".$i;
		if ($pos == $i) echo " selected ";
		echo ">".$i."</option>";
	}
?>
</select>
<?php
}
// admin_load
function	admin_load($thong_bao,$url)
{
?>
<center>
	<b><font size="2"><?=$thong_bao?></font></b>
	<br /><img vspace="3" src="images/83.gif" />
	<br>Xin đợi vài giây hoặc bấm <b><a href="<?=$url?>">vào đây</a></b> để tiếp tục...
</center>
<head>
	<meta http-equiv="Refresh" content="1; URL=<?=$url?>">
</head>
<?php
	die();
}
// resize hình ảnh bất kỳ
function img_resize($src,$dis,$par)
{
 	require_once('../lib/phpthumb/phpthumb.class.php');
 	$phpThumb = new phpThumb();
 	$phpThumb->src = $src;
		$r = explode("&",$par);
		for ($i = 0; $i <= count($r); $i++)
		{
			if ($r[$i] != "")
			{
				$q = explode("=",$r[$i]);
				if ($q[0] == 'h')
					$phpThumb->h = $q[1];
				if ($q[0] == 'w')
					$phpThumb->w = $q[1];

				if ($q[0] == 'zc')
				{
					$phpThumb->zc = $q[1];
				}

				if ($q[0] == 'fltr[]')
				{
					$phpThumb->fltr[] = $q[1];
				}
			}
		}
	$phpThumb->q = 100;
	$phpThumb->config_output_format = 'jpeg';
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($dis);
  	}
  	else
	{
  	}
}
function VndDot($strNum)
{
	$len = strlen($strNum);
	$counter = 3;
	$result = "";
	while ($len - $counter >= 0)
	{
		$con = substr($strNum, $len - $counter , 3);
		$result = '.'.$con.$result;
		$counter+= 3;
	}
	$con = substr($strNum, 0 , 3 - ($counter - $len) );
	$result = $con.$result;
	if(substr($result,0,1)=='.'){
		$result=substr($result,1,$len+1);
	}
	return $result;
}
?>
