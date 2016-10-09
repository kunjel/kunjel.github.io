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

	$orders = mysql_qw('SELECT * FROM ' . DB_PREFIX."orders". ' WHERE oid=?', $_GET['oid']) or die("dont get users");

	for($us = array(); $cv = mysql_fetch_assoc($orders); $us[] = $cv);

?>

	<script>

		function showTextBox()

		{        	$("#cst").hide();

        	$("#box").show();		}

	</script>

	<form method="post">

	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 5px;">

		<tr>

			<td class="bl lh al level1" style="width: 150px;">Дата заказа</td>

			<td class="bl lh al level1"><?=date("d.m.Y", $us[0]['date'])?></td>

		</tr>

		<tr>

			<td class="bl lh level1">Им�?, фамили�?</td>

			<td class="bl lh level1"><?=$us[0]['name']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1">E-mail</td>

			<td class="bl lh al level1"><?=$us[0]['email']?></td>

		</tr>

		<tr>

			<td class="bl lh level1">Телефон</td>

			<td class="bl lh level1"><?=$us[0]['phone']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1">�?азвание</td>

			<td class="bl lh al level1"><?=$us[0]['subject']?></td>

		</tr>

		<tr>

			<td class="bl lh level1">Детали заказа</td>

			<td class="bl lh level1"><?=$us[0]['body']?></td>

		</tr>

		<tr>

			<td class="bl lh al level1">

				Стату�?

			</td>

			<td class="bl lh al level1">

				<div id="cst">

					<?=nl2br($us[0]['status'])?> <a href="javascript:showTextBox()" style="font-size: 11px; color: Blue;">Изменить</a>

				</div>

                <div id="box" style="display: none; margin-bottom: 5px; margin-top: 3px;">

                	<textarea name="status" cols="40" rows="5"><?=$us[0]['status']?></textarea>

                	<div style="padding-top: 5px;">

                		<input type="hidden" value="<?=$_GET['oid']?>" name="oid" />

                		<input type="submit" name="updateOrder" value="Сохранить" />

                	</div>

                </siv>

			</td>

		</tr>

	</table>

    </form>

