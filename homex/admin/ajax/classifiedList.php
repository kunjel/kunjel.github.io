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

	require_once "../../includes/base.php";
    global $l;

	$allpages = mysql_query("SELECT cms_classifieditems.*, cms_users.login FROM cms_classifieditems LEFT JOIN cms_users ON cms_users.uid = cms_classifieditems.uid where cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1 ORDER BY cms_classifieditems.cid DESC") or die(mysql_query());

	for($allp = array(); $cv = mysql_fetch_assoc($allpages); $allp[] = $cv);

?>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<tr>

		    <td class="bl lhs level1">Title</td>

		    <td class="bl">Add Date</td>

		    <td class="bl">User</td>

			

			<td class="bl">Disapprove</td>

			

			<td class="bl"><?=$l['Upgraded']?></td>

			

			<td class="bl" align="center"><?=$l['Edit']?></td>

		    <td class="bl" align="center"><?=$l['Delete']?></td>

		</td>

		<?for($i = 0; $i < count($allp); $i++) {?>

			<tr>

				<td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$allp[$i]['name2']?></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("m/d/Y", $allp[$i]['date'])?></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=htmlspecialchars($allp[$i]['login'])?></td>

				

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?m=classifieds&mode=disapprove&pid=<?=$allp[$i]['cid']?>&tab=5"><?=$l['DisApprove']?></a></td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>">

					<?

					$currentDate = strtotime(date("Y-m-d H:i:s"));

					

					if($currentDate < $allp[$i]['paidTo']){

					if($allp[$i]['pay'] == 1 || $allp[$i]['pay'] == 2){

						if($allp[$i]['pay'] == 2)

							echo $l['bold']." - " ; 

						else

							echo $l['Featured']." - " ; 

					}

					else echo " ";

					

					?> <?php if($allp[$i]['paidTo']!=NULL)echo date("m/d/Y",$allp[$i]['paidTo']) ?>

					<?php } else echo "<a href='index.php?m=upgrade&mode=upgradeads&user_id=".$allp[$i]['uid']."&pid=".$allp[$i]['cid']."&tab=6'>upgrade</a>"; ?>

				</td>

				

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a href="index.php?m=classifieds&mode=editads&pid=<?=$allp[$i]['cid']?>&tab=6"><img src="images/page_white_edit.png" border="0" /></a></td>

				

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=classifieds&mode=delete&pid=<?=$allp[$i]['cid']?>"><img src="images/page_white_delete.png" border="0" /></a></td>

			</tr>

		<?}?>

	</table>