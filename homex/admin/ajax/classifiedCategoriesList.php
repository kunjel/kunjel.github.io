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

function catgeories($pid=0)
{
    global $categories;
    
    $category_sql = "SELECT * FROM ".DB_PREFIX."classifiedcategories WHERE pid='$pid' ORDER BY weight,name".langId().' ASC';
    $category_rs  = mysql_query($category_sql);
    while ($category_row = mysql_fetch_assoc($category_rs))
    {
         $cid = $category_row['cid'];
        	$categories[] = $category_row;
        	
        	catgeories($cid);
    }
}
catgeories();

//$cats = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' ORDER BY weight,name'.langId()." ASC") or die(mysql_error());
echo '<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td class="bl lhs level1">'.$l['CategoryName'].'</td>
        <td class="bl" align="center">'.$l['Edit'].'</td>
        <td class="bl" align="center">'.$l['Delete'].'</td>
    </tr>';
foreach ($categories as $key=>$category) {
    $class = ($key%2==0 ? 'al' : '');
    $name  = $category['name2'];
    $cid   = $category['cid'];
    $level = 'level1';
    for($i=1;$i<=$category['level'];$i++)
        $name = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name"
    ?>
    <tr>
        <td class="bl lh <?=$class?> <?=$level?>"><?=$name?></td>
        <td class="bl <?=$class?>" style="width: 120px;" align="center"><a href="index.php?m=classifieds&editCat=<?=$cid?>"><img src="images/page_white_edit.png" alt="edit" title="edit" /></a></td>
        <td class="bl <?=$class?>" style="width: 120px;" align="center"><a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=classifieds&deleteCat=<?=$cid?>"><img src="images/page_white_delete.png" alt="delete" title="delete" /></a></td>
    </tr>
    <?
}
echo '</table>';
exit;

for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">

	<tr>

		<td class="bl lhs level1"><?=$l['CategoryName']?></td>

		<td class="bl" align="center"><?=$l['Edit']?></td>

		<td class="bl" align="center"><?=$l['Delete']?></td>

	</tr>

			<?$q = -1; for ($i = 0; $i < count($cat); $i++) { ?>

		  		<?if($cat[$i]['pid'] == "0") {$q++;?>

		  			<tr>

		  				<td class="bl lh <?if(($q % 2) == 0) {?>al<?}?> level1"><?=$cat[$i]['name2']?></td>

		  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" style="width: 120px;" align="center">

		  					<a href="index.php?m=classifieds&editCat=<?=$cat[$i]['cid']?>"><img src="images/page_white_edit.png" alt="edit" title="edit" /></a>

		  				</td>

		  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" style="width: 120px;" align="center">

		  					<a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=classifieds&deleteCat=<?=$cat[$i]['cid']?>"><img src="images/page_white_delete.png" alt="delete" title="delete" /></a>

		  				</td>

		  			</tr>

				<?}?>

		  			<?for($j = 0; $j < count($cat); $j++) { if ($cat[$j]['pid'] == $cat[$i]['cid'] && $cat[$j]['level'] == 2) { $q++; ?>

		  				<tr>

		  					<td class="bl lh <?if(($q % 2) == 0) {?>al<?}?> level2"><?=$cat[$j]['name2']?></td>

			  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" align="center">

			  					<a href="index.php?m=classifieds&editCat=<?=$cat[$j]['cid']?>"><img src="images/page_white_edit.png" alt="edit" title="edit" /></a>

			  				</td>

			  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" align="center">

			  					<a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=classifieds&deleteCat=<?=$cat[$j]['cid']?>"><img src="images/page_white_delete.png" alt="delete" title="delete" /></a>

			  				</td>

		  				</tr>

				  			<?for($k = 0; $k < count($cat); $k++) { if ($cat[$k]['pid'] == $cat[$j]['cid'] && $cat[$k]['level'] == 3) { $q++; ?>

				  				<tr>

				  					<td class="bl lh <?if(($q % 2) == 0) {?>al<?}?> level3"><a class="blue" href="#"><?=$cat[$k]['name2']?></a></td>

				  					<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" align="center">

				  						<a href="index.php?m=classifieds&editCat=<?=$cat[$k]['cid']?>"><img src="images/page_white_edit.png" alt="edit" title="edit" /></a>

				  					</td>

					  				<td class="bl <?if(($q % 2) == 0) {?>al<?}?>" align="center">

					  					<a onclick="return confirm('<?=$l['AreYouSure']?>')" href="index.php?m=classifieds&deleteCat=<?=$cat[$k]['cid']?>"><img src="images/page_white_delete.png" alt="delete" title="delete" /></a>

					  				</td>

				  				</tr>

							<?}}?>

					<?}}?>

		 	<?}?>

</table>