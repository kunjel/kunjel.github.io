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
?>
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
if ($_GET['mode'] == "edit"){
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
    <b><?=$l['Details']?>:</b><br/>
    <br/>
    <?if(!$editMode) {?>
    <?=$l['choose_category']?>
    <br/>
    <select size="1" name="cat" style="width: 250px;" ONCHANGE="getCatsLevel2(this.options[this.selectedIndex].value)">
      <option value="0">-</option>
      <?for($i = 0; $i < count($cs); $i++) { if ($cs[$i]['level'] == "1") {?>
      <option value="<?=$cs[$i]['cid']?>">
      <?=$cs[$i]['name2']?>
      </option>
      <?}}?>
    </select>
    <br/>
    <br/>
    <div id="loadCat2"></div>
    <div id="loadCat3"></div>
    <?}?>
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
    <?=$l['Price']?>
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
    <textarea cols="50" rows="4" name="video"><?=$it['video']?>
</textarea>
    <br/>
    <br/>
    <input type="submit" name="saveClass" value=" <?=$l['Save']?>" class="but" />
  </form>
</div>
