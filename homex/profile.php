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
	if (isset($_POST['sh']))
	{
		if ($_POST['showOnly'] == "1")
			mysql_query("UPDATE cms_users SET myCity=1") or die(mysql_error());
		else
			mysql_query("UPDATE cms_users SET myCity=0") or die(mysql_error());
	}
	if (isset($_GET['uid']) && is_numeric($_GET['uid']))
	{
		$auth_user = mysql_qw('SELECT * FROM ' . DB_PREFIX."users" . ' WHERE uid=? LIMIT 1', $_GET['uid']) or die(mysql_error());
		$auth_user_data = mysql_fetch_assoc( $auth_user );
		$usid = $_GET['uid'];
	}
    else
    {
    	$user_login  =  trim( $_SESSION['login'] );
    	$auth_user = mysql_qw('SELECT * FROM ' . DB_PREFIX."users" . ' WHERE login=? LIMIT 1', $user_login) or die(mysql_error());
        $auth_user_data = mysql_fetch_assoc( $auth_user );
    	$usid = $_SESSION['uid'];
    }
	$ucCountry = $auth_user_data['country'];
    $ucCity = $auth_user_data['city'];
    $myCity = $auth_user_data['myCity'];
	if ($auth_user_data['countryId'] > 0)
	{
		$ucCountry = mysql_query("SELECT name2, cid FROM cms_countries WHERE cid=". $auth_user_data['countryId']) or die(mysql_error());
		$ucCountry = mysql_fetch_assoc($ucCountry);
		$ucCountry = $ucCountry['name2'];
	}
	if ($auth_user_data['stateId'] > 0)
	{
		$ucCity = mysql_query("SELECT name2, cid FROM cms_states WHERE cid=". $auth_user_data['stateId']) or die(mysql_error());
		$ucCity = mysql_fetch_assoc($ucCity);
		$ucState = $ucCity['name2'];
	}
	
	if ($auth_user_data['cityId'] > 0)
	{
		$ucCity = mysql_query("SELECT name2, cid FROM cms_cities WHERE cid=". $auth_user_data['cityId']) or die(mysql_error());
		$ucCity = mysql_fetch_assoc($ucCity);
		$ucCity = $ucCity['name2'];
	}
?>
<div class="title" class="padding_bottom_10">
  <?=$l['Profile']?>
</div>
<?require_once "navigation.php"; ?>
<div class="profile_container">
  <?if(strlen($auth_user_data['photo']) > 0) {?>
  <div class="photo_div"> <img src="upload/s_<?=$auth_user_data['photo']?>" style="border: 1px solid #d9b94a;"> </div>
  <?}?>
  <div class="profile_content_div">
    <div class="title">
      <?=htmlspecialchars($auth_user_data['login'])?>
    </div>
    <div style="clear:both;"></div>
    <div class="left_column_profile">
      <?=$l['Name']?>
      :
      <?=htmlspecialchars($auth_user_data['firstname'])?>
      <br/>
      <?=$l['Last_name']?>
      :
      <?=htmlspecialchars($auth_user_data['lastname'])?>
      <br/>
      E-mail:
      <?=htmlspecialchars($auth_user_data['mail'])?>
      <br/>
    </div>
    <div class="left_column_profile">
      <?=$l['Country']?>
      :
      <?=$ucCountry?>
      <!--<?=$auth_user_data['country']?>-->
      <br/>
      <?=$l['City']?>
      :
      <?=$ucCity?>
      <!--<?=$auth_user_data['city']?>-->
      <br/>
      <?=$l['us_state']?>
      :
      <?=$ucState?>
      <!--<?=$auth_user_data['city']?>-->
      <br/>
      <!--
	<?=$l['Address']?>: <?=$auth_user_data['adress']?><br/>
	<?=$l['Zip']?>: <?=$auth_user_data['zip']?>
	ICQ: <?=htmlspecialchars($auth_user_data['icq'])?><br/>
	Skype: <?=htmlspecialchars($auth_user_data['skype'])?><br/>
	<?=$l['phone']?>: <?=htmlspecialchars($auth_user_data['phone'])?><br/>
	<?=$l['Fax']?>: <?=htmlspecialchars($auth_user_data['fax'])?><br/>
	<?=$l['mob']?>: <?=htmlspecialchars($auth_user_data['mob'])?><br/>
                        -->
    </div>
    <div style="clear:both;"></div>
  </div>
</div>
<div style="clear:both;"></div>
<br/>
<form method="post">
  <input name="showOnly" type="checkbox" value="1" onclick="this.form.submit()" <?if($myCity == 1) {?>checked<?}?> />
  <?=$l['ShowOnly']?>
  <br/>
  <input name="sh" type="hidden" value="">
</form>
<br/>
<a class="sm" href="Signup/edit">
<?=$l['EditProfile']?>
</a> 
