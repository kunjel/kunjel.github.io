<?php
// *************************************************************************
// *                                                                       *
// * Top Classified Software                                               *
// * Copyright (c) Top Classified Software. All Rights Reserved,           *
// * Release Date: November 21, 2011                                       *
// * Version 4.2.0                                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: contact@topclassifiedsoftware.com                              *
// * Website: http://topclassifiedsoftware.com                             *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  Top Classified Software may terminate this license if you   *
// * don't comply with any of the terms and conditions set forth in our    *
// * end userlicense agreement (EULA).  In such event,  licensee  agrees   *
// * to return licensor  or destroy  all copies of software  upon          *
// * termination of the license.                                           *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
?>
<?
    global $l;
    if (@$_GET['mode'] == "edit")
    	require_once "../includes/base.php";
	else
		require_once "../includes/base.php";
	$statesCat = mysql_query("SELECT * FROM cms_states WHERE pid='". $_GET['cid'] ."' ORDER BY name2") or die("dont get categories");
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
        		$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities.php?cid=0')
	</script>
		<select size="1" class="input_postad_300" name="stateId" ONCHANGE="getCities(this.options[this.selectedIndex].value)">
				<option value="-1">--</option>
				<?for($i = 0; $i < count($cat); $i++) {?>
					<option value="<?=$cat[$i]['cid']?>" <?if($_GET['select'] > 0 && $_GET['select'] == $cat[$i]['cid']) {?>echo selected<?}?>><?=$cat[$i]['name2']?></option>
				<?}?>
		</select>