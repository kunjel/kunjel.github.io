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

if(isset($_POST['auth']) || isset($_POST['auth_x']))

{

   $user_login  =  trim( $_POST['auth_login'] );

   $user_passwd =  trim( md5( $_POST['auth_passwd'] ) );

   if (isset($_POST['auth_x']))

   {

  	 $user_login  =  trim( $_POST['log_x'] );

   	 $user_passwd =  trim( md5( $_POST['pass_x'] ) );

   }

   $auth_user = mysql_qw('SELECT uid, login, passwd, block, mail FROM ' . DB_PREFIX."users" . ' WHERE login=? LIMIT 1', $user_login, $user_passwd) or die(mysql_error());

   $auth_user_data = mysql_fetch_assoc( $auth_user );

   $auth_user_passwd = $auth_user_data['passwd'];

   $auth_user_status = $auth_user_data['block'];

   $auth_user_id     = $auth_user_data['login_id'];

   $auth_user_mail   = $auth_user_data['mail'];

   $auth_user_id     =  $auth_user_data['uid'];

   // проверка на правильность пароля

   if( $user_passwd === $auth_user_passwd )

   {

        if(!isset( $_REQUEST[session_name()] ))

        	session_start();
		
        $_SESSION['login']  = $user_login;

        $_SESSION['passwd'] = $user_passwd;

        $_SESSION['uid'] = $auth_user_id;
		
		print_r($_SESSION);
        //echo $_SESSION['login'];

        //exit;

        if(isset( $_SESSION['register'] ))

        	unset( $_SESSION['register'] );

        // update last ip and last login date

        $lu = mysql_query("SELECT ip2, lastLoginDate2 FROM cms_users users WHERE uid=".$auth_user_id) or die(mysql_error());

        $lu = mysql_fetch_assoc($lu);

        mysql_query("UPDATE `cms_users` SET `ip` = '". $lu['ip2'] ."', `lastLoginDate` = '". $lu['lastLoginDate2'] ."' WHERE `uid`=".$auth_user_id. " LIMIT 1") or die(mysql_error());

        mysql_query("UPDATE `cms_users` SET `ip2` = '". $_SERVER['REMOTE_ADDR'] ."', `lastLoginDate2` = '".now()."' WHERE `uid`=".$auth_user_id. " LIMIT 1") or die(mysql_error());

		if (strpos($_SERVER['HTTP_REFERER'], "admin"))

        	redirect("admin/index.php");

        else

			redirect($p."/");

   }

   else

   {

       if (strpos($_SERVER['HTTP_REFERER'], "admin"))

       		redirect("admin/Login.php?incpass=true");

       else

       		redirect($p."/Login/false");

   }

}

function isAdmin()

{

	if( isset( $_SESSION['login'] ))

	{

		 $pass = mysql_qw('SELECT passwd, roleId FROM ' . DB_PREFIX."users" . ' WHERE uid=? LIMIT 1', $_SESSION['uid']) or die("dont get passwd for this login");

		 $arUserData = mysql_fetch_assoc($pass);

		 if ($arUserData['passwd'] === $_SESSION['passwd'] && $arUserData['roleId'] == 2)

		 	return true;

		 else

		 	return false;

	}

	else

		return false;

}

/*

function isAuth()

{

	if( isset( $_SESSION['login'] ))

	{

		 $pass = mysql_qw('SELECT passwd FROM ' . DB_PREFIX."register" . ' WHERE login=? LIMIT 1', $_SESSION['login']) or die("dont get passwd for this login");

		 $arUserData = mysql_fetch_assoc($pass);

		 if ($arUserData['passwd'] === $_SESSION['passwd'])

		 	return true;

		 else

		 	return false;

	}

	else

		return false;

}

*/

function isAuth()

{

	if( isset( $_SESSION['login'] ) && isset( $_SESSION['passwd'] ))

	{

		 return true;

	}

	else

		return false;

}

?>

