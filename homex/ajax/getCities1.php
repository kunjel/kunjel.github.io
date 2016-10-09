<?
    global $l;
    if ($_GET['mode'] == "edit")
    	require_once "../../includes/base.php";
	else
		require_once "../includes/base.php";
	$citiesCat = mysql_query("SELECT * FROM cms_cities WHERE state=". $_GET['cid'] ." ORDER BY name2") or die("dont get categories");
	for($cat = array(); $cv = mysql_fetch_assoc($citiesCat); $cat[] = $cv);
?>
		<select size="1" name="cityId" class="input_postad_300">
				<option value="-1">--</option>
				<?for($i = 0; $i < count($cat); $i++) {?>
					<option value="<?=$cat[$i]['cid']?>" <?if($_GET['select'] > 0 && $_GET['select'] == $cat[$i]['cid']) {?>echo selected<?}?>><?=$cat[$i]['name2']?></option>
				<?}?>
		</select>