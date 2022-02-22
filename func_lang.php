<?php
				function curPageURL()  /*lay url hien tai*/
					{
						 $pageURL = 'http';
						 $pageURL .= "://";
						if ($_SERVER["SERVER_PORT"] != "80") 
						{
							$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
						} 
						else 
						{
							$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
						}
						return $pageURL;
					}
				   $geturl = curPageURL();
    			   $checken = '/en/' ;
				   $checken2 = '.html' ;
				   if( strpos($geturl, $checken) !== false and strpos($geturl, $checken2) !== false ){ /*kiem tra su ton tai cua ky tu /en/ va .html*/
						$en=  $geturl;
					}
					else if( strpos($geturl, $checken) !== true and strpos($geturl, $checken2) !== false ){ /*kiem tra su ton tai cua ky tu .html*/
						$langen = explode("/vn/",$geturl); /*tach ky tu vn trong url*/
				  		$en = $langen[0].'/en/'.$langen[1]; /*thay the ky tu vn bang en*/
					}
					else {
				  		$en = "/en/trang-chu".lg_string::get_link($txt);
					}
					
				   $checkvn = '/vn/' ;
				   $checkvn2 = '.html' ;
				   if( strpos($geturl, $checkvn) !== false and strpos($geturl, $checkvn2) !== false){ /*kiem tra su ton tai cua ky tu /vn/ va .html*/
						$vn=  $geturl;
					}
					else if( strpos($geturl, $checkvn) !== true and strpos($geturl, $checkvn2) !== false){ /*kiem tra su ton tai cua ky tu .html*/
						$langvn = explode("/en/",$geturl); /*tach ky tu en trong url*/
				  		$vn = $langvn[0].'/vn/'.$langvn[1]; /*thay the ky tu en bang vn*/
					}
					else {
						$vn = "/vn/trang-chu".lg_string::get_link($txt);
					}
					
?>