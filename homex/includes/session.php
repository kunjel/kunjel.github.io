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
<?php
// TODO: DEFINE DB_PREFIX
function sessao_open($aSavaPath, $aSessionName)
{
       global $aTime;
       sessao_gc( $aTime );
       return True;
}
function sessao_close()
{
       return True;
}
function sessao_read( $aKey )
{
       $query = "SELECT DataValue FROM ".DB_PREFIX."sessions WHERE SessionID='$aKey'";
       $busca = mysql_query($query);
       if(mysql_num_rows($busca) == 1)
       {
             $r = mysql_fetch_array($busca);
             return $r['DataValue'];
       } ELSE {
             $query = "INSERT INTO ".DB_PREFIX."sessions (SessionID, LastUpdated, DataValue)
                       VALUES ('$aKey', NOW(), '')";
             mysql_query($query);
             return "";
       }
}
function sessao_write( $aKey, $aVal )
{
       $aVal = addslashes( $aVal );
       $query = "UPDATE ".DB_PREFIX."sessions SET DataValue = '$aVal', LastUpdated = NOW() WHERE SessionID = '$aKey'";
       mysql_query($query) or die(mysql_error());
       return True;
}
function sessao_destroy( $aKey )
{
       $query = "DELETE FROM ".DB_PREFIX."sessions WHERE SessionID = '$aKey'";
       mysql_query($query);
       return True;
}
function sessao_gc( $aMaxLifeTime )
{
       $query = "DELETE FROM ".DB_PREFIX."sessions WHERE UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(LastUpdated) > 9000";
       mysql_query($query);
       return True;
}
session_set_save_handler("sessao_open", "sessao_close", "sessao_read", "sessao_write", "sessao_destroy", "sessao_gc");
// стартуем сессию только тем, кто прислал идентификатор
//if (isset($_REQUEST[session_name()])) session_start();
?>