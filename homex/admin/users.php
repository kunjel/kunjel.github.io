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
	if (!isset($_GET['type']))
	{
		$users = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' ORDER BY uid') or die("dont get users");
		for($us = array(); $cv = mysql_fetch_assoc($users); $us[] = $cv);
    }
    else
    {
		$users = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' WHERE login !=? AND type=?', 'admin', $_GET['type']) or die("dont get users");
		for($us = array(); $cv = mysql_fetch_assoc($users); $us[] = $cv);
    }
    global $roles;
?>
<script>
	<?if (isset($_GET['tab'])) {?>
	    $(document).ready(function() {
	    	show(<?=$_GET['tab']?>);
	  	});
	<?}?>
	function show(id)
	{
    	for(i = 1; i < 4; i++)
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
    		$("#log").load("<?=getSet("url")?>/admin/ajax/logList.php");
    	if (id == 3)
    		$("#roles").load("<?=getSet("url")?>/admin/ajax/rolesList.php");
	}
</script>
<div class="title"><?=$l['Users']?></div>
	<div class="sublinkpadd">
		<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['ListOfUsers']?></a></div>
		<!--<div class="sublink" id="sl_3"><a id="sll_3" href="javascript:show(3)"><?=$l['Roles']?></a></div>-->
		<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['UserLog']?></a></div>
	<div style="clear: both;"></div>
	</div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
<div id="div_1">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td class="bl lhs level1" style="width: 75px;"><?=$l['Login']?></td>
	            <td class="bl" style="width: 170px;"><?=$l['UserEmail']?></td>
	            <td class="bl" style="width: 170px;"><?=$l['FirstandLastName']?></td>
	            <td class="bl" style="width: 125px;"><?=$l['SignupDate']?></td>
	            <td class="bl" style="width: 75px;"><?=$l['Roles']?></td>
	            <td class="bl" style="width: 50px;" align="center"><?=$l['Edit']?></td>
				<td class="bl" style="width: 50px;" align="center"><?=$l['Delete']?></td>
			</tr>
		<?for ($i = 0; $i < count($us); $i++) { ?>
			<tr>
	            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1">
	            	<a href="ajax/userGet.php?uid=<?=$us[$i]['uid']?>&height=370&amp;width=600" class="thickbox" title="User <b><?=htmlspecialchars($us[$i]['login'])?></b>">
	            		<?=htmlspecialchars($us[$i]['login'])?>
	            	</a>
	            </td>
	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=htmlspecialchars($us[$i]['mail'])?></td>
	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=htmlspecialchars($us[$i]['firstname'])?>, <?=htmlspecialchars($us[$i]['lastname'])?></td>
	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("m/d/Y", $us[$i]['regDate'])?></td>
	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=getRoleNameById($us[$i]['roleId'])?></td>
	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center">
	            	<a href="ajax/userGet.php?uid=<?=$us[$i]['uid']?>&mode=edit&height=400&amp;width=600" class="thickbox" title="Edit user <b><?=htmlspecialchars($us[$i]['login'])?></b>">
	            		<img border="0" hspace="5" src="images/page_white_edit.png">
	            	</a>
	            </td>
				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a href="index.php?m=users&deleteus=<?=$us[$i]['uid']?>" onclick="return confirm('<?=$l['AreYouSure']?>')"><img border="0" hspace="5" src="images/page_white_delete.png"></a></td>
			</tr>
		<?}?>
	</table>
</div>
<div id="div_2" style="display: none;">
	<div id="log"></div>
	<div class="sublink" style="padding-top: 10px;"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=users&log=clear"><?=$l['ClearLog']?></a></div>
</div>
<div id="div_3" style="display: none;">
    <div id="roles"></div>
</div>