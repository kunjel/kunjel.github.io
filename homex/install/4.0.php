<?php
 //Upgrade queries
	mysql_query("ALTER TABLE  `".DB_PREFIX."classifieditems` ADD  `approved` TINYINT NOT NULL ;");
	mysql_query("ALTER TABLE  `".DB_PREFIX."pages` ADD  `menushowbottom` ENUM(  '0',  '1' ) NOT NULL ;");
	mysql_query("ALTER TABLE  `".DB_PREFIX."classifieditems` ADD  `street_address` VARCHAR( 255 ) NOT NULL AFTER  `paidTo` ;");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('TopBannerCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('LeftBannerCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('LeftBannerOption',  '1');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('RightBannerCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('TopClassifiedCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('RightClassifiedCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('BottomClassifiedCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('RightClassifiedDetailsCode',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('autoapproveads',  '1');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('defaultLanguage',  'ENGLISH');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('ShowFooterLink',  '1');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('AffiliateID',  '100');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('captchaPublicKey',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('captchaPrivateKey',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('cmsDate',  '6-18-2011');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('autoDeleteAds',  '0');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('cronInstruction',  '');");
	mysql_query("INSERT INTO  `".DB_PREFIX."settings` (`sname` ,`svalue`) VALUES ('localkey',  '');");
	mysql_query("ALTER TABLE `".DB_PREFIX."users` CHANGE `mail` `mail` VARCHAR(100);");
	mysql_query("ALTER TABLE `".DB_PREFIX."users` ADD `stateId` INT NOT NULL AFTER `countryId`;");
	mysql_query("UPDATE `".DB_PREFIX."settings` SET svalue='4.0.0' WHERE sname='cmsVersion';");
?>