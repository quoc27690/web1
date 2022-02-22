<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
        <img src="images/icon_danhmuc.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">QUẢN LÝ DANH MỤC</strong> 
    </div>
    <div class="border"></div>
    <div class="function">
        <a href="?act=cat_new&id_lang=<?=$_SESSION['lang']?>"><img src="images/add_new.jpg"/> Tạo danh mục mới</a>
    </div>
	<?php
		$delete = $delete + 0;
		if ($delete != 0)
		{
			$db->delete("goon_cat","id_alias = '".$delete."'");
			admin_load("Đã xóa thành công.","?act=cat_manager&id_lang=".$_SESSION['lang']);
		}
    ?>
    <table class="tb_table" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="tb_head">
        <td>ID</td>
        <td>Tên danh mục</td>
        <td>CMS</td>
        <td>Product</td>
        <td>Gallery</td>
        <td>Project</td>
        <td>Doc</td>
        <td>File</td>
        <td>Media</td>
        <td>Sửa</td>
        <td>Xóa</td>
      </tr>
    <?php
        $r	=	$db->select("goon_cat","","order by id asc");
        while ($row2 = $db->fetch($r))
        {
        ?>
            <tr class="tb_content">
                <td><?=$row2["id"]?></td>
                <td><?=$row2["ten"]?></td>
                <td><?=$row2["_cms"]?></td>
                <td><?=$row2["_product"]?></td>
                <td><?=$row2["_gallery"]?></td>
                <td><?=$row2["_project"]?></td>
                <td><?=$row2["_doc"]?></td>
                <td><?=$row2["_file"]?></td>
                <td><?=$row2["_media"]?></td>
                <td><a href="?act=cat_edit&id_alias=<?=$row2["id_alias"]?>&id_lang=<?=$_SESSION['lang']?>"><img src="images/sua_big.png"/></a></td>
                <td><a href="?act=cat_manager&delete=<?=$row2["id_alias"]?>&id_lang=<?=$_SESSION['lang']?>" onClick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');"><img src="images/xoa.png"/></a></td>
            </tr>
         <?
        }
    ?>
        <tr class="tb_foot">
            <td colspan="11"> </td>
        </tr>
    </table>
</div>