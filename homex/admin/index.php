<?php

ob_start();

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


require_once ("../includes/base.php");

//session_start();

includeScripts();

if (!isAdmin() && $_GET['m'] != "login")

	redirect("Login.php");

function getMenuClass($p)

{

	if ($p == "home" && !isset($_GET['m']))

		return "sel";

	if ($p == $_GET['m'])

		return "sel";

	return "";

}

$p = getSet("url");

$orderCount = mysql_query("SELECT COUNT(*) as co FROM cms_payments") or die("1" . mysql_error());

$orderCount = mysql_fetch_assoc($orderCount);

$orderCount = $orderCount['co'];

/*

$us = mysql_query("SELECT * FROM cms_users") or die("us" . mysql_error());

$us = mysql_fetch_assoc($us);

print_r($us);

*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head><title>

	<?=$l['CMS']?> - <?=getSet('projectName')?>

</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />

<link rel="stylesheet" href="../css/thickbox.css" type="text/css" media="screen" />

<script type="text/javascript" src="../js/base.js"></script>

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="../js/thickbox-compressed.js"></script>

<script type="text/javascript" src="js/menu.js"></script>

</head>

<body>

<div class="content">

	<table border="0" class="bgtable" cellspacing="0" cellpadding="0" width="100%">

    	<tr>

    		<td align="center">

<div class="header"><img src="images/tcs-header.jpg" /></div>

    			<table border="0" class="conttable" cellspacing="0" cellpadding="0" width="900">

    				<tr>

    					<td align="left" class="topbg">

    						<table border="0" cellspacing="0" cellpadding="0" width="100%">

    							<tr>

    								<td width="50%">

    									<?=getSet('projectName')?>

    								</td>

    						        <td width="50%" style="font-size: 13px; color: #FFF; padding-right: 10px;" align="right">

    						        	<?=$l['Hello']?> <?=$_SESSION['login']?>

    						        	&nbsp/&nbsp;<a class="white" href="../index.php?m=logout"><?=$l['Logout']?></a>

										&nbsp/&nbsp;<a href="../index.php" class="white" target="_blank"><?=$l['GoToUserPart']?></a>&nbsp;&rarr; 

    						        </td>

    							</tr>

    						</table>

    					</td>

    				</tr>

    				</tr>

    					<td style="height: 32px; background-color: #e4e4df; background-image: url('images/bgm.jpg');" valign="top">

							<ul id="jsddm">

								<li><a class="<?=getMenuClass('home')?>" href="index.php"><?=$l['Home']?></a></li>

								<li><a href="#"><?=$l['Content']?></a>

									<ul>

										<li><a href="index.php?m=classifieds"><?=$l['Classifieds']?></a></li>

										<li><a href="index.php?m=pages"><?=$l['Pages']?></a></li>

										<li><a href="index.php?m=news"><?=$l['News']?></a></li>

										<li><a href="index.php?m=articles"><?=$l['Articles']?></a></li>

										<li><a href="index.php?m=files"><?=$l['Files']?></a></li>

									</ul>

								</li>

								<li><a href="index.php?m=payments"><?=$l['Payments']?> (<?=$orderCount?>)</a></li>

								<li><a class="<?=getMenuClass('users')?>" href="index.php?m=users"><?=$l['Users']?></a></li>

								<li><a class="<?=getMenuClass('places')?>" href="index.php?m=places"><?=$l['CountryCity']?></a></li>

								<li><a class="<?=getMenuClass('banners')?>" href="index.php?m=banners"><?=$l['Banners']?></a></li>

								<li><a class="<?=getMenuClass('settings')?>" href="index.php?m=settings"><?=$l['Settings']?></a></li>

								<li><a class="<?=getMenuClass('help')?>" href="index.php?m=help"><?=$l['Help']?></a>

									<ul>

										<li><a href="info_php.php" target="help_area">PHP Info</a></li>

									</ul>

								</li>

							</ul>

							<div class="clear"></div>

    					</td>

    				</tr>

    				<tr>

    					<td valign="top" align="left" class="contmiddle">

							<div style="margin-top: 20px;" class="tbp">

								<?

									includeForms();

								?>

							</div>

    					</td>

    				</tr>

    			</table>

    		</td>

    	</tr>

    </table>

</div>

<div class="footer">

	<table border="0" cellspacing="0" cellpadding="0" width="100%">

    	<tr>

    		<td align="center">

    			<table border="0" align="center" cellspacing="0" cellpadding="0" width="900">

					<tr>

    					<td align="right" class="bottom">

    						<div style="padding-right: 15px; color: #FFF;">

    							<a href="../index.php" class="white" target="_blank"><?=$l['GoToUserPart']?></a>&nbsp;&rarr; 

    						</div>

    					</td>

    				</tr>

					</table>

    			</td>

    		</tr>

    	</table>

</div>

</body>

</html>