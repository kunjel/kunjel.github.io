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
?>
<?
	if (isset($_GET['deleteus']))
		DeleteUser();
function DeleteUser()
{
//    if(!isAdmin())
//    {
//        redirect("index.php?m=login");
//        exit();
//    }
    
    if ($_GET['deleteus'] != 1)
    {
        $user_id = $_GET['deleteus'];
        
        $classifieditems_sql = "SELECT * FROM ".DB_PREFIX."classifieditems WHERE uid='$user_id'";
        $classifieditems_rs  = mysql_query($classifieditems_sql);
        while ($classifieditems_row = mysql_fetch_assoc($classifieditems_rs))
        {
            $cid = $classifieditems_row['cid'];
            
            for($i=1;$i<=5;$i++)
            {
                $filename = "../upload/".$classifieditems_row['file'.$i];
                if($classifieditems_row['file'.$i]!='')
                {
                    @unlink($filename);
                }	
            }
            $classifieditem_sql = "DELETE FROM ".DB_PREFIX."classifieditems WHERE cid='$cid'";
            mysql_query($classifieditem_sql);
        }
        
        $articles_sql = "DELETE FROM ".DB_PREFIX."articles WHERE uid='$user_id'";
        mysql_query($articles_sql);
        
        $contacts_sql = "DELETE FROM ".DB_PREFIX."contacts WHERE uid='$user_id'";
        mysql_query($contacts_sql);
        
        $inbox_sql = "DELETE FROM ".DB_PREFIX."inbox WHERE fromUid='$user_id' OR toUid='$user_id'";
        mysql_query($inbox_sql);
        
        $outbox_sql = "DELETE FROM ".DB_PREFIX."outbox WHERE fromUid='$user_id' OR toUid='$user_id'";
        mysql_query($outbox_sql);
        
        $log_sql = "DELETE FROM ".DB_PREFIX."log WHERE uid='$user_id'";
        mysql_query($log_sql);
        
        $news_sql = "DELETE FROM ".DB_PREFIX."news WHERE uid='$user_id'";
        mysql_query($news_sql);
        
        $payments_sql = "DELETE FROM ".DB_PREFIX."payments WHERE uid='$user_id'";
        mysql_query($payments_sql);
        
        $user_sql = "DELETE FROM ".DB_PREFIX."users WHERE uid='$user_id'";
        mysql_query($user_sql);        
    }
    
    redirect('index.php?m=users');
}
	if (isset($_POST['userBalanceSave']))
	{
		mysql_query("UPDATE `cms_register` SET `balance` = '".$_POST['user_balance']."' WHERE `login_id`=".$_GET['edit']) or die(mysql_error());
		redirect("index.php?m=users");
	}
	if (isset($_POST['updateProfile']))
	{
		$login = trim($_POST['login']);
		$email = trim($_POST['email']);
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		//$country = trim($_POST['country']);
		$region = trim($_POST['region']);
        //$city = trim($_POST['city']);
        $adress = trim($_POST['adress']);
        $zip = trim($_POST['zip']);
        $phone = trim($_POST['phone']);
        $fax = trim($_POST['fax']);
        $mob = trim($_POST['mob']);
        $icq = trim($_POST['icq']);
        $skype = trim($_POST['skype']);
        $loginId = $_POST['uid'];
		//mysql_qw('UPDATE ' . DB_PREFIX."users" . ' SET login=?, mail=?, firstname=?, lastname=?, country=?, city=?, region=?, icq=?, skype=?, zip=?, phone=?, adress=?, fax=?, mob=? WHERE uid=?',
		//											   $login, $email, $fname, $lname, $country, $city, $region, $icq, $skype, $zip, $phone, $adress, $fax, $mob, $loginId) or die("error in adding user".mysql_error());
		mysql_qw('UPDATE ' . DB_PREFIX."users" . ' SET login=?, mail=?, firstname=?, lastname=?, region=?, icq=?, skype=?, zip=?, phone=?, adress=?, fax=?, mob=? WHERE uid=?',
													   $login, $email, $fname, $lname, $region, $icq, $skype, $zip, $phone, $adress, $fax, $mob, $loginId) or die("error in adding user".mysql_error());
        addToLog($_SESSION['uid'], 6, $loginId, 2);
		redirect("index.php?m=users&mode=saved");
	}
	if ($_GET['log'] == "clear")
	{
		mysql_query("TRUNCATE TABLE cms_log") or die(mysql_error());
		addToLog($_SESSION['uid'], 0, 0, 3);
  		redirect("index.php?m=users&tab=2&mode=saved");
	}
	if (isset($_POST['updatePasword']))
	{
		$loginId = $_POST['uid'];
        $pass1 = trim($_POST['password1']);
        $pass2 = trim($_POST['password2']);
		if ($pass1 == $pass2 && strlen($pass1) > 0)
			mysql_qw('UPDATE ' . DB_PREFIX."users" . ' SET passwd=? WHERE uid=?', md5($pass1), $loginId) or die("error in adding user".mysql_error());
        addToLog($_SESSION['uid'], 6, $loginId, 2);
		redirect("index.php?m=users");
	}
?>
