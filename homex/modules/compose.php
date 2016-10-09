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
if (isset($_POST['compose']))
{
	unset($err);
	$to = trim($_POST['to']);
	$from = $_SESSION['uid'];
	$subject = trim($_POST['subject']);
	$message = trim($_POST['message']);
	$date = time();
	if (strlen($to) == 0)
		$err[0] = "1";
	if (strlen($message) == 0)
		$err[1] = "1";
	$users = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' WHERE login=? LIMIT 1', $to) or die("dont get users");
	for($us = array(); $cv = mysql_fetch_assoc($users); $us[] = $cv);
    //echo(count($us));
    //exit;
	if (count($us) == 1)
	{
		$to = $us[0]['uid'];
		mysql_qw('INSERT INTO ' . DB_PREFIX."inbox" . ' SET fromUid=?, toUid=?, subject=?, message=?, date=?', $from, $to, $subject, $message, $date) or die("error in insert message page".mysql_error());
		mysql_qw('INSERT INTO ' . DB_PREFIX."outbox" . ' SET fromUid=?, toUid=?, subject=?, message=?, date=?', $from, $to, $subject, $message, $date) or die("error in insert message page".mysql_error());
		redirect("$p/Inbox");
	}
    else  // user not found
    {
		$err[2] = "1"; // user not found
    }
}
?>
