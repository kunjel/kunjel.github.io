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

	$allNews = mysql_query("SELECT cms_news.title1, cms_news.title2, cms_news.title3, cms_news.nid, cms_users.login, cms_users.uid, cms_news.date FROM cms_news LEFT JOIN cms_users ON cms_users.uid = cms_news.uid ORDER BY nid DESC") or die (mysql_error());

    for($ne = array(); $cv = mysql_fetch_assoc($allNews); $ne[] = $cv);

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">

	<tr>

		<td class="bl lhs level1"><?=$l['NewsName']?></td>

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

			<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?m=news&edit=<?=$ne[$i]['nid']?>&lg=2"><img src="images/page_white_edit.png" /></a></td>

			<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=news&delete=<?=$ne[$i]['nid']?>"><img src="images/page_white_delete.png" /></a></td>

		</tr>

	<?}?>

</table>