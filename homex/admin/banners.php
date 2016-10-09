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
?>
<div class="title"><?=$l['Banners']?></div>
<div clear="both"></div>
<div ><?=$l['BannerInstructions']?><br /><br />
Google AdSense - <a href="https://www.google.com/adsense" target="_blank">https://www.google.com/adsense</a><br />
Amazon Associates - <a href="https://affiliate-program.amazon.com/" target="_blank">https://affiliate-program.amazon.com</a><br />
eBay Partner Network - <a href="https://www.ebaypartnernetwork.com/files/hub/en-US/index.html" target="_blank">https://www.ebaypartnernetwork.com/files/hub/en-US/index.html</a><br />
Afinity Click - <a href="http://www.affinityclick.com" target="_blank">http://www.affinityclick.com</a><br />
Ad Dynamo - <a href="http://www.addynamo.com" target="_blank">http://www.addynamo.com</a><br />
Chitika - <a href="http://chitika.com" target="_blank">http://chitika.com</a><br />
<br /><br />
</div>
<?if ($_GET['mode'] == "saved") {?>
   <div class="ok"><?=$l['Saved']?></div>
<?}?>
<form method="post">
<div id="banners">
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td width="300" valign="top" style="width: 300px; padding-top: 8px;"><b><?=$l['TopBanner']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['TopBannerCode']?><br/>
				<textarea name="topbannercode" rows="10" cols="60"><?=getSet('TopBannerCode')?></textarea> <img src="images/TopBanner.jpg" width="180px" /><br/><br/></td>
		</tr>
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="width: 200px; padding-top: 8px;"><b><?=$l['LeftBanner']?></b></td>
			<td width="203" valign="top" style="padding-top: 8px;" >
			    <?=$l['LeftBannerCode']?><br/>
			    <textarea name="leftbannercode" rows="10" cols="60"><?=getSet('LeftBannerCode')?></textarea>
			    <br /><br /></td>
	      <td width="452" valign="top" style="padding-top: 8px;" ><br />
		      <img src="images/LeftBannerTop.jpg" width="180px" />
	      <br /><br /></td>
		</tr>
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>		
		
		<tr>
			<td width="300" valign="top" style="width: 300px; padding-top: 8px;"><b><?=$l['LeftBottomBanner']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['LeftBottomBannerCode']?><br/>
				<textarea name="leftbottombannercode" rows="10" cols="60"><?=getSet('LeftBottomBannerCode')?></textarea> <img src="images/LeftBannerBottomNew.jpg" width="180px" /><br/><br/></td>
		</tr>
		
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td style="width: 200px; padding-top: 8px;" valign="top"><b><?=$l['RightDashboard']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['RightBannerCode']?><br/>
			    <textarea name="rightbannercode" rows="10" cols="60"><?=getSet('RightBannerCode')?></textarea><img src="images/RightDashboard.jpg" width="180px" /><br/><br/>			</td>
		</tr>
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td style="width: 200px; padding-top: 8px;" valign="top"><b><?=$l['TopClassified']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['TopClassifiedCode']?><br/>
			    <textarea name="topclassifiedcode" rows="10" cols="60"><?=getSet('TopClassifiedCode')?></textarea><img src="images/TopClassified.jpg" width="180px" /><br/><br/>			</td>
		</tr>
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td style="width: 200px; padding-top: 8px;" valign="top"><b><?=$l['RightClassified']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['RightClassifiedCode']?><br/>
			    <textarea name="rightclassifiedcode" rows="10" cols="60"><?=getSet('RightClassifiedCode')?></textarea><img src="images/RightClassified.jpg" width="180px" /><br/><br/>			</td>
		</tr>		
				<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td style="width: 200px; padding-top: 8px;" valign="top"><b><?=$l['BottomClassified']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['BottomClassifiedCode']?><br/>
			    <textarea name="bottomclassifiedcode" rows="10" cols="60"><?=getSet('BottomClassifiedCode')?></textarea><img src="images/BottomClassified.jpg" width="180px" /><br/><br/>			</td>
		</tr>	
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td style="width: 200px; padding-top: 8px;" valign="top"><b><?=$l['RightClassifiedDetails']?></b></td>
			<td colspan="4" valign="top" style="padding-top: 8px;" >
			    <?=$l['RightClassifiedDetailsCode']?><br/>
			    <textarea name="rightclassifieddetailscode" rows="10" cols="60"><?=getSet('RightClassifiedDetailsCode')?></textarea><img src="images/RightClassifiedDetails.jpg" width="180px" /><br/><br/>			</td>
		</tr>	
		<tr>
		    <td colspan="5" class="line"><img src="images/pix.gif" /></td>
		</tr>
		<tr>
			<td valign="top" style="padding-top: 8px;">&nbsp;</td>
			<td colspan="4">
				<input type="submit" class="but" value="<?=$l['Save']?>" name="saveSettings" />			</td>
		</tr>
	</table>
</div>
</form>
</div>
