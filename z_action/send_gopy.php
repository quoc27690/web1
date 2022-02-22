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
	$mail->FromName = 'THẮC MẮC VÀ TRAO ĐỔI';
	$mail->From     = "sendmail@goon.net.vn";
	$mail->addAddress(get_bien("email"), get_bien("title"));     // mail đến
	$mail->Subject  = 'THẮC MẮC VÀ TRAO ĐỔI';
	$mail->WordWrap = 50;
	$mail->Body = '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><body><div style="width:570px; margin:0 auto;padding:15px;border:solid 10px #D0D0D0"><p style="margin:5px 0; text-align:center; text-transform:uppercase"><strong><span style="color:#993300;">Yêu cầu đặt lịch khám</span></strong></p><p style="margin:5px 0"><strong><span style="font-family:arial,sans-serif; font-size:10.0pt">&nbsp;</span></strong></p><table border="0" cellpadding="5" cellspacing="0"><tbody><tr><td>Loại thắc mắc:</td><td>'.$type.'</td></tr><tr><td>Họ và tên:</td><td>'.$name.'</td></tr><tr><td>Giới tính:</td><td>'.$gioi_tinh.'</td></tr><tr><td>Ngày sinh:</td><td>'.$ngay_sinh.'</td></tr><tr><td>Điện thoại:</td><td>'.$phone.'</td></tr><tr><td>Email:</td><td>'.$email.'</td></tr><tr><td>Ngày khám bệnh:</td><td>'.$ngay_kham.'</td></tr><tr><td>Tin nhắn:</td><td>'.$tin_nhan.'</td></tr><tr><td>Liên lạc lại:</td><td>'.$lien_lac_lai'</td></tr></tbody></table></div></body></html>';
	if(!$mail->send()) {
		echo 'Không thể gửi mail của bạn vì có một vài lỗi từ phía máy chủ.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Cám ơn bạn đã gửi mail góp ý. Chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.';
	}
?>
