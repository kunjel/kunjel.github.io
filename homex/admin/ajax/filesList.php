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

	if ($_GET['type'] == "1")

		$d = "images";

	else if ($_GET['type'] == "2")

    	$d = "docs";

	else

    	$d = "other";

    $dir = opendir("../../upload/" . $d);

?>

<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 20px;"><tr><td colspan="2" class="line"><img src="images/pix.gif" /></td></tr></table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
    <td class="bl lhs level1"><?=$l['FileName']?></td>
    <td class="bl lhs level1"><?=$l['FilePath']?></td>
    <td class="bl" align="center"><?=$l['Delete']?></td>
</tr>
<?
$i = 0;
while ($file = readdir($dir))
{
    if ($file != "." && $file != "..")
    {
        $i++;
        ?>
        <tr>
            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><a href="../upload/<?=$d?>/<?=$file?>"><?=$file?></a></td>
            <td class="bl lh <?if(($i % 2) == 0) {?>al<?}?> level1"><?=getSet("url")?>/upload/<?=$d?>/<?=$file?></td>
            <td class="bl <?if(($i % 2) == 0) {?>al<?}?>" align="center"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=files&deleteFrom=<?=$_GET['type']?>&delete=<?=$file?>"><img src="images/page_white_delete.png" border="0" /></a></td>
        </tr>
        <?
    }
}
?>
</table>