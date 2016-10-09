<?
    global $l;
    if ($_GET['mode'] == "edit")
    	require_once "../../includes/base.php";
	else
		require_once "../includes/base.php";
	$statesCat = mysql_query("SELECT * FROM cms_states WHERE pid=". $_GET['cid'] ." ORDER BY name2") or die("dont get categories");
	for($cat = array(); $cv = mysql_fetch_assoc($statesCat); $cat[] = $cv);
?>
	<script>
		function getCatsLevel2(id)
		{
			$("#loadCat2").load('<?=getSet("url")?>/ajax/classifiedCategories.php?cid=' + id)
		}
		function getCatsLevel3(id)
		{
			$("#loadCat3").load('<?=getSet("url")?>/ajax/classifiedCategories.php?cid=' + id + '&level=3')
		}
		function deletePhoto(id)
		{
        	$("#alhf" + id).val("");
        	$("#ph" + id).hide();
		}
		function getCities(id)
		{
        	$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities.php?cid=' + id)
		}
		function getCities1(id)
		{
        	$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities1.php?cid=' + id)
		}
		
		
		function getStates(id){
			
			$("#statesEmpty").load('<?=getSet("url")?>/ajax/getStates.php?cid=' + id)
		
		}
        <?if ($_GET['mode'] == "edit") {?>
        	$(document).ready(function() {
        		//getCities(<?=$it['countryId']?>);
        	});
        <?}?>
	</script>
		<select size="1" class="input_postad_300" name="stateId" ONCHANGE="getCities(this.options[this.selectedIndex].value)">
				<option value="-1">--</option>
				<?for($i = 0; $i < count($cat); $i++) {?>
					<option value="<?=$cat[$i]['cid']?>" <?if($_GET['select'] > 0 && $_GET['select'] == $cat[$i]['cid']) {?>echo selected<?}?>><?=$cat[$i]['name2']?></option>
				<?}?>
		</select>