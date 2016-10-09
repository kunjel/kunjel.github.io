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
		global $p;
		$users = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' WHERE uid=? LIMIT 1', $_SESSION['uid']) or die("dont get users");
		for($us = array(); $cv = mysql_fetch_assoc($users); $us[] = $cv);
		$totIn = mysql_qw("SELECT COUNT(*) as total, (SELECT COUNT(*) as unread FROM cms_inbox WHERE toUid=".$_SESSION['uid']." AND isRead=1) as unread FROM cms_inbox WHERE toUid=".$_SESSION['uid']) or die(mysql_error());
		for($into = array(); $cv = mysql_fetch_assoc($totIn); $into[] = $cv);
		$ountbox = mysql_qw('SELECT COUNT(*) as total FROM ' . DB_PREFIX."outbox". ' WHERE fromUid=? LIMIT 1', $_SESSION['uid']) or die(mysql_error());
		for($out = array(); $cv = mysql_fetch_assoc($ountbox); $out[] = $cv);
?>
<div style="margin-bottom: 10px;">
	<?if (!isset($_GET['uid'])) {?>
		<a href="<?=getSet("url")?>/Profile"><?=$l['Profile']?></a>&nbsp;&nbsp;&nbsp;<a href="<?=getSet("url")?>/Inbox"><?=$l['Inbox']?></a> (<?=$into[0]['unread']?>/<?=$into[0]['total']?>)&nbsp;&nbsp;&nbsp;<a href="<?=getSet("url")?>/Outbox"><?=$l['Outbox']?></a> (<?=$out[0]['total']?>)&nbsp;&nbsp;&nbsp;<a href="<?=getSet("url")?>/Compose"><?=$l['Compose']?></a>
	<?}?>
</div>