<style>
.tieu_de
{
	position:absolute;
	background:#FFF;
	padding:0 10px;
	margin-left:10px;
	font-weight:bold;
}
.form_cauhinh
{
	padding:20px 0 10px 0;
	margin-bottom:20px;
}
.form_chung,.form_cauhinh
{
	background:#FFF;
	border:solid 1px #cccccc;
	margin-top:10px;
}
.form_chung tr td,.form_cauhinh tr td
{
	padding:3px 0 3px 15px;
}

</style>
<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
        <img src="images/icon_cauhinh.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">CẤU HÌNH HỆ THỐNG WEBSITE</strong> 
    </div>
    <div class="border"></div>
    <center>
    <?php
    if ($func == "update")
    {
        $db->update("goon_bien","gia_tri",$txt_email,"ten = 'email'");
        $db->update("goon_bien","gia_tri",$txt_lien_ket,"ten = 'lien_ket'");
        $db->update("goon_bien","gia_tri",$txt_title,"ten = 'title'");
        $db->update("goon_bien","gia_tri",$txt_description,"ten = 'description'");
        $db->update("goon_bien","gia_tri",$txt_keyword,"ten = 'keyword'");
        $db->update("goon_bien","gia_tri",$txt_author,"ten = 'author'");
        $db->update("goon_bien","gia_tri",$txt_copyright,"ten = 'copyright'");
		$db->update("goon_bien","gia_tri",$txt_email_dat_hang,"ten = 'email_dat_hang'");
		$db->update("goon_bien","gia_tri",$txt_hien_thi,"ten = 'hien_thi'");
		move_uploaded_file($_FILES["hinh_gif"]["tmp_name"],
			"../uploads/favicon/" . $_FILES["hinh_gif"]["name"]);
		move_uploaded_file($_FILES["hinh_ico"]["tmp_name"],
			"../uploads/favicon/" . $_FILES["hinh_ico"]["name"]);
		move_uploaded_file($_FILES["logo_jpg"]["tmp_name"],
			"../uploads/favicon/" . $_FILES["logo_jpg"]["name"]);
		move_uploaded_file($_FILES["icon_online"]["tmp_name"],
			"../uploads/yahoo/" . $_FILES["icon_online"]["name"]);
		move_uploaded_file($_FILES["icon_offline"]["tmp_name"],
			"../uploads/yahoo/" . $_FILES["icon_offline"]["name"]);
        admin_load("Đã cập nhật các thông tin khác.","?act=other");
    }
    ?>
    <?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
    <form name="frm_edit" id="frm_edit" action="?act=other" enctype="multipart/form-data" method="post" style="margin:0px;" />
        <input type="hidden" name="func" value="update" />
        <table cellpadding="0" cellspacing="0" width="100%" class="form_chung">
            <tr><td class="khung_title" colspan="3"><img src="images/icon_thongtin.jpg" align="absmiddle"/> Nhập thông tin để cấu hình cho Website</td></tr>
            <tr>
            	<td width="49%">
                	<div class="tieu_de">Thông tin các thẻ SEO</div>
                	<table cellpadding="0" cellspacing="0" width="100%" class="form_cauhinh">
                    	<tr>
                            <td width="30%">Tiêu đề website : </td>
                            <td width="70%">
                                <input type="text" name="txt_title" value="<?=get_bien("title")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thẻ Meta description : </td>
                            <td>
                                <input type="text" name="txt_description" value="<?=get_bien("description")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thẻ Meta keyword : </td>
                            <td>
                                <input type="text" name="txt_keyword" value="<?=get_bien("keyword")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thẻ Meta author : </td>
                            <td>
                                <input type="text" name="txt_author" value="<?=get_bien("author")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                         <tr>
                            <td>Thẻ Meta copyright : </td>
                            <td>
                                <input type="text" name="txt_copyright" value="<?=get_bien("copyright")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="49%">
                	<div class="tieu_de">Cấu hình Mail, Pop-up</div>
                	<table cellpadding="0" cellspacing="0" width="100%" class="form_cauhinh">
                    	<tr>
                            <td width="25%">Email liên hệ: </td>
                            <td width="75%">
                                <input type="text" name="txt_email" value="<?=get_bien("email")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email đặt hàng: </td>
                            <td>
                                <input type="text" name="txt_email_dat_hang" value="<?=get_bien("email_dat_hang")?>" class="inputbox" style="width:90%" />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="line-height:20px">Email nhận tin khuyến mãi : </td>
                            <td>
                                <textarea name="txt_lien_ket" class="inputbox" style="width:90%" rows="4"><?=get_bien("lien_ket")?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="line-height:20px">Pop-up trang chủ : </td>
                            <td>
                                <input name="txt_hien_thi" type="radio" value="0" <?=get_bien("hien_thi")==0?"checked":""?> /> Tắt
                				<input name="txt_hien_thi" type="radio" value="1" <?=get_bien("hien_thi")==1?"checked":""?> /> Mở
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="2%"></td>
            </tr>
            <tr>
            	<td colspan="2">
                	<div class="tieu_de">Favicon website - Logo mail</div>
                	<table cellpadding="0" cellspacing="0" width="100%" class="form_cauhinh">
                    	<tr>
                            <td width="32%">
                            	Icon(gif): <input type="file" name="hinh_gif" class="inputbox" style="width:60%; margin-right:30px" /><img src="../uploads/favicon/favicon.gif">
                            </td>
                            <td width="32%">
                                Icon(ico): <input type="file" name="hinh_ico" class="inputbox" style="width:60%; margin-right:30px" /><img src="../uploads/favicon/favicon.ico">
                            </td>
                            <td width="36%">
                            	 Logo(jpg): <input type="file" name="logo_jpg" class="inputbox" style="width:60%; margin-right:10px" /><img src="../uploads/favicon/logo.jpg">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                	<div class="tieu_de">Icon online, offline Yahoo</div>
                	<table cellpadding="0" cellspacing="0" width="100%" class="form_cauhinh">
                    	<tr>
                            <td width="50%">
                            	Online: <input type="file" name="icon_online" class="inputbox" style="width:40%; margin-right:30px" /><img src="../uploads/yahoo/online.png" align="absmiddle">
                            </td>
                            <td width="50%">
                                Offline: <input type="file" name="icon_offline" class="inputbox" style="width:40%; margin-right:30px" /><img src="../uploads/yahoo/offline.png" align="absmiddle">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            	<td width="100%" colspan="2" align="center" class="form_bot">
                    <div class="khung_button" style="width:125px;"><input name="submit" type="submit" class="button" value="Lưu cấu hình" /></div>
                </td>
            </tr>
        </table>
    </form>
    </center>
</div>