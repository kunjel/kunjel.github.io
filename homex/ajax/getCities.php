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

    global $l;

    if (@$_GET['mode'] == "edit")

    	require_once "../includes/base.php";

	else

		require_once "../includes/base.php";

	$citiesCat = mysql_query("SELECT * FROM cms_cities WHERE state=". $_GET['cid'] ." ORDER BY name2") or die("dont get categories");

	for($cat = array(); $cv = mysql_fetch_assoc($citiesCat); $cat[] = $cv);

?>

		<select size="1" name="cityId" class="input_postad_300">

				<option value="-1">--</option>

				<?for($i = 0; $i < count($cat); $i++) {?>

					<option value="<?=$cat[$i]['cid']?>" <?if($_GET['select'] > 0 && $_GET['select'] == $cat[$i]['cid']) {?>echo selected<?}?>><?=$cat[$i]['name2']?></option>

				<?}?>

		</select>