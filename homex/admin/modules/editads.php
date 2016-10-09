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
    global $p;global $l;
	
	// edit - check permissions
	if ($_GET['mode'] == "edit")
	{
		$editId = $_GET['pid'];
		$own = mysql_qw("SELECT uid FROM cms_classifieditems WHERE cid= ? ", intval($editId)) or die(mysql_error("Cannot execute query"));
  		$own = mysql_fetch_assoc($own);
	}
	if(isset($_POST['saveClass']))
	{
		$cat = $_POST['cat'];
		if (isset($_POST['cat2']))
			$cat = $_POST['cat2'];
		if (isset($_POST['cat3']))
			$cat = $_POST['cat3'];
		$date = now();
		$uid = $_SESSION['uid'];
		$title = trim($_POST['name']);
		$url = clearUrl($title);
		$descr = trim($_POST['descr']);
		$city = trim($_POST['city']);
		$price = trim($_POST['price']);
		$prType = trim($_POST['PriceType']);
		$video = trim($_POST['video']);
		$countryId = trim($_POST['countryId']);
		$cityId = trim($_POST['cityId']);
		$zip = trim($_POST['zip']);
        $stateId = $_POST['stateId'];
		// Check coor for Google maps
		if ($cityId > 0)
		{
			$ci = mysql_qw("SELECT name2 FROM cms_cities WHERE cid= ?",$cityId) or die(mysql_error());
			$ci = mysql_fetch_assoc($ci);
			$ge = getSet("classDefCountry") . ", " . $ci['name2'];
		}
		else
			$ge = getSet("classDefCountry") . ", " . $city;
		$cist = "";
		if ($stateId > 0)
		{
			$cist = mysql_qw("SELECT name2 FROM cms_states WHERE cid=?",$stateId) or die(mysql_error());
			$cist = mysql_fetch_assoc($cist);
			$cist = ", " . $cist['name2'];
		}
		$ge = $ge . $cist;
		//echo $ge;
		//exit;
		$ge = str_replace(" ", "", $ge);
		@$s = file_get_contents("http://maps.google.com/maps/geo?q=". $ge ."&output=csv&oe=utf8&sensor=false&key=" . getSet('googleMaps'));
		$items = explode(',', $s);
		$coorx = $items[2];
		$coory = $items[3];
		//echo $items[2].','.$items[3];
		$al_file1 = uploadPhotos('fi1');
		$al_file1 = strlen($al_file1) < 5 ? $_POST['alhf1'] : $al_file1;
		$al_file2 = uploadPhotos('fi2');
		$al_file2 = strlen($al_file2) < 5 ? $_POST['alhf2'] : $al_file2;
		$al_file3 = uploadPhotos('fi3');
		$al_file3 = strlen($al_file3) < 5 ? $_POST['alhf3'] : $al_file3;
		$al_file4 = uploadPhotos('fi4');
		$al_file4 = strlen($al_file4) < 5 ? $_POST['alhf4'] : $al_file4;
		$al_file5 = uploadPhotos('fi5');
		$al_file5 = strlen($al_file5) < 5 ? $_POST['alhf5'] : $al_file5;
		if ($_GET['mode'] != "edit")
			echo $s = mysql_qw('INSERT INTO cms_classifieditems SET pid=?, date=?, uid=?, name2=?, description=?, city=?, price=?, priceType=?, video=?, file1=?, file2=?, file3=?, file4=?, file5=?, url=?, coorx=?, coory=?, countryId=?, cityId=?, stateId=?, zip=?', $cat, $date, $uid, $title, $descr, $city, $price, $prType, $video, $al_file1, $al_file2, $al_file3, $al_file4, $al_file5, $url, $coorx, $coory, $countryId, $cityId, $stateId, $zip) or die(mysql_error());
		else                                                                                                
		 	echo $s = mysql_qw("UPDATE `cms_classifieditems` SET `name2` = ?, `description` = ?, `price` = ?, `priceType` = ?, `url` = ?, `video` = ?, `file1` = ?, `file2` = ?, `file3` = ?, `file4` = ?, `file5` = ?, `coorx` = ?, `coory` = ?, `countryId` = ?, `cityId` = ?, `stateId` = ?, `zip` = ? WHERE `cid`= ? LIMIT 1",  $title ,$descr,$price,$prType,$url,$video,$al_file1,$al_file2,$al_file3,$al_file4,$al_file5,$coorx,$coory,$countryId,$cityId,$stateId,$zip,$_GET['pid'] ) or die(mysql_error());
		//redirect("myAds");
		if($s)echo "success";
	}
	function uploadPhotos($fn)
	{
		$new_image = $_FILES[$fn];
	    $new_image_tmp = $new_image['tmp_name'];
	    $file_name = "s_".time().rand(1000, 100000);
	    if( file_exists($new_image_tmp) )
	    {
	        $image_size = getimagesize($_FILES[$fn]['tmp_name']);
	        if ( preg_match('{image/(.*)}is', $image_size['mime'], $p) )
	        {
	            if(preg_match('/\.gif$|\.jpe?g$|\.png$|\.GIF$|\.JPE?G$|\.PNG$/', $_FILES[$fn]['name']))
	            {
	               $i_file_name = $file_name.".".$p[1];
	               $upload_dir = "../upload/";
	                $image_name = $upload_dir ."/". $i_file_name;
				    move_uploaded_file($_FILES[$fn]["tmp_name"], $upload_dir.$i_file_name);
					edit_image_size($image_name, $i_file_name, $image_size, $module_name, false);
					return $i_file_name;
	            }
	        }
	    }
	}
	function edit_image_size($image_name, $i_file_name, $image_size, $module_name, $waterMark)
	{
	   $upload_dir = "../upload";
	   $width_small  = 135;
	   $height_small = 101;
	   // для гор. изобр
	   $new_width = $image_size[0] / $width_small;     // x
	   $new_height= $image_size[1] / $new_width;
	   // для верт. изобр.
	   $new_width2 = $image_size[1] / $width_small;     // x
	   $new_height2= $image_size[0] / $new_width2;
	   // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	   if($image_size[0] > 714)
	   {
	    	$b1 = 714;
	   		$b2 = 536;
	   }
	   else
	   {
	   		$b1 = $image_size[0];
	   		$b2 = $image_size[1];
	   }
	   // для гор. изобр
	   $nw = $image_size[0] / $b1;     // x
	   $nh= $image_size[1] / $nw;
	   // для верт. изобр.
	   $nw2 = $image_size[1] / $b1;     // x
	   $nh2= $image_size[0] / $nw2;
	   // переделаем фото в большое и маленькое
	   switch( $image_size['mime'] )
	   {
	       case "image/png":  $from = imageCreateFromPng($image_name); break;
	       case "image/jpg":  $from = imageCreateFromJpeg($image_name); break;
	       case "image/jpeg": $from = imageCreateFromJpeg($image_name); break;
	       case "image/gif":  $from = imageCreateFromGif($image_name); break;
	       default: submit_error($_SERVER['SCRIPT_NAME']. $module_name . "&mime&" .session_name()."=".session_id());
	   }
	   if ($waterMark)
	   {
	       //$color=ImageColorAllocate($from, 250, 255, 255);
		  // ImageTTFtext($from, 20, 0, 10, $image_size[1]-10, $color, 'images/arial.ttf', '© www.sitename.com');
       }
	   if( $image_size[0] < $image_size[1] ) // если ширина < меньше высоты - вертикальное изображение
	   {
	       $to_big = imageCreateTrueColor($nh2, $b1);
	       $to_small = imageCreateTrueColor($new_height2, $width_small);
	   }
	   else  // горизонтальное изображение
	   {
	       $to_big = imageCreateTrueColor($b1, $nh);
	       $to_small = imageCreateTrueColor($width_small, $new_height);
	   }
	   imageCopyResampled($to_big, $from,0,0,0,0, imageSX($to_big), imageSY($to_big), imageSX($from), imageSY($from));
	   imageCopyResampled($to_small, $from, 0, 0, 0, 0, imageSX($to_small), imageSY($to_small), imageSX($from), imageSY($from));
	    switch($image_size['mime'])
	    {
	       case "image/png":
	       {
	           imagePng($to_big, $upload_dir."/".$i_file_name);
	           imagePng($to_small, $upload_dir."/s_".$i_file_name);
	           break;
	       }
	       case "image/jpg":
	       {
	           imageJpeg($to_big, $upload_dir."/".$i_file_name);
	           imageJpeg($to_small, $upload_dir."/s_".$i_file_name);
	           break;
	       }
	       case "image/jpeg":
	       {
	           imageJpeg($to_big, $upload_dir."/".$i_file_name);
	           imageJpeg($to_small, $upload_dir."/s_".$i_file_name);
	           break;
	       }
	       case "image/gif":
	       {
	           imagePng($to_big, $upload_dir."/".$i_file_name);
	           imagePng($to_small, $upload_dir."/s_".$i_file_name);
	           break;
	       }
	       default:
	       {
	       }
        }
	}
?>
