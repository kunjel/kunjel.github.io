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

global $l;

$classified_id = $_GET['mode'];

$classified_rs  = mysql_query("SELECT * FROM ".DB_PREFIX."classifieditems WHERE 	cid='$classified_id'") or die(mysql_error());
$classified_row = mysql_fetch_assoc($classified_rs);
$pay_status     = $classified_row['pay_status'];

$featured_price = getSet("classPrice1");
$bold_price     = getSet("classPrice2");
$ads_price      = getSet("adsPrice");

//echo "$featured_price == $bold_price == $ads_price == $classified_id"; exit;

if($pay_status==1 || $ads_price==0)
{
echo "<b>{$l['Choosepayment']}:</b>";
?>
<form method="post">
    <div style="padding-top: 10px;"><input name="pt" type="radio" value="1" checked> <?=$l['Topcategory']?> (<?=$featured_price?> <?=getSet("classCurrency")?>)</div>
    <div style="padding-top: 5px;"><input name="pt" type="radio" value="2"> <?=$l['BoldAd']?> (<?=$bold_price?> <?=getSet("classCurrency")?>)</div>
    <div style="padding-top: 5px;"><input type="submit" class="but" name="pay" value="<?=$l['paypalPay']?>" /></div>
</form>
<? } else { 
    $featured_price_1 = $featured_price + $ads_price;
    $bold_price_1     = $bold_price + $ads_price;
    
echo "<b>{$l['ChooseAdsType']}:</b>";
?>  
  
<form method="post">
    <div style="padding-top: 10px;"><input name="pt" type="radio" value="0" checked> <?=$l['adsPrice']?> (<?=$ads_price?> <?=getSet("classCurrency")?>)</div>
    <div style="padding-top: 5px;"><input name="pt" type="radio" value="3"> <?=$l['adsPriceTopcategory']?> (<?=$featured_price_1?> <?=getSet("classCurrency")?> [<?=$ads_price.'+'.$featured_price?>])</div>
    <div style="padding-top: 5px;"><input name="pt" type="radio" value="4"> <?=$l['adsPriceBoldAd']?> (<?=$bold_price_1?> <?=getSet("classCurrency")?> [<?=$ads_price.'+'.$bold_price?>])</div>
    <div style="padding-top: 5px;"><input type="submit" class="but" name="pay" value="<?=$l['paypalPay']?>" /></div>
</form>

<? } ?>