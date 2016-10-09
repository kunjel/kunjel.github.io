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

	require_once "../includes/base.php";

	$cats = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' WHERE pid=? ORDER BY weight, name'.langId()." ASC", $_GET['cid']) or die("dont get page");

	for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);

?>

<?if(!isset($_GET['level'])) {?>

	<br/><?=$l['choose_sub_category']?><br/>

	<select size="1" name="cat2" style="width: 250px;" ONCHANGE="getCatsLevel3(this.options[this.selectedIndex].value)">

		<?for($i = 0; $i < count($cat); $i++) {?>

	  		<option value="<?=$cat[$i]['cid']?>"><?=$cat[$i]['name2']?></option>

		<?}?>

	</select><br/><br/>

<?} else if (count($cat) > 0) {?>

	<br/><?=$l['choose_sub_category']?><br/>

	<select size="1" name="cat3" style="width: 250px;">

		<?for($i = 0; $i < count($cat); $i++) {?>

	  		<option value="<?=$cat[$i]['cid']?>"><?=$cat[$i]['name2']?></option>

		<?}?>

	</select><br/><br/>

<?}?>