<?
// Database upgrade items for 4.0 to 4.1 upgrade
mysql_query('SET NAMES utf8');
mysql_query("INSERT INTO ".DB_PREFIX."settings (sname,svalue) VALUES('showcategorycount','1')");
mysql_query("ALTER TABLE ".DB_PREFIX."classifieditems ADD views INT NOT NULL");
mysql_query("INSERT INTO `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('LeftBottomBannerCode', 'NULL')");
mysql_query("INSERT INTO `".DB_PREFIX."settings` (`sname`, `svalue`) VALUES ('projectNameDisplay', '1')");
mysql_query("ALTER TABLE  `".DB_PREFIX."classifieditems` ADD  `urlText` VARCHAR( 200 ) NOT NULL AFTER  `description`");
mysql_query("ALTER TABLE  `".DB_PREFIX."classifieditems` ADD  `urlLink` TEXT NOT NULL AFTER  `urlText`");
mysql_query("INSERT INTO `".DB_PREFIX."settings` (`sname`, `svalue`) VALUES ('headerImage', NULL)");
mysql_query("UPDATE `".DB_PREFIX."settings` SET svalue='4.1.0' WHERE sname='cmsVersion';");
mysql_query("UPDATE `".DB_PREFIX."settings` SET svalue='9/24/2011' WHERE sname='cmsDate';");
	
?>