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
$name2 = $_POST['catname'];
if (isset($_POST['countrySave']) || isset($_POST['countryAdd']) || isset($_GET['countryDelete']))
{
    if(isset($_POST['countrySave']))
        mysql_query("UPDATE ".DB_PREFIX."countries SET name2=".GetSQLValueString($name2, 'text')." WHERE cid=".$_GET['countryEdit']) or die(mysql_error());
    else if(isset($_POST['countryAdd']))
        mysql_qw("INSERT INTO ".DB_PREFIX."countries SET name2=?", $name2) or die(mysql_error());
    else if(isset($_GET['countryDelete']))
    {
        mysql_qw("DELETE FROM ".DB_PREFIX."countries WHERE cid=?", $_GET['countryDelete']) or die(mysql_error());
        mysql_qw("DELETE FROM ".DB_PREFIX."states WHERE pid=?", $_GET['countryDelete']) or die(mysql_error());
        mysql_qw("DELETE FROM ".DB_PREFIX."cities WHERE pid=?", $_GET['countryDelete']) or die(mysql_error());
    }
    
    redirect("index.php?m=places&mode=saved");
}
if (isset($_POST['stateSave']) || isset($_POST['stateAdd']) || isset($_GET['stateDelete']))
{
    if(isset($_POST['stateSave']))
        mysql_query("UPDATE ".DB_PREFIX."states SET pid='".$_POST['catpid']."',name2=".GetSQLValueString($name2, 'text')." WHERE cid=".$_GET['stateEdit']) or die(mysql_error());
    else if(isset($_POST['stateAdd']))
        mysql_qw("INSERT INTO ".DB_PREFIX."states SET pid=?,name2=?", $_POST['catpid'], $name2) or die(mysql_error());
    else if(isset($_GET['stateDelete']))
    {
        mysql_qw("DELETE FROM ".DB_PREFIX."states WHERE cid=?", $_GET['stateDelete']) or die(mysql_error());
        mysql_qw("DELETE FROM ".DB_PREFIX."cities WHERE state=?", $_GET['stateDelete']) or die(mysql_error());
    }
    
    redirect("index.php?m=places&tab=3&mode=saved");
}
if (isset($_POST['cityAdd']) || isset($_POST['citySave']) || isset($_GET['cityDelete']))
{
    if (isset($_POST['cityAdd']) || isset($_POST['citySave']))
    {
        $name  = $_POST['ctname'];
        $state = $_POST['catpid'];
        
        $state_sql = "SELECT * FROM ".DB_PREFIX."states WHERE cid='$state'";
        $state_rs  = mysql_query($state_sql);
        if(mysql_num_rows($state_rs)==1)
        {
            $state_row = mysql_fetch_assoc($state_rs);
            $pid       = $state_row['pid'];        
        }
    }
    if(isset($_POST['cityAdd']))
          mysql_qw("INSERT INTO ".DB_PREFIX."cities SET pid=?,name2=?,state=?", $pid, $name, $state) or die(mysql_error());
    else if(isset($_POST['citySave']))
        mysql_query("UPDATE ".DB_PREFIX."cities SET name2=".GetSQLValueString($name, 'text').",pid=".$pid.",state=".$state." WHERE cid=".$_GET['cityEdit']) or die(mysql_error());
    else if(isset($_GET['cityDelete']))
        mysql_qw("DELETE FROM ".DB_PREFIX."cities WHERE cid=?", $_GET['cityDelete']) or die(mysql_error());
    
    redirect("index.php?m=places&tab=2&mode=saved");
}
?>