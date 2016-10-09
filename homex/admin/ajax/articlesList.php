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


	require_once "../../includes/base.php";

	global $l;

	$allarticles = mysql_query("SELECT cms_articles.title1, cms_articles.title2, cms_articles.title3, cms_articles.nid, cms_users.login, cms_users.uid, cms_articles.date FROM cms_articles LEFT JOIN cms_users ON cms_users.uid = cms_articles.uid ORDER BY nid DESC") or die (mysql_error());

    for($ne = array(); $cv = mysql_fetch_assoc($allarticles); $ne[] = $cv);

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">

	<tr>

		<td class="bl lhs level1"><?=$l['ArticleName']?></td>

		<td class="bl"><?=$l['AddDate']?></td>

		<td class="bl"><?=$l['AddedBy']?></td>

		<td class="bl"><?=$l['Edit']?></td>

		<td class="bl"><?=$l['Delete']?></td>

	</tr>

	<?for($i = 0; $i < count($ne); $i++) {?>

		<tr>

			<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$ne[$i]['title2']?></td>

			<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("m/d/Y", $ne[$i]['date'])?></td>

			<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a target="_blank" href="index.php?m=profile&uid=<?=$ne[$i]['uid']?>"><?=$ne[$i]['login']?></a></td>

			<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?m=articles&edit=<?=$ne[$i]['nid']?>&lg=2"><img src="images/page_white_edit.png" /></a></td>

			<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=articles&delete=<?=$ne[$i]['nid']?>"><img src="images/page_white_delete.png" /></a></td>

		</tr>

	<?}?>

</table>