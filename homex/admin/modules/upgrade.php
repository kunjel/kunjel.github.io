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
global $p;
if (isset($_POST['pay']))
{
    $now           = now();
    $ptype         = $_POST['pt'];
    $classified_id = $_POST['adId'];
    $user_id       = trim($_POST['user_id']);
    
    $paidTo        = time() + (getSet("classPayDays")*60*60*24);
    
    mysql_query("UPDATE ".DB_PREFIX."classifieditems SET pay='$ptype',paidTo='$paidTo' WHERE cid='$classified_id'") or die(mysql_error());    
    mysql_query("INSERT INTO ".DB_PREFIX."payments SET cid='$classified_id',uid='$user_id',date='$now',ptype='$ptype'") or die(mysql_error());
    
    redirect($p."/admin/index.php?m=classifieds&tab=2");
    
//    $type = $_POST['pt'];
//    $iid = $_POST['adId'];
//    
//    $paidTo = time() + (getSet("classPayDays") * 60 * 60 * 24);
//    
//    if ($type == 1)
//        mysql_query("UPDATE `cms_classifieditems` SET `priceType` = 1,`pay` = 1, `paidTo` = '".$paidTo."' WHERE `cid`=".$iid." LIMIT 1") or die(mysql_error());
//    else
//        mysql_query("UPDATE `cms_classifieditems` SET `priceType` = 2,`pay` = 1,`paidTo` = '".$paidTo."' WHERE `cid`=".$iid." LIMIT 1") or die("11".mysql_error());
//    
//    mysql_qw('INSERT INTO ' . DB_PREFIX."payments" . ' SET cid=?, uid=?, date=?, ptype=?', $iid, $_POST['user_id'], now(), $type) or die(mysql_error());
//    
//    redirect($p."/admin/index.php?m=classifieds&tab=2");
}
?>
