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

require_once "../includes/base.php";

global $l;

$user_id       = $_GET['uid'];

$payment_id    = $_GET['pid'];

$classified_id = $_GET['cid'];

$payment_sql = "SELECT * FROM ".DB_PREFIX."payments WHERE pid='$payment_id' AND cid='$classified_id'";

$payment_rs  = mysql_query($payment_sql) or die("dont get payments");

$payment_row = mysql_fetch_assoc($payment_rs);

?>

<script type="text/javascript" src="js/date.js"></script>

<script type="text/javascript" src="js/jquery.datePicker.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">

<form method="post">

    <input type="hidden" name="cid" value="<?=$classified_id?>" />

    <input type="hidden" name="pid" value="<?=$payment_id?>" />

    <table border="0" cellpadding="0" cellspacing="0" width="100%">

        <tr>

            <td class="bl lh al level1" style="width: 150px;"><?=$l['Date']?></td>

            <td class="bl lh al level1"><input type="text" name="login" id="login" style="width: 80px;" value="<? if($payment_row['date']!=NULL) echo date("m/d/Y",$payment_row['date'])?>" readonly /></td>

        </tr>

        <tr>

            <td class="bl lh level1"><?=$l['UpgradedType']?></td>

            <td class="bl lh level1">

                <select name="ptype">

                    <option value="0" <?php if($payment_row['ptype'] == 0)echo "selected"; ?>>-</option>

                    <option value="1" <?php if($payment_row['ptype'] == 1)echo "selected"; ?>>Featured</option>

                    <option value="2" <?php if($payment_row['ptype'] == 2)echo "selected"; ?>>Bold</option>

                </select>

            </td>

        </tr>

        <tr>

            <td class="bl lh al level1"><input type="hidden" value="<?=$user_id?>" name="uid" /></td>

            <td class="bl lh al level1"><input type="submit" class="but" name="updatePayment" value="<?=$l['Save']?>" /></td>

        </tr>

    </table>

</form>

<script>

$(function()

{

    $('#login').datePicker({autoFocusNextInput: true});

});

</script>

