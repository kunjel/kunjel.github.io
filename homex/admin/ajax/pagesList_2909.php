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
    global $l;
	require_once "../../includes/base.php";
	//pages that cannot be deleted
	$main_pages = array("Home","Contact","Sign up","My Ads", "Post ad", "Login", "Articles", "News", "Help");
	$allpages = mysql_qw('SELECT * FROM ' . DB_PREFIX."pages". ' ORDER BY weight DESC') or die("dont get page");
	for($allp = array(); $cv = mysql_fetch_assoc($allpages); $allp[] = $cv);
?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
		    <td class="bl lhs level1"><?=$l['Name']?></td>
		    <td class="bl" align="center"><?=$l['Edit']?></td>
		    <td class="bl" align="center"><?=$l['Delete']?></td>
		</td>
		<?for($i = 0; $i < count($allp); $i++) {?>
			<tr>
				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><a href="../<?=$allp[$i]['url']?>"><?=$allp[$i]['name2']?></a></td>
				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a href="index.php?m=pages&pid=<?=$allp[$i]['pid']?>&lg=2"><img src="images/page_white_edit.png" border="0" /></a></td>
				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center">
				<?php if(!in_array($allp[$i]['name2'],$main_pages)){ ?>
				<a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=pages&mode=delete&pid=<?=$allp[$i]['pid']?>"><img src="images/page_white_delete.png" border="0" /></a>
				<?php } ?>
				</td>
			</tr>
		<?}?>
	</table>