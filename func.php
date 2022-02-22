<?php

function showPageNavigation($currentPage, $maxPage, $path = '') {
	if ($maxPage <= 1)
	{
		return;
	}
	
	
	$suffix = lg_string::get_link($txt);
	
	$nav = array(
		// bao nhiêu trang bên trái currentPage
		'left'	=>	3,
		// bao nhiêu trang bên phải currentPage
		'right'	=>	3,
	);
	
	// nếu maxPage < currentPage thì cho currentPage = maxPage
	if ($maxPage < $currentPage) {
		$currentPage = $maxPage;
	}
	
	// số trang hiển thị
	$max = $nav['left'] + $nav['right'];
	
	// phân tích cách hiển thị
	if ($max >= $maxPage) {
		$start = 1;
		$end = $maxPage;
	}
	elseif ($currentPage - $nav['left'] <= 0) {
		$start = 1;
		$end = $max + 1;
	}
	elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
		$start = $maxPage - $max;
		$end = $maxPage;
	}
	else {
		$start = $currentPage - $nav['left'];
		if ($start == 2) {
			$start = 1;
		}
		
		$end = $start + $max;
		if ($end == $maxPage - 1) {
			++$end;
		}
	}
	
	$navig = '<div class="navigation"><span class="current_page_item">Page <b>'.$currentPage.'</b>/<b>'.$maxPage.'</b></span>';
	if ($currentPage >= 2) {
		if ($currentPage >= $nav['left']) {
			if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
				// thêm nút "First"
				$navig .= '<span class="page_item"><a href="'.$path.'1'.$suffix.'">1</a></span>';
				$navig .= '<span class="current_page_item"><b>...</b></span>';
			}
		}
		// thêm nút "«"
		$navig .= '<span class="page_item"><a href="'.$path.($currentPage - 1).$suffix.'">«</a></span>';
	}

	for ($i=$start;$i<=$end;$i++) {
		// trang hiện tại
		if ($i == $currentPage) {
			$navig .= '<span class="current_page_item">'.$i.'</span>';
		}
		// trang khác
		else {
			$pg_link = $path.$i;
			$navig .= '<span class="page_item"><a href="'.$pg_link.$suffix.'">'.$i.'</a></span>';
		}
	}
	
	if ($currentPage <= $maxPage - 1) {
		// thêm nút "»"
		$navig .= '<span class="page_item"><a href="'.$path.($currentPage + 1).$suffix.'">»</a></span>';
		
		if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
			// thêm nút "Last"
			$navig .= '<span class="current_page_item">...</span>';
			$navig .= '<span class="page_item"><a href="'.$path.$maxPage.$suffix.'">'.$maxPage.'</a></span>';
		}
	}
	$navig .= '</div>';
	
	// hiển thị kết quả
	echo $navig;
}


function	get_page($alias,$col)
{
	global $db , $_fix;
	
	$alias = $db->escape($alias);
	
	$db->query("UPDATE goon_page SET luot_xem = luot_xem + 1 WHERE alias = '".$alias."'");
	$r		=	$db->select("goon_page","alias = '".$alias."'");
	$row 	= 	$db->fetch($r);
	$r2 	= 	$db->select("goon_page_lang","id='".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'","");
	while ($row2 = $db->fetch($r2))
	{
		return str_replace("\\","",$row2[$col]);
	}
	
	return "Unknown alias '".$alias."'";
}
function	get_news($id,$col)
{
	global $db , $_fix;
	
	$r		=	$db->select("goon_cms","id = '".$id."'");
	$row 	= 	$db->fetch($r);
	$r2 	= 	$db->select("goon_cms_lang","id='".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'","");
	while ($row2 = $db->fetch($r2))
	{
		return str_replace("\\","",$row2[$col]);
	}
	
	return "Unknown news '".$id."'";
}
function	get_news_cat($id,$col)
{
	global $db , $_fix;
	
	$r		=	$db->select("goon_cms_menu","id = '".$id."'");
	$row 	= 	$db->fetch($r);
	$r2 	= 	$db->select("goon_cms_menu_lang","id='".$row["id"]."' and id_lang='".$_SESSION['id_lang']."'","");
	while ($row2 = $db->fetch($r2))
	{
		return str_replace("\\","",$row2[$col]);
	}
	
	return "Unknown news cat '".$id."'";
}
function	get_bien($id)
{
	global $db;
	
	$r	=	$db->select("goon_bien","ten = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["gia_tri"];
}

function gui_mail($nguoigoi,$nguoinhan,$tieude,$noidung)
{
	global $conf;
	
	if (ereg("(.*)<(.*)>", $nguoigoi, $regs)) {
	   $nguoigoi = '=?UTF-8?B?'.base64_encode($regs[1]).'?=<'.$regs[2].'>';
	}
	
	$header = "From: ".$nguoigoi."\n";
	$header .= "Content-Type:text/html;";
	$header .= "charset=UTF-8\n";
	$noidung =	str_replace("\n"	, "<br>"	, $noidung);
	$noidung =	str_replace("  "	, "&nbsp; "	, $noidung);
	$noidung =	str_replace("<script>","&lt;script&gt;", $noidung);
	return (@mail($nguoinhan, $tieude, $noidung, $header));
			
}
function	get_title()
{
	global $db;
	$txt	=	get_bien("title");
	
	$r	=	$db->select("goon_page","alias like 'dich_vu_%'","order by id limit 50");
	while($row = $db->fetch($r))
	{
		
		
			$txt .= " - ".lg_string::bo_dau($row["ten"]);
		
	
	}
		
	return $txt;
}

function hashString($string)
{
	return md5('qweasdzxc'.$string);
}

function numberFormatVN($number)
{
	return number_format($number, 0, '.', ',');
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