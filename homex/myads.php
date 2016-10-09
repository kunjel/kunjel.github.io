<?php

// *************************************************************************

// *                                                                       *

// * Top Classified Software                                               *

// * Copyright (c) Top Classified Software. All Rights Reserved,           *

// * Release Date: October 19, 2011                                        *

// * Version 4.1.1                                                         * 

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

    global $p;

	global $l;	

	if ($_SESSION['uid'] > 0)

	{

    	$myAds = mysql_query("SELECT cms_classifieditems.*, cms_classifiedcategories.url as catName FROM cms_classifieditems LEFT JOIN cms_classifiedcategories ON cms_classifiedcategories.cid = cms_classifieditems.pid WHERE cms_classifieditems.uid=".$_SESSION['uid'] . " ORDER BY cms_classifieditems.cid DESC") or die(mysql_error());

		for($it = array(); $cv = mysql_fetch_assoc($myAds); $it[] = $cv);

	}

?>

<?if(isAuth()) {?>

	<?if($_GET['mode'] == "successPay") {?>

		<div style="padding-bottom: 10px;"><center><b><?=$l['PaymentThanks']?></b></center></div>

	<?}?>

	<?if($_GET['mode'] == "cancelPay") {?>

		<div style="padding-bottom: 10px;"><center><b><?=$l['PaymentIncomplete']?></b></center></div>

	<?}?>

	<?if(count($it) > 0) {?>

<b><a href="<?=$p?>/postAd"><?=$l['PleaseAdd']?></a></b><br /><br />

<div class="myads">

<div class="myads_container1">

    <div class="bc myads_photo_div_header"><?=$l['Photo']?></div>

    <? if(getSet("classPrice1") > 0) { $cntwidth = "215px";} else { $cntwidth = "395px";}?> 

    <div class="bc myads_title_header" style="width:<?=$cntwidth;?>;"><?=$l['Title']?></div>

    <? if(getSet("classPrice1") > 0) {?><div class="bc myads_price_header"><?=$l['Payment']?></div><? }?>

    <div class="bc myads_date_header"><?=$l['Adddate']?></div>

    <div class="bc myads_date_header"><?=$l['AdStatus']?></div>

    <div class="bc myads_date_header"><?=$l['Views']?></div>

    <div class="bc myads_action_header"><?=$l['Actions']?></div>

</div>

<?for($i = 0; $i < count($it); $i++) {?>

<div class="myads_container1">

    <div class="bc myads_photo_div_content"><?if(strlen($it[$i]['file1']) > 0) {?> <img src="<?=getSet("url")?>/upload/s_<?=$it[$i]['file1']?>" width="90" /> <?}?></div>

    <? if(getSet("classPrice1") > 0) { $cntwidth = "215px";} else { $cntwidth = "395px";}?> 

    <div class="bc myads_title_content" style="width:<?=$cntwidth;?>;"><a href="<?=getSet("url")?>/Classified/<?=clean_accents($it[$i]['catName'])?>/<?=clean_accents($it[$i]['url'])?>"><?=$it[$i]['name2']?></a></div>

    <? if(getSet("classPrice1") > 0) {?><div class="bc myads_price_content">

    <?if($it[$i]['paidTo'] > 0 && time() < $it[$i]['paidTo']) {?>Paid to <?=date("m/d/Y", $it[$i]['paidTo'])?><?} else if($it[$i]['pay_status']==0) {?><a href="<?=getSet("url")?>/pay/<?=$it[$i]['cid']?>"><?=$l['payToList']?></a><?} else {?><a href="<?=getSet("url")?>/pay/<?=$it[$i]['cid']?>"><?=$l['Upgrade']?></a><?}?>

    </div><? }?>

    <div class="bc myads_date_content"><?=date("m/d/Y", $it[$i]['date'])?></div>

    <div class="bc myads_date_content"><?=($it[$i]['approved'] == 0) ? $l['Waiting'] : $l['Approved']?></div>

    <div class="bc myads_date_content"><?=$it[$i]['views']?></div>

    <div class="bc myads_action_content"><a href="<?=getSet("url")?>/postAd/edit/<?=$it[$i]['cid']?>"><img src="<?=getSet("url")?>/images/page_white_edit.png"></a>&nbsp;&nbsp;<a onclick="return confirm('<?=$l['AreYouSure']?>')" href="<?=getSet("url")?>/myAds/delete/<?=$it[$i]['cid']?>"><img src="<?=getSet("url")?>/images/page_white_delete.png"></a></div>

</div>

<?}?>

<br /><br />

</div>

		

	<?} else {?>

 		<center><?=$l['Myadsnone']?> <a href="postAd"><?=$l['PleaseAdd']?></a>.</center>

	<?}?>

<?} else {?>

	<center><?=$l['Please']?> <a href="<?=$p?>/Login"><?=$l['Log_in']?></a> or <a href="<?=$p?>/Signup"><?=$l['register']?></a></center>

<?}?>