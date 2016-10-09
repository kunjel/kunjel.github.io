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
	global $p;
	//Get the pages count
	$number_of_pages_sql = mysql_qw('SELECT * FROM ' . DB_PREFIX."pages");
	$number_of_pages = mysql_num_rows($number_of_pages_sql);
	if (isset($_GET['pid']))
	{
	 $pid = $_GET['pid'];
		$currPage = mysql_qw('SELECT * FROM ' . DB_PREFIX."pages" . ' WHERE pid=? LIMIT 1', $pid) or die("error in selecting page");
		$arPageData = mysql_fetch_assoc($currPage);
    	$pageBody = $arPageData['body'.langId()];
    	$pageName = $arPageData['name'.langId()];
    	$title = $arPageData['title'.langId()];
    	$keys = $arPageData['keys'.langId()];
    	$descr = $arPageData['descr'.langId()];
		$showMenuTop = $arPageData['menushow'];
		
		$showMenuBottom = $arPageData['menushowbottom'];
		
		$weight = $arPageData['weight'];
    	$url = $arPageData['url'];
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
    	for(i = 1; i < 3; i++)
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
    		$("#pageList").load("<?=getSet("url")?>/admin/ajax/pagesList.php");
	}
</script>
<div class="title"><?=$l['Pages']?></div>
<div class="sublinkpadd">
	<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['AddPage']?></a></div>
	<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['AddedPages']?></a></div>
	<div style="clear: both;"></div>
</div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
	<?if ($_GET['mode'] == "deleted") {?>
	   <div class="error"><?=$l['Removed']?></div>
	<?}?>
<div id="div_1">
<?php
//pages that cannot be deleted
$main_pages = array("Home","Contact","Sign up","My Ads", "Post ad", "Login", "Articles", "News", "Help");
?>
	<form method="post">
		<?=$l['Name']?>:<br/>
		<input style="width: 350px;" name="pageName" value="<?=$pageName?>" /><br/><br/>
		<?php //if(!in_array($pageName,$main_pages)){ ?>
		<?php if($pid>9){ ?>
		<?=$l['PageAddress']?>: (<?=$l['AvailableCharacters']?>)<br/>
		<?=getSet("url")?>/ <input style="width: 350px;" name="url" value="<?=$url?>" /><br/><br/>
		<?php } ?>
		<?=$l['Title']?>:<br/>
		<input style="width: 670px;" name="title" value="<?=$title?>" /><br/><br/>
		<?=$l['Keywords']?>:<br/>
		<input style="width: 670px;" name="keys" value="<?=$keys?>" /><br/><br/>
		<?=$l['Description']?>:<br/>
		<input style="width: 670px;" name="descr" value="<?=$descr?>" /><br/><br/>
		<?=$l['ShowMenuTop']?>:<br/>
		<input type="checkbox" name="showMenuTop" value="1" <?php if($showMenuTop==1)echo "checked"; ?> /><br/><br/>
		
		<?=$l['ShowMenuBottom']?>:<br/>
		<input type="checkbox" name="showMenuBottom" value="1" <?php if($showMenuBottom==1)echo "checked"; ?> /><br/><br/>
		
		<?=$l['position']?>:<br/>
		<select name="position">
			<option value="0"><?=$l['select_position']?></option>
			<?php 
				$i = 1;
				for($i=1;$i<=$number_of_pages;$i++){
				?>
					<option value="<?=$i;?>" <?php if($i==$weight)echo "selected"; ?>><?=$i;?></option>
				<?php
				}
			?>
		</select><br/><br/>
		<?=$l['Text']?>:<br/>
		<textarea name="fckBody"><?=$pageBody?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'fckBody',
		    {
		        width : '800'
		    });
		</script>
		<br/>
	    <!--
		<input style="width: 250px;" name="pageWeight" value="<?=$pageWeight?>" /><br/><br/>
		<input type="checkbox" name="pageMenuShow" value="1" <?=$pageShow?> />
		<br/><br/>-->
		<input type="submit" class="but" name="pageSave" value="<?=$l['Save']?>" />
	</form>
</div>
<div id="div_2" style="display: none;">
	<div id="pageList"></div>
</div>
