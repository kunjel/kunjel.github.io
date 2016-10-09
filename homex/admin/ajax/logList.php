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

	$allpages = mysql_query("SELECT cms_log.*, cms_users.login FROM cms_log LEFT JOIN cms_users ON cms_users.uid = cms_log.uid ORDER BY lid DESC") or die("dont get page");

	for($allp = array(); $cv = mysql_fetch_assoc($allpages); $allp[] = $cv);

	function getAction($action)

	{

		global $l;

    	if ($action == 1)

    		return $l['Add'];

    	else  if ($action == 2)

    		return $l['Update'];

    	else  if ($action == 3)

    		return $l['Delete'];

    	else  if ($action == 4)

    		return $l['ChangeSettings'];

	}

	function getObject($o)

	{

		global $l;

    	if ($o == 1)

    		return $l['News'];

        else if ($o == 2)

    		return $l['Articles'];

         else if ($o == 3)

    		return "Объекты недвижимо�?ти";

         else if ($o == 4)

    		return "Категории недвижимо�?ти";

         else if ($o == 5)

    		return $l['Pages'];

         else if ($o == 6)

    		return $l['Users'];

         else if ($o == 8)        // 7 ???

    		return "E-mail подпи�?ка";

         else if ($o == 9)

    		return "Заказы";

			

		else if ($o == 10)

    		return $l['Settings'];

         else if ($o == 0)

    		return $l['UserLog'];

    	 return $o;

	}

?>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<tr>

		    <td class="bl lhs level1"><?=$l['User']?></td>

		    <td class="bl"><?=$l['Action']?></td>

		    <td class="bl"><?=$l['TypeOfData']?></td>

		    <td class="bl"><?=$l['Date']?></td>

		    <td class="bl">IP</td>

		</td>

		<?for($i = 0; $i < count($allp); $i++) {?>

			<tr>

				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><a href="index.php?uid=<?=$allp[$i]['uid']?>"><?=htmlspecialchars($allp[$i]['login'])?></a></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><span style="<?if($allp[$i]['action'] == 1) {?>color: Green<?}?><?if($allp[$i]['action'] == 3) {?>color: Red<?}?>"><?=getAction($allp[$i]['action'])?></span></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?pid=<?=$allp[$i]['pid']?>"><?=getObject($allp[$i]['object'])?></a></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("m/d/Y H:i", $allp[$i]['date'])?></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?pid=<?=$allp[$i]['pid']?>"><?=$allp[$i]['ip']?></a></td>

			</tr>

		<?}?>

	</table>