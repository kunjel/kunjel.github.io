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



global $p;

global $e;



// edit - check permissions

if ($_GET['mode'] == "edit")

{

    $editId = $_GET['page'];



    $own = mysql_query("SELECT uid FROM cms_classifieditems WHERE cid=" . intval($editId)) or die(mysql_error());

    $own = mysql_fetch_assoc($own);

    if ($_SESSION['uid'] != $own['uid'])

    {

        redirect($p . "/" . "myAds");

    }

}



if(isset($_POST['saveClass']))

{

    $mode          = $_GET['mode'];

    $pay_status    = 0;

    $cat           = trim((isset($_POST['cat3'])) ? $_POST['cat3'] : (isset($_POST['cat2']) ? $_POST['cat2'] : $_POST['cat']));

    $date          = now();

    $uid           = $_SESSION['uid'];

    $title         = trim($_POST['name']);

    $url           = clearUrl($title);

    $descr         = trim($_POST['descr']);

    $city          = trim($_POST['city']);

    $price         = trim($_POST['price']);

    $prType        = trim($_POST['PriceType']);

    $video         = trim($_POST['video']);

    $streetAddress = trim($_POST['streetAddress']);

    $countryId     = trim($_POST['countryId']);

    $stateId       = trim($_POST['stateId']);

    $cityId        = trim($_POST['cityId']);

    $zip           = trim($_POST['zip']);

    $urlText = trim($_POST['urlText']);

    $urlLink = trim($_POST['urlLink']);



    //Get Country Name

    if($countryId>0)

    {

        $country_rs   = mysql_query("SELECT name2 FROM cms_countries WHERE cid='".$countryId."'") or die(mysql_error());

        $country_row  = mysql_fetch_assoc($country_rs);

        $country_name = $country_row['name2'];

    }



    //Get state Name

    if ($stateId > 0)

    {

        $state_rs   = mysql_query("SELECT name2 FROM cms_states WHERE cid='".$stateId."'") or die(mysql_error());

        $state_row  = mysql_fetch_assoc($state_rs);

        $state_name = $state_row['name2'];

    }



    //Get City Name

    if ($cityId > 0)

    {

        $city_rs   = mysql_query("SELECT name2 FROM cms_cities WHERE cid='".$cityId."'") or die(mysql_error());

        $city_row  = mysql_fetch_assoc($city_rs);

        $city_name = $city_row['name2'];

    }

 

    $maps_google = str_replace(" ", "", (str_replace(" ","+",$streetAddress) .",". str_replace(" ","+",$city_name) .",". str_replace(" ","+",$state_name) .",". str_replace(" ","+",$country_name) .",". str_replace(" ","+",$zip)));
	
	// file_get_contents doesn't work in the server's where allow_url_fopen is set off, so use curl instead
    //@$s    = file_get_contents("http://maps.google.com/maps/geo?q=". $maps_google ."&output=csv&oe=utf8&sensor=false");
	
	$curl = curl_init("http://maps.google.com/maps/geo?q=". urlencode($maps_google) ."&output=csv&oe=utf8&sensor=false");
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_TIMEOUT,10);
    $s = curl_exec($curl);
	curl_close($curl);

    $items = explode(',', $s);

    $coorx = $items[2];

    $coory = $items[3];



    $al_file1 = uploadPhotos('fi1');

    $al_file1 = ((strlen($al_file1) < 5) ? $_POST['alhf1'] : $al_file1);



    $al_file2 = uploadPhotos('fi2');

    $al_file2 = ((strlen($al_file2) < 5) ? $_POST['alhf2'] : $al_file2);



    $al_file3 = uploadPhotos('fi3');

    $al_file3 = ((strlen($al_file3) < 5) ? $_POST['alhf3'] : $al_file3);



    $al_file4 = uploadPhotos('fi4');

    $al_file4 = ((strlen($al_file4) < 5) ? $_POST['alhf4'] : $al_file4);



    $al_file5 = uploadPhotos('fi5');

    $al_file5 = ((strlen($al_file5) < 5) ? $_POST['alhf5'] : $al_file5);  

    

    if ($mode=="edit")

    {

        $classified_id  = $_GET['page'];

        $classified_rs  = mysql_query("SELECT pay_status FROM ".DB_PREFIX."classifieditems WHERE 	cid='$classified_id'") or die(mysql_error());

        $classified_row = mysql_fetch_assoc($classified_rs);

        $pay_status     = $classified_row['pay_status'];

    }



    //Check if auto approve ads has been set

    $autoApprove = (getSet("autoapproveads")==1) ? 1 : 0;    

    $pay_status  = (getSet("adsPrice")==0) ? 1 : $pay_status;

   

    $classified_sql = "pid='$cat',name2=".GetSQLValueString($title, 'text').", description=".GetSQLValueString($descr, 'text').", price=".GetSQLValueString($price, 'text').", priceType='$prType', url=".GetSQLValueString($url, 'text').", video=".GetSQLValueString($video, 'text').", file1='$al_file1', file2='$al_file2', file3='$al_file3', file4='$al_file4', file5='$al_file5', coorx='$coorx', coory='$coory', street_address=".GetSQLValueString($streetAddress, 'text').", countryId='$countryId', cityId='$cityId', stateId='$stateId', zip=".GetSQLValueString($zip, 'text').", approved='$autoApprove', urlText=".GetSQLValueString($urlText, 'text').", urlLink=".GetSQLValueString($urlLink, 'text');

    if ($mode != "edit")

    {

        $classified_sql = "INSERT INTO ".DB_PREFIX."classifieditems SET date='$date', uid='$uid', $classified_sql, pay_status='$pay_status'";

        mysql_query($classified_sql) or die(mysql_error());

        $classified_id = mysql_insert_id();

    }

    else

    { 

        $classified_id = $_GET['page'];

        $classified_sql = "UPDATE ".DB_PREFIX."classifieditems SET $classified_sql WHERE cid='$classified_id'";

        mysql_query($classified_sql) or die(mysql_error());

    }



    $page = "/myAds";

//    if($autoApprove == 0)
//
//    {

        // Only if the auto approve is set to zero, send the mail

        //Get the User details

        $user_details     = mysql_query("SELECT * FROM ".DB_PREFIX."users WHERE uid='$uid'");

        $res_user_details = mysql_fetch_assoc($user_details);

        $user_name        = $res_user_details['firstname']." ".$res_user_details['lastname'];

        $user_phone       = $res_user_details['phone'];

        

        // From email

        $from_email       = $res_user_details['mail'];

        

        // To email

        $to_email = getSet("email");



        // Subject

        $subject = $e['approvalMailsubject'];

        

        //Message

        $mess  = $e['adEditedapprovalMailsubject'].": <br><br>";

        $mess .= $e['approvalMailTitle'].": $title<br><br>";

        $mess .= $e['approvalMailDescription'].": $descr<br><br>";

        $mess .= $e['approvalMailName'].": $user_name <br><br>";

        $mess .= $e['approvalMailPhone'].": $user_phone <br><br>";

    if($autoApprove == 0)
        $mess .= "<br><br>{$e['approvalLink']}<br>$p/admin/index.php?m=classifieds&mode=approve&pid=$classified_id&tab=5";

        

        cms_template_mail($from_email, $to_email, $subject, $mess);

//    }
//
    //else 
    if($pay_status==0)

        $page = "/pay/$classified_id";

    

    redirect($p.$page);

}



function uploadPhotos($fn)

{

    $new_image     = $_FILES[$fn];

    $new_image_tmp = $new_image['tmp_name'];

    $file_name     = "s_".time().rand(1000, 100000);   



    if( file_exists($new_image_tmp) )

    {

        $image_size = getimagesize($_FILES[$fn]['tmp_name']);

        if ( preg_match('{image/(.*)}is', $image_size['mime'], $p)) 

        {

            if(preg_match('/\.gif$|\.jpe?g$|\.png$|\.GIF$|\.JPE?G$|\.PNG$/', $_FILES[$fn]['name']))

            {

                $i_file_name = $file_name.".".$p[1];

                $upload_dir  = "upload/";

                $image_name  = $upload_dir ."/". $i_file_name;                



                move_uploaded_file($_FILES[$fn]["tmp_name"], "upload"."/".$i_file_name);

                

                edit_image_size($image_name, $i_file_name, $image_size, $module_name, false);

                

                return $i_file_name;

            }

        }

    }

}



function edit_image_size($image_name, $i_file_name, $image_size, $module_name, $waterMark)

{

    $upload_dir = "upload";

    $width_small  = 135;

    $height_small = 101;    



    // 

    $new_width = $image_size[0] / $width_small;

    $new_height= $image_size[1] / $new_width;    



    // 

    $new_width2 = $image_size[1] / $width_small;

    $new_height2= $image_size[0] / $new_width2;   



    // 

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



    // ��� ���. �����

    $nw = $image_size[0] / $b1;     // x

    $nh= $image_size[1] / $nw;    



    // ��� ����. �����.

    $nw2 = $image_size[1] / $b1;     // x

    $nh2= $image_size[0] / $nw2;    



    // ���������� ���� � ������� � ���������

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

        // ImageTTFtext($from, 20, 0, 10, $image_size[1]-10, $color, 'images/arial.ttf', '� www.sitename.com');

    }    



    if( $image_size[0] < $image_size[1] )

    {

        $to_big = imageCreateTrueColor($nh2, $b1);

        $to_small = imageCreateTrueColor($new_height2, $width_small);

    }

    else  // �������������� �����������

    {

        $to_big = imageCreateTrueColor($b1, $nh);

        $to_small = imageCreateTrueColor($width_small, $new_height);

    }    



    imageCopyResampled($to_big, $from,0,0,0,0, imageSX($to_big), imageSY($to_big), imageSX($from), imageSY($from));

    imageCopyResampled($to_small, $from, 0, 0, 0, 0, imageSX($to_small), imageSY($to_small), imageSX($from), imageSY($from));

    

    switch($image_size['mime'])

    {

        case "image/png":

            imagePng($to_big, $upload_dir."/".$i_file_name);

            imagePng($to_small, $upload_dir."/s_".$i_file_name);

            break;            



        case "image/jpg":

            imageJpeg($to_big, $upload_dir."/".$i_file_name);

            imageJpeg($to_small, $upload_dir."/s_".$i_file_name);

            break;



        case "image/jpeg":

            imageJpeg($to_big, $upload_dir."/".$i_file_name);

            imageJpeg($to_small, $upload_dir."/s_".$i_file_name);

            break;



        case "image/gif":

            imagePng($to_big, $upload_dir."/".$i_file_name);

            imagePng($to_small, $upload_dir."/s_".$i_file_name);

            break;



        default:

            break;

    }

}

?>