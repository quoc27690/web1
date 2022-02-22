<?php
	$mang = explode(",",$_SESSION['cart']);
	if(in_array($sp,$mang)==false) $_SESSION['cart'] = $_SESSION['cart'].$sp.',';
	$tong_sp = 0;
	if($_SESSION['cart']!=""){
		$chuoi = substr($_SESSION['cart'],0,-1) ; 
		$mang = explode(",",$chuoi); 
		$tong_sp = count($mang);
	}
	echo $tong_sp;
?>