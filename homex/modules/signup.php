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
global $errorReg;
if (isset($_POST['updatePassword']))
{
	$oldPass = trim($_POST['register_pass']);
	$newPass = trim($_POST['register_pass2']);
	$newsPassConf = trim($_POST['register_pass3']);
	if (strlen($oldPass) == 0)
	    $errorPass[1] = "1";
	if (strlen($newPass) == 0)
	    $errorReg[2] = "1";
	if (strlen($newsPassConf) == 0)
	    $errorReg[3] = "1";
	if ($newPass != $newsPassConf)
    	 $errorReg[4] = "1";
	if (count($errorReg) == 0)
	{
		$pass = mysql_qw('SELECT * FROM cms_users WHERE uid=?', $_SESSION['uid']) or die("error in select data" . mysql_error());
		for($comm = array(); $cv = mysql_fetch_assoc($pass); $comm[] = $cv);
		if ($comm[0]['passwd'] != md5($oldPass))
			$errorReg[5] = "1";
		if (count($errorReg) == 0)
		{
			mysql_query("UPDATE `cms_users` SET passwd = '".md5($newPass)."' WHERE `uid`=".$_SESSION['uid']) or die(mysql_error());
			redirect($p."/Profile");
		}
	}
}
if (isset($_POST['registrationSend']))
{
	$login = htmlspecialchars(trim($_POST['login']));
	$name = htmlspecialchars(trim($_POST['firstName']));
	$lastName = htmlspecialchars(trim($_POST['lastName']));
    //$country = htmlspecialchars(trim($_POST['country']));
    $city = htmlspecialchars(trim($_POST['city']));
    $countryId = htmlspecialchars(trim($_POST['countryId']));
    $stateId = htmlspecialchars(trim($_POST['stateId']));
    $cityId = htmlspecialchars(trim($_POST['cityId']));
    $region = htmlspecialchars(trim($_POST['region']));
    $email = htmlspecialchars(trim($_POST['email']));
    $icq = htmlspecialchars(trim($_POST['icq']));
    $skype = htmlspecialchars(trim($_POST['skype']));
	$pass = htmlspecialchars(trim($_POST['password']));
	$compass = htmlspecialchars(trim($_POST['passwordConfirm']));
    $zip = trim($_POST['zip']);
    $address = trim($_POST['adress']);
    $icq = trim($_POST['icq']);
    $skype = trim($_POST['skype']);
    $phone = trim($_POST['phone']);
    $fax = trim($_POST['fax']);
    $mob = trim($_POST['mob']);
	$photo = "";
    $errorLen = 0;
    if (strlen($login) == 0 && !isset($_GET['mode']))
    	$errorLen = 1;
	if (strlen($email) == 0)
    	$errorLen = 1;
	if (strlen($name) == 0)
    	$errorLen = 1;
	if (strlen($lastName) == 0)
    	$errorLen = 1;
	if (strlen($email) > 0 && !check_mail($email))
    	$errorLen = 1;
	if (!isset($_GET['mode']))
	{
		if (strlen($pass) == 0)
		    $errorLen = 1;
		if (strlen($compass) == 0)
		    $errorLen = 1;
		if ($pass !== $compass)
		{
		    $errorLen = 1;
		    $errorLen = 1;
		}
    }
    $al_file = "";
    if ($errorLen == 1)
    {
    	return false;
    }
    else
    {
     	if (!isset($_GET['mode']))
     	{
	    	mysql_qw('INSERT INTO ' . DB_PREFIX."users" . ' SET login=?, passwd=?, mail=?, block=?, firstname=?, lastname=?, country=?, city=?, region=?, icq=?, skype=?, zip=?, phone=?,adress=?, fax=?, mob=?, regDate=?, lastLoginDate=?, countryId=?, cityId=?, stateId=?', $login, md5($pass), $email, 0, $name, $lastName, $country, $city, $region, $icq, $skype, $zip, $phone, $address, $fax, $mob, time(), time(), $countryId, $cityId, $stateId) or die("error in adding user".mysql_error());
	        $getLast = mysql_qw('SELECT * FROM cms_users ORDER BY uid DESC LIMIT 1') or die("error in select data" . mysql_error());
	        for($comm = array(); $cv = mysql_fetch_assoc($getLast); $comm[] = $cv);
	        $_SESSION['login']  = $login;
	        $_SESSION['passwd'] = md5($pass);
	        $_SESSION['uid'] = $comm[0]['uid'];
            redirect($p."/Signup/success");
	    	//redirect("index.php?m=profile&".session_name()."=".session_id());
	  	}
	  	else
	  	{
	    	mysql_qw('UPDATE cms_users SET mail=?, block=?, firstname=?, lastname=?, country=?, city=?, region=?, icq=?, skype=?, zip=?, phone=?, adress=?, fax=?, mob=?, countryId=?, cityId=?, stateId=? WHERE uid=?', $email, 0, $name, $lastName, $country, $city, $region, $icq, $skype, $zip, $phone, $address, $fax, $mob, $countryId, $cityId, $stateId,  $_SESSION['uid']) or die("error in adding user".mysql_error());
	        //if (isset($_GET['uid']) && isAdmin())
	        //    redirect("index.php?m=users");
	       // else
	     		redirect($p."/Profile");
	  	}
    }
}
?>
