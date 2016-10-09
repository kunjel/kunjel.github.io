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
	if (isset($_POST['updateOrder']))
	{
		mysql_qw('UPDATE ' . DB_PREFIX."orders" . ' SET status=? WHERE oid=? LIMIT 1', $_POST['status'], $_POST['oid']) or die("error in adding user".mysql_error());
        addToLog($_SESSION['uid'], 9, $loginId, 2);
		redirect("index.php?m=orders");
	}
	if (isset($_POST['updateContact']))
	{
		mysql_qw('UPDATE ' . DB_PREFIX."contacts" . ' SET status=? WHERE cid=? LIMIT 1', $_POST['status'], $_POST['cid']) or die("error in adding user".mysql_error());
        addToLog($_SESSION['uid'], 10, $loginId, 2);
		redirect("index.php?m=orders&tab=2");
	}
	if (isset($_GET['deleteOrder']))
	{
		mysql_qw('DELETE FROM ' . DB_PREFIX."orders" . ' WHERE oid=?', $_GET['deleteOrder']) or die("error in delete page");
		addToLog($_SESSION['uid'], 9, $_GET['deleteOrder'], 3);
		redirect("index.php?m=orders");
	}
	if (isset($_GET['deleteContact']))
	{
		mysql_qw('DELETE FROM ' . DB_PREFIX."contacts" . ' WHERE cid=?', $_GET['deleteContact']) or die("error in delete page");
		addToLog($_SESSION['uid'], 10, $_GET['deleteContact'], 3);
		redirect("index.php?m=orders&tab=2");
	}
?>
