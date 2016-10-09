<?
	$tpath = $p . "/templates/". $skin ."";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
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
</head>
<body onload="initialize()" onunload="GUnload()">
<div align="center">
<!-- Top Banner Start -->
<? if(getSet("TopBannerCode")!="") {?><?=getSet("TopBannerCode")?><? }?>
<!-- Top Banner End -->
<div class="site_container">
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec5ce02331b92fd"></script>
  <div id="search_box" style="margin-bottom: 5px;">
    <?if(!isAuth()) {?>
		<form method="post">
			<?=$l['Login']?> <input type="text" name="log_x" class="login" /> <?=$l['Password']?> <input type="password" name="pass_x" class="login" />&nbsp;<input type="submit" value="<?=$l['Login']?>" name="auth_x" class="toplogbut" />
		</form>
	<?} else {?>
	   <?=$l['hello']?> <?=htmlspecialchars($_SESSION['login'])?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/myAds"><?=$l['myAds']?></a><? if($unread_messages==0) { ?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/Inbox"><?=$l['messages']?></a><? } else { ?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/Inbox"><?=$l['newmessages']?></a><? } ?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/Profile"><?=$l['Profile']?></a>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/logout"><?=$l['Logout']?></a><?if(isAdmin()) {?>&nbsp;&nbsp;&nbsp;<a class="mc" href="<?=$p?>/admin/index.php"><?=$l['Administration']?></a><?}?>
	<?}?>
  </div>
<div  class="seperator" style="clear: both;"></div>
<?php $headerImage = getSet('headerImage'); ?>
<div class="header" <?=($headerImage!='' ? 'style="background-image: url('.$p.'/'.$headerImage.');"' : '')?>>
    <div class="header_title"> <br />
	 <h1><?=(getSet('projectNameDisplay')==1 ? getSet('projectName') : '')?></h1>
    </div>
    <div class="header_search_box" style="display:none"> <br />
      <form method="post" action="<?=$p?>/Classified">
        <div class="search_container">
          <input name="searchText" type="text" class="search" value="<?=$l['SearchField']?>" onblur="if(this.value=='') this.value='Search...';" onfocus="if(this.value=='Search...') this.value='';" />
        </div>
        <div class="search_container_button">
          <input type="image" src="<?=$tpath?>/images/search.gif" name="search" />
        </div>
      </form>
		<div class="advanced_link"><a href="<?=$p?>/aSearch" class="wh"><?=$l['advancedSearchLink']?></a></div>
    </div>
	<?php
	$menu = mysql_query("SELECT * FROM cms_pages where menushow='1' and url!='myAds' order by weight asc") or die(mysql_error());
	$num_of_pages = mysql_num_rows($menu);	
	$cls = "top_menu";
	if($num_of_pages<=10){
		$cls = "top_menu1";
	}
	?>
	<div class="top_menu">
      <?php 
	  
	  while($menus = mysql_fetch_assoc($menu)){
	  		if($menus['url'] == 'signup'){
			?>
			<?if(!isAuth()) {?><div class="menu_links"><a href="<?=$p?>/<?=$menus['url']?>" class="top"><?=$menus['name2']?></a></div><?}?>
			<?if(isAuth() && 1==2) {?><div class="menu_links"><a href="<?=$p?>/Profile" class="top"><?=$l['profile']?></a></div><?}?>
			<?php
			}
			else if($menus['url'] == 1){
			?>
			<div class="menu_links"><a href="<?=$p?>/index.php" class="top"><?=$menus['name2']?></a></div>
			<?php	
			} else if($menus['url'] == 'Login'){
			?>
			<?if(!isAuth()) {?><div class="menu_links"><a href="<?=$p?>/<?=$menus['url']?>/" class="top"><?=$menus['name2']?></a></div><?}?>
			<?php	
			} else {
			?>
			<div class="menu_links"><a href="<?=$p?>/<?=$menus['url']?>/" class="top"><?=$menus['name2']?></a></div>
			<?php	
			}
			
	  }
	  ?>
	  <div>&nbsp;</div>
    </div>
  </div>
  <div  class="seperator"></div>
  <div id="left_column">
    <div class="header_search_box"> 
      <form method="post" action="<?=$p?>/Classified">
        <div class="search_container">
          <input name="searchText" type="text" class="search" value="<?=$l['SearchField']?>" onblur="if(this.value=='') this.value='Search...';" onfocus="if(this.value=='Search...') this.value='';" />
        </div>
        <div class="search_container_button" align="center">
          <input type="image" src="<?=$tpath?>/images/search.gif" name="search" />
        </div>
      </form>
<!--		<div class="advanced_link"><a href="<?=$p?>/aSearch" class="wh"><?=$l['advancedSearchLink']?></a></div>-->
    </div>
  	<div class="left_menu_divider">
		<?for($i = 0; $i < count($cc); $i++) {?>
			<div class="dmenu">
				<a class="lmenu" href="<?=$p?>/Classified/<?=clean_accents($cc[$i]['url'])?>/"><?=$cc[$i]['name' . langId()]?><span><?=$cc[$i]['count']?></span></a>
			</div>
		<?}?>
	</div>
	<div class="listing_area">
<!-- Left Banner Top Option Start -->
	<? if(getSet("LeftBannerCode")!="") {?>
	<div align="center"><br /><?=getSet("LeftBannerCode")?></div>
	<? }?>
<!-- Left Banner Top Option End-->
		<div class="pading">
			<div class="new_listing"><?=$l['newListings']?></div>
			<? for($i = 0; $i<count($ni); $i++) {?>
				<div class="pading">
					<center>
					<div class="padding_bottom_5px">
						<a href="<?=$p?>/Classified/<?=clean_accents($ni[$i]['catUrl'])?>/<?=clean_accents($ni[$i]['url'])?>/" class="wh"><?=$ni[$i]['name2']?></a>
					</div>
						<a href="<?=$p?>/Classified/<?=clean_accents($ni[$i]['catUrl'])?>/<?=clean_accents($ni[$i]['url'])?>/"><img src="<?=$p?>/upload/s_<?=$ni[$i]['file1']?>"></a>
					</center>
				</div>
			<?}?>
		</div>
	</div>
<!-- Left Banner Bottom Option Start -->
	<? if(getSet("LeftBottomBannerCode")!="") {?>
	<div align="center"><br /><?=getSet("LeftBottomBannerCode")?></div>
	<? }?>
<!-- Left Banner Bottom Option End -->
  </div>
  <div id="right_column">