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
$conn = mysql_connect(DB_HOST,DB_LOGIN,DB_PASSWD);
if(!$conn) die("Failed to connect to database!");
$status = mysql_select_db(DB_NAME, $conn);
if(!$status) die("Failed to select database!");
global $p;
global $e;
global $l;
//echo '<pre>'; print_r($_GET); exit;
$classifieditems_sql = "UPDATE ".DB_PREFIX."classifieditems SET pay=0,paidTo='' WHERE pay!=0 AND paidTo<".time();
mysql_query($classifieditems_sql);
$publickey  = getSet("captchaPublicKey");
$privatekey = getSet("captchaPrivateKey");
function fromMyCity($cityId)
{
    if (!isAuth()) return true;
    
    $user = mysql_query("SELECT * FROM cms_users WHERE uid='" . $_SESSION['uid'] . "'") or die(mysql_error());
    $user = mysql_fetch_assoc($user);
    
    if ($user['cityId'] == "" || $user['cityId'] == 0) return true;
    
    if ($cityId == "" || $cityId == 0) return true;
    
    if ($user['myCity'] == 1 && $user['cityId'] != $cityId) return false;
    
    return true;
}

if (!isset($_GET['page']))
{
    $thisCat = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' WHERE url=?', $_GET['mode']) or die("dont get categories");
    $thisCat = mysql_fetch_assoc($thisCat);
    
    $cids  = $thisCat['cid'];
    $cids .= ','.subcategory($thisCat['cid']);
    
//    if ($thisCat['pid'] == 0 || 1) // get ads for category
//    {	
//        $ads = "SELECT * FROM cms_classifieditems WHERE pid='".$thisCat['cid']."' OR pid IN (SELECT cid FROM cms_classifiedcategories WHERE pid = ".  $thisCat['cid'].")  AND approved=1";
//        //Include pagination code
//    }
//    else  // get ads fot subcategory
//    {	
//        $ads = "SELECT * FROM cms_classifieditems WHERE pid=".$thisCat['cid']."  AND approved=1";
//        //Include pagination code
//    }
	$classPerPage = getSet('classPerPage');

    $ads   = "SELECT * FROM cms_classifieditems WHERE pid IN ($cids) AND approved=1 AND pay_status=1 ORDER BY field(pay, 1,2,0), date desc";
    $pager = new PS_Pagination($conn, $ads, $classPerPage, 5, "");
	
	$rs    = @$pager->paginate();
    
    if($rs) for($it = array(); $cv = mysql_fetch_assoc($rs); $it[] = $cv);
}
else if ($_GET['mode'] == "search") // search
{ 
    //echo '<pre>'; print_r($_GET); print_r($_POST); exit;
    if (isset($_POST['ASearch']))
    {
        $ss = "";
        $isAnd = "";
        if (isset($_POST['atitle']) && strlen($_POST['atitle']) > 0)
        {
            $ss = "(cms_classifieditems.name2 LIKE '%".$_POST['atitle']."%' OR cms_classifieditems.description LIKE '%".$_POST['atitle']."%')";
            $isAnd = " AND ";
        }
        if(strlen($_POST['p1']) > 0 && $_POST['p1'] > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.price >= " . $_POST['p1'];
            $isAnd = " AND ";
        }
        if(strlen($_POST['p2']) > 0 && $_POST['p2'] > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.price <= " . $_POST['p2'];
            $isAnd = " AND ";
        }
        if(strlen($_POST['countryId']) > 0 && $_POST['countryId'] > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.countryId = " . $_POST['countryId'];
            $isAnd = " AND ";
        }
        if(strlen($_POST['stateId']) > 0 && $_POST['stateId'] > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.stateId = " . $_POST['stateId'];
            $isAnd = " AND ";
        }    
        if(strlen($_POST['cityId']) > 0 && $_POST['cityId'] > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.cityId = " . $_POST['cityId'];
            $isAnd = " AND ";
        }    
        if(strlen($_POST['zip']) > 0 && strlen($_POST['zip']) > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.zip LIKE '%" . $_POST['zip']."%'";
            $isAnd = " AND ";
        }
        if(strlen($_POST['PriceType']) > 0 &&  $_POST['PriceType'] > 0)
        {
            $ss .= $isAnd . " cms_classifieditems.PriceType = '" . $_POST['PriceType']."'";
            $isAnd = " AND ";
        }
        
        if (strlen($ss) > 0)
            $ss = " WHERE " . $ss . " AND cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1 order by field(cms_classifieditems.pay, 1,2,0), date desc";
        else
            $ss = " WHERE 1=2";
        
        $item = "SELECT cms_classifieditems.*, cms_classifiedcategories.url as url2 FROM cms_classifieditems LEFT JOIN cms_classifiedcategories ON cms_classifiedcategories.cid = cms_classifieditems.pid ". $ss ;
        
       // echo $item;
        //Include pagination code
        $pager = new PS_Pagination($conn, $item, 2, 5, "");
    }
    else
    {
        $str = str_replace("-"," ",$_GET['page']);
        $item = "SELECT cms_classifieditems.*, cms_classifieditems.url, cms_classifiedcategories.url as url2 FROM cms_classifieditems LEFT JOIN cms_classifiedcategories ON cms_classifiedcategories.cid = cms_classifieditems.pid WHERE (cms_classifieditems.name2 LIKE '%".$str."%' OR cms_classifieditems.description LIKE '%".$str."%' OR cms_classifieditems.zip LIKE '%".$str."%') AND cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1 ORDER BY field(cms_classifieditems.pay, 1,2,0), date desc";
        //echo $item;
        //Include pagination code
        $pager = new PS_Pagination($conn, $item, 2, 5, "");
    }
    $rs = @$pager->paginate();
    
    if($rs) for($it = array(); $cv = mysql_fetch_assoc($rs); $it[] = $cv);
}
else // get ad by id
{
    //$item = mysql_query("SELECT cms_classifieditems.*, cms_users.login FROM cms_classifieditems LEFT JOIN cms_users ON cms_classifieditems.uid=cms_users.uid WHERE cms_classifieditems.url='" . $_GET['page']."' AND cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1") or die(mysql_error());
	$pageArr = explode('_',$_GET['page']);
	if($pageArr[0] && $pageArr[1])
		$item = mysql_query("SELECT cms_classifieditems.*, cms_users.login FROM cms_classifieditems LEFT JOIN cms_users ON cms_classifieditems.uid=cms_users.uid WHERE cms_classifieditems.url='" . $pageArr[1]."' AND cms_classifieditems.date='" . $pageArr[0]."' AND cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1") or die(mysql_error());
	else
		$item = mysql_query("SELECT cms_classifieditems.*, cms_users.login FROM cms_classifieditems LEFT JOIN cms_users ON cms_classifieditems.uid=cms_users.uid WHERE cms_classifieditems.url='" . $_GET['page']."' AND cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1") or die(mysql_error());
		
    //    echo $item;exit;
    $it = mysql_fetch_assoc($item);
    if ($it['cityId'] > 0)
    {
        $ccity = mysql_query("SELECT * FROM cms_cities WHERE cid=" . $it['cityId']) or die(mysql_error());
        $ccity = mysql_fetch_assoc($ccity);
        $ccity = $ccity['name2'];
    }
    
    $cl_id = $it['cid'];
    if(!isset($_SESSION['views'][$cl_id]))
    {
        $_SESSION['views'][$cl_id] = $cl_id;
        mysql_query("UPDATE cms_classifieditems SET views=views+1 WHERE cid='$cl_id'") or die(mysql_error());
    }
}
function gpt($id)
{
    if ($id == 1)
        return "Free";
    else if($id == 2)
        return "Best offer";
    else
        return "Wanted";
}
//Get email address of the ad poster
$uid_qry = mysql_query("SELECT	cms_classifieditems.* FROM cms_classifieditems LEFT JOIN cms_users ON cms_classifieditems.uid=cms_users.uid WHERE cms_classifieditems.url='" . $_GET['page']."'") or die(mysql_error());
$uid_qry_res = mysql_fetch_assoc($uid_qry);
$email_qry = mysql_query("SELECT * FROM cms_users WHERE uid='" . $uid_qry_res['uid'] . "'") or die(mysql_error());
$user_email = mysql_fetch_assoc($email_qry);
$user_email = $user_email['mail'];
//Get the currency symbol
$symbol = mysql_qw('SELECT * FROM ' . DB_PREFIX."currencies". ' WHERE shortcode=?', getSet("classCurrency")) or die("cant get currencies");
$res_symbol = mysql_fetch_assoc($symbol);
if (!isset($_GET['page']) || $_GET['mode'] == "search") { ?>
    
    <?php if(getSet("TopClassifiedCode")!="") echo getSet("TopClassifiedCode"); ?>
    <br /><br /><h2><?php if($_GET['page'] == 'as') {?><h2>Classified ads</h2><?php } else { ?><h2><?=$l['SearchResults']?> <?php if($thisCat['name2']) echo $thisCat['name2']; else echo $_GET['page'];}?></h2>
    <div style="clear:both"></div>
    <?if(count($it) > 0) { ?>
    
        <div class="myads_container">
            <div class="bc myads_photo_div_header"><?=$l['Photo']?></div>
            <? $cntwidth = "305px";?>
            <div class="bc myads_title_header" style="width:<?=$cntwidth;?>;"><?=$l['Title']?></div>
            <div class="bc myads_price_header"><?=$l['Price_classified']?> - <?=getSet("classCurrency")?></div>
            <div class="bc myads_action_header"><?=$l['Date']?></div>
        </div>
        
        <div class="classified_right_column"><?php if(getSet("RightClassifiedCode")!="") echo getSet("RightClassifiedCode");  ?></div>
    
        <?
        for($i = 0; $i < count($it); $i++)
        {
            if($_GET['mode'] == "search") $thisCat['url'] = $it[$i]['url2'];
            $cntwidth = "305px";
            
            //$url   = $p.'/Classified/'.clean_accents($thisCat['url']).'/'.clean_accents($it[$i]['url']);
			$url   = $p.'/Classified/'.clean_accents($thisCat['url']).'/'.clean_accents($it[$i]['date']).'_'.clean_accents($it[$i]['url']);
            $class = ($it[$i]['paidTo']!=NULL) ? (($it[$i]['pay']==1) ? 'featured_ads' : 'bld') : '';
            
            $description = substr($it[$i]['description'],0,120).((strlen($it[$i]['description'])>120) ? "..." : "");
            
            if(fromMyCity($it[$i]['cityId'])) {?>
                <div class="myads_container <?=$cl?>">
                    <div class="bc myads_photo_div_content <?=$class?>">
                        <?if(strlen($it[$i]['file1']) > 0) { ?>
                            <a href="<?=$url?>"><img src="<?=getSet("url")?>/upload/s_<?=$it[$i]['file1']?>" width="90" /></a>
                        <? } ?>
                    </div>
                    <div class="bc myads_title_content <?=$class?>" style="width:<?=$cntwidth;?>;">
                        <a <?=(($it[$i]['paidTo']!=NULL) ? "class='bld'" : '')?> href="<?=$url?>"><?=$it[$i]['name2']?></a><br /><span class="desc3"><?=$description?></span>
                    </div>
                    <div class="bc myads_price_content <?=$class?>">
                        <?php 
                        if($it[$i]['priceType'] == 1 || $it[$i]['priceType'] == 2 || $it[$i]['priceType'] == 3)
                        {
                            if($it[$i]['priceType'] == 1)
                                echo "<span class='bld'>".$l['Free']."</span>";
                            else if($it[$i]['priceType'] == 2)
                                echo "<span class='bld'>".$l['Bestoffer']."</span>";
                            else if($it[$i]['priceType'] == 3)
                                echo "<span class='bld'>".$l['wanted']."</span>";
                        }
                        else
                            echo $res_symbol['code'].$it[$i]['price'];
                        ?>
                    </div>
                    <div class="bc myads_action_content <?=$class?>"><?=date("m/d/Y", $it[$i]['date'])?></div>
                </div>
            <?
            }
        }
        ?>
        <div class="line_seperator menu_links padding_top_15px"><?php echo $pager->renderFullNav(); ?></div>
        <!-- Bottom Classified Banner Start -->
        <div class="line_seperator left_column_classified"><br /><br /><?php if(getSet("BottomClassifiedCode")!="") echo getSet("BottomClassifiedCode"); ?></div>
        <div class="line_seperator"></div>
        <!-- Bottom Classified Banner End -->
        
    <? } else { ?> <center><?=$l['noads']?></center> <?}?>
    
    <div style="padding-top:20px;" align="center"><div class="advanced_link" align="center"><a href="<?=$p?>/aSearch" class="wh"><?=$l['advancedSearchLink']?></a></div></div>
<? } else { ?>
<h2><?=$it['name2']?><? if($it['priceType'] != "0") echo ' - '.gpt($it['priceType']); else if($it['price']>0) echo  ' - '.$res_symbol['code']."".$it['price'];?></h2>
<div class="blank_div">
<div class="left_column_classified">
    <?=$l['Addedby']?> <b><?=$it['login']?></b> <?=date("m/d/Y", $it['date'])?> <? if (isAuth()) { ?><a href="<?=$p?>/Compose/classified/<?=$it['cid']?>"><?=$l['sendPrivateMessage']?></a><? } ?>
    
    <br /><br />
    <?=nl2br($it['description'])?>
    <div class="line_seperator"></div>
    <? if($it['urlLink']!='') { ?>
    <br>
    <a href="<?=$it['urlLink']?>" target="_blank"><?=($it['urlText']!='' ? $it['urlText'] : 'Click here for more information')?></a>
    <div class="line_seperator"></div>
    <? } ?>
    <div class="title padding_top_15px"><?=$l['ContactSeller']?></div>
    <div class="line_seperator"></div>
    <?php 
    $url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
    $success = substr($url,strlen($url)-2,2);
	
	if($success == '=1')
        echo "<div class='title'>".$e['message_sent']."</div>";
    if($success == '=2')
        echo "<div class='title asterik'>".$e['invalid_captcha']."</div>";
    ?>
<form id="form1" name="form1" method="post" action="">
<?=$l['YourName']?>: <span class="asterik">*</span><br/>
<input type="text" class="input_postad_300" name="contact_name" id="contact_name" value="<?=$_GET['n']?>" />
<br/><br/>
<?=$l['emailAddress']?>: <span class="asterik">*</span><br/>
<input type="text" class="input_postad_300" name="contact_email" id="contact_email" value="<?=$email?>" />
<br/><br/>
<?=$l['message']?>: <span class="asterik">*</span><br/>
<textarea type="text" class="input_postad_300" name="contact_message" id="contact_message" cols="10" rows="10"><?=$message?></textarea>
<input type="hidden" name="url" value="<?php echo "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>" />
<input type="hidden" name="seller_email" value="<?php echo $user_email; ?>" />
<br/><br/>
<?php echo recaptcha_get_html($publickey, $error); ?>
<input style="margin-left:50px; margin-top:10px;" type="submit" class="but" name="contactSend" onclick="return checkForm();" value="<?=$l['SendMessage']?>">
<br /><br />
</form>
<div class="line_seperator"></div>
<?if(strlen($it['video']) > 0) {?>
<div class="title padding_top_15px"><?=$l['Video']?></div>
<?=$it['video']?>
<?}?>
<?if(strlen($it['coorx']) > 0) {?>
<div class="title padding_top_15px"><?=$l['Map']?>:</div>
<script>
    /* Google Map API V3 */
function initialize() {
var geocoder;
var map;
var marker;
//if (GBrowserIsCompatible()) {
var latlng = new google.maps.LatLng(<?=$it['coorx']?>,<?=$it['coory']?>);
  var options = {
    zoom: 16,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  map = new google.maps.Map(document.getElementById("map_canvas"), options);
  
  geocoder = new google.maps.Geocoder();
  var contentString = "<b><?=$it['city']?></b><br/><?=$it['name2']?><br/><?if($it['price'] > 0) echo $it['price']; echo " " . getSet("classCurrency"); ?>"; 
  var infowindow = new google.maps.InfoWindow({
    content: contentString
});
    marker = new google.maps.Marker({
  position: new google.maps.LatLng(<?=$it['coorx']?>, <?=$it['coory']?>),  
  map: map  
  });
  infowindow.open(map,marker);
  marker.setMap(map);  
//}
}
</script>
<div id="map_canvas" class="map_canvas_classified"></div>
<br /><br /></div>
<div class="right_column_classified">
<div class="title"><?//=$l['ShareSocial']?></div>
<?php //echo getSocialNetworkingIcons(); ?><br />
<div class="title"><?=$l['Photos']?></div>
<div class="line_seperator"></div>
<div class="blank_div">
<?for($i = 1; $i < 6; $i++) {?>
<? $fid = "file" . $i;
if(strlen($it[$fid]) > 0) {?>
<div class="images_container"> <a class="thickbox" rel="gallery-plants" href="<?=getSet("url")?>/upload/<?=$it[$fid]?>"><img src="<?=getSet("url")?>/upload/s_<?=$it[$fid]?>" class="images_div"  /></a></div>
<?}?>
<?}?>
</div>
<!-- Right Classified Details Banner Start -->
<?php if(getSet("RightClassifiedDetailsCode")!="") echo getSet("RightClassifiedDetailsCode"); ?>
<!-- Right Classified Details Banner End -->
</div>
</div>
<div class="line_seperator"></div>
<?}?>
<?}?>
<script>
function checkForm()
{
    var er = true;
    if (!checkField("contact_name"))
        er = false;
    if (!checkField("contact_email"))
        er = false;
    if (!checkField("contact_message"))
        er = false;
        
    return er;
}
</script>