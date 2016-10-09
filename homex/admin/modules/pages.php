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
	if($_GET['mode'] == "delete")
		DeletePage();
	if (isset($_POST['pageSave']))
	{
		if (!isset($_GET['pid'])) // insert
		{
			$pid = getMaxId() + 1;
			$pageMenuShow = "1";
            $url = trim($_POST['url']);
            if(strlen($url) == 0)
            	$url = $pid;
			mysql_qw('INSERT INTO ' . DB_PREFIX."pages" . ' SET pid=?, body2=?, name2=?, weight=?, menushow=?, title2=?, keys2=?, descr2=?, url=?', $pid, trim($_POST['fckBody']), trim($_POST['pageName']), trim($_POST['pageWeight']),  $pageMenuShow, $_POST['title'], $_POST['keys'], $_POST['descr'], $url) or die("error in adding page".mysql_error());
			addToLog($_SESSION['uid'], 5, $pid, 1);
		}
		else
		{
			$pageMenuShow = "1";
			$clang = $_GET['lg'];
			$pid = $_GET['pid'];
    $url = trim($_POST['url']);
			
			//This are the pages which cannot be editor for URL
			$main_pages = array("Home","Contact","Sign up","My Ads", "Post ad", "Login", "Articles", "News", "Help");
			/*mysql_query("UPDATE `cms_pages` SET `body".$clang."` = '". addslashes(trim($_POST['fckBody']))."', `name".$clang."` = '".trim($_POST['pageName'])."', `weight` = '".trim($_POST['pageWeight'])."', menushow = '".$pageMenuShow."', title".$clang." = '".$_POST['title']."', keys".$clang." = '".$_POST['keys']."', descr".$clang." = '".$_POST['descr']."', url='".$url."', menushow='".$_POST['showMenuTop']."', menushowbottom='".$_POST['showMenuBottom']."', weight='".$_POST['position']."' WHERE `pid`=".$pid) or die(mysql_error());*/
			
			if($pid<=9){
				mysql_query("UPDATE `cms_pages` SET `body".$clang."` = '". addslashes(trim($_POST['fckBody']))."', `name".$clang."` = '".trim($_POST['pageName'])."', `weight` = '".trim($_POST['pageWeight'])."', menushow = '".$pageMenuShow."', title".$clang." = '".$_POST['title']."', keys".$clang." = '".$_POST['keys']."', descr".$clang." = '".$_POST['descr']."', menushow='".$_POST['showMenuTop']."', menushowbottom='".$_POST['showMenuBottom']."', weight='".$_POST['position']."' WHERE `pid`=".$pid) or die(mysql_error());
			}
			else{
				mysql_query("UPDATE `cms_pages` SET `body".$clang."` = '". addslashes(trim($_POST['fckBody']))."', `name".$clang."` = '".trim($_POST['pageName'])."', `weight` = '".trim($_POST['pageWeight'])."', menushow = '".$pageMenuShow."', title".$clang." = '".$_POST['title']."', keys".$clang." = '".$_POST['keys']."', descr".$clang." = '".$_POST['descr']."', url='".$url."', menushow='".$_POST['showMenuTop']."', menushowbottom='".$_POST['showMenuBottom']."', weight='".$_POST['position']."' WHERE `pid`=".$pid) or die(mysql_error());
			}
			
			
			addToLog($_SESSION['uid'], 5, $pid, 2);
		}
        redirect("index.php?m=pages&tab=2&mode=saved");
		//redirect("index.php?pid=".$pid);
	}
    function getMaxId()
    {
    	$mid = mysql_qw('SELECT pid FROM ' . DB_PREFIX."pages". ' ORDER BY pid DESC') or die("error in selecting page".mysql_error());
    	$max = mysql_fetch_assoc($mid);
    	if ($max['pid'] > 0)
    		return $max['pid'];
    	else
    		return 0;
    }
    function DeletePage()
    {
    	mysql_qw('DELETE FROM ' . DB_PREFIX."pages" . ' WHERE pid=?', $_GET['pid']) or die("error in delete page");
    	addToLog($_SESSION['uid'], 5, $_GET['pid'], 3);
     	redirect("index.php?m=pages&tab=2&mode=deleted");
    }
?>
