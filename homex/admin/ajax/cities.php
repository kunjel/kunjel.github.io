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

require_once "../../includes/base.php";

$city_search = (isset($_REQUEST['city_search'])) ? addslashes(stripslashes(trim($_REQUEST['city_search']))) : ''; 

$cats = mysql_query("SELECT cms_cities.*,cms_countries.name2 as country_name,cms_states.name2 as state_name FROM cms_cities LEFT JOIN cms_countries ON cms_cities.pid = cms_countries.cid LEFT JOIN cms_states ON cms_cities.state = cms_states.cid WHERE cms_cities.name2!='' AND cms_cities.name2 LIKE '$city_search%' ORDER BY cms_cities.name2 ") or die("dont get categories");

for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 10px;">

    <tr>

        <td class="bl lhs level1"><?=$l['Name']?></td>

        <td class="bl lhs level1"><?=$l['State']?></td>

        <td class="bl lhs level1"><?=$l['Country']?></td>

        <td class="bl" style="width: 110px;"><?=$l['Edit']?></td>

        <td class="bl" style="width: 110px;"><?=$l['Delete']?></td>

    </tr>

    <?for($i = 0; $i < count($cat); $i++) {?>

        <tr>

            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$cat[$i]['name2']?></td>

            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$cat[$i]['state_name']?></td>

            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=$cat[$i]['country_name']?></td>

            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a href="index.php?m=places&tab=2&cityEdit=<?=$cat[$i]['cid']?>"><img src="images/page_white_edit.png" /></a></td>

            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=places&tab=2&cityDelete=<?=$cat[$i]['cid']?>"><img src="images/page_white_delete.png" /></a></td>

        </tr>

    <?}?>

</table>