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
    global $l;
	$articles = mysql_qw('SELECT * FROM ' . DB_PREFIX."articles". ' ORDER BY nid DESC') or die("dont get articles");
	for($ne = array(); $cv = mysql_fetch_assoc($articles); $ne[] = $cv);
	$nbody = "";
	if ($_GET['edit'] > 0)
	{
    	$onearticles = mysql_qw('SELECT * FROM ' . DB_PREFIX."articles". ' WHERE nid=?', $_GET['edit']) or die("dont get links");
		$ne = mysql_fetch_assoc($onearticles);
        $cl = $_GET['lg'];
		$namel = $ne['title'.$cl];
		$nbody = $ne['body'.$cl];
	}
?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script>
	<?if (isset($_GET['tab'])) {?>
	    $(document).ready(function() {
	    	show(<?=$_GET['tab']?>);
	  	});
	<?}?>
	function show(id)
	{
    	for(i = 1; i < 4; i++)
    	{
    		$("#div_" + i).hide();
        	$("#sl_" + i).removeClass("sublinkact");
        	$("#sl_" + i).addClass("sublink");
        	$("#sll_" + i).removeClass("wh");
    	}
    	$("#div_" + id).show();
        $("#sl_" + id).addClass("sublinkact");
        $("#sll_" + id).addClass("wh");
    	if (id == 2)
    		$("#load").load("<?=getSet("url")?>/admin/ajax/articlesList.php");
	}
</script>
<div class="title"><?=$l['Articles']?></div>
<div class="sublinkpadd">
	<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['AddArticle']?></a></div>
	<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['AddedArticles']?></a></div>
	<!--<div class="sublink" id="sl_3"><a id="sll_3" href="javascript:show(3)"><?=$l['Settings']?></a></div>-->
	<div style="clear: both;"></div>
</div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
	<?if ($_GET['mode'] == "deleted") {?>
	   <div class="error"><?=$l['Removed']?></div>
	<?}?>
<div id="div_1">
	<form method="post" enctype="multipart/form-data">
		<?=$l['Name']?><br/>
		<input type="text" style="width: 350px;" name="articlesName" value="<?=$namel?>" /><br/><br/>
		<?=$l['ArticleName']?><br/>
		<textarea name="articlesBody"><?=$nbody?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'articlesBody',
		    {
		        width : '800'
		    });
		</script>
		<br/>
		<input type="submit" class="but" name="articlesSave" value="<?=$l['Save']?>">
	</form>
</div>
<div id="div_2" style="display: none;">
    <div id="load"></div>
</div>
<div id="div_3" style="display: none;">
<!--	<form method="post">
		<?=$l['ArticlesPerPage']?><br/>
		<input type="text" style="width: 350px;" name="articlesSet1" value="<?=getSet("articlesPerPage")?>" /><br/><br/>
		<?=$l['ArticlesSymbols']?><br/>
		<input type="text" style="width: 350px;" name="articlesSet2" value="<?=getSet("articlesLength")?>" /><br/><br/>
		<input type="submit" name="articlesSettSave" value="<?=$l['Save']?>">
	</form>
-->
</div>