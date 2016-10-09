<?

   require_once("../database/settings.php");


   $db_connect = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWD);

   if( !$db_connect || !mysql_select_db( DB_NAME ) )
   {
      echo "Incorrect database connection data";
      exit();
   }

   mysql_query('SET NAMES utf8');


	mysql_query("

		CREATE TABLE IF NOT EXISTS `cms_articles` (
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
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ") or die(mysql_error());


	mysql_query("

		CREATE TABLE IF NOT EXISTS `cms_contacts` (
		  `cid` mediumint(9) NOT NULL auto_increment,
		  `uid` int(11) default NULL,
		  `name` varchar(250) default NULL,
		  `email` varchar(250) default NULL,
		  `phone` varchar(250) default NULL,
		  `subject` varchar(250) default NULL,
		  `body` text,
		  `date` varchar(40) NOT NULL,
		  `status` text,
		  PRIMARY KEY  (`cid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ") or die(mysql_error());


    mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_log` (
		  `lid` mediumint(9) NOT NULL auto_increment,
		  `uid` int(11) NOT NULL,
		  `date` varchar(40) NOT NULL,
		  `object` int(11) NOT NULL,
		  `objectId` int(11) NOT NULL,
		  `action` int(11) NOT NULL,
		  `ip` varchar(40) NOT NULL,
		  PRIMARY KEY  (`lid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ") or die(mysql_error());


    mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_news` (
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
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ") or die(mysql_error());


   mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_pages` (
		  `pid` mediumint(9) NOT NULL,
		  `parent_id` int(11) NOT NULL default '0',
		  `name1` tinytext NOT NULL,
		  `name2` tinytext NOT NULL,
		  `name3` tinytext NOT NULL,
		  `body1` mediumtext,
		  `body2` mediumtext,
		  `body3` mediumtext,
		  `title1` varchar(250) default NULL,
		  `title2` varchar(250) default NULL,
		  `title3` varchar(250) default NULL,
		  `keys1` varchar(250) default NULL,
		  `keys2` varchar(250) default NULL,
		  `keys3` varchar(250) default NULL,
		  `descr1` mediumtext,
		  `descr2` mediumtext,
		  `descr3` mediumtext,
		  `weight` int(11) NOT NULL default '0',
		  `menushow` enum('0','1') default '0',
		  `url` varchar(250) NOT NULL,
		  PRIMARY KEY  (`pid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
   ") or die(mysql_error());

   mysql_query("TRUNCATE TABLE `cms_pages`") or die(mysql_error());


   mysql_query("

		INSERT INTO `cms_pages` (`pid`, `parent_id`, `name1`, `name2`, `name3`, `body1`, `body2`, `body3`, `title1`, `title2`, `title3`, `keys1`, `keys2`, `keys3`, `descr1`, `descr2`, `descr3`, `weight`, `menushow`, `url`) VALUES
		(1, 0, '', 'Home', '', NULL, '', NULL, NULL, 'Home page', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', '1'),
		(2, 0, '', 'Contact', '', NULL, '', NULL, NULL, 'Contact', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'Contact'),
		(3, 0, '', 'Post ad', '', NULL, '', NULL, NULL, 'Post ad', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'postAd'),
		(4, 0, '', 'Sign up', '', NULL, '', NULL, NULL, 'Sign Up', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'signup'),
		(5, 0, '', 'My Ads', '', NULL, '', NULL, NULL, 'My ads', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'myAds'),
		(6, 0, '', 'Articles', '', NULL, '', NULL, NULL, 'Articles', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'Articles'),
		(7, 0, '', 'Login', '', NULL, '', NULL, NULL, 'Login', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'Login'),
		(8, 0, '', 'News', '', NULL, '', NULL, NULL, 'News', NULL, NULL, '', NULL, NULL, '', NULL, 0, '1', 'News');
	
   ");

   mysql_query("

INSERT INTO `cms_pages` VALUES ('9', '0', '', 'Help', '', null, '<div class=\"help\">\r\n	<h2>\r\n		How To Post Ads</h2>\r\n	<p>\r\n		<br />\r\n		1. Log in with your username and password using the form at the top right of the website.</p>\r\n	<p>\r\n		<br />\r\n		<img border=\"1\" height=\"53\" hspace=\"30\" src=\"../upload/images/help_image002.gif\" width=\"498\" /><br />\r\n		<br />\r\n		2. Click &ldquo;Post Ad&rdquo;<br />\r\n		<br />\r\n		<img height=\"56\" hspace=\"30\" src=\"../upload/images/help_image004.jpg\" width=\"319\" /><br />\r\n		<br />\r\n		3.&nbsp; Choose the category and a sub-category.<br />\r\n		<img height=\"109\" hspace=\"30\" src=\"../upload/images/help_image006.gif\" width=\"281\" /><br />\r\n		<br />\r\n		4.&nbsp; Enter the title of your ad.<br />\r\n		<img height=\"51\" hspace=\"30\" src=\"../upload/images/help_image008.gif\" width=\"322\" /><br />\r\n		<br />\r\n		5.&nbsp; Enter the description of your ad.<br />\r\n		<img height=\"150\" hspace=\"30\" src=\"../upload/images/help_image010.gif\" width=\"440\" /><br />\r\n		<br />\r\n		6. Enter the price or choose from the other option between &ldquo;free&rdquo; or &ldquo;best offer.&rdquo;<br />\r\n		<img height=\"57\" hspace=\"30\" src=\"../upload/images/help_image012.gif\" width=\"351\" /><br />\r\n		<br />\r\n		7. Fill in your address with a street address, country, state or region, city, and zip/postal code. These fields&nbsp;are optional.<br />\r\n		<img height=\"275\" hspace=\"30\" src=\"../upload/images/help_image014.gif\" width=\"325\" /><br />\r\n		<br />\r\n		8. Choose a photo for your ad. Click &ldquo;Choose File&rdquo; and select an image to upload. The acceptable file<br />\r\n		&nbsp;&nbsp;&nbsp; format is jpg, png, or gif. You can only have a maximum of 5 images per&nbsp;ad.<br />\r\n		<img height=\"182\" hspace=\"30\" src=\"../upload/images/help_image016.gif\" width=\"300\" /><br />\r\n		<br />\r\n		9. If you would like to show a video in your ad, enter the video embed code.<br />\r\n		<img height=\"100\" hspace=\"30\" src=\"../upload/images/help_image018.gif\" width=\"443\" /><br />\r\n		<br />\r\n		10. Click &ldquo;Save&rdquo; to publish your ad.<br />\r\n		<img height=\"54\" hspace=\"30\" src=\"../upload/images/help_image020.gif\" width=\"79\" /></p>\r\n</div>', null, null, 'Help', null, null, '', null, null, '', null, '5', '1', 'help');
   ");


	mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_roles` (
		  `rid` mediumint(9) NOT NULL auto_increment,
		  `name` varchar(50) NOT NULL,
		  PRIMARY KEY  (`rid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ") or die(mysql_error());

    mysql_query("TRUNCATE TABLE `cms_roles`") or die(mysql_error());

    mysql_query("
		INSERT INTO `cms_roles` (`rid`, `name`) VALUES
		(1, 'user'),
		(2, 'admin'),
		(3, 'manager 1'),
		(4, 'manager 2');
    ") or die(mysql_error());


    mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_sessions` (
		  `SessionID` char(255) NOT NULL,
		  `LastUpdated` datetime NOT NULL,
		  `DataValue` text,
		  PRIMARY KEY  (`SessionID`),
		  KEY `LastUpdated` (`LastUpdated`)
		) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    ") or die(mysql_error());


    mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_settings` (
		  `sname` varchar(40) NOT NULL,
		  `svalue` text
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    ") or die(mysql_error());

    mysql_query("TRUNCATE TABLE `cms_settings`") or die(mysql_error());

    mysql_query("
		INSERT INTO `cms_settings` (`sname`, `svalue`) VALUES
		('email', 'mail@mail.com'),
		('title3', NULL),
		('title2', 'Classifieds'),
		('title1', NULL),
		('keys1', NULL),
		('keys2', NULL),
		('keys3', NULL),
		('newsPerPage', '20'),
		('newsLength', '300'),
		('articlesPerPage', '20'),
		('articlesLength', '500'),
		('url', NULL),
		('path', NULL),
		('timeZone', '-5'),
		('signUp', ''),
		('googleMaps', ''),
		('counters', ''),
		('headMeta', ''),
		('descr1', NULL),
		('descr2', NULL),
		('descr3', NULL),
		('classPrice2', '2'),
		('classPerPage', '20'),
		('classPrice1', '3.5'),
		('projectName', 'Classifieds'),
		('classCurrency', 'USD'),
		('classDefCountry', 'USA'),
		('skin', 'orange'),
		('licenseKey', NULL),
		('payPalEmail', NULL),
		('classPayDays', '14'),
		('disableStates', '0'),
		('cmsVersion', '3.8');
    ") or die(mysql_error());


    mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_users` (
		  `uid` mediumint(9) NOT NULL auto_increment,
		  `login` varchar(40) NOT NULL,
		  `passwd` varchar(50) NOT NULL,
		  `mail` varchar(30) NOT NULL,
		  `block` enum('0','1') default '1',
		  `roleId` int(11) default '1',
		  `firstname` varchar(250) default NULL,
		  `lastname` varchar(250) default NULL,
		  `country` varchar(90) default NULL,
		  `region` varchar(250) default NULL,
		  `city` varchar(90) default NULL,
		  `adress` varchar(250) default NULL,
		  `zip` varchar(90) default NULL,
		  `phone` varchar(90) default NULL,
		  `fax` varchar(90) default NULL,
		  `mob` varchar(90) default NULL,
		  `icq` varchar(90) default NULL,
		  `skype` varchar(90) default NULL,
		  `regDate` varchar(40) default NULL,
		  `lastLoginDate` varchar(40) default NULL,
		  `lastLoginDate2` varchar(40) NOT NULL,
		  `ip` varchar(40) NOT NULL,
		  `ip2` varchar(40) NOT NULL,
		  PRIMARY KEY  (`uid`),
		  KEY `i_login` (`login`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ") or die(mysql_error());

    mysql_query("TRUNCATE TABLE `cms_users`") or die(mysql_error());

    mysql_query("

		CREATE TABLE IF NOT EXISTS `cms_classifiedcategories` (
		  `cid` mediumint(9) NOT NULL auto_increment,
		  `pid` int(11) NOT NULL,
		  `url` varchar(250) NOT NULL,
		  `name1` tinytext,
		  `name2` tinytext,
		  `name3` tinytext,
		  `level` int(11) NOT NULL,
		  `weight` int(11) default NULL,
		  PRIMARY KEY  (`cid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

    ");

    mysql_query("
		CREATE TABLE IF NOT EXISTS `cms_classifieditems` (
		  `cid` mediumint(9) NOT NULL auto_increment,
		  `pid` int(11) NOT NULL,
		  `uid` int(11) NOT NULL,
		  `date` varchar(40) NOT NULL,
		  `url` varchar(250) NOT NULL,
		  `name1` tinytext,
		  `name2` tinytext,
		  `name3` tinytext,
		  `description` text,
		  `file1` varchar(40) default NULL,
		  `file2` varchar(40) default NULL,
		  `file3` varchar(40) default NULL,
		  `file4` varchar(40) default NULL,
		  `file5` varchar(40) default NULL,
		  `video` text,
		  `price` float default NULL,
		  `priceType` varchar(40) default NULL,
		  `city` varchar(250) default NULL,
		  `coorx` varchar(250) default NULL,
		  `coory` varchar(250) default NULL,
		  `pay` int(11) default '0',
		  `paidTo` varchar(40) default NULL,
		  PRIMARY KEY  (`cid`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    ");

?>