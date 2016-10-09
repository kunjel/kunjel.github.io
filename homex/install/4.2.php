<?
mysql_query("INSERT INTO `".DB_PREFIX."settings` (`sname`, `svalue`) VALUES ('adsPrice', '0')");
mysql_query("ALTER TABLE  `".DB_PREFIX."classifieditems` ADD  `pay_status` INT( 1 ) NOT NULL DEFAULT  '1' AFTER  `approved`;");
mysql_query("UPDATE `".DB_PREFIX."settings` SET svalue='4.2.0' WHERE sname='cmsVersion';");
mysql_query("UPDATE `".DB_PREFIX."settings` SET svalue='11/17/2011' WHERE sname='cmsDate';");
?>