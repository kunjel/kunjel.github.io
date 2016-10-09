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
	
	//Get currencies
	$currencies = array();
	$curr = mysql_qw('SELECT * FROM ' . DB_PREFIX."currencies". ' ') or die(mysql_error());
	while($row = mysql_fetch_assoc($curr)){
//		$currencies[] = $row['shortcode'];	
		$currencies[] = $row;
	}
?>
<div class="title"><?=$l['Settings']?></div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
<form method="post" enctype="multipart/form-data">
<div id="settings">
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td style="width: 200px; padding-top: 8px;" valign="top"><b><?=$l['General']?></b></td>
			<td valign="top" style="padding-top: 8px;" >
			    <?=$l['ProjectName']?><br/>
			    <input type="text" style="width: 100%;" name="projectName" value="<?=getSet('projectName')?>" /><br/><br/>
			    
				<input type="checkbox" name="projectNameDisplay" <? if(getSet("projectNameDisplay") == 1) echo 'checked'; else echo '';?> value="1" /> <?=$l['projectNameDisplay']?><br/><br/>
<?php $headerImage = getSet('headerImage'); ?>
<?=$l['headerImage']?><br/>
<input type="file" name="headerImage"><br/>
<?
if($headerImage!='') { ?>
<div><a href="../<?=$headerImage?>" target="_blank">Current Image</a>&nbsp;&nbsp;<input type="checkbox" name="headerImageDelete">&nbsp;<?=$l['headerImageDelete']?></div>
<br/>
<? } ?><br/>
			 	<?=$l['Skin']?><br/>
				<?php
				$dir = get_template_folders();
				?>
				<select name="skin" style="width: 200px;">
					<?php foreach($dir as $k=>$v){ ?>
						<option <?php if(getSet('skin') == $v)echo "selected"; ?> value="<?php echo $v; ?>"><?php echo ucwords($v); ?></option>
					<?php } ?>
				</select><br/><br/>						
			    <?=$l['URL']?><br/>
			    <input type="text" style="width: 100%;" name="url" value="<?=getSet('url')?>" /><br/><br/>
			    <?=$l['WebSitePath']?><br/>
			    <input type="text" style="width: 100%;" name="path" value="<?=getSet('path')?>"  disabled /><br/><br/>  
				<?=$l['AdminEmail']?><br/>
				<input type="text" style="width: 100%;" name="email" value="<?=getSet('email')?>" /><br/><br/>
				<?=$l['paypalemail']?><br/>
				<input type="text" style="width: 100%;" name="payPalEmail" value="<?=getSet('payPalEmail')?>" /><br/><br/>
				<?=$l['TimeZone']?><br/>
				<select size="1" name="timeZone">
					<option <?=csel(getSet('timeZone'), -12)?> title="[UTC - 12] Baker Island Time" value="-12">[UTC - 12] Baker Island Time</option>
					<option <?=csel(getSet('timeZone'), -11)?> title="[UTC - 11] Niue Time, Samoa Standard Time" value="-11">[UTC - 11] Niue Time, Samoa Standard Time</option>
					<option <?=csel(getSet('timeZone'), -10)?> title="[UTC - 10] Hawaii-Aleutian Standard Time, Cook Island Time" value="-10">[UTC - 10] Hawaii-Aleutian Standard Time, Cook Island Time</option>
					<option <?=csel(getSet('timeZone'), -9.5)?> title="[UTC - 9:30] Marquesas Islands Time" value="-9.5">[UTC - 9:30] Marquesas Islands Time</option>
					<option <?=csel(getSet('timeZone'), -9)?> title="[UTC - 9] Alaska Standard Time, Gambier Island Time" value="-9">[UTC - 9] Alaska Standard Time, Gambier Island Time</option>
					<option <?=csel(getSet('timeZone'), -8)?> title="[UTC - 8] Pacific Standard Time" value="-8">[UTC - 8] Pacific Standard Time</option>
					<option <?=csel(getSet('timeZone'), -7)?> title="[UTC - 7] Mountain Standard Time" value="-7">[UTC - 7] Mountain Standard Time</option>
					<option <?=csel(getSet('timeZone'), -6)?> title="[UTC - 6] Central Standard Time" value="-6">[UTC - 6] Central Standard Time</option>
					<option <?=csel(getSet('timeZone'), -5)?> title="[UTC - 5] Eastern Standard Time" value="-5">[UTC - 5] Eastern Standard Time</option>
					<option <?=csel(getSet('timeZone'), -4.5)?> title="[UTC - 4:30] Venezuelan Standard Time" value="-4.5">[UTC - 4:30] Venezuelan Standard Time</option>
					<option <?=csel(getSet('timeZone'), -4)?> title="[UTC - 4] Atlantic Standard Time" value="-4">[UTC - 4] Atlantic Standard Time</option>
					<option <?=csel(getSet('timeZone'), -3.5)?> title="[UTC - 3:30] Newfoundland Standard Time" value="-3.5">[UTC - 3:30] Newfoundland Standard Time</option>
					<option <?=csel(getSet('timeZone'), -3)?> title="[UTC - 3] Amazon Standard Time, Central Greenland Time" value="-3">[UTC - 3] Amazon Standard Time, Central Greenland Time</option>
					<option <?=csel(getSet('timeZone'), -2)?> title="[UTC - 2] Fernando de Noronha Time, South Georgia &amp; the South Sandwich Islands Time" value="-2">[UTC - 2] Fernando de Noronha Time, South Georgia &amp; the South Sandwich Islands Time</option>
					<option <?=csel(getSet('timeZone'), -1)?> title="[UTC - 1] Azores Standard Time, Cape Verde Time, Eastern Greenland Time" value="-1">[UTC - 1] Azores Standard Time, Cape Verde Time, Eastern Greenland Time</option>
					<option <?=csel(getSet('timeZone'), 0)?> title="[UTC] Western European Time, Greenwich Mean Time" value="0">[UTC] Western European Time, Greenwich Mean Time</option>
					<option <?=csel(getSet('timeZone'), 1)?> title="[UTC + 1] Central European Time, West African Time" value="1">[UTC + 1] Central European Time, West African Time</option>
					<option <?=csel(getSet('timeZone'), 2)?> title="[UTC + 2] Eastern European Time, Central African Time" value="2">[UTC + 2] Eastern European Time, Central African Time</option>
					<option <?=csel(getSet('timeZone'), 3)?> title="[UTC + 3] Moscow Standard Time, Eastern African Time" value="3">[UTC + 3] Moscow Standard Time, Eastern African Time</option>
					<option <?=csel(getSet('timeZone'), 3.5)?> title="[UTC + 3:30] Iran Standard Time" value="3.5">[UTC + 3:30] Iran Standard Time</option>
					<option <?=csel(getSet('timeZone'), 4)?> title="[UTC + 4] Gulf Standard Time, Samara Standard Time" value="4">[UTC + 4] Gulf Standard Time, Samara Standard Time</option>
					<option <?=csel(getSet('timeZone'), 4.5)?> title="[UTC + 4:30] Afghanistan Time" value="4.5">[UTC + 4:30] Afghanistan Time</option>
					<option <?=csel(getSet('timeZone'), 5)?> title="[UTC + 5] Pakistan Standard Time, Yekaterinburg Standard Time" value="5">[UTC + 5] Pakistan Standard Time, Yekaterinburg Standard Time</option>
					<option <?=csel(getSet('timeZone'), 5.5)?> title="[UTC + 5:30] Indian Standard Time, Sri Lanka Time" value="5.5">[UTC + 5:30] Indian Standard Time, Sri Lanka Time</option>
					<option <?=csel(getSet('timeZone'), 5.75)?> title="[UTC + 5:45] Nepal Time" value="5.75">[UTC + 5:45] Nepal Time</option>
					<option <?=csel(getSet('timeZone'), 6)?> title="[UTC + 6] Bangladesh Time, Bhutan Time, Novosibirsk Standard Time" value="6">[UTC + 6] Bangladesh Time, Bhutan Time, Novosibirsk Standard Time</option>
					<option <?=csel(getSet('timeZone'), 6.5)?> title="[UTC + 6:30] Cocos Islands Time, Myanmar Time" value="6.5">[UTC + 6:30] Cocos Islands Time, Myanmar Time</option>
					<option <?=csel(getSet('timeZone'), 7)?> title="[UTC + 7] Indochina Time, Krasnoyarsk Standard Time" value="7">[UTC + 7] Indochina Time, Krasnoyarsk Standard Time</option>
					<option <?=csel(getSet('timeZone'), 8)?> title="[UTC + 8] Chinese Standard Time, Australian Western Standard Time, Irkutsk Standard Time" value="8">[UTC + 8] Chinese Standard Time, Australian Western Standard Time, Irkutsk Standard Time</option>
					<option <?=csel(getSet('timeZone'), 8.75)?> title="[UTC + 8:45] Southeastern Western Australia Standard Time" value="8.75">[UTC + 8:45] Southeastern Western Australia Standard Time</option>
					<option <?=csel(getSet('timeZone'), 9)?> title="[UTC + 9] Japan Standard Time, Korea Standard Time, Chita Standard Time" value="9">[UTC + 9] Japan Standard Time, Korea Standard Time, Chita Standard Time</option>
					<option <?=csel(getSet('timeZone'), 9.5)?> title="[UTC + 9:30] Australian Central Standard Time" value="9.5">[UTC + 9:30] Australian Central Standard Time</option>
					<option <?=csel(getSet('timeZone'), 10)?> title="[UTC + 10] Australian Eastern Standard Time, Vladivostok Standard Time" value="10">[UTC + 10] Australian Eastern Standard Time, Vladivostok Standard Time</option>
					<option <?=csel(getSet('timeZone'), 10.5)?> title="[UTC + 10:30] Lord Howe Standard Time" value="10.5">[UTC + 10:30] Lord Howe Standard Time</option>
					<option <?=csel(getSet('timeZone'), 11)?> title="[UTC + 11] Solomon Island Time, Magadan Standard Time" value="11">[UTC + 11] Solomon Island Time, Magadan Standard Time</option>
					<option <?=csel(getSet('timeZone'), 11.5)?> title="[UTC + 11:30] Norfolk Island Time" value="11.5">[UTC + 11:30] Norfolk Island Time</option>
					<option <?=csel(getSet('timeZone'), 12)?> title="[UTC + 12] New Zealand Time, Fiji Time, Kamchatka Standard Time" value="12">[UTC + 12] New Zealand Time, Fiji Time, Kamchatka Standard Time</option>
					<option <?=csel(getSet('timeZone'), 12.75)?> title="[UTC + 12:45] Chatham Islands Time" value="12.75">[UTC + 12:45] Chatham Islands Time</option>
					<option <?=csel(getSet('timeZone'), 13)?> title="[UTC + 13] Tonga Time, Phoenix Islands Time" value="13">[UTC + 13] Tonga Time, Phoenix Islands Time</option>
				</select><br/><br/>
                <!--
                <?=$l['SignUp']?><br/>
                <input name="signUp" type="radio" value="1" checked> <?=$l['On']?><br/>
                <input name="signUp" type="radio" value="0"> <?=$l['Off']?><br/><br/>
                -->
				
				<?=$l['SelectLanguage']?><br/>
			    <!--<input type="text" style="width: 100%;" name="skin" value="<?=getSet('skin')?>" disabled /><br/><br/>-->
				<?php
				
				$langs = get_languages();
				?>
				<select name="defaultLanguage" style="width: 200px;">
					<?php foreach($langs as $k=>$v){ ?>
						<option <?php if(getSet('defaultLanguage') == $v)echo "selected"; ?> value="<?php echo $v; ?>"><?php echo ucwords($v); ?></option>
					<?php } ?>
				</select><br/><br/>
						<?=$l['Currency']?>&nbsp;&nbsp;<a href="<?=getSet("url")?>/admin/index.php?m=curr"><?=$l['EditCurrency']?></a><br/>
						<select size="1" name="classCurrency" style="width: 350px;">
						  <?php
						  foreach($currencies as $k=>$v){
						  ?>
						  <option value="<?=$v['shortcode']?>" <?=csel($v['shortcode'], getSet("classCurrency"))?>><?=$v['shortcode'].' - '.$v['code'].' - '.$v['country_name']?></option>
						  <?php
						  }
						  ?>
						</select><br/><br/>
<!--				
			 	<?=$l['gmapskey']?> - (<a href="http://code.google.com/apis/maps/signup.html" target="_blank"><?=$l['FreeKey']?></a>)<br/>
			    <input type="text" style="width: 100%;" name="googleMaps" value="<?=getSet('googleMaps')?>" /><br/><br/>
				
				<?=$l['DefaultCountryGoogleMaps']?><br/>
				<input type="text" style="width: 350px;" name="classDefCountry" value="<?=getSet("classDefCountry")?>" /><br/><br/>
-->				
			 	<?=$l['Licensekey']?><br/>
			    <input type="text" style="width: 100%;" name="licenseKey" value="<?=getSet('licenseKey')?>" /><br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['Recaptcha']?></b><br />&nbsp;&nbsp;<?=$l['RecaptchaBY']?></td>
			<td style="padding-top: 8px;"><?=$l['captchaPublicKey']?> - (<a href="http://www.google.com/recaptcha/whyrecaptcha" target="_blank"><?=$l['FreeKey']?></a>)<br />
				<input type="text" name="captchaPublicKey"  style="width: 100%;" value="<?=getSet('captchaPublicKey');?>" />
			</td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"></td>
			<td style="padding-top: 8px;"><?=$l['captchaPrivateKey']?><br />
				<input type="text" name="captchaPrivateKey"  style="width: 100%;" value="<?=getSet('captchaPrivateKey');?>" /><br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['Classifieds']?></b></td>
			<td style="padding-top: 8px;">
						<input type="checkbox" name="autoapproveads" <? if(getSet("autoapproveads") == 1) echo 'checked'; else echo '';?> value="1" /> <?=$l['AutoApproveAds']?><br/><br/>
						<input type="checkbox" name="showcategorycount" <? if(getSet("showcategorycount") == 1) echo 'checked'; else echo '';?> value="1" /> <?=$l['ShowCategory']?><br/><br/>
						<?=$l['CostAds']?><br/>
						<input type="text" style="width: 100px;" name="adsPrice" value="<?=getSet("adsPrice")?>" /><br/><br/>
						<?=$l['CostFirstPlace']?><br/>
						<input type="text" style="width: 100px;" name="classPrice1" value="<?=getSet("classPrice1")?>" /><br/><br/>
						<?=$l['CostBoldPlace']?><br/>
						<input type="text" style="width: 100px;" name="classPrice2" value="<?=getSet("classPrice2")?>" /><br/><br/>
						<?=$l['NumberDaysPaidAds']?><br/>
						<input type="text" style="width: 100px;" name="classPayDays" value="<?=getSet("classPayDays")?>" /><br/><br/>
						<?=$l['NumberAdsPerPage']?><br/>
						<input type="text" style="width: 100px;" name="classPerPage" value="<?=getSet("classPerPage")?>" /><br/><br/>
						<?=$l['AutoDeteteAds']?><br/>
						<input type="text" style="width: 100px;" name="autoDeleteAds" value="<?=getSet("autoDeleteAds")?>" /><br/><br/>
						<?=$l['AutoDeteteAdsCommand']?><br/>
						<input type="text"   style="width: 100%;" name="cronInstruction" value="/usr/bin/php -q <?=getSet("path")?>admin/index.php?m=cron" readonly="readonly" /><br/><br/>						
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['News']?></b></td>
			<td style="padding-top: 8px;">
				<?=$l['NewsPerPage']?> - (<a href="<?=getSet('url')?>/news" target="_blank"><?=$l['AddedNews']?></a>)<br/>
				<input type="text" style="width: 100px;" name="newsSet1" value="<?=getSet("newsPerPage")?>" /><br/><br/>
				<?=$l['NewsSymbols']?><br/>
		
				<input type="text" style="width: 100px;" name="newsSet2" value="<?=getSet("newsLength")?>" /><br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['Articles']?></b></td>
			<td style="padding-top: 8px;">
				<?=$l['ArticlesPerPage']?> - (<a href="<?=getSet('url')?>/articles" target="_blank"><?=$l['AddedArticles']?></a>)<br/>
				<input type="text" style="width: 100px;" name="articlesSet1" value="<?=getSet("articlesPerPage")?>" /><br/><br/>
		
				<?=$l['ArticlesSymbols']?><br/>
				<input type="text" style="width: 100px;" name="articlesSet2" value="<?=getSet("articlesLength")?>" /><br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['Pages']?></b></td>
			<td style="padding-top: 8px;">
				<?=$l['DefaultTitle']?><br/>
				<input type="text" style="width: 100%;" name="title2" value="<?=getSet('title2')?>" /><br/><br/>
				<?=$l['DefaultKeywords'] ?><br/>
				<input type="text" style="width: 100%;" name="keys2" value="<?=getSet('keys2')?>" /><br/><br/>
				<?=$l['DefaultDescription']?><br/>
				<input type="text" style="width: 100%;" name="descr2" value="<?=getSet('descr2')?>" /><br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['HeadMetaTitle']?></b></td>
			<td style="padding-top: 8px;">
				<?=$l['AdditionalMeta']?><br/>
			    <textarea style="width: 100%;" rows="10" name="headMeta"><?=getSet('headMeta')?></textarea><br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['CountersAndHTML']?></b></td>
			<td style="padding-top: 8px;">
				<?=$l['Counters']?><br/>
				<textarea style="width: 100%;" rows="10" name="counters"><?=getSet('counters')?></textarea><br/><br/>
			</td>
		</tr>		
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"><b><?=$l['TCSAffiliate']?></b><br/>
			&nbsp;&nbsp;<?=$l['TcsAffiliateProgram']?><br/>
			&nbsp;&nbsp;<a href="http://support.topclassifiedsoftware.com/affiliate/" target="_blank" /><?=$l['TcsAffiliateLearnMoore']?></a></td>
			<td style="padding-top: 8px;">
				<input type="checkbox" name="showAffiliateFooterLink" value="1" <?php if(getSet('ShowFooterLink')==1)echo "checked"; ?>  />  - <?=$l['showAffiliateFooterLink']?>
			</td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;"></td>
			<td style="padding-top: 8px;"><?=$l['TcsAffiliateId']?><br/>
				<input type="text" name="AffiliateID" value="<?=getSet('AffiliateID');?>" />
				<br/><br/>
			</td>
		</tr>
		<tr>
		    <td colspan="2" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;">&nbsp;</td>
			<td style="padding-top: 8px;" id="sub">
				<input type="submit" class="but" value="<?=$l['Save']?>" name="saveSettings" />
			</td>
		</tr>
	</table>
</div>
</form>
</div>