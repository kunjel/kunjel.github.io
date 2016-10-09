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


	require_once "../../includes/base.php";

	global $l;

	$users = mysql_qw('SELECT * FROM ' . DB_PREFIX."users". ' WHERE uid=?', $_GET['uid']) or die("dont get users");

	for($us = array(); $cv = mysql_fetch_assoc($users); $us[] = $cv);

	$ucCountry = $us[0]['country'];

    $ucCity = $us[0]['city'];

	if ($us[0]['countryId'] > 0)

	{

		$ucCountry = mysql_query("SELECT name2, cid FROM cms_countries WHERE cid=". $us[0]['countryId']) or die(mysql_error());

		$ucCountry = mysql_fetch_assoc($ucCountry);

		$ucCountry = $ucCountry['name2'];

	}

	if ($us[0]['cityId'] > 0)

	{

		$ucCity = mysql_query("SELECT name2, cid FROM cms_cities WHERE cid=". $us[0]['cityId']) or die(mysql_error());

		$ucCity = mysql_fetch_assoc($ucCity);

		$ucCity = $ucCity['name2'];

	}

?>

<?if($_GET['mode'] != "edit") {?>

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<tr>

			<td class="bl lh al level1" style="width: 150px;"><?=$l['Login']?></td>

			<td class="bl lh al level1"><?=$us[0]['login']?></td>

		</tr>

		<tr>

			<td class="bl lh level1">E-mail</td>

			<td class="bl lh level1"><?=$us[0]['mail']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['FirstName']?></td>

			<td class="bl lh al level1"><?=$us[0]['firstname']?></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['LastName']?></td>

			<td class="bl lh level1"><?=$us[0]['lastname']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['Country']?></td>

			<td class="bl lh al level1"><?=$ucCountry?><!--<?=$us[0]['country']?>--></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['City']?></td>

			<td class="bl lh level1"><?=$ucCity?><!--<?=$us[0]['city']?>--></td>

		</tr>

		<!--<tr>

			<td class="bl lh level1"><?=$l['Region']?></td>

			<td class="bl lh level1"><?=$us[0]['region']?></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['Address']?></td>

			<td class="bl lh level1"><?=$us[0]['adress']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['Zip']?></td>

			<td class="bl lh al level1"><?=$us[0]['zip']?></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['Phone']?></td>

			<td class="bl lh level1"><?=$us[0]['phone']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['Fax']?></td>

			<td class="bl lh al level1"><?=$us[0]['fax']?></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['Mobile']?></td>

			<td class="bl lh level1"><?=$us[0]['mob']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1">ICQ</td>

			<td class="bl lh al level1"><?=$us[0]['icq']?></td>

		</tr>

		<tr>

			<td class="bl lh level1">Skype</td>

			<td class="bl lh level1"><?=$us[0]['skype']?></td>

		</tr> -->

		<tr>

			<td class="bl lh al level1"><?=$l['SignupDate']?></td>

			<td class="bl lh al level1"><?=date("d.m.Y", $us[0]['regDate'])?></td>

		</tr>

		<?if(strlen($us[0]['lastLoginDate']) > 0) {?>

		<tr>

			<td class="bl lh level1"><?=$l['LastLoginDate']?></td>

			<td class="bl lh level1"><?=date("d.m.Y", $us[0]['lastLoginDate'])?></td>

		</tr>

		<?}?>

	</table>

<?} else {?>

<script>

	function checkForm()

	{

    	var er = true;

        if (!checkField("password1"))

        	er = false;

        if (!checkField("password2"))

        	er = false;

        if (!checkCompareField("password1", "password2"))

        	er = false;

    	return er;

	}

</script>

	<form method="post">

	<table border="0" cellpadding="0" cellspacing="0" width="100%">

		<tr>

			<td class="bl lh al level1" style="width: 150px;"><?=$l['Login']?></td>

			<td class="bl lh al level1"><input type="text" name="login" style="width: 320px;" value="<?=$us[0]['login']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1">E-mail</td>

			<td class="bl lh level1"><input type="text" name="email" style="width: 320px;" value="<?=$us[0]['mail']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['FirstName']?></td>

			<td class="bl lh al level1"><input type="text" name="fname" style="width: 320px;" value="<?=$us[0]['firstname']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['LastName']?></td>

			<td class="bl lh level1"><input type="text" name="lname" style="width: 320px;" value="<?=$us[0]['lastname']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['Country']?></td>

			<td class="bl lh al level1"><input type="text" name="country" style="width: 320px;" value="<?=$ucCountry?>" disabled /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['City']?></td>

			<td class="bl lh level1"><input type="text" name="city" style="width: 320px;" value="<?=$ucCity?>" disabled /></td>

		</tr>

		<!--

		<tr>

			<td class="bl lh level1"><?=$l['Region']?></td>

			<td class="bl lh level1"><input type="text" name="region" style="width: 320px;" value="<?=$us[0]['region']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['Address']?></td>

			<td class="bl lh level1"><input type="text" name="adress" style="width: 320px;" value="<?=$us[0]['adress']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['Zip']?></td>

			<td class="bl lh al level1"><input type="text" name="zip" style="width: 320px;" value="<?=$us[0]['zip']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['Phone']?></td>

			<td class="bl lh level1"><input type="text" name="phone" style="width: 320px;" value="<?=$us[0]['phone']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['Fax']?></td>

			<td class="bl lh al level1"><input type="text" name="fax" style="width: 320px;" value="<?=$us[0]['fax']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['Mobile']?></td>

			<td class="bl lh level1"><input type="text" name="mob" style="width: 320px;" value="<?=$us[0]['mob']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh al level1">ICQ</td>

			<td class="bl lh al level1"><input type="text" name="icq" style="width: 320px;" value="<?=$us[0]['icq']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1">Skype</td>

			<td class="bl lh level1"><input type="text" name="skype" style="width: 320px;" value="<?=$us[0]['skype']?>" /></td>

		</tr>-->

		<tr>

			<td class="bl lh al level1"><input type="hidden" value="<?=$_GET['uid']?>" name="uid" /></td>

			<td class="bl lh al level1"><input type="submit" name="updateProfile" value="<?=$l['Save']?>" /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><b><?=$l['Password']?></b></td>

			<td class="bl lh level1">&nbsp;</td>

		</tr>

		<tr>

			<td class="bl lh al level1"><?=$l['NewPassword']?></td>

			<td class="bl lh al level1"><input type="password" name="password1" id="password1" style="width: 320px;" /></td>

		</tr>

		<tr>

			<td class="bl lh level1"><?=$l['ConfirmNewPassword']?></td>

			<td class="bl lh level1"><input type="password" name="password2" id="password2" style="width: 320px;" /></td>

		</tr>

		<tr>

			<td class="bl lh al level1">&nbsp;</td>

			<td class="bl lh al level1"><input type="submit" name="updatePasword" value="<?=$l['Save']?>" onclick="return checkForm();" /></td>

		</tr>

	</table>

    </form>

<?}?>