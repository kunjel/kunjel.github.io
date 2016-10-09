<?php
// *************************************************************************
// *                                                                       *
// * Top Classified Software                                               *
// * Copyright (c) Top Classified Software. All Rights Reserved,           *
// * Release Date: September 23, 2011                                      *
// * Version 4.1.0                                                         *
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
global $p;
global $e;
global $l;
?>
<?
	if (!isset($_GET['mode']))
	{
		$links = mysql_qw('SELECT * FROM ' . DB_PREFIX."news". ' ORDER BY nid DESC') or die("dont get links");
		for($li = array(); $cv = mysql_fetch_assoc($links); $li[] = $cv);
    }
    else
    {
		$links = mysql_qw('SELECT * FROM ' . DB_PREFIX."news". ' WHERE nid=? ORDER BY nid DESC', $_GET['mode']) or die("dont get links");
		for($li = array(); $cv = mysql_fetch_assoc($links); $li[] = $cv);
    }
	function subNews($n, $id)
	{
        $newsLen = getSet("newsLength");
        //$n = strip_tags($n);
		global $p, $l;
		if (strlen($n) >= $newsLen)
			return substr($n, 0, $newsLen) . "... <a href=\"". $p ."/news/". $id ."\">".$l['moreInfo']."</a>";
		else
			return $n;
	}
?>
<?if (!isset($_GET['mode'])) {?>
	<?for($i = 0; $i < count($li); $i++) {?>
	    <div class="blank_div">
	                <div class="title"><a name="a<?=$li[$i]['nid']?>"></a><?=$li[$i]['title2']?> </div>
		</div>
	    
		<div style="clear:both;"></div>
	    <div class="padding_bottom_20">
			<div class="news_content"><?=subNews($li[$i]['body2'], $li[$i]['nid'])?></div>
		</div>
	<?}?>
<?} else {?>
		<div class="blank_div">
						<div class="title"><a name="a<?=$li[0]['nid']?>"></a><?=$li[0]['title2']?></div>
	
		</div>
	    
		<div style="clear:both;"></div>
	    
	    <div class="padding_bottom_20">
			<div class="news_content"><?=$li[0]['body2']?></div>
		</div>
<?}?>
