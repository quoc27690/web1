<?
    $r = $db->select("goon_product_lang","id='".$tour."' and id_lang='".$_SESSION["lang"]."'");
    $row = $db->fetch($r);
?>
<div style="padding:5px 10px 0 20px">
    <div class="quan_ly">
        <img src="images/icon_sp.png" align="absmiddle"/>&nbsp;<strong style="font-size:14px">TẠO CHI TIẾT HÀNH TRÌNH CHO TOUR: <?=$row["ten"]?></strong> 
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td width="40%">
            <div class="function">
                <a href="?act=giai_phap_new&tour=<?=$tour?>&txt_cat=<?=$txt_cat?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/add_new.jpg"/> Tạo mới</a>
            </div>
        </td>
      </tr>
    </table>
    <?php
        if ($_POST['delete'])
        {
            for ($i = 0; $i < count($tik); $i++)
            {
                $db->delete("goon_giai_phap_lang","id = '".$tik[$i]."'");
            }
            admin_load("Đã xóa các Bài viết đã chọn.","?act=giai_phap_list&tour=".$tour."&txt_cat=".$txt_cat."&id_lang=".$id_lang);
        }
    ?>
    <form action="?act=giai_phap_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
        <input type="hidden" name="tour" value="<?=$tour?>" />
        <input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
        <input type="hidden" name="lang" value="<?=$lang?>" />
        <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr class="tb_head">
                <td width="50px">STT</td>
                <td>Tên bài viết</td>
                <td>Chỉnh sửa</td>
                <td>Xóa</td>
            </tr>
            <?php
            $count = 0;
            $r = $db->select("goon_giai_phap_lang","tour = '".$tour."' and id_lang='".$_SESSION["lang"]."'","order by id");
            while ($row = $db->fetch($r))
            {
                $count++;
            ?>
                <tr class="tb_content">
                    <td><?=$count?></td>
                    <td><?=str_replace("\\","",$row["ten"])?></td>
                    <td><a href="?act=giai_phap_edit&id=<?=$row["id"]?>&tour=<?=$row["tour"]?>&txt_cat=<?=$txt_cat?>&id_lang=<?=$_SESSION["lang"]?>"><img src="images/sua_big.png"/></a></td>
                    <td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                </tr>
            <?
            }
            ?>
            <tr class="tb_foot">
                <td colspan="4" style="text-align:right; padding-right: 50px;"><input type="submit" value="Delete" name="delete" class="button_3"/></td>
            </tr>
        </table>
    </form>
</div>