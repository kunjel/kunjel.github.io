<?php

// *************************************************************************

// *                                                                       *

// * Top Classified Software                                               *

// * Copyright (c) Top Classified Software. All Rights Reserved,           *

// * Release Date: October 19, 2011                                        *

// * Version 4.1.1                                                         * 

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

	$cats = mysql_query("SELECT * FROM cms_countries ORDER BY name2") or die(mysql_error());

	for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);

	if ($_GET['mode'] == "edit")

	{

		if (isset($_GET['uid']) && isAdmin())

		{

			$auth_user = mysql_qw('SELECT * FROM ' . DB_PREFIX."users" . ' WHERE uid=? LIMIT 1', $_GET['uid']) or die("dont select this user");

		}

	    else

	    {

	    	$login  =  trim( $_SESSION['login'] );

	   		$auth_user = mysql_qw('SELECT * FROM ' . DB_PREFIX."users" . ' WHERE login=? LIMIT 1', $login) or die("dont select this user");

	    }

	   $auth_user_data = mysql_fetch_assoc( $auth_user );

	   $name = $auth_user_data['firstname'];

	   $lastName = $auth_user_data['lastname'];

	   $city = $auth_user_data['city'];

	   $email = $auth_user_data['mail'];

	   $icq = $auth_user_data['icq'];

	   $skype = $auth_user_data['skype'];

	   $country = $auth_user_data['country'];

	   $region = $auth_user_data['region'];

	   $day = $auth_user_data['day'];

	   $month = $auth_user_data['month'];

	   $year = $auth_user_data['year'];

	   $alFile = $auth_user_data['photo'];

	   $profile = $auth_user_data['profile'];

	   $lang = $auth_user_data['lang'];

	   $zip = $auth_user_data['zip'];

	   $address = $auth_user_data['adress'];

	   $phone = $auth_user_data['adress'];

	   $fax = $auth_user_data['fax'];

	   $mob = $auth_user_data['mob'];

	   $adit = $auth_user_data['adit'];

	   $url = $auth_user_data['url'];

	   $phone = $auth_user_data['phone'];

	   $role = $auth_user_data['roleId'];

	   $countryId = $auth_user_data['countryId'];

	   $stateId = $auth_user_data['stateId'];

	   $cityId = $auth_user_data['cityId'];

	   if ($cityId > 0)

	   {

			$citiesCat = mysql_query("SELECT * FROM cms_cities WHERE state='$stateId' ORDER BY name2") or die(mysql_error());

			for($cities = array(); $cv = mysql_fetch_assoc($citiesCat); $cities[] = $cv);

	   }

	   if ($stateId > 0)

	   {

			$citiesCat = mysql_query("SELECT * FROM cms_states WHERE pid='$countryId' ORDER BY name2") or die(mysql_error());

			for($states = array(); $cv = mysql_fetch_assoc($citiesCat); $states[] = $cv);

	   }

	   

//	   echo '<pre>'; print_r($cities); echo '<br>'; print_r($states); exit;

	}

	function isSel($v1, $v2)

	{

		if ($v1 == $v2)

			return "selected=\"selected\"";

	}

	global $l;

	global $roles;

	global $errorReg;

	if ($cityId == "")

		$cityId = 0;

	if ($countryId == "")

		$countryId = 0;

?>

<?if($errorLen == "1") {?>

<div style="color: Red;">

  <?=$l['req']?>

</div>

<br/>

<?}?>

<script>
function checkForm()
{
    var er = true;
    
    if (!checkField("login"))
        er = false;
    else if (!checkSpecial("login"))
        er = false;
    if (!checkField("firstName"))
        er = false;
    if (!checkField("lastName"))
        er = false;
    if (!checkField("email"))
        er = false;
    if (!checkField("password"))
        er = false;
    if (!checkField("passwordConfirm"))
        er = false;
    if (!checkCompareField("password", "passwordConfirm"))
        er = false;

    return er;
}

	function checkPassForm()

	{

		var er = true;

        if (!checkField("register_pass"))

        	er = false;

        if (!checkField("register_pass2"))

        	er = false;

        if (!checkField("register_pass3"))

        	er = false;

        if (!checkCompareField("register_pass2", "register_pass3"))

        	er = false;

    	return er;

	}

</script>

<?if($_GET['mode'] != "success") {?>

<?if (!isset($_GET['reg'])) {?>

<script>

			function getCities(id, select)

			{

	        	$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities.php?cid=' + id + '&select=' + select);

			}

		function getStates(id){

			

			$("#statesEmpty").load('<?=getSet("url")?>/ajax/getStates.php?cid=' + id);

			$("#citiesEmpty").load('<?=getSet("url")?>/ajax/getCities.php?cid=-1');

		

		}

	        <?if ($_GET['mode'] == "edit") {?>

	        	$(document).ready(function() {

	        		//getCities(<?=$countryId?>, <?=$cityId?>);

	        	});

	        <?}?>

		</script>

<form method="post" enctype="multipart/form-data" id="signupForm">

 	  <div class="signup_container">

	  <?if ($_GET["mode"] != "edit") {?>

        <?=$l['LoginNic']?>

        <br/>

        <input type="text" class="content_input" name="login" id="login" value="<?=$login?>"  />

        <span class="asterik">*</span><br/>

        <br/>

        <?}?>

        <?=$l['Name']?>

        <br/>

        <input class="content_input" name="firstName" id="firstName" value="<?=$name?>" />

        <span class="asterik">*</span><br/>

        <br/>

        <?=$l['Last_name']?>

        <br/>

        <input class="content_input" name="lastName" id="lastName" value="<?=$lastName?>" />

        <span class="asterik">*</span><br/>

        <br/>

        E-mail:<br/>

        <input type="text" class="content_input" name="email" id="email" value="<?=$email?>" />

        <span class="asterik">*</span><br/>

        <br/>

      </div>

      <div class="signup_container"><?=$l['Country']?> (<?=$l['optional']?>)<br/>

        <select size="1" name="countryId" class="content_input" ONCHANGE="getStates(this.options[this.selectedIndex].value)">

          <option value="-1">--</option>

          <?for($i = 0; $i < count($cat); $i++) {?>

          <option value="<?=$cat[$i]['cid']?>" <?=isSel($cat[$i]['cid'], $countryId)?>>

          <?=$cat[$i]['name2']?>

          </option>

          <?}?>

        </select>

        <br/>

        <br/>

        

			<?=$l['us_state']?> (<?=$l['optional']?>)<br/>

			<div id="statesEmpty"  class="float_left">

			<select size="1" name="stateId" class="input_postad_300"  ONCHANGE="getCities(this.options[this.selectedIndex].value)">

				<option value="value1">-</option>

				<?for($i = 0; $i < count($states); $i++) {?>

			    	<option value="<?=$states[$i]['cid']?>" <?=isSel($states[$i]['cid'], $stateId)?>><?=$states[$i]['name2']?></option>

			    <?}?>

			</select><br/><br/>

			</div>

        <br/>

        <br/>

			

        <?=$l['City']?> (<?=$l['optional']?>)<br/>

        <div id="citiesEmpty" class="float_left">

          <select size="1" name="cityId" class="signup_city_dropdown">

            <option value="value1">-</option>

				<?for($i = 0; $i < count($cities); $i++) {?>

			    	<option value="<?=$cities[$i]['cid']?>" <?=isSel($cities[$i]['cid'], $cityId)?>><?=$cities[$i]['name2']?></option>

			    <?}?>

          </select>

        </div>

		<div class="float_left" style="display:none"> &nbsp;or

          <input type="text" class="signup_city" name="city" value="<?=$city?>" />

        </div>

        <div style="clear:both;"></div>

        <br/>

        <!--<input style="width: 250px;" name="city" id="city____" value="<?=$city?>" /><br/><br/>-->

        <?if ($_GET["mode"] != "edit") {?>

        <?=$l['Password']?><br/>

        <input type="password" class="content_input" name="password" id="password" value="<?=$pass?>" />

        <span class="asterik">*</span><br/>

        <br/>

        <?=$l['Confirm_password']?><br/>

        <input type="password" class="content_input" name="passwordConfirm" id="passwordConfirm" value="<?=$pass?>" />

        <span class="asterik">*</span><br/>

        <br/>

        <?}?>

      </div>

  <div class="submit_button" style="width:100%"><input type="submit" class="but" onclick="return checkForm();" name="registrationSend" value="<?=$l['Submit']?>"></div>

  <div style="clear:both;"></div>

</form>

<div class="blank_div">&nbsp;</div>

<?if($_GET['mode'] == "edit") {?>

<div class="horizontal_line"></div>

<form method="post" enctype="multipart/form-data">

  <?if($errorLen == "1") {?>

  <div style="color: Red;">

    <?=$l['BothPassReq']?>

  </div>

  <?}?>

  <?if($errorReg[5] == "1") {?>

  <div class="asterik">

    <?=$l['IncOldPass']?>

  </div>

  <?}?>

  <?if($errorReg[4] == "1") {?>

  <div class="asterik">

    <?=$l['PassNotEqual']?>

  </div>

  <?}?>

  <?=$l['oldpass']?>

  :<br/>

  

  <input type="password" class="content_input" name="register_pass" id="register_pass" />

  <span class="asterik">*</span><br/>

  <br/>

  <?=$l['newpass']?>

  :<br/>

  <input type="password" class="content_input" name="register_pass2" id="register_pass2" />

  <span style="color: Red;">*</span><br/>

  <br/>

  <?=$l['Confirm_password']?>

  :<br/>

  <input type="password" class="content_input" name="register_pass3" id="register_pass3" />

  <span class="asterik">*</span><br/>

  <br/>

  <input type="submit" class="but" name="updatePassword" value="<?=$l['Submit']?>" onclick="return checkPassForm();" />

</form>

<?}?>

<?}?>

<?} else {?>

<center>

  <?=$l['RegComplete']?> <?=$l['RegCompletePostAd']?>

  <!--. <a href="<?=$p?>/Login"><?=$l['Log_in']?></a>-->

</center>

<?}?>

</form>

