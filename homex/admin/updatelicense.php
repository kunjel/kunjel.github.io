<?
    $settingsFile = "../database/settings.php";
	if(isset($_POST['install1']))
	{
     	Header("Location: index.php?step=2");
	}
//	if(isset($_POST['install2']))
//	{
//		require_once("data.php");
//    	Header("Location: index.php?step=3");
//	}
	if(isset($_POST['install3']))
	{
   require_once("../database/settings.php");
 $db_connect = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWD);
 
   if( !$db_connect || !mysql_select_db( DB_NAME ) )
   {
      echo "Incorrect database connection data";
      exit();
   }
   
//Need sql to save new liense key
//echo "UPDATE cms_settings SET `svalue` = '" . trim($_POST['license']) . "' WHERE `sname`='licenseKey'";exit;
   mysql_query("UPDATE cms_settings SET `svalue` = '" . trim($_POST['license']) . "' WHERE `sname`='licenseKey'") or die(mysql_error());
     	Header("Location: index.php?step=4");
	}
?>
<script type="text/javascript" src="../js/base.js"></script>
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" href="../admin/css/style.css" type="text/css" media="screen" />
<style>
	input
	{
		height: 30px;
	}
</style>
<form method="post">
	<?if(!isset($_GET['step'])) {?>
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
					<table class="conttable" style="width: 300px;" border="0" cellspacing="0" cellpadding="5">
						<tr>
							<td align="left">
								<h3>Enter New License</h3>
								Failure to enter the correct license key will create a license error on your site.<br/><br/>
								Please enter the new license key:<br/><small>(Need help, <a href="http://support.topclassifiedsoftware.com/knowledgebase/2/License-keys.html" target="_blank">click here</a>)</small><br/><br/>
                             	<input name="license" id="license" type="text" value="<?=@$license?>" style="width: 250px;" /><br/><br/>
								<input type="submit" name="install3" value=" Save New License Key " />
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?} else if ($_GET['step'] == "2") {?>
	<?} else if ($_GET['step'] == "3") {?>
	<?} else if ($_GET['step'] == "4") {?>
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
					<table class="conttable" style="width: 300px;" border="0" cellspacing="0" cellpadding="5">
						<tr>
							<td align="left">
                             	<h3>License Key Update Successfull<br/></h3>
								<p>Next Steps:<br/><br/>
								Login to your admin area.<br/>
								<center>
								>> <a href="../admin/index.php">Click Here For Your Admin Area</a> <<
								</center><br/>
								</p>
                            </td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?}?>
</form>