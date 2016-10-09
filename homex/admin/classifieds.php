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
?>
<?
	global $l;
	$cats = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' ORDER BY weight,name'.langId()." ASC") or die(mysql_error());
	for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);
	if (isset($_GET['editCat']))
	{
		$ca = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' WHERE cid=?', $_GET['editCat']) or die(mysql_error());
		$ca = mysql_fetch_assoc($ca);
	}
	
	//Get currencies
	$currencies = array();
	$curr = mysql_qw('SELECT * FROM ' . DB_PREFIX."currencies". ' ') or die(mysql_error());
	while($row = mysql_fetch_assoc($curr)){
		$currencies[] = $row['shortcode'];	
	}
	
?>
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript" src="js/jquery.datePicker.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">
<script>
	<?if (isset($_GET['tab'])) {?>
	    $(document).ready(function() {
	    	show(<?=$_GET['tab']?>);
	  	});
	<?}?>
	function show(id)
	{
    	for(i = 1; i <= 6; i++)
    	{
    		$("#div_" + i).hide();
        	$("#sl_" + i).removeClass("sublinkact");
        	$("#sl_" + i).addClass("sublink");
        	$("#sll_" + i).removeClass("wh");
    	}
    	$("#div_" + id).show();
        $("#sl_" + id).addClass("sublinkact");
        $("#sll_" + id).addClass("wh");
    	if (id == 2)
    		$("#load").load("<?=getSet("url")?>/admin/ajax/classifiedList.php");
    	else if (id == 4)
    		$("#loadCats").load("<?=getSet("url")?>/admin/ajax/classifiedCategoriesList.php");
		else if (id == 5)
    		$("#load1").load("<?=getSet("url")?>/admin/ajax/pendingclassified.php");
	}
</script>
<div class="title">Classifieds</div>
<div class="sublinkpadd">
	<div class="sublinkact" id="sl_1"><a id="sll_1" class="wh" href="javascript:show(1)"><?=$l['AddCategory']?></a></div>
	<div class="sublink" id="sl_4"><a id="sll_4" href="javascript:show(4)"><?=$l['AddedCategory']?></a></div>
	<div class="sublink" id="sl_2"><a id="sll_2" href="javascript:show(2)"><?=$l['AddedAds']?></a></div>
	<div class="sublink" id="sl_5"><a id="sll_5" href="javascript:show(5)"><?=$l['NeedsApproval']?></a></div>
	<div style="clear: both;"></div>
</div>
	<?if ($_GET['mode'] == "saved") {?>
	   <div class="ok"><?=$l['Saved']?></div>
	<?}?>
	<?if ($_GET['mode'] == "deleted") {?>
	   <div class="error"><?=$l['Removed']?></div>
	<?}?>
<div id="div_1">
	<form method="post" enctype="multipart/form-data">
		<?=$l['Name']?><br/>
		<input type="text" style="width: 350px;" name="name2" value="<?=$ca['name2']?>" /><br/><br/>
        
        <?=$l['Category']?><br/>
		<select size="1" name="cat" style="width: 350px;">
			<option value="0">---</option>
			<?for ($i = 0; $i < count($cat); $i++) {?>
		  		<?if($cat[$i]['pid'] == "0") {?>
		  			<option value="<?=$cat[$i]['cid']?>" <?=csel($cat[$i]['cid'], $ca['pid'])?>><?=$cat[$i]['name2']?></option>
				<?}?>
		  			<?for($j = 0; $j < count($cat); $j++) { if ($cat[$j]['pid'] == $cat[$i]['cid'] && $cat[$j]['level'] == 2) {?>
		  				<option value="<?=$cat[$j]['cid']?>" <?=csel($cat[$j]['cid'], $ca['pid'])?>>---<?=$cat[$j]['name2']?></option>
				  			<?for($k = 0; $k < count($cat); $k++) { if ($cat[$k]['pid'] == $cat[$j]['cid'] && $cat[$k]['level'] == 3) {?>
				  				<option value="<?=$cat[$k]['cid']?>" <?=csel($cat[$k]['cid'], $ca['pid'])?>>------<?=$cat[$k]['name2']?></option>
							<?}}?>
					<?}}?>
		 	<?}?>
		</select><br/><br/>
		<input type="submit" class="but" name="catSave" value="<?=$l['Save']?>">
	</form>
</div>
<div id="div_4" style="display: none;">
    <div id="loadCats"></div>
</div>
<div id="div_2" style="display: none;">
    <div id="load"></div>
</div>
<div id="div_5" style="display: none;">
    <div id="load1"></div>
</div>
<!--<div id="div_3" style="display: none;">
	<form method="post">
		<?=$l['NumberAdsPerPage']?><br/>
		<input type="text" style="width: 350px;" name="classPerPage" value="<?=getSet("classPerPage")?>" /><br/><br/>
		<?=$l['CostFirstPlace']?><br/>
		<input type="text" style="width: 350px;" name="classPrice1" value="<?=getSet("classPrice1")?>" /><br/><br/>
		<?=$l['CostBoldPlace']?><br/>
		<input type="text" style="width: 350px;" name="classPrice2" value="<?=getSet("classPrice2")?>" /><br/><br/>
		<?=$l['Currency']?><br/>
		<select size="1" name="classCurrency" style="width: 350px;">
		  <?php
		  foreach($currencies as $k=>$v){
		  ?>
		  <option value="<?=$v?>" <?=csel($v, getSet("classCurrency"))?>><?=$v?></option>
		  <?php
		  }
		  ?>
		</select><br/><br/>
		<?=$l['NumberDaysPaidAds']?><br/>
		<input type="text" style="width: 350px;" name="classPayDays" value="<?=getSet("classPayDays")?>" /><br/><br/>
		<?=$l['DefaultCountryGoogleMaps']?><br/>
		<input type="text" style="width: 350px;" name="classDefCountry" value="<?=getSet("classDefCountry")?>" /><br/><br/>
		<input type="checkbox" name="disableStates" <?if(getSet("disableStates") == 1) echo 'checked'; else echo '';?> value="1" /> <?=$l['DisableUSAstates']?><br/><br/>
		<input type="checkbox" name="autoapproveads" <? if(getSet("autoapproveads") == 1) echo 'checked'; else echo '';?> value="1" /> <?=$l['AutoApproveAds']?><br/><br/>
		<input type="submit" name="classSettSave" value="<?=$l['Save']?>">
	</form>
</div>-->
<div id="div_6" style="display: none;">
 <?
global $l;global $p;
$editId = htmlentities($_GET['pid']);
$csq = mysql_qw('SELECT * FROM ' . DB_PREFIX."classifiedcategories". ' ORDER BY weight') or die(mysql_error("test1"));
for($cs = array(); $cv = mysql_fetch_assoc($csq); $cs[] = $cv);
$cats = mysql_query("SELECT * FROM cms_countries ORDER BY name2") or die(mysql_error());
for($cat = array(); $cv = mysql_fetch_assoc($cats); $cat[] = $cv);
$citiesCat = mysql_query("SELECT * FROM cms_cities ORDER BY name2") or die(mysql_error());
for($cities = array(); $cv = mysql_fetch_assoc($citiesCat); $cities[] = $cv);
$statesCat = mysql_query("SELECT * FROM cms_states ORDER BY name2") or die(mysql_error());
for($states = array(); $cv = mysql_fetch_assoc($statesCat); $states[] = $cv);
$editMode = false;
if ($_GET['mode'] == "editads"){
	$editId = $_GET['pid'];
	$editMode = true;
	$it = mysql_query("SELECT * FROM cms_classifieditems WHERE cid=" . intval($editId)) or die(mysql_error());
	$it = mysql_fetch_assoc($it);
	if ($it['countryId'] > 0){
		$citiesCat = mysql_query("SELECT * FROM cms_states WHERE pid=". $it['countryId'] ." ORDER BY name2") or die("2" . mysql_error());
		for($states = array(); $cv = mysql_fetch_assoc($citiesCat); $states[] = $cv);
		$citiesCat = mysql_query("SELECT * FROM cms_cities WHERE state=". $it['stateId'] ." ORDER BY name2") or die("2" . mysql_error());
		for($catc = array(); $cv = mysql_fetch_assoc($citiesCat); $catc[] = $cv);
	}
	else{}
	$selCountry = $it['countryId'];
	$selCity = $it['cityId'];
	$selState = $it['stateId'];
	
	
    $category_id    = $it['pid'];
    
    $category_sql   = "SELECT * FROM ".DB_PREFIX."classifiedcategories WHERE cid='$category_id'";
    $category_rs    = mysql_query($category_sql);
    $category_row   = mysql_fetch_assoc($category_rs);
    $category_ids[$category_row['level']] = $category_id;
    if($category_row['pid']>0)
    {
        $category_id = $category_row['pid'];
        
        $category_sql   = "SELECT * FROM ".DB_PREFIX."classifiedcategories WHERE cid='$category_id'";
        $category_rs    = mysql_query($category_sql);
        $category_row   = mysql_fetch_assoc($category_rs);
        $category_ids[$category_row['level']] = $category_id;
        if($category_row['pid']>0)
        {
            $category_sql   = "SELECT * FROM ".DB_PREFIX."classifiedcategories WHERE cid='$category_id'";
            $category_rs    = mysql_query($category_sql);
            $category_row   = mysql_fetch_assoc($category_rs);
            $category_ids[$category_row['level']] = $category_id;
        }
    }
    
    
}
else{
	
		
	
}
	
function isSel($m, $v){
		if ($m == $v)
			return "selected=\"selected\"";
}
?>
<script>
function getCatsLevel2(id){
	$("#loadCat2").load('<?=getSet("url")?>/admin/ajax/classifiedCategories.php?cid=' + id)
}
function getCatsLevel3(id){
	$("#loadCat3").load('<?=getSet("url")?>/admin/ajax/classifiedCategories.php?cid=' + id + '&level=3')
}
function deletePhoto(id){
	$("#alhf" + id).val("");
	$("#ph" + id).hide();
}
		function getStates(id){
			
			$("#statesEmpty").load('<?=getSet("url")?>/admin/ajax/getStates.php?cid=' + id);
			$("#citiesEmpty").load('<?=getSet("url")?>/admin/ajax/getCities.php?cid=-1');
		
		}
		
function getCities(id){
	$("#citiesEmpty").load('<?=getSet("url")?>/admin/ajax/getCities.php?cid=' + id)
}
<?if ($_GET['mode'] == "edit") {?>
	$(document).ready(function() {
		//getCities(<?=$it['countryId']?>);
});
<?}?>
</script>
<div class="padding_top_10px">
  <form method="post" enctype="multipart/form-data">
    <b>Details:</b><br/>
    <br/>
    
<? //if(!$editMode || 1==1) { ?>
<?=$l['choose_category']?><br/>
<select size="1" name="cat" style="width: 250px;" onchange="getCatsLevel2(this.options[this.selectedIndex].value)">
    <option value="0">-</option>
    <? for($i = 0; $i < count($cs); $i++) { ?>
        <?if ($cs[$i]['level'] == "1") { ?>
            <option value="<?=$cs[$i]['cid']?>"<?=(($category_ids[1]==$cs[$i]['cid']) ? 'selected' : '')?>><?=$cs[$i]['name2']?></option>
        <?}?>
    <?}?>
</select>
<div id="loadCat2">
    <? if(isset($category_ids[2])) { ?>
    <select size="1" name="cat2" style="width: 250px;" onchange="getCatsLevel3(this.options[this.selectedIndex].value)">
        <option value="0">-</option>
        <? for($i = 0; $i < count($cs); $i++) { ?>
            <?if ($cs[$i]['level'] == "2" && $cs[$i]['pid']==$category_ids[1]) { ?>
                <option value="<?=$cs[$i]['cid']?>"<?=(($category_ids[2]==$cs[$i]['cid']) ? 'selected' : '')?>><?=$cs[$i]['name2']?></option>
            <?}?>
        <?}?>
    </select>
    <? } ?>
</div>
<div id="loadCat3">
    <? if(isset($category_ids[3])) { ?>
    <select size="1" name="cat3" style="width: 250px;" onchange="getCatsLevel4(this.options[this.selectedIndex].value)">
        <option value="0">-</option>
        <? for($i = 0; $i < count($cs); $i++) { ?>
            <?if ($cs[$i]['level'] == "3" && $cs[$i]['pid']==$category_ids[2]) { ?>
                <option value="<?=$cs[$i]['cid']?>"<?=(($category_ids[3]==$cs[$i]['cid']) ? 'selected' : '')?>><?=$cs[$i]['name2']?></option>
            <?}?>
        <?}?>
    </select>
    <br/><br/>
    <? } ?>
</div>
<? //} ?>
    
    <?=$l['UpgradedType']?>  :
    <br/>
    <select name="ptype" onchange="if(this.value!=0) { document.getElementById('date_div').style.display=''; } else { document.getElementById('date_div').style.display='none'; } ">
        <option value="0" <?php if($it['pay'] == 0)echo "selected"; ?>>-</option>
        <option value="1" <?php if($it['pay'] == 1)echo "selected"; ?>><?=$l['Featured']?></option>
        <option value="2" <?php if($it['pay'] == 2)echo "selected"; ?>><?=$l['bold']?></option>
    </select>
    <div id="date_div" <?=(($it['pay']==0 || strtotime(date("Y-m-d H:i:s"))>$it['paidTo']) ? 'style="display:none"' : '')?>>
        <br/>
        <?=$l['Date']?> : <br/>
        <input type="text" name="login" id="login" style="width: 80px;" value="<? if($it['paidTo']!=NULL && strtotime(date("Y-m-d H:i:s"))<$it['paidTo']) echo date("m/d/Y",$it['paidTo'])?>" readonly />
    </div>
    <br/><br/>
    <?=$l['title']?>
    <br/>
    <input type="text" name="name"  class="input_postad_300" value="<?=$it['name2']?>" />
    <br/>
    <br/>
    <?=$l['description']?>
    <br/>
    <textarea cols="50" rows="7" name="descr"><?=$it['description']?>
</textarea>
    <br/>
    <br/>
    <?=$l['Price_classified']?>
    <br/><input type="text" name="price"  class="input_postad" value="<?=$it['price']?>" /><?=$l['or']?>
    <select size="1" name="PriceType"  class="input_postad">
      <option value="0">-</option>
      <option value="1" <?=csel(1, $it['priceType'])?> >
      <?=$l['free']?>
      </option>
      <option value="2" <?=csel(2, $it['priceType'])?> >
      <?=$l['best_offer']?>
      </option>
      <option value="3" <?=csel(3, $it['priceType'])?> >
      <?=$l['wanted']?>
      </option>
    </select>
    <br/>
    <br/>
    <b>
    <?=$l['location']?>
    :</b><br/>
	<?=$l['streetAddress']?><br/>
	<input type="text" name="streetAddress" value="<?php echo $it['street_address']; ?>" /><br/><br/>
    <br/>
    <?=$l['country']?>
    (
    <?=$l['optional']?>
    )<br/>
    <select size="1" name="countryId"  class="input_postad_300" ONCHANGE="getStates(this.options[this.selectedIndex].value)">
      <option value="-1">--</option>
      <?for($i = 0; $i < count($cat); $i++) {?>
      <option value="<?=$cat[$i]['cid']?>" <?=isSel($cat[$i]['cid'], $selCountry)?>>
      <?=$cat[$i]['name2']?>
      </option>
      <?}?>
    </select>
    <br/>
    <br/>
    <?if(getSet("disableStates") == "0") {?>
    <?=$l['us_state']?>
    (
    <?=$l['optional']?>
    )<br/>
    <div id="statesEmpty">
    <select size="1" name="stateId" class="input_postad_300" onchange="getCities(this.options[this.selectedIndex].value)">
      <option value="value1">-</option>
      <?for($i = 0; $i < count($states); $i++) {?>
      <option value="<?=$states[$i]['cid']?>" <?if($selState == $states[$i]['cid']) {?>echo selected<?}?>>
      <?=$states[$i]['name2']?>
      </option>
      <?}?>
    </select>
    </div>
    <br/>
    <br/>
    <?}?>
    <?=$l['city']?>(<?=$l['optional']?>)<br/>
    <div id="citiesEmpty"  class="float_left">
      <select size="1" name="cityId" class="input_postad">
        <option value="0">-</option>
        <?for($i = 0; $i < count($catc); $i++) {?>
        <option value="<?=$catc[$i]['cid']?>" <?if($selCity == $catc[$i]['cid']) {?>echo selected<?}?>>
        <?=$catc[$i]['name2']?>
        </option>
        <?}?>
      </select>
    </div>
    <div class="float_left" style="display:none">&nbsp;
      <?=$l['or']?> 
      <input type="text" name="city" class="input_postad" value="<?=$it['city']?>" />
    </div>
    <div style="clear: both;"></div>
    <br/>
    <?=$l['zip_postal_code']?>
    <br/>
    <input type="text" name="zip"  class="input_postad_300" value="<?=$it['zip']?>" />
    <br/>
    <br/>
    <b>
    <?=$l['photos_videos']?>
    </b><br/>
    <br/>
    <?=$l['images_extensions']?>
    <br/>
    <input type="file" name="fi1" />
    <br/>
    <input type="hidden" name="alhf1" id="alhf1" value="<?=$it['file1']?>" />
    <div class="padding_3px">
      <input type="file" name="fi2" />
      <input type="hidden" name="alhf2" id="alhf2" value="<?=$it['file2']?>" />
    </div>
    <div class="padding_3px">
      <input type="file" name="fi3" />
      <input type="hidden" name="alhf3" id="alhf3" value="<?=$it['file3']?>" />
    </div>
    <div class="padding_3px">
      <input type="file" name="fi4" />
      <br/>
      <input type="hidden" name="alhf4" id="alhf4" value="<?=$it['file4']?>" />
    </div>
    <div class="padding_3px">
      <input type="file" name="fi5" />
      <br/>
      <input type="hidden" name="alhf5" id="alhf5" value="<?=$it['file5']?>" />
    </div>
    <?if($editMode) {?>
    <div  class="padding_top_10px">
      <?for($i = 1; $i < 6; $i++) {?>
      <? $fid = "file" . $i; if(strlen($it[$fid]) > 0) {?>
      <div style="float: left;" id="ph<?=$i?>">
        <div class="type_edit"> <a class="thickbox" rel="gallery-plants" href="<?=getSet("url")?>/upload/<?=$it[$fid]?>"><img src="<?=getSet("url")?>/upload/s_<?=$it[$fid]?>" style="border: 1px solid #fd670b; padding: 3px;" /></a> <br/>
          <a href="javascript:deletePhoto(<?=$i?>)">
          <?=$l['delete']?>
          </a> </div>
        <div class="postad_seperator"></div>
      </div>
      <?}?>
      <?}?>
      <div style="clear: both"></div>
    </div>
    <?}?>
    <br/>
    <?=$l['Video']?>
    : (
    <?=$l['VideoCode']?>
    ) - (
    <?=$l['optional']?>
    )<br/>
    <textarea cols="50" rows="4" name="video"><?=$it['video']?></textarea>
    <br/><br/>
    
    
		<?=$l['urlText']?> <i><?=$l['urlTextEx']?></i><br/>
		<input type="text" name="urlText"  class="input_postad_300" value="<?=$it['urlText']?>" maxlength="200" /><br/><br/>
		<?=$l['urlLink']?> <i><?=$l['urlLinkEx']?></i><br/>
		<textarea cols="50" rows="4" name="urlLink"><?=$it['urlLink']?></textarea><br/><br/>
    <input type="submit" name="saveClass" value=" <?=$l['Save']?>" class="but" />
  </form>
</div>
<script>
$(function()
{
    $('#login').datePicker({autoFocusNextInput: true});
});
</script>
  
</div>