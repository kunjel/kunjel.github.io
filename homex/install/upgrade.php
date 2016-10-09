<?
require_once("../database/settings.php");
$db_connect = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWD);
if( !$db_connect || !mysql_select_db( DB_NAME ) )
{
    echo "Incorrect database connection data";
    exit();
}
	if (isset($_POST['install1']))
	{
     	Header("Location: upgrade.php?step=2");
	}


	if (isset($_POST['install2']))
	{
	     if(isset($_POST['upgrade']) && $_POST['upgrade']==2)
     	    require_once("upgrade4.1-4.2.php");
     	else
     	    require_once("upgrade4.0-4.1.php");
     	    
     	Header("Location: upgrade.php?step=3");
	}
?>
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
                             	<h3>Step 1 of 3 - Confirmation<br/></h3>
								Please ensure your current database has been properly backed up.<br/>
                             	<br/><center>
                                <a href="http://support.topclassifiedsoftware.com/knowledgebase/5/How-to-backup-or-restore-your-MySQL-database.html" target="_blank">Click here for database backup<br/> instructions for cPanel control panel</a><br/><small>- opens in new window -</small></center><br/>
								
								I understand the risk of data loss and confirm that the database has been properly backed up.<br/><br/>		
														
								<center><input type="submit" name="install1" value=" Click To Confirm " /></center>
							
                            </td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

	<?} else if ($_GET['step'] == "2") {?>
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
                             	<h3>Step 2 of 3 - Upgrade Database<br/></h3>
								Last chance before update.  Please ensure your database has been properly backed up.
								<br/><br/>
								<center>
                                <a href="http://support.topclassifiedsoftware.com/knowledgebase/5/How-to-backup-or-restore-your-MySQL-database.html" target="_blank">Click here for database backup<br/> instructions for cPanel control panel</a><br/><small>- opens in new window -</small></center><br/>
								When ready, select which version update you need then click the 'Upgrade Database' button below to continue.<br/><br/>
								<center>
                                <a href="http://support.topclassifiedsoftware.com/knowledgebase/12/How-to-determine-current-version.html" target="_blank">Click here for instructions on <br/>how to determine your current version</a><br/><small>- opens in new window -</small></center><br/>
								
								
								<br/>
								<center><strong>Select version upgrade:</strong><br/>
								<input type="radio" name="upgrade" value="1" checked style="padding-top:10px;">4.0 to 4.1
								<br/>
								<input type="radio" name="upgrade" value="2">4.1 to 4.2
								<br/><br/>								
                             	<input type="submit" value="Upgrade Database > " name="install2" /></center>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?} else if ($_GET['step'] == "3") {?>
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
								<center>
									<h3>Database upgrade was successful</h3>
									<span style="color: Red; font-size: 18px;">Please delete "<b>install</b>" folder</span><br/><br/>
									<b>-</b> <a href="../admin/index.php">Login as admin and customize your settings</a> <b>-</b><br /><br />
								</center>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?}?>
</form>