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
    $inbox = false;
	if ($_GET['pid'] == "Inbox")
		$inbox = true;
	else
		$inbox = false;
//echo '<pre>'; print_r($_REQUEST); exit;
	$toUid = $_SESSION['uid'];
	if ($toUid < 0)
		redirect("login");
	if ($inbox)
		$inboxq = mysql_query("SELECT cms_inbox.*, cms_users.login, cms_users.uid, cms_users.photo FROM `cms_inbox`  LEFT JOIN `cms_users` ON cms_users.uid = cms_inbox.fromUid WHERE toUid=". $toUid. " ORDER BY cms_inbox.mid DESC") or die(mysql_error());
	else
		$inboxq = mysql_query("SELECT cms_outbox.*, cms_users.login, cms_users.uid, cms_users.photo FROM `cms_outbox`  LEFT JOIN `cms_users` ON cms_users.uid = cms_outbox.toUid WHERE fromUid=". $toUid. " ORDER BY cms_outbox.mid DESC") or die(mysql_error());
	for($in = array(); $cv = mysql_fetch_assoc($inboxq); $in[] = $cv);
	function ss($msg, $mid)
	{
		$slen = 300;
		if (strlen($msg) > $slen)
			return  substr($msg, 0, $slen). "... " . "<a onclick=\"loadMessage(". $mid .")\" href=\"javascript:;\">More</a>";
		else
			return $msg;
	}
?>
<?if ($inbox) {?>
	<div class="title"><?=$l['Inbox']?></div>
<?} else {?>
	<div class="title"><?=$l['Outbox']?></div>
<?}?>
<?require_once "navigation.php"; ?>
<div id="divPaste"></div>
<script>
	function deleteMes(id)
	{
		<?if ($inbox)
			echo 'var type = "1";';
		else
			echo 'var type = "0";';
		?>
		$("#divPaste").load('<?=getSet("url")?>/ajax/deleteMessage.php?d=' + id + '&type=' + type);
	}
	function loadMessage(id)
	{
		<?if ($inbox)
			echo 'var type = "1";';
		else
			echo 'var type = "0";';
		?>
		$("#msgBody_" + id).load('<?=getSet("url")?>/ajax/messageBody.php?d=' + id + '&type=' + type);
	}
</script>
<form method="post">
<?for($i = 0; $i < count($in); $i++) {?>
<?
	if($in[$i]['isRead'] == "0")
		$nr = "style=\"font-weight: bold;\"";
?>
	<div style="width: 100%; margin-bottom: 10px;" id="mes_<?=$in[$i]['mid']?>">
		<table border="0" width="100%" class="bc">
			<tr>
				<?if(strlen($in[$i]['photo']) > 0) {?>
					<td class="bc" style="padding: 3px; width: 150px;" valign="top"><img src="upload/s_<?=$in[$i]['photo']?>" /></td>
				<?}?>
				<td class="bc" style="padding: 3px;" valign="top">
					<table border="0" width="100%">
						<tr>
							<td <?=$nr?> ><?if($inbox) {?><?=$l['From']?><?} else {?><?=$l['To_']?><?}?> <?=$in[$i]['login']?><!--<a href="index.php?m=profile&uid=<?=$in[$i]['uid']?>"></a>--> <small>(<?=date("m/d/Y", $in[$i]['date'])?>)</small></td>
							<td align="right" style="width: 140px;"><a href="<?=getSet("url")?>/Compose/<?=$in[$i]['uid']?>/<?=$in[$i]['mid']?>" class="sm"><?=$l['Reply']?></a>&nbsp;&nbsp;<a href="javascript:;" onclick="deleteMes(<?=$in[$i]['mid']?>)" class="sm"><?=$l['DeleteMess']?></a>&nbsp;<input name="mark[]" type="checkbox" value="<?=$in[$i]['mid']?>"></td>
						</tr>
					</table>
					<b><?=htmlspecialchars($in[$i]['subject'])?></b><br/>
					<div id="msgBody_<?=$in[$i]['mid']?>"><?=ss(htmlspecialchars($in[$i]['message']), $in[$i]['mid'])?></div>
				</td>
			</tr>
		</table>
	</div>
<?}?>
<?if(count($in) > 0) {?>
	<div align="right">
		<?=$l['MarkedMessages']?> <select size="1" name="mark_action" style="width: 150px;">
		  <option value="0"><?=$l['DeleteMess']?></option>
		  <option value="1"><?=$l['MasrkAsRead']?></option>
		</select> <input type="submit" class="but" name="SaveMark" value="<?=$l['Save']?>" />
	</div>
<?}?>
</form>