<div style="padding:5px 10px 0 20px">
	<div class="quan_ly">
        <img src="images/icon_phanquyen.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ PHÂN QUYỀN</strong> 
    </div>
    <div class="border"></div>
    <div class="function" style="width:90px">
        <a href="?act=phanquyen_new"><img src="images/add_new.jpg" style="margin-right:10px"/>Phân quyền</a>
    </div>
    <table class="tb_table" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="tb_head">
        <td>Quyền</td>
        <td>Xóa</td>
        <td>Tin tức</td>
        <td>Hình ảnh</td>
        <td>Sản phẩm</td>
        <td>Dự án</td>
        <td>Bài viết</td>
        <td>File</td>
        <td>Media</td>
        <td>Tài khoản</td>
        <td>Cấu hình</td>
        <td>Sửa</td>
        <td>Xóa</td>
      </tr>
    <?php
        $level_arr	=	array("","Admin","Super Moderator","Moderator","Member");
        $r2	=	$db->select("goon_phanquyen","","order by quyen asc");
        while ($row2 = $db->fetch($r2))
        {
            if($row2["quyen"]!=1)
            {
        ?>
            <tr class="tb_content">
                <td><?=$level_arr[$row2["quyen"]]?></td>
                <td><?=$row2["xoa"]?></td>
                <td><?=$row2["tin_tuc"]?></td>
                <td><?=$row2["hinh_anh"]?></td>
                <td><?=$row2["san_pham"]?></td>
                <td><?=$row2["du_an"]?></td>
                <td><?=$row2["bai_viet"]?></td>
                <td><?=$row2["file"]?></td>
                <td><?=$row2["media"]?></td>
                <td><?=$row2["tai_khoan"]?></td>
                <td><?=$row2["cau_hinh"]?></td>
                <td><a href="?act=phanquyen_edit&quyen=<?=$row2["quyen"]?>"><img src="images/sua_big.png"/></a></td>
                <td><a href="?act=phanquyen_manager&delete=<?=$row2["quyen"]?>" onClick="return confirm('Bạn có chắc chắn không ?');"><img src="images/xoa.png"/></a></td>
            </tr>
         <?
            }
        }
    ?>
    </table>
</div>