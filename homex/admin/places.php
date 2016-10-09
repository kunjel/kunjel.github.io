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
	$cats = mysql_qw('SELECT * FROM ' . DB_PREFIX."countries". ' ORDER BY name2') or die("dont get categories");
	for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);
	
	$cats3 = mysql_qw('SELECT * FROM ' . DB_PREFIX."states". ' ORDER BY name2') or die("dont get categories");
	for($cat3 = array(); $cv3 = mysql_fetch_assoc($cats3); $cat3[] = $cv3);
	if (isset($_GET['countryEdit']) && $_GET['countryEdit'] > 0)
	{
    	$cats1 = mysql_qw('SELECT * FROM ' . DB_PREFIX."countries". ' WHERE cid=?', $_GET['countryEdit']) or die("dont get categories");
		for($cat1 = array(); $cv1 = mysql_fetch_assoc($cats1); $cat1[] = $cv1);
	}
	if (isset($_GET['cityEdit']) && $_GET['cityEdit'] > 0)
	{
    	$cats2 = mysql_qw('SELECT * FROM ' . DB_PREFIX."cities". ' WHERE cid=?', $_GET['cityEdit']) or die("dont get categories");
		for($cat2 = array(); $cv2 = mysql_fetch_assoc($cats2); $cat2[] = $cv2);
		
		$cats3 = mysql_qw('SELECT * FROM ' . DB_PREFIX."states". ' WHERE 1') or die("dont get categories");
		for($cat3 = array(); $cv3 = mysql_fetch_assoc($cats3); $cat3[] = $cv3);
	}
	if (isset($_GET['stateEdit']) && $_GET['stateEdit'] > 0)
	{
    	$cats3 = mysql_qw('SELECT * FROM ' . DB_PREFIX."states". ' WHERE cid=?', $_GET['stateEdit']) or die("dont get categories");
		for($cat3 = array(); $cv3 = mysql_fetch_assoc($cats3); $cat3[] = $cv3);
	}
?>
<script>
	<?if (isset($_GET['tab'])) {?>
	    $(document).ready(function() {
	    	show(<?=$_GET['tab']?>);
	  	});
	<?}?>
function show(id)
{
    for(i = 1; i < 4; i++)
    {
        $("#div_" + i).hide();
        $("#sl_" + i).removeClass("sublinkact");
        $("#sl_" + i).addClass("sublink");
        $("#sll_" + i).removeClass("wh");
    }
    
    $("#div_" + id).show();
    $("#sl_" + id).addClass("sublinkact");
    $("#sll_" + id).addClass("wh");
    
    if (id == 2)
    {
//        $("#city").load("ajax/cities.php");
    }
    
    
    if (id == 3)
    {
        $("#state").load("<?=getSet("url")?>/admin/ajax/states.php");
        var script = document.createElement( 'script' );
        script.type = 'text/javascript';
        script.src ='http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js' ;
        $("#state").append( script );
    }
}
function citySearch()
{
    var city_search = $('#city_search').val();
    $("#city").load("<?=getSet("url")?>/admin/ajax/cities.php?city_search=" + city_search);
}
</script>
<div class="title"><?=$l['CountryCity']?></div>
	<div class="sublinkpadd">
		<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['Countries']?></a></div>
		<div class="sublink" id="sl_3"><a id="sll_3" href="javascript:show(3)"><?=$l['StatesRegions']?></a></div>
		<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['Cities']?></a></div>
	<div style="clear: both;"></div>
	</div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
	<?if ($_GET['mode'] == "deleted") {?>
	   <div class="error"><?=$l['Removed']?></div>
	<?}?>
<div id="div_1">
	<b><?=$l['Countries']?>:</b>
	<?if (isset($_GET['countryEdit']) && $_GET['countryEdit'] > 0) {?>
		<div style="padding: 15px 0px 15px 0px;">
			<form method="post">
				<?=$l['Edit']?> <?=$l['Countries']?> <input type="text" style="width: 250px;" name="catname" value="<?=$cat1[0]['name2']?>" /> <input type="submit" class="but" name="countrySave" value=" <?=$l['Save']?>" />
			</form>
		</div>
	<?} else {?>
		<div style="padding: 15px 0px 15px 0px;">
			<form method="post">
				 <?=$l['AddNewCountry']?> <input type="text" style="width: 250px;" name="catname" /> <input type="submit" class="but" name="countryAdd" value=" <?=$l['Save']?>" />
			</form>
		</div>
	<?}?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 10px;">
		<tr>
	    	<td class="bl lhs level1"><?=$l['Name']?></td>
	        <td class="bl" style="width: 110px;"><?=$l['Edit']?></td>
			<td class="bl" style="width: 110px;"><?=$l['Delete']?></td>
		</tr>
		<?for($i = 0; $i < count($cat); $i++) {?>
			<tr>
				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$cat[$i]['name2']?></td>
				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?m=places&countryEdit=<?=$cat[$i]['cid']?>"><img src="images/page_white_edit.png" /></a></td>
				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=places&countryDelete=<?=$cat[$i]['cid']?>"><img src="images/page_white_delete.png" /></a></td>
			</tr>
		<?}?>
	</table>
</div>
<div id="div_2" style="display: none;">
	<b><?=$l['Cities']?>:</b>
	<?if (isset($_GET['cityEdit']) && $_GET['cityEdit'] > 0) {?>
		<div style="padding: 15px 0px 15px 0px;">
			<form method="post">
				<?=$l['Edit']?> <?=$l['city']?> <input type="text" style="width: 250px;" name="ctname" value="<?=$cat2[0]['name2']?>" /> <?=$l['State']?>: <select size="1" name="catpid" style="width: 250px;">
				  <?for($i = 0; $i < count($cat3); $i++) {?>
				  		<option value="<?=$cat3[$i]['cid']?>" <?=csel($cat3[$i]['cid'], $cat2[0]['state'])?>><?=$cat3[$i]['name2']?></option>
				  <?}?>
				</select> <input type="submit" class="but" name="citySave" value=" <?=$l['Save']?>" />
			</form>
			
		</div>
	<?} else {?>
		<div style="padding: 15px 0px 15px 0px;">
			<form method="post">
				<?=$l['AddNewCity']?> <input type="text" style="width: 250px;" name="ctname" /> <?=$l['State']?>: <select size="1" name="catpid" style="width: 250px;">
				  <?for($i = 0; $i < count($cat3); $i++) {?>
				  		<option value="<?=$cat3[$i]['cid']?>"><?=$cat3[$i]['name2']?></option>
				  <?}?>
				</select> <input type="submit" class="but" name="cityAdd" value=" <?=$l['Save']?>" />
			</form>
			<br>
			<?=$l['City']?> &nbsp;:&nbsp;<input type="text" name="city_search" id="city_search">&nbsp;&nbsp;<input type="button" value="Search" onclick="citySearch()">
			<br>
		</div>
	<?}?>
	<div id="city"></div>
</div>
<div id="div_3" style="display: none;">
	<b><?=$l['State']?>:</b>
	<?if (isset($_GET['stateEdit']) && $_GET['stateEdit'] > 0) {?>
		<div style="padding: 15px 0px 15px 0px;">
			<form method="post">
				<?=$l['Change']?> <?=$l['State']?>: <input type="text" style="width: 250px;" name="catname" value="<?=$cat3[0]['name2']?>" /> 
				<?=$l['country']?>: <select size="1" name="catpid" style="width: 250px;">
				  <?for($i = 0; $i < count($cat); $i++) {?>
				  		<option value="<?=$cat[$i]['cid']?>" <?=csel($cat[$i]['cid'], $cat3[0]['pid'])?>><?=$cat[$i]['name2']?></option>
				  <?}?>
				</select> 
				
				<input type="submit" class="but" name="stateSave" value=" <?=$l['Save']?>" />
			</form>
		</div>
	<?} else {?>
		<div style="padding: 15px 0px 15px 0px;">
			<form method="post">
				<?=$l['AddNewState']?> <input type="text" style="width: 250px;" name="catname" /> 
				&nbsp;&nbsp; <?=$l['Country']?>: <select size="1" name="catpid" style="width: 250px;">
				  <?for($i = 0; $i < count($cat); $i++) {?>
				  		<option value="<?=$cat[$i]['cid']?>"><?=$cat[$i]['name2']?></option>
				  <?}?>
				
				<input type="submit" class="but" name="stateAdd" value=" <?=$l['Save']?>" />
			</form>
		</div>
	<?}?>
	<div id="state"></div>
</div>
