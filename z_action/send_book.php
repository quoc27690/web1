<?php
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
	$mail->FromName = 'Đăng ký từ website';
	$mail->From     = "sendmail@goon.net.vn";
	$mail->addAddress(get_bien("email"), get_bien("title"));     // mail đến
	$mail->Subject  = 'Đăng ký từ website';
	$mail->WordWrap = 50;
	$mail->Body = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><body><div style="width:570px; margin:0 auto;padding:15px;border:solid 10px #D0D0D0"><p style="margin:5px 0; text-align:center; text-transform:uppercase"><strong><span style="color:#993300;">Thông tin đăng ký từ website</span></strong></p><p style="margin:5px 0"><strong><span style="font-family:arial,sans-serif; font-size:10.0pt">&nbsp;</span></strong></p><table border="0" cellpadding="5" cellspacing="0"><tbody><tr><td>Họ và tên:</td><td>'.$name.'</td></tr><tr><td>Điện thoại/Email:</td><td>'.$phone.'</td><tr><td>Địa chỉ:</td><td>'.$add.'</td></tr></tr><tr><td>Giới tính:</td><td>'.$sex.'</td></tr><tr><td>Chi nhánh:</td><td>'.$chi_nhanh'</td></tr><tr><td>Lớp học:</td><td>'.$lop_hoc'</td></tr><tr><td>Ghi chú:</td><td>'.$message'</td></tr></tbody></table></div></body></html>';
	if(!$mail->send()) {
		echo 'Không thể gửi mail của bạn vì có một vài lỗi từ phía máy chủ.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Cám ơn bạn đã gửi mail liên hệ. Chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.';
	}
?>
