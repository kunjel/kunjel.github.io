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
global $l;
if (isset($_GET['mode']) && $_GET['mode']>0)
{
    $mto = $_GET['mode'];
    if (is_numeric($mto))
    {
        $toUser = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' WHERE uid=? LIMIT 1', $mto) or die("dont get users");
        for($us1 = array(); $cv1 = mysql_fetch_assoc($toUser); $us1[] = $cv1);
        if (count($us1) > 0)
        {
            $to = $us1[0]['login'];
        }
    }
}
if (isset($_GET['p']) && $_GET['mode']!='classified')
{
    $mid = $_GET['p'];
    if (is_numeric($mid))
    {
        $message_rs = mysql_qw('SELECT * FROM ' . DB_PREFIX."inbox". ' WHERE mid=? LIMIT 1', $mid) or die("dont get users");
        for($messages = array(); $message_row = mysql_fetch_assoc($message_rs); $messages[] = $message_row);
        if (count($messages) > 0)
        {
            $subject = 'Re: '.$messages[0]['subject'];
        }
        $message_rs = mysql_qw('SELECT * FROM ' . DB_PREFIX."outbox". ' WHERE mid=? LIMIT 1', $mid) or die("dont get users");
        for($messages = array(); $message_row = mysql_fetch_assoc($message_rs); $messages[] = $message_row);
        if (count($messages) > 0)
        {
            $subject = 'Re: '.$messages[0]['subject'];
        }
    }
}
if (isset($_GET['p']) && $_GET['mode']=='classified')
{
    $mid = $_GET['p'];
    if (is_numeric($mid))
    {
        $classified_rs  = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifieditems". ' WHERE cid=? LIMIT 1', $mid) or die("dont get users");
        $classified_row = mysql_fetch_assoc($classified_rs);
        $uid            = $classified_row['uid'];
        
        $user_rs  = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' WHERE uid=? LIMIT 1', $uid) or die("dont get users");
        $user_row = mysql_fetch_assoc($user_rs);
        
        $to      = $user_row['login'];
        $subject = 'Classified - '.$classified_row['name2'];
    }
}
?>
<form method="post">
<div class="title"><?=$l['Compose']?></div>
<?require_once "navigation.php"; ?>
<?if($_GET['send'] == "true" && strlen($err[2]) == 0) {?>
   <div style="padding: 10px 0px 10px 0px;"><center><?=$l['MEssageSecSend']?></center></div>
<?}?>
<?if($err[2] == "1") {?>
	<br/><span style="color: Red;"><?=$l['UserNotFound']?></span><br/>
<?}?>
<table border="0">
	<tr>
		<td style="height: 30px; width: 150px;"><?=$l['ForUser']?>:</td>
		<td><input name="to" type="text" value="<?=$to?>" style="width: 200px;"> <?if($err[2] == "1") {?><span style="color: Red;">* </span><?}?><small>(<?=$l['EnterLogin']?>)</small></td>
	</tr>
	<tr>
		<td style="height: 30px;"><?=$l['subject']?>:</td>
		<td><input name="subject" type="text" value="<?=$subject?>" style="width: 200px;"></td>
	</tr>
	<tr>
		<td style="height: 30px;" valign="top"><?=$l['message']?>:</td>
		<td><textarea cols="40" rows="7" name="message"><?=$message?></textarea><?if($err[1] == "1") {?><span style="color: Red;">*</span><br/><?}?></td>
	</tr>
	<tr>
		<td style="height: 30px;" valign="top">&nbsp;</td>
		<td><input type="submit" class="but" name="compose" value="<?=$l['Submit']?>" /></td>
	</tr>
</table>
