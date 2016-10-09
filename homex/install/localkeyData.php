<?

require_once("../database/settings.php");

$db_connect = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWD);

if( !$db_connect || !mysql_select_db( DB_NAME ) ){
  echo "Incorrect database connection data";
  exit();
}

mysql_query("UPDATE cms_settings SET `svalue` = '" . $localkeydata . "' WHERE `sname`='localkey'") or die(mysql_error());

?>