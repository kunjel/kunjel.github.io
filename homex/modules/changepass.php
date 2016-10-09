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
if (isset($_POST["btnChangePass"]))
{
	$old = trim($_POST['cp1']);
	$new1 = trim($_POST['cp2']);
	$new2 = trim($_POST['cp3']);
	$p = mysql_qw('SELECT passwd FROM ' . DB_PREFIX."register" . ' WHERE login=? LIMIT 1', "admin") or die("error in selecting login");
	$arPageData = mysql_fetch_assoc($p);
    $pp = $arPageData['passwd'];
	//echo $pp;
	$cpEr = "";
	if ($new1 !== $new2)
        $cpEr = "Введенные пароли не совпадают";
 	else if ($pp !== md5($old))
 		$cpEr = "Не верно введен старый пароль";
 	else
 		{
 			mysql_query("UPDATE `cms_register` SET `passwd` = '".md5($new2)."' WHERE `login`='admin'") or die(mysql_error());
 			$cpEr = "Пароль успешно изменен";
 		}
}
?>
