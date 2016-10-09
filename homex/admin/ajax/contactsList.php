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

	$contacts = mysql_qw('SELECT * FROM ' . DB_PREFIX."contacts". ' ORDER BY cid DESC') or die("dont get users");

	for($us = array(); $cv = mysql_fetch_assoc($contacts); $us[] = $cv);

?>

	<link rel="stylesheet" href="../css/thickbox.css" type="text/css" media="screen" />

	<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>

	<script type="text/javascript" src="../js/thickbox-compressed.js"></script>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

			<tr>

				<td class="bl lhs level1">Им�?, фамили�?</td>

	            <td class="bl" style="width: 250px;">E-mail</td>

	            <td class="bl" style="width: 250px;">Телефон</td>

	            <td class="bl" style="width: 110px;">Дата</td>

	            <td class="bl" style="width: 110px;" align="center">Подробнее</td>

				<td class="bl" style="width: 110px;" align="center">Удалить</td>

			</tr>

		<?for ($i = 0; $i < count($us); $i++) { ?>

			<tr>

	            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1">

	            	<?=htmlspecialchars($us[$i]['name'])?>

	            </td>

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=htmlspecialchars($us[$i]['email'])?></td>

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=htmlspecialchars($us[$i]['phone'])?></td>

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("d.m.Y", $us[$i]['date'])?></td>

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center">

	            	<a href="ajax/contactGet.php?cid=<?=$us[$i]['cid']?>&height=370&amp;width=600" class="thickbox" title="Детали контактного �?ообщени�? от <b><?=date("d.m.Y", $us[$i]['date'])?></b>">

	            		Подробнее

	            	</a>

	            </td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a href="index.php?m=orders&deleteContact=<?=$us[$i]['cid']?>" onclick="return confirm('<?=$l['AreYouSure']?>')"><img border="0" hspace="5" src="images/page_white_delete.png"></a></td>

			</tr>

		<?}?>

	</table>