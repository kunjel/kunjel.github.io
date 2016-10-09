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
	$cats = mysql_query("SELECT * FROM cms_countries ORDER BY name2") or die(mysql_error());
	for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);
	$citiesCat = mysql_query("SELECT * FROM cms_cities WHERE 1=2 ORDER BY name2") or die(mysql_error());
	for($cities = array(); $cv = mysql_fetch_assoc($citiesCat); $cities[] = $cv);
	$statesCat = mysql_query("SELECT * FROM cms_states WHERE 1=2 ORDER BY name2") or die(mysql_error());
	for($states = array(); $cv = mysql_fetch_assoc($statesCat); $states[] = $cv);
	function isSel($m, $v)
	{
		if ($m == $v)
			return "selected=\"selected\"";
	}
$p = getSet("url");
?>
<div class="title"><?=$l['Advancedsearch']?></div>
<?if(!isset($_GET['ASearch'])) {?>
	<script>
		function getStates(id){
			
			$("#statesEmpty").load('<?=getSet("url")?>/ajax/getStates.php?cid=' + id);
			$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities.php?cid=-1');
		
		}
		
			function getCities(id)
			{
	        	$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities.php?cid=' + id)
			}
	</script>
	<form method="post" action="Classified/search/as">
		<?=$l['Title']?><br/>
		<input type="text" name="atitle" style="width: 300px;"><br/><br/>
		<?=$l['Price']?><br/>
		<?=$l['From']?> <input type="text" name="p1" style="width: 120px;"> - <input type="text" name="p2" style="width: 120px;">
		<?=$l['or']?>
			<select size="1" name="PriceType" style="width: 150px;">
				<option value="0">-</option>
				<option value="1"><?=$l['free']?></option>
				<option value="2"><?=$l['best_offer']?></option>
				<option value="3"><?=$l['wanted']?></option>
			</select>
		<br/><br/>
		<?=$l['Country']?><br/>
				<select size="1" name="countryId" style="width: 300px;" ONCHANGE="getStates(this.options[this.selectedIndex].value)">
						<option value="-1">--</option>
						<?for($i = 0; $i < count($cat); $i++) {?>
							<option value="<?=$cat[$i]['cid']?>" <?=isSel($cat[$i]['cid'], $it['countryId'])?>><?=$cat[$i]['name2']?></option>
						<?}?>
				</select><br/><br/>
		<?=$l['USAstate']?><br/>
					<div id="statesEmpty" >
				<select size="1" name="stateId" style="width: 300px;" ONCHANGE="getCities(this.options[this.selectedIndex].value)">
					<option value="value1">-</option>
					<?for($i = 0; $i < count($states); $i++) {?>
				    	<option value="<?=$states[$i]['cid']?>"><?=$states[$i]['name2']?></option>
				    <?}?>
				</select>
					</div><br/>
		<?=$l['City']?><br/>
					<div id="citiesEmpty" >
					    <select size="1" name="cityId" style="width: 150px;">
						  <option value="value1">-</option>
						</select>
					</div><br/>
		<?=$l['Zip']?><br/>
		<input type="text" name="zip" style="width: 300px;"><br/><br/>
		<input type="submit" name="ASearch" value="<?=$l['Search']?>" class="but" />
	</form>
<?} else {?>
<?}?>