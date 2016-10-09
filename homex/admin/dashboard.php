<?php
// *************************************************************************
// *                                                                       *
// * Top Classified Software                                               *
// * Copyright (c) Top Classified Software. All Rights Reserved,           *
// * Release Date: November 21, 2011                                       *
// * Version 4.2.0                                                         *
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
	$lastRE = mysql_query("SELECT date, (SELECT count(*) FROM cms_payments) as total FROM cms_payments ORDER BY pid DESC") or die (mysql_error());
	$lastRE = mysql_fetch_assoc($lastRE);
	$lastAd = mysql_query("SELECT date, name2, (SELECT count(*) FROM cms_classifieditems) as total FROM cms_classifieditems ORDER BY cid DESC") or die (mysql_error());
	$lastAd = mysql_fetch_assoc($lastAd);
	$lastP = mysql_query("SELECT count(*) as total FROM cms_pages") or die (mysql_error());
	$lastP = mysql_fetch_assoc($lastP);
	$lastNews = mysql_query("SELECT title2, date, (SELECT count(*) FROM cms_news) as total FROM cms_news ORDER BY nid DESC") or die (mysql_error());
	$lastNews = mysql_fetch_assoc($lastNews);
	$lastArticles = mysql_query("SELECT title2, date, (SELECT count(*) FROM cms_articles) as total FROM cms_articles ORDER BY nid DESC") or die (mysql_error());
	$lastArticles = mysql_fetch_assoc($lastArticles);
	$lastUsers = mysql_query("SELECT login, regDate, (SELECT count(*) FROM cms_users) as total FROM cms_users ORDER BY uid DESC") or die (mysql_error());
	$lastUsers = mysql_fetch_assoc($lastUsers);
	$allPages = mysql_query("SELECT name2, pid FROM cms_pages ORDER BY pid DESC LIMIT 1") or die (mysql_error());
	$ap = mysql_fetch_assoc($allPages);
	$me = userGetById($_SESSION['uid']);
	global $orderCount;
	global $contactCount;
	global $l;
?>
<div class="title"><?=$l['Home']?></div>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="95%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg"><a class="gr" href="index.php?m=orders"><?=$l['Payments']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div>
			       			<?=$l['TotalPayments']?>: <?=$orderCount?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestPayment']?>: <?=date("m/d/Y", $lastRE['date'])?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg"><a class="gr" href="index.php?m=pages"><?=$l['Pages']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div>
			       			<?=$l['TotalPages']?>: <?=$lastP['total']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestPage']?>: <a href="../index.php?pid=<?=$ap['pid']?>"><?=$ap['name2']?></a>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top: 20px;">
	<tr>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="95%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg" ><a class="gr" href="index.php?m=classifieds"><?=$l['Classifieds']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div>
			       			<?=$l['TotalAds']?>: <?=$lastAd['total']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestAd']?>: <?=$lastAd['name2']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['DateofLastAd']?>: <?=date("m/d/Y", $lastAd['date'])?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg"><a class="gr" href="javascript:;"><?=$l['Auth']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div>
			       			<?=$l['YouLoggedAs']?>: <?=$_SESSION['login']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestVisitDate']?>: <?if(strlen($me['lastLoginDate']) > 3 ) echo date("m/d/Y", $me['lastLoginDate']); ?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestIP']?>: <?=$me['ip']?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top: 20px;">
	<tr>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="95%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg" ><a class="gr" href="index.php?m=news"><?=$l['News']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div >
			       			<?=$l['TotalNews']?>: <?=$lastNews['total']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestNews']?>: <?=$lastNews['title2']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['DateOfLatestNews']?>: <?=date("m/d/Y", $lastNews['date'])?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg"><a class="gr" href="index.php?m=news"><?=$l['Articles']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div >
			       			<?=$l['TotalArticles']?>: <?=$lastArticles['total']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestArticle']?>: <?=$lastArticles['title2']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['DateOfLatestArticle']?>: <?=date("m/d/Y", $lastArticles['date'])?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top: 20px;">
	<tr>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="95%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg" ><a class="gr" href="index.php?m=users"><?=$l['Users']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div >
			       			<?=$l['TotalUsers']?>: <?=$lastUsers['total']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['LatestUser']?>: <?=$lastUsers['login']?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['DateOfLatestUser']?>: <?=date("m/d/Y", $lastUsers['regDate'])?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
		<td style="width: 50%;" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td class="tdtop">
			       		<div style="margin-bottom: 20px;"><div class="dashBg" ><a class="gr" href="#"><?=$l['System']?></a></div></div>
					</td>
				</tr>
				<tr>
					<td class="tdbot">
			       		<div >
			       			<?=$l['CMSName']?>: Top Classified Software
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['CMSVersion']?>: <?=getSet("cmsVersion")?>
			       		</div>
			       		<div style="padding-top: 10px;">
			       			<?=$l['ReleaseDate']?>: <?=getSet("cmsDate")?>
			       		</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
