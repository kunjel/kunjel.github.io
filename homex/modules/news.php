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
//echo $_POST['editor1'];
//exit;
global $pages;
if (isset($_GET['delete']))
{
	mysql_qw('DELETE FROM ' . DB_PREFIX."news" . ' WHERE nid=?', $_GET['delete']) or die("error in delete page");
	redirect("index.php?pid=".$pages['News']);
}
if (isset($_POST['newsSave']))
{
 	$name = trim($_POST['newsName']);
    $descr = trim($_POST['newsBody']);
    $d = time(); //date("d.m.y", mktime(0, 0, 0, date("m"), date("d")));
	if (!isset($_GET['edit']))
	{
 		mysql_qw('INSERT INTO ' . DB_PREFIX."news" . ' SET title2=?, body2=?, date=?, uid=?', $name, $descr, $d, $_SESSION['uid']) or die("error in adding news1".mysql_error());
    	$lastNews = mysql_query("SELECT nid FROM cms_news ORDER BY nid DESC LIMIT 1") or die(mysql_error());
    	$lNews = mysql_fetch_assoc($lastNews);
    	$lid = $lNews['nid'];
    	redirect("index.php?pid=". $pages['News'] ."&nid=". $lid);
    }
    else
    {
        $cl = $_GET['lg'];
		mysql_query("UPDATE `cms_news` SET `title". $cl ."` = '". $name ."', `body".$cl."` = '".$descr."', `date` = '".$d."' WHERE `nid`=".$_GET['edit']) or die(mysql_error());
    }
 	redirect("index.php?pid=".$pages['News']);
}
if (isset($_POST['newsSettSave']))
{
	updateSetting("newsPerPage", trim($_POST['newsSet1']));
	updateSetting("newsLength", trim($_POST['newsSet2']));
}
?>
