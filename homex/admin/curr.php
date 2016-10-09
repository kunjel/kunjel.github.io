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
	global $p;
	//Get the pages count
	$number_of_pages_sql = mysql_qw('SELECT * FROM ' . DB_PREFIX."currencies");
	$number_of_pages = mysql_num_rows($number_of_pages_sql);
	if (isset($_GET['cid']))
	{
		$currency = mysql_qw('SELECT * FROM ' . DB_PREFIX."currencies" . ' WHERE currency_id=? LIMIT 1', $_GET['cid']) or die("error in selecting currency");
		$arCurrData = mysql_fetch_assoc($currency);
		$country_name = $arCurrData['country_name'];
		
		$shortcode = $arCurrData['shortcode'];
		
		$code = $arCurrData['code'];
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
    	for(i = 1; i < 3; i++)
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
    		$("#pageList").load("<?=getSet("url")?>/admin/ajax/currencyList.php");
	}
</script>
<div class="title"><?=$l['Currencies']?></div>
<div class="sublinkpadd">
	<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['AddCurrency']?></a></div>
	<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['currentCurrencies']?></a></div>
	<div style="clear: both;"></div>
</div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
	<?if ($_GET['mode'] == "deleted") {?>
	   <div class="error"><?=$l['Removed']?></div>
	<?}?>
<div id="div_1">
	<form method="post">
		<?=$l['currCountryName']?>:<br/>
		<input type="text" name="country_name" value="<?=$country_name?>" /><br/><br/>
		
		<?=$l['currShortCode']?>:<br/>
		<input type="text" name="shortcode" value="<?=$shortcode?>" /><br/><br/>
		
		<?=$l['Symbol']?>:<br/>
		<input type="text" name="code" value="<?=$code?>" /><br/><br/>
	    <input type="submit" class="but" name="pageSave" value="<?=$l['Save']?>" />
	</form>
</div>
<div id="div_2" style="display: none;">
	<div id="pageList"></div>
</div>
