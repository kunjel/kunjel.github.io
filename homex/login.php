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
	global $p;
	global $l;
?>
<center>
	<span style="color:red;">
	<?
	if ($_GET["mode"] == "false")
		echo $l['Incorrect_login_or_password'];//.'&nbsp;&nbsp;<a href="/forgot">'.$l['forgot'].'</a>';
	?>
	</span>
</center>
<form action="<?=$_SERVER['PHP_SELF']?>?m=login" method="POST">
<div class="login_container_main">
	<div class="login_label"><?=$l['Login']?>:&nbsp;&nbsp;</div><div class="login_input"><input name="auth_login" type="text" class="input_postad"></div>
	<br /><br />
	<div class="login_label"><?=$l['Password']?>:&nbsp;&nbsp;</div><div class="login_input"><input name="auth_passwd" type="password" class="input_postad"></div>
	<br /><br />
	<div class="login_label">&nbsp;</div><div class="login_input"><input type="submit" class="but" name="auth" value="<?=$l['Submit']?>">&nbsp;&nbsp;<a href="<?=$p?>/forgot"><?=$l['forgot']?></a></div>
</div>
</form>
