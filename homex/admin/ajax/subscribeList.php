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

	$allpages = mysql_query("SELECT cms_subscribe.*, cms_users.login, cms_users.mail as regEmail FROM cms_subscribe LEFT JOIN cms_users ON cms_users.uid = cms_subscribe.uid ORDER BY sid DESC") or die("dont get page");

	for($allp = array(); $cv = mysql_fetch_assoc($allpages); $allp[] = $cv);

?>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<tr>

		    <td class="bl lhs level1">Пользователь</td>

		    <td class="bl">E-mail</td>

		    <td class="bl">Дата подпи�?ки</td>

		    <td class="bl">&nbsp;</td>

		</td>

		<?for($i = 0; $i < count($allp); $i++) {?>

			<tr>

				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><a href="index.php?uid=<?=$allp[$i]['uid']?>"><?=htmlspecialchars($allp[$i]['login'])?></a></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?if(strlen($allp[$i]['email']) < 2) echo $allp[$i]['regEmail']; else echo $allp[$i]['email']; ?></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("d.m.Y", $allp[$i]['date'])?></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=subscribe&delete=<?=$allp[$i]['sid']?>"><img src="images/page_white_delete.png" border="0" /></a></td>

			</tr>

		<?}?>

	</table>

	<div style="padding-top: 10px;">

		Логины показаны только дл�? зареги�?трированных пользователей.

	</div>