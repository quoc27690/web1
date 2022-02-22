<?php
include "../../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

function img_resize($src,$dis,$par)
{
 	require_once('../../lib/phpthumb/phpthumb.class.php');
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
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
	$dinh_dang = strrchr($_FILES['Filedata']['name'],".");
	$time=rand(0,time());
	
	$targetFile = str_replace('//','/',$targetPath).$_GET['id']."_".$time.$dinh_dang;
	 
	$filename = $_GET['id']."_".$time.$dinh_dang;
	$thumb = "nho_".$filename ;
	$bigc = "lon_".$filename ;

	img_resize($tempFile,$targetPath.$thumb,"w=125&h=75&zc=1");	
	img_resize($tempFile,$targetPath.$bigc,"w=690&h=450&zc=1");	
	img_resize($tempFile,$targetPath.$filename,"h=480");
	
	echo $filename;	
	
 
	$p = $db->select("goon_project","id = ".$_GET['id'],"LIMIT 1");
	$photo = $db->fetch($p);
	
	if ( $photo["photos"] == NULL ) $photos = $filename;
	else $photos = $photo["photos"].";".$filename;
	
	$db->update("goon_project","photos",$photos,"id = ".$_GET['id']);		
}
?>