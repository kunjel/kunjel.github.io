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

	if(isset($_GET['pay_id'])){

	

		$orders = mysql_query("SELECT cms_payments.*, cms_users.login, cms_classifieditems.name2 FROM cms_payments LEFT JOIN

						   cms_users ON cms_payments.uid = cms_users.uid LEFT JOIN

						   cms_classifieditems ON cms_classifieditems.cid = cms_payments.cid

						   where pid = '".$_GET['pay_id']."'") or die(mysql_error());

						   

	    $result = mysql_fetch_array($orders);

	}

	else{

	$orders = mysql_query("SELECT cms_payments.*, cms_users.login, cms_classifieditems.name2 FROM cms_payments LEFT JOIN

						   cms_users ON cms_payments.uid = cms_users.uid LEFT JOIN

						   cms_classifieditems ON cms_classifieditems.cid = cms_payments.cid

						   ORDER BY pid DESC") or die(mysql_error());

	for($us = array(); $cv = mysql_fetch_assoc($orders); $us[] = $cv);

	}

	global $orderCount;

	global $contactCount;

	global $l;

?>

<script>

	<?if (isset($_GET['tab'])) {?>

	    $(document).ready(function() {

	    	show(<?=$_GET['tab']?>);

	  	});

	<?}?>

	function show(id)

	{

    	for(i = 1; i < 3; i++)

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

    		$("#log").load("<?=getSet("url")?>/admin/ajax/contactsList.php");

	}

</script>

<div class="title"><?=$l['Payments']?> (<?=$orderCount?>)</div>

<?php if(isset($_GET['pay_id'])){ ?>

<?php } else { ?>

<div id="div_1">

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

			<tr>

				<td class="bl lhs level1" style="width: 75px;"><?=$l['Login']?></td>

				<td class="bl"><?=$l['AdTitle']?></td>

	            <td class="bl" style="width: 150px;"><?=$l['Date']?></td>

	            <td class="bl" style="width: 75px;"><?=$l['Type']?></td>

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

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href='index.php?m=classifieds&mode=editads&pid=<?=$us[$i]['cid']?>&tab=6'><?=$us[$i]['name2']?></a></td>

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><?=date("m/d/Y", $us[$i]['date'])?></td>

	            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>">

	            	<?if($us[$i]['ptype'] == 0) {?><?=$l['ListPrice']?><?}?>
	            	
	            	<?if($us[$i]['ptype'] == 1) {?><?=$l['Featured']?><?}?>

	            	<?if($us[$i]['ptype'] == 2) {?><?=$l['bold']?><?}?>

	            </td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center">

	            	<a href="paymentedit.php?m=paymentedit&pid=<?=$us[$i]['pid']?>&cid=<?=$us[$i]['cid']?>&mode=edit&height=120&width=600" class="thickbox" title="Edit user '<?=htmlspecialchars($us[$i]['login'])?>'">

	            		<img border="0" hspace="5" src="images/page_white_edit.png">

	            	</a>

	            </td>

				<td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a href="index.php?m=payments&pay_id=<?=$us[$i]['pid']?>&mode=del&cid=<?=$us[$i]['cid']?>" onclick="return confirm('<?=$l['AreYouSure']?>')"><img border="0" hspace="5" src="images/page_white_delete.png"></a></td>

			</tr>

		<?}?>

	</table>

</div>

<?php } ?>

