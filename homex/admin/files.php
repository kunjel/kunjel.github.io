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
	// TODO: spaces in files
    global $l;
?>
<script>
    $(document).ready(function() {
		<?if (isset($_GET['tab'])) {?>
		    show(<?=$_GET['tab']?>);
		<?} else {?>
	        show(1);
		<?}?>
    });
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
    	$("#load" + id).load("<?=getSet("url")?>/admin/ajax/filesList.php?type=" + id);
	}
</script>
<div class="title"><?=$l['Files']?></div>
<div class="sublinkpadd">
	<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['Images']?></a></div>
	<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['Documents']?></a></div>
	<div class="sublink" id="sl_3"><a id="sll_3" href="javascript:show(3)"><?=$l['Other']?></a></div>
	<div style="clear: both;"></div>
</div>
	<?if(strlen($uploadedFile) > 0) {?>
		<div class="ok"><?=$uploadedFile?></div>
	<?}?>
	<?if ($_GET['mode'] == "deleted") {?>
	   <div class="error"><?=$l['Removed']?></div>
	<?}?>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 10px;">
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
	</table>
<form method="post" enctype="multipart/form-data">
	<div id="div_1">
		<b><?=$l['AddaFile']?>:</b> <input type="file" name="file1" /> <input type="submit" class="but" value="<?=$l['Submit']?>" name="upload1" /><br /><br />
		<div id="load1"></div>
	</div>
	<div id="div_2" style="display: none;">
		<b><?=$l['AddaFile']?>:</b> <input type="file" name="file2" /> <input type="submit" class="but" value="<?=$l['Submit']?>" name="upload2" /><br /><br />
		<div id="load2"></div>
	</div>
	<div id="div_3" style="display: none;">
		<b><?=$l['AddaFile']?>:</b> <input type="file" name="file3" /> <input type="submit" class="but" value="<?=$l['Submit']?>" name="upload3" /><br /><br />
		<div id="load3"></div>
	</div>
</form>