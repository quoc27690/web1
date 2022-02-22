<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
ob_start();
@session_start();
include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");
ob_end_clean();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đặt hàng BEGILI</title>
<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
</head>
<body>
<?php
	$name 		= $_POST['name'];
	$phone 		= $_POST['phone'];
	$email 		= $_POST['email'];
	$message	= $_POST['message'];
	$so_luong	= $_POST['so_luong'];
	foreach($so_luong as $key=>$value){
		$don_hang = $don_hang.'<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
	}
	$body = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><body><div style="width:570px; margin:0 auto;padding:15px;border:solid 10px #D0D0D0"><p style="margin:5px 0; text-align:center; text-transform:uppercase"><strong><span style="color:#993300;">Mail đặt hàng từ website</span></strong></p><p style="margin:5px 0"><strong><span style="font-family:arial,sans-serif; font-size:10.0pt">&nbsp;</span></strong></p><table border="0" cellpadding="5" cellspacing="0"><tbody><tr><td>Họ và tên:</td><td>'.$name.'</td></tr><tr><td>Điện thoại:</td><td>'.$phone.'</td></tr><tr><td>E-mail:</td><td>'.$email.'</td></tr><tr><td>Yêu cầu:</td><td>'.$message.'</td></tr></tbody></table><table cellpadding="5" cellspacing="0" border="1" width="100%" style="border-collapse:collapse; border-color:#000; color:#000; margin-top:20px"><tr style="text-transform:uppercase; font-weight:bold; text-align:center; background:#A7B653; color:#fff;"><td>Sản phẩm</td><td width="50px">SL</td></tr>'.$don_hang.'</table></div></body></html>';
	include('mail/class.phpmailer.php');
	$mail = new PHPMailer();  
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->Mailer = "smtp";
	$mail->Host = "ssl://smtp.gmail.com";
	$mail->Port = 465;
	$mail->isHTML(true);
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = "autosendmail@goon.net.vn"; // SMTP username
	$mail->Password = "dviduzwvwnbxelgj"; // SMTP password
	$mail->FromName = 'Đặt hàng từ website';
	$mail->From     = $email;
	$mail->addAddress(get_bien("email"), get_bien("title"));     // mail đến
	$mail->addReplyTo($email, $name);			// mail khách hàng
	$mail->Subject  = 'Đặt hàng từ website';
	$mail->WordWrap = 50;
	$mail->Body = $body;
	if(!$mail->send()) {
		?>
        <script type="text/javascript">
			$(document).ready(function(){
				alert('Không thể gửi đơn đặt hàng của bạn vì có một vài lỗi từ phía máy chủ.\nYour order could not be submitted because there are some errors on the server side.');
			});
        </script>
        <?
	} else {
		$_SESSION['cart'] ="";
		?>
        <script type="text/javascript">
			$(document).ready(function(){
				alert('Cám ơn bạn đã đặt hàng. Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.\nThank you for ordering. We will respond to you as soon as possible.');
			});
        </script>
        <?
	}
?>
</body>
</html>