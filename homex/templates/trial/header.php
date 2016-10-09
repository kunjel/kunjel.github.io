<?
	$tpath = $p . "/templates/". $skin ."";
?><!DOCTYPE html>
<html>
<head>
<!-- FUnction to show different titles -->
<?php
//print_r($_GET);
if(isAuth())
{
    $unread_message_rs = mysql_qw("SELECT COUNT(*) as total, (SELECT COUNT(*) as unread FROM cms_inbox WHERE toUid=".$_SESSION['uid']." AND isRead=1) as unread FROM cms_inbox WHERE toUid=".$_SESSION['uid']) or die(mysql_error());
    $unread_message_row = mysql_fetch_assoc($unread_message_rs);
    $unread_messages    = $unread_message_row['unread'];
}
$p1 = "";
if (!isset($_GET['page'])){
	$thisCat = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' WHERE url=?', $_GET['mode']) or die("dont get categories");
	$thisCat = mysql_fetch_assoc($thisCat);
	$page1 = $thisCat['name2'];
	
}
else{
	$p1 = explode("-",$_GET['page']);
	$page1 = implode(" ",$p1);
}
if($page1!="")
$page1 = $page1." - ";
?>
<title>
	<?if(strlen($title) <= 0) {?><?=$page1.getSet("title2");?><?} else echo $page1.$title; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="<?if(strlen($descr) <= 0) {?><?=getSet("descr2")?><?} else echo $descr; ?>" name="description">
<meta content="<?if(strlen($keys) <= 0) {?><?=getSet("keys2")?><?} else echo $keys; ?>" name="keywords">
<?=getSet("headMeta")?>
<link rel="stylesheet" href="<?=$tpath?>/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$p?>/css/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=$p?>/js/base.js"></script>
<script type="text/javascript" src="<?=$p?>/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?=$p?>/js/thickbox-compressed.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
function toggleDiv(divId) {
   $("#"+divId).fadeToggle(200, 'swing');
}
</script>
</head>

<body>

	<div id="topbar">
		<?if(!isAuth()) {?>
		<!-- <form method="post">
			<?=$l['Login']?> <input type="text" name="log_x" class="login" /> <?=$l['Password']?> <input type="password" name="pass_x" class="login" />&nbsp;<input type="submit" value="<?=$l['Login']?>" name="auth_x" class="toplogbut" />
		</form> -->
		<a class="mc" href="javascript:toggleDiv('loginbox');">Log in</a>
		<div style="width: 750px; margin: auto; position: relative;">
		<div id="loginbox">
		The content in this div will hide and show (toggle) when the toggle is pressed. 
		</div>
		</div>
	<?} else {?>
	   <span style="float: left;">Hello, <?=htmlspecialchars($_SESSION['login'])?>!</span>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/myAds"><?=$l['myAds']?></a><? if($unread_messages==0) { ?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/Inbox"><?=$l['messages']?></a><? } else { ?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/Inbox"><?=$l['newmessages']?></a><? } ?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/Profile"><?=$l['Profile']?></a>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/logout"><?=$l['Logout']?></a><?if(isAdmin()) {?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/admin/index.php"><?=$l['Administration']?></a><?}?>
	<?}?>
	</div>

	<div id="content">

		<div id="header">
			<div id="head">
			<h1>Codename HomeX</h1>
			</div>
			
			<div id="nav">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
				<li style="margin-right: 0;"><a href="#">Link 1</a></li>
			</ul>
			</div>
		</div>
	</div>