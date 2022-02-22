<?php
	$xoa = str_replace($sp.',', '', $_SESSION['cart']);
	$_SESSION['cart'] = $xoa;
?>