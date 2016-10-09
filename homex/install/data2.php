<?

   require_once("../database/settings.php");


   $db_connect = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWD);

   if( !$db_connect || !mysql_select_db( DB_NAME ) )
   {
      echo "Incorrect database connection data";
      exit();
   }

   mysql_query('SET NAMES utf8');

   mysql_query("UPDATE cms_settings SET `svalue` = '" . trim($_POST['email']) . "' WHERE `sname`='email'") or die(mysql_error());
   mysql_query("UPDATE cms_settings SET `svalue` = '" . trim($_POST['pName']) . "' WHERE `sname`='projectName'") or die(mysql_error());
   mysql_query("UPDATE cms_settings SET `svalue` = '" . trim($_POST['url']) . "' WHERE `sname`='url'") or die(mysql_error());
   mysql_query("UPDATE cms_settings SET `svalue` = '" . trim($_POST['path']) . "' WHERE `sname`='path'") or die(mysql_error());
   mysql_query("UPDATE cms_settings SET `svalue` = '" . trim($_POST['license']) . "' WHERE `sname`='licenseKey'") or die(mysql_error());

   mysql_query("TRUNCATE TABLE cms_users") or die(mysql_error());

   mysql_query("INSERT INTO `cms_users` (
	`uid` ,
	`login` ,
	`passwd` ,
	`mail` ,
	`block`,
	`roleId`
	)
	VALUES (
	'1', 'admin', '". md5(trim($_POST['password'])) ."', '". trim($_POST['email']) ."', '0', '2');"
	);


   require_once("3.2.php");
   require_once("3.7.php");
   require_once("4.0.php");
   require_once("location.php");
   require_once("4.1.php");
   require_once("4.2.php");


?>