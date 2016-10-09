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
	if($_GET['mode'] == "delete")
		DeleteCurrency();
	if (isset($_POST['pageSave']))
	{
		if (!isset($_GET['cid'])) // insert
		{
			$pid = getMaxId() + 1;
			mysql_qw('INSERT INTO ' . DB_PREFIX."currencies" . ' SET currency_id=?, country_name=?, shortcode=?, code=?', $pid, trim($_POST['country_name']), trim($_POST['shortcode']), trim($_POST['code'])) or die("error in adding page".mysql_error());
			addToLog($_SESSION['uid'], 5, $pid, 1);
		}
		else
		{
			$cid = $_GET['cid'];
				mysql_query("UPDATE `".DB_PREFIX."currencies` SET `country_name` = '". trim($_POST['country_name'])."', `shortcode` = '".trim($_POST['shortcode'])."', `code` = '".trim($_POST['code'])."' WHERE `currency_id`=".$cid) or die(mysql_error());
			addToLog($_SESSION['uid'], 5, $cid, 2);
		}
        redirect("index.php?m=curr&tab=2&mode=saved");
		//redirect("index.php?pid=".$pid);
	}
    function getMaxId(){
    	$mid = mysql_qw('SELECT currency_id FROM ' . DB_PREFIX."currencies". ' ORDER BY currency_id DESC') or die("error in selecting currency".mysql_error());
    	$max = mysql_fetch_assoc($mid);
		if ($max['currency_id'] > 0)
    		return $max['currency_id'];
    	else
    		return 0;
    }
    function DeleteCurrency(){
    	mysql_qw('DELETE FROM ' . DB_PREFIX."currencies" . ' WHERE currency_id=?', $_GET['cid']) or die("error in delete currency");
		
		addToLog($_SESSION['uid'], 5, $_GET['cid'], 3);
		redirect("index.php?m=curr&tab=2&mode=deleted");
    }
?>
