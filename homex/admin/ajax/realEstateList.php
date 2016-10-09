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

	$cats = mysql_query("SELECT cms_realestate.*, cms_realestatecategories.name1 as nameCat1, cms_realestatecategories.name2 as nameCat2, cms_realestatecategories.name3 as nameCat3 FROM cms_realestate LEFT JOIN cms_realestatecategories ON cms_realestatecategories.cid=cms_realestate.pid") or die(mysql_error());

	for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">

	<tr>

		<td class="bl lhs level1">�?азвание объекта</td>

		<td class="bl">Категори�?</td>

		<td class="bl">Дата добавлени�?</td>

		<td class="bl" align="center">Редактировать</td>

		<td class="bl" align="center">Удалить</td>

	</tr>

			<?$q = -1; for ($i = 0; $i < count($cat); $i++) { $q++;?>

	  			<tr>

	  				<td class="bl lh <?if(($q % 2) == 0) {?>al<?}?> level1"><a class="blue" href="#"><?=$cat[$i]['name2']?></a></td>

	  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" ><?=$cat[$i]['nameCat2']?></td>

	  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" style="width: 120px;" align="center"><?=date("d.m.Y", $cat[$i]['dateAdd'])?></td>

	  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" style="width: 120px;" align="center">

	  					<a href="index.php?m=realEstate&editCat=<?=$cat[$i]['rid']?>"><img src="images/page_white_edit.png" alt="edit" title="edit" /></a>

	  				</td>

	  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" style="width: 120px;" align="center">

	  					<a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=realEstate&deleteObj=<?=$cat[$i]['rid']?>"><img src="images/page_white_delete.png" alt="delete" title="delete" /></a>

	  				</td>

	  			</tr>

		 	<?}?>

</table>