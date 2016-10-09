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

	require_once "../includes/base.php";

	global $l;

	$users = mysql_query('SELECT p.*,c.pay FROM cms_payments as p left join cms_classifieditems as c ON p.cid = c.cid WHERE p.pid='.$_GET['pid']) or die("dont get payments");

	$cv = mysql_fetch_assoc($users);

	

echo 'asdas'; exit;

?>

<form method="post">

<input type="hidden" name="cid" value="<?php echo $_GET['cid'] ?>" />

<input type="hidden" name="pid" value="<?php echo $_GET['pid'] ?>" />

  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <tr>

      <td class="bl lh al level1" style="width: 150px;"><?=$l['Date']?></td>

      <td class="bl lh al level1"><input type="text" name="login" style="width: 320px;" value="<? if($cv['paidTo']!=NULL) echo date("m/d/Y",$cv['paidTo'])?>" /></td>

    </tr>

    <tr>

      <td class="bl lh level1"><?=$l['PriceTyp']?></td>

      <td class="bl lh level1"><select name="ptype">

          <option value="0" <?php if($cv['ptype'] == 0)echo "selected"; ?>>-</option>

          <option value="1" <?php if($cv['ptype'] == 1)echo "selected"; ?>>Free</option>

          <option value="2" <?php if($cv['ptype'] == 2)echo "selected"; ?>>Best Price</option>

        </select>

      </td>

    </tr>

    <tr>

      <td class="bl lh al level1"><input type="hidden" value="<?=$_GET['uid']?>" name="uid" /></td>

      <td class="bl lh al level1"><input type="submit" name="updatePayment" value="<?=$l['Save']?>" /></td>

    </tr>

  </table>

</form>

