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
if (isset($_POST['btnForgot']))
{
    global $l;
    
    $e = trim($_POST['forgotEmail']);
    $erForgot = "";
    if (strlen($e) == 0)
        $erForgot .= $l['ReqEmail']. "<br/>";
    else if (!check_mail($e))
        $erForgot .= $l['EmailInc']. "<br/>";
    else
    {
        $us1 = mysql_qw('SELECT * FROM '.DB_PREFIX.'users WHERE mail=?', $e) or die("dont get user");
        for($u1 = array(); $cv = mysql_fetch_assoc($us1); $u1[] = $cv);
        if (count($u1) == 0)
            $erForgot .= $l['EmailNotFound']. "<br/>";
        if (strlen($erForgot) == 0)
        {
            $t = rand_str(7);
            $t = substr($t, 0, 7);
            mysql_query("UPDATE ".DB_PREFIX."users SET passwd='".md5($t)."' WHERE mail='".$e."'") or die(mysql_error());
            $b = str_replace("%pass%", $t, $l['ForgotEmailBody']);
            
            cms_template_mail($adminEmail, $e, $l['ForPassword'], $b, "utf-8");
            
            $erForgot .= $l['NewPassSent']. "<br/>";
        }
    }
    
    $_GET['erForgot'] = $erForgot;
}
?>