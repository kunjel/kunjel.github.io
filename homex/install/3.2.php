<?


 mysql_query("CREATE TABLE IF NOT EXISTS `cms_articles` (
  `nid` mediumint(9) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title1` tinytext,
  `title2` tinytext,
  `title3` tinytext,
  `body1` text,
  `body2` text,
  `body3` text,
  `date` varchar(40) default NULL,
  PRIMARY KEY  (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");


     mysql_query("CREATE TABLE IF NOT EXISTS `cms_payments`
             (
                 pid MEDIUMINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                 cid INT NOT NULL,
                 uid INT NOT NULL,
                 date VARCHAR(40) NOT NULL,
                 ptype VARCHAR(40) NOT NULL,
                 price FLOAT NULL

             ) ENGINE=MyISAM CHARACTER SET=utf8 ");


mysql_query("CREATE TABLE IF NOT EXISTS `cms_cities` (
  `cid` mediumint(9) NOT NULL auto_increment,
  `pid` mediumint(9) NOT NULL,
  `name2` tinytext,
  `state` int(11) default NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3638 ;");


mysql_query("CREATE TABLE IF NOT EXISTS `cms_countries` (
  `cid` mediumint(9) NOT NULL auto_increment,
  `name2` tinytext,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;");


mysql_query("CREATE TABLE IF NOT EXISTS `cms_inbox` (
  `mid` mediumint(9) NOT NULL auto_increment,
  `fromUid` int(11) NOT NULL,
  `toUid` int(11) NOT NULL,
  `subject` tinytext,
  `message` text,
  `date` varchar(40) NOT NULL,
  `isRead` enum('0','1') default '0',
  PRIMARY KEY  (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;");


mysql_query("CREATE TABLE IF NOT EXISTS `cms_news` (
  `nid` mediumint(9) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title1` tinytext,
  `title2` tinytext,
  `title3` tinytext,
  `body1` text,
  `body2` text,
  `body3` text,
  `date` varchar(40) default NULL,
  PRIMARY KEY  (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;");


mysql_query("CREATE TABLE IF NOT EXISTS `cms_outbox` (
  `mid` mediumint(9) NOT NULL auto_increment,
  `fromUid` int(11) NOT NULL,
  `toUid` int(11) NOT NULL,
  `subject` tinytext,
  `message` text,
  `date` varchar(40) NOT NULL,
  PRIMARY KEY  (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;");


mysql_query("CREATE TABLE IF NOT EXISTS `cms_states` (
  `cid` mediumint(9) NOT NULL auto_increment,
  `pid` mediumint(9) NOT NULL,
  `name2` tinytext,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;");

mysql_query("ALTER TABLE `cms_users` ADD `photo` VARCHAR( 40 ) NOT NULL ;");

mysql_query("INSERT INTO `cms_classifiedcategories` (`cid`, `pid`, `url`, `name1`, `name2`, `name3`, `level`, `weight`) VALUES
(1, 0, 'Cars-vehicles', '', 'Cars & vehicles', '', 1, NULL),
(2, 0, 'Community', '', 'Community', '', 1, NULL),
(3, 0, 'Housing', '', 'Housing', '', 1, NULL),
(4, 0, 'Jobs', '', 'Jobs', '', 1, NULL),
(5, 0, 'Pets', '', 'Pets', '', 1, NULL),
(6, 0, 'Services', '', 'Services', '', 1, NULL),
(7, 1, 'Cars', '', 'Cars', '', 2, NULL),
(8, 1, 'Classic-cars', '', 'Classic cars', '', 2, NULL),
(9, 1, 'Motorcycles-scooters', '', 'Motorcycles & scooters', '', 2, NULL),
(10, 1, 'Parts-accessories', '', 'Parts & accessories', '', 2, NULL),
(11, 1, 'Trailers-RVs', '', 'Trailers & RVs', '', 2, NULL),
(12, 1, 'Trucks-vans', '', 'Trucks & vans', '', 2, NULL),
(13, 1, 'Other', '', 'Other', '', 2, NULL),
(14, 2, 'Activity-partners', '', 'Activity partners', '', 2, NULL),
(15, 2, 'Announcements', '', 'Announcements', '', 2, NULL),
(16, 2, 'Artists-musicians', '', 'Artists & musicians', '', 2, NULL),
(17, 2, 'Carpool-rideshare', '', 'Carpool & rideshare', '', 2, NULL),
(18, 2, 'Childcare-babysitting', '', 'Childcare & babysitting', '', 2, NULL),
(19, 2, 'Classes-lessons', '', 'Classes & lessons', '', 2, NULL),
(20, 2, 'Garage-sales', '', 'Garage sales', '', 2, NULL),
(21, 2, 'Lost-found', '', 'Lost & found', '', 2, NULL),
(22, 2, 'Other', '', 'Other', '', 2, NULL),
(23, 3, 'Apartments-for-rent', '', 'Apartments for rent', '', 2, NULL),
(24, 3, 'Commercial', '', 'Commercial', '', 2, NULL),
(25, 3, 'Homes-for-rent', '', 'Homes for rent', '', 2, NULL),
(26, 3, 'Homes-for-sale', '', 'Homes for sale', '', 2, NULL),
(27, 3, 'Land', '', 'Land', '', 2, NULL),
(28, 3, 'Real-estate-services', '', 'Real estate services', '', 2, NULL),
(29, 3, 'Rooms-roommates', '', 'Rooms & roommates', '', 2, NULL),
(30, 3, 'Short-term-sublets', '', 'Short term & sublets', '', 2, NULL),
(31, 3, 'Other', '', 'Other', '', 2, NULL),
(32, 4, 'Accounting-finance', '', 'Accounting & finance', '', 2, NULL),
(33, 4, 'Administrative-office', '', 'Administrative & office', '', 2, NULL),
(34, 4, 'Architecture-engineering', '', 'Architecture & engineering', '', 2, NULL),
(35, 4, 'Biotech-R-D-science', '', 'Biotech, R&D, & science', '', 2, NULL),
(36, 4, 'Business-management', '', 'Business & management', '', 2, NULL),
(37, 3, 'Construction-trades', '', 'Construction & trades', '', 2, NULL),
(38, 4, 'Customer-service', '', 'Customer service', '', 2, NULL),
(39, 4, 'Education-training', '', 'Education & training', '', 2, NULL),
(40, 4, 'Food-beverage-hospitality', '', 'Food/beverage & hospitality', '', 2, NULL),
(41, 4, 'Graphic-web-design', '', 'Graphic & web design', '', 2, NULL),
(42, 4, 'IT-software-development', '', 'IT & software development', '', 2, NULL),
(43, 4, 'Marketing-PR', '', 'Marketing & PR', '', 2, NULL),
(44, 5, 'Accessories', '', 'Accessories', '', 2, NULL),
(45, 5, 'Animal-services', '', 'Animal services', '', 2, NULL),
(46, 5, 'Birds', '', 'Birds', '', 2, NULL),
(47, 5, 'Cats-kittens', '', 'Cats & kittens', '', 2, NULL),
(48, 5, 'Dogs-puppies', '', 'Dogs & puppies', '', 2, NULL),
(49, 5, 'Livestock', '', 'Livestock', '', 2, NULL),
(50, 5, 'Lost-found', '', 'Lost & found', '', 2, NULL),
(51, 5, 'Other-pets', '', 'Other pets', '', 2, NULL),
(52, 6, 'Art-music-decor', '', 'Art, music, & decor', '', 2, NULL),
(53, 6, 'Beauty-health', '', 'Beauty & health', '', 2, NULL),
(54, 6, 'Cleaning-maintenance', '', 'Cleaning & maintenance', '', 2, NULL),
(55, 6, 'Computer', '', 'Computer', '', 2, NULL),
(56, 6, 'Events-occasions', '', 'Events & occasions', '', 2, NULL),
(57, 6, 'Financial-mortgages', '', 'Financial & mortgages', '', 2, NULL),
(58, 6, 'Moving-storage', '', 'Moving & storage', '', 2, NULL),
(59, 6, 'Repair-remodel', '', 'Repair & remodel', '', 2, NULL),
(60, 6, 'Other', '', 'Other', '', 2, NULL);");

mysql_query("ALTER TABLE `cms_classifieditems` ADD `cityId` INT NULL");
mysql_query("ALTER TABLE `cms_classifieditems` ADD `countryId` INT NULL");
mysql_query("ALTER TABLE `cms_classifieditems` ADD `stateId` INT NULL");
mysql_query("ALTER TABLE `cms_classifieditems` ADD `zip` VARCHAR( 20 ) NULL");


?>