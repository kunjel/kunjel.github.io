<?
    $settingsFile = "../database/settings.php";
	
	if (isset($_POST['install3']))
	{
     	require_once("data.php");
     	Header("Location: index.php?step=3");
	}
	if(isset($_POST['install1']))
	{
	   $dbName = trim($_POST['dbName']);
	   $dblogin = trim($_POST['dblogin']);
	   $dbpass = trim($_POST['dbpass']);
	   $dbhost = trim($_POST['dbhost']);
	   $dbError = true;
	   $cfile = false;
       if(!@mysql_connect($dbhost, $dblogin, $dbpass))
       {
       		$error = "<center><span style='color: Red;'>Incorrect login, password or host</span></center>";
       }
       else
       {
       		if (!@mysql_select_db($dbName))
       		{
       			$error = "<center><span style='color: Red;'>Incorrect database name</span></center>";
       		}
       		else
       		{
            	$dbError = false;
            	//mysql_query('SET NAMES utf8');
       		}
       }
       if (!$dbError)
       {
			$connectCode = "<?
DEFINE('DB_LOGIN', '". $dblogin ."');
DEFINE('DB_PASSWD', '". $dbpass ."');
DEFINE('DB_HOST', '". $dbhost ."');
DEFINE('DB_NAME', '". $dbName ."');
DEFINE('DB_PREFIX', 'cms_');
?>";
			if (!@fopen($settingsFile, 'w'))
			{
				$error = "<center><span style='color: Red;'>Set correct write permissions for the file ". $settingsFile ." and click <b>Continue</b></span></center>";
				$cfile = true;
			}
			else
			{
				$fo = fopen($settingsFile, 'w');
				fwrite($fo, $connectCode);
				fclose($fo);
				Header("Location: index.php?step=2");
			}
       }
	}
	if (isset($_POST['install2']))
	{
		Header("Location: index.php?step=2");
	}
	if (isset($_POST['install4']))
	{
		
		$licensekey = $_POST['license'];
		$localkey = '';
        require_once("data2.php");
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
<script>
	function checkForm()
	{
    	var er = true;
        if (!checkField("dbName"))
        	er = false;
        if (!checkField("dblogin"))
        	er = false;
        if (!checkField("dbpass"))
        	er = false;
        if (!checkField("dbhost"))
        	er = false;
    	return er;
	}
	function checkForm2()
	{
    	var er = true;
        if (!checkField("pName"))
        	er = false;
        if (!checkField("url"))
        	er = false;
        if (!checkField("email"))
        	er = false;
        if (!checkField("password"))
        	er = false;
        if (!checkField("password2"))
        	er = false;
         if (!checkField("license"))
        	er = false;
        if (!checkField("path"))
        	er = false;
         if (!checkCompareField("password", "password2"))
        	er = false;
    	return er;
	}
</script>
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
								<h3>Installation Step 1</h3>
								<a href="http://support.topclassifiedsoftware.com/knowledgebase/3/Installation-instructions.html" target="_blank">Installation instruction here</a><br/><br/>
								Database Name<br/>
								<input name="dbName" id="dbName" type="text" value="<?=$dbName?>" style="width: 250px;" /><br/><br/>
								Database User<br/>
		                        <input name="dblogin" id="dblogin" type="text" value="<?=$dblogin?>" style="width: 250px;" /><br/><br/>
								Database Password<br/>
		                        <input name="dbpass" type="text" id="dbpass" value="<?=$dbpass?>" style="width: 250px;" /><br/><br/>
								Location <small>(This is localhost 99% of the time)</small><br/>
								<input name="dbhost" type="text" id="dbhost" value="<?=$dbhost?>" style="width: 250px;" /><br/><br/>
								<input type="submit" name="install1" value="Continue > " onclick="return checkForm()" />
							</td>
						</tr>
					</table>
                    <center>
						<?if(strlen($error) > 0) {?>
						   <div style="padding-top: 10px;"><b><?=$error?></b></div>
						<?}?>
						<?if($cfile) {?>
						   <br/>
						   <span style="color: Red;">Or<br/><br/><b>put the folowing code into the "<?=$settingsFile?>" file and click <u>Next step</u>:</b></span><br/>
						   <textarea cols="60" rows="10"><?=$connectCode?></textarea><br/>
						   <input type="submit" name="install2" value="Next step > " onclick="return checkForm()" />
						<?}?>
					</center>
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
                             	<h3>Installation Step 2</h3>
                             	Connection is successfully established.<br/><br/>
                             	Click "Start install".<br/><br/>
                             	<input type="submit" value="Start install > " name="install3" />
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
								<?
									$wu = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                                    $wu = str_replace('/install/index.php', '', $wu);
                                    $wu = str_replace('www.', '', $wu);
								?>
                             	<h3>Installation Step 3</h3>
                             	Site name:<br/>
                             	<input name="pName" id="pName" type="text" value="<?=$pName?>" style="width: 250px;" /><br/><br/>
                             	Website URL<br/>
                             	<input name="url" id="url" type="text" value="<?=$wu?>" style="width: 250px;" /><br/><br/>
                             	Admin e-mail:<br/>
                             	<input name="email" id="email" type="text" value="<?=$email?>" style="width: 250px;" /><br/><br/>
                             	Admin login:<br/>
                             	<input name="email" id="email" type="text" value="admin" style="width: 250px;" disabled /><br/><br/>
                             	Admin password:<br/>
                             	<input name="password" id="password" type="password" value="<?=$password?>" style="width: 250px;" /><br/><br/>
                             	Confirm admin password:<br/>
                             	<input name="password2" id="password2" type="password" value="<?=$password2?>" style="width: 250px;" /><br/><br/>
                             	License key: <small>(Need help, <a href="http://support.topclassifiedsoftware.com/knowledgebase/2/License-keys.html" target="_blank">click here</a>)</small><br/>
                             	<input name="license" id="license" type="text" value="<?=$license?>" style="width: 250px;" /><br/><br/>
                             	<input name="path" id="path" type="hidden" value="<?= str_replace('install/index.php', '', $_SERVER[SCRIPT_FILENAME])?>" style="width: 250px;" />
                                <input type="submit" name="install4" value="Finish > " onclick="return checkForm2()" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
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
								<center>
									<h3>Script was successfully installed</h3>
									<span style="color: Red; font-size: 18px;">Please delete "<b>install</b>" folder</span><br/><br/>
									<b>></b> <a href="../admin/index.php">Login as admin and customize your settings</a> <b><</b><br /><br />
								</center>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?}?>
</form>