<?
//seo web
$id 	=$_GET['id'];
$title  = "";
$key	= "";
$description = "";
	switch ($act)
    {
		case "gioi_thieu":
		    $get_id = $db->select("goon_cms","hien_thi=1 and id =".$id."","");
			$get_ten = $db->fetch($get_id); 
			echo $title = $get_ten["title"];
				 $key = $get_ten["khoa"];
				 $description = $get_ten["description"];	
            break;
		case "lien_he":
          $e = $db->select("goon_page","alias like 'lien_he'","");
		  $r = $db->fetch($e);
		  echo $title = $r["title"];
		  	   $key = $r["khoa"];
			   $description = $r["description"];	
           break;
		case "hoc_tieng_anh":
		case "phuong_phap":
		case "tien_ich":
		case "tin_tuc":
            $get_id = $db->select("goon_cms_menu","hien_thi=1 and id ='".$id."'");
			$get_ten = $db->fetch($get_id); 
			echo $title = $get_ten["title"];
				 $key = $get_ten["khoa"];
				 $description = $get_ten["description"];	
            break;
        case "hoc_tieng_anh_xem":
		case "phuong_phap_xem":
		case "tien_ich_xem":
		case "tin_tuc_xem":
            $get_id = $db->select("goon_cms","hien_thi=1 and link ='".$id."'");
			$get_ten = $db->fetch($get_id); 
			echo $title = $get_ten["title"];
				 $key = $get_ten["khoa"];
				 $description = $get_ten["description"];	
            break;
	    default: echo $title = get_bien("title"); $key = get_bien("keyword"); $description = get_bien("description");
    }
?>