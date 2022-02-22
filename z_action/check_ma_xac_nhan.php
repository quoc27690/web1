<?php
	if($ma == $_SESSION['security_code']){
		?>
        <input type="hidden" name="check_ma_xac_nhan" id="check_ma_xac_nhan" value="yes" />
        <?
	}
	else{
		?>
        <input type="hidden" name="check_ma_xac_nhan" id="check_ma_xac_nhan" value="no" />
        <?
	}
?>

