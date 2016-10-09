<?

	mysql_query("ALTER TABLE  `cms_users` ADD  `countryId` INT NULL , ADD  `cityId` INT NULL ;") or die(mysql_error());

	mysql_query("ALTER TABLE  `cms_users` ADD  `myCity` TINYINT NOT NULL DEFAULT  '0';") or die(mysql_error());

?>