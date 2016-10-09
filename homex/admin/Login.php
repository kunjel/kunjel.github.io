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

require_once ("../includes/base.php");

global $l;

?>

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>

<title>

<?=$l['CMS']?>

-

<?=getSet('projectName')?>

</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" href="../css/thickbox.css" type="text/css" media="screen" />

<script type="text/javascript" src="../js/base.js"></script>

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="js/corner.js"></script>

<style>

	input

	{

		height: 30px;

	}

</style>

</head>

		<table style="height: 100%; width: 100%;" border="0" cellspacing="0" cellpadding="0" align="center">

			<tr>

				<td style="height: 100%;" align="center">

					<table style="width: 300px;" border="0" cellspacing="0" cellpadding="0" align="center">

						<tr>

							<td><div align="center"><img src="../admin/images/tcs-header-sm.jpg" /></div></td>

						</tr>

						<tr>

							<td style="height: 15px; background-color: #86AD37;"></td>

						</tr>

					</table>

					<table class="conttable" style="width: 300px;" border="0" cellspacing="5" cellpadding="5">

						<tr>

							<td align="left">

	<center>

        <span class="error_login">

        <?

				if ($_GET["incpass"] == "true")

					echo $l['IncorLoginOrPassword'];

				?>

        </span>

      </center>

          <form method="post" action="../index.php">

              <?=$l['Login']?>:<br/>

              <input name="auth_login" type="text" style="width: 250px;">

              <br/>

              <br/>

              <?=$l['Password']?>:<br/>

              <input name="auth_passwd" type="password" style="width: 250px;">

              <br/>

              <br/>

              <input type="submit" class="but" name="auth" value=" <?=$l['log_in']?> " />

          </form>

							</td>

						</tr>

					</table>

				</td>

			</tr>

		</table>

</body>

</html>

