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
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script>
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
    		$("#log").load("<?=getSet("url")?>/admin/ajax/subscribeList.php");
	}
</script>
<div class="title">Пользователи</div>
<div class="sublinkpadd">
	<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)">Сделать ра�?�?ылку</a></div>
	<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)">Подпи�?авшие�?�? пользователи</a></div>
	<div style="clear: both;"></div>
</div>
<div id="div_1">
	<form method="post">
		Заголовок (будет отображен в теме пи�?ьма):<br/>
		<input style="width: 350px;" name="subject" value="<?=$subject?>" /><br/><br/>
		Тек�?т:<br/>
		<textarea name="fckBody"><?=$body?></textarea>
		<script type="text/javascript">
			CKEDITOR.replace( 'fckBody',
		    {
		        width : '800'
		    });
		</script>
		<br/>
		<input type="submit" class="but" name="sendEmails" value="Отправить" />
	</form>
</div>
<div id="div_2">
	<div id="log"></div>
</div>