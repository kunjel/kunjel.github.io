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
	global $e;
	global $l;
	$publickey = getSet("captchaPublicKey");
	$privatekey = getSet("captchaPrivateKey");
?>
<script>
function checkForm(){
	var er = true;
    if (!checkField("contact_name"))
      	er = false;
    if (!checkField("contact_email"))
      	er = false;
    if (!checkField("contact_message"))
      	er = false;
   	return er;
}
</script>
<div>
	<?=$l['RequireFields']?><br/><br/>
	<?if($errorReqFields == 1) {?>
		<center><span style="color: Red;"><?=$l['FillAllFields']?></span></center>
	<?}?>
	<?if (strlen($erStr) > 0) {?>
	  <span style="color: Red;"><?=$erStr?></span><br/>
	<?}?>
	<?php 
		$url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
		$success = substr($url,-1,1);
		
		if($success == 1){
			echo "<div class='title'>".$l['succSent']."</div>";
		}
		if($success == 2){
			echo "<div class='title asterik'>".$e['invalid_captcha']."</div>";
		}
	?>
		<form method="post" action="">
			<?=$l['ContactName']?>: <span style="color: Red;">*</span><br/>
			<input type="text" style="width: 300px;" name="contact_name" id="contact_name" value="<?=$name?>" /><br/><br/>
			<?=$l['ContactEmail']?>: <span style="color: Red;">*</span><br/>
			<input type="text" style="width: 300px;" name="contact_email" id="contact_email" value="<?=$email?>" /><br/><br/>
			<?=$l['subject']?>: <span style="color: Red;">*</span><br/>
			<input type="text" style="width: 300px;" name="contact_subject" id="contact_subject" value="<?=$subject?>" /><br/><br/>
			<?=$l['message']?>: <span style="color: Red;">*</span><br/>
			<textarea type="text" style="width: 300px;" name="contact_message" id="contact_message" cols="10" rows="10"><?=$message?></textarea><br/><br/>
	  <?php echo recaptcha_get_html($publickey, $error); ?>
      <input style="margin-left:50px; margin-top:10px;" type="submit" class="but" name="contactSend" onclick="return checkForm();" value="<?=$l['SendMessage']?>">
		</form>
</div>
