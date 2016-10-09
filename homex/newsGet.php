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
	global $pages;
	$pcount = getSet("newsPerPage");
    if(isset($_GET['page']))
    	$page = $_GET['page'];
    else
    	$page = 1;
    $l_begin = ($page - 1) * $pcount;
    $l_end   = intval($pcount);
    if (!isset($_GET['nid']))
		$links = mysql_qw('SELECT * FROM ' . DB_PREFIX."news". ' ORDER BY nid DESC LIMIT ?, ?', $l_begin, $l_end) or die(mysql_error());
	else
		$links = mysql_qw('SELECT * FROM ' . DB_PREFIX."news". ' WHERE nid=?', $_GET['nid']) or die("dont get links");
	for($li = array(); $cv = mysql_fetch_assoc($links); $li[] = $cv);
	$nav_page = mysql_query("SELECT count(*) as co FROM cms_news") or die(mysql_error());
	$nav_page = mysql_fetch_assoc($nav_page);
 	$nav_page = print_page_navigation($nav_page['co'], $pcount);
   	function subBody($b)
   	{
   		$len = getSet("newsLength");
   		if (strlen($b) > $len)
   		{
   			$b = strip_tags($b);
   			return mb_substr($b, 0, $len) . "...";
   		}
   		else
   			return $b;
   	}
?>
<?if(!isset($_GET['nid'])) {?>
	<div style="padding-top: 10px;" align="left">
		<?for($i = 0; $i < count($li); $i++) {?>
			<div style="padding-bottom: 20px;">
			<div>
				<a style="font-weight: bold;" href="index.php?pid=<?=$pages['News']?>&nid=<?=$li[$i]['nid']?>"><?=$li[$i]['title'.langId()]?></a> <span style="font-weight: normal">(<?=date("d.m.Y", $li[$i]['date'])?>)</span>
			</div>
			<div><?=subBody( $li[$i]['body'.langId()] )?></div>
			<?if (isAdmin()) {?>
				<div style="padding-bottom: 10px;">
		 			<a class="sm" href="index.php?m=news&edit=<?=$li[$i]['nid']?>&lg=2">ru</a>&nbsp;<a class="sm" href="index.php?m=news&edit=<?=$li[$i]['nid']?>&lg=1">en</a>&nbsp;<a class="sm" href="index.php?m=news&edit=<?=$li[$i]['nid']?>&lg=3">kz</a>&nbsp;<a
		 			href="index.php?m=news&delete=<?=$li[$i]['nid']?>" onclick="return confirm('<?=$l['AreYouSure']?>')">удалить</a>
				</div>
			<?}?>
			</div>
		<?}?>
	</div>
	<?=$nav_page?>
<?} else { $i = 0;?>
	<div style="font-weight: bold;"><?=$li[$i]['title'.langId()]?></div>
	<?=subBody( $li[$i]['body'.langId()] )?>
			<?if (isAdmin()) {?>
				<div style="padding-bottom: 10px;">
		 			<a class="sm" href="index.php?m=news&edit=<?=$li[$i]['nid']?>&lg=2">ru</a>&nbsp;<a class="sm" href="index.php?m=news&edit=<?=$li[$i]['nid']?>&lg=1">en</a>&nbsp;<a class="sm" href="index.php?m=news&edit=<?=$li[$i]['nid']?>&lg=3">kz</a>&nbsp;<a
		 			href="index.php?m=news&delete=<?=$li[$i]['nid']?>" onclick="return confirm('<?=$l['AreYouSure']?>')">удалить</a>
				</div>
			<?}?>
<?}?>
