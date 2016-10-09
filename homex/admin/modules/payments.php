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
if ($_GET['mode'] == "del")
    DeletePayment();
function DeletePayment()
{
    if(!isAdmin())
    {
        redirect("index.php?m=login");
        exit();
    }
    
    mysql_query("DELETE FROM ".DB_PREFIX."payments WHERE pid='".$_GET['pay_id']."'") or die("error1");
    mysql_query("UPDATE ".DB_PREFIX."classifieditems SET pay='0' where cid=".$_GET['cid']."") or die("error2");
    
    redirect('index.php?m=payments');
}
if (isset($_POST['updatePayment']))
{
    $ptype = $_POST['ptype'];
    $date  = strtotime($_POST['login']);
    
    $payment_id    = $_POST['pid'];
    $classified_id = $_POST['cid'];
    $payment_sql = "UPDATE ".DB_PREFIX."payments SET ptype='$ptype',date='$date' WHERE pid='$payment_id' AND cid='$classified_id'";
    mysql_query($payment_sql) or die("error2");
    
    redirect("index.php?m=payments");
}
?>
