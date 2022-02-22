<?
	$cat=$_GET["cat"];
?>
<div class="selectbox_form_chung">
    <span></span>
    <select name="txt_phukien">
    	<option value="">-Chọn phụ kiện-</option>
    <?
		include "../config.php";
		$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
		include "function.php";
        $r = $db->select("goon_media","cat = '".$cat."' and id_lang=1","order by id");
        while ($row = $db->fetch($r))
        {
    ?>
        <option value="<?=$row["id"]?>"><?=$row["ten"]?></option>
    <?
    }
    ?>
    </select>
</div>