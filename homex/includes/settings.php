<?php
// *************************************************************************
// *                                                                       *
// * Top Classified Software                                               *
// * Copyright (c) Top Classified Software. All Rights Reserved,           *
// * Release Date: September 23, 2011                                         *
// * Version 4.0.0                                                         *
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
	$settings = mysql_query("SELECT * FROM cms_settings") or die (mysql_error());
    for($set = array(); $cv = mysql_fetch_assoc($settings); $set[] = $cv);
    function getSet($name)
    {
    	global $set;
    	for ($i = 0; $i < count($set); $i++)
    	{
    		if ($set[$i]['sname'] == $name)
    			return $set[$i]['svalue'];
    	}
    }
    function updateSetting($key, $value)
    {
     $value = GetSQLValueString($value, 'text');
     $key   = GetSQLValueString($key, 'text');
     
    	mysql_query("UPDATE cms_settings SET svalue=$value WHERE sname=$key") or die(mysql_error());
    }
?>