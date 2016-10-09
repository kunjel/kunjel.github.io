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
global $l;
$autoDeleteAds = getSet("autoDeleteAds");
//Delete ads only if the auto delete ads is set to 1
if($autoDeleteAds != 0){
	$todays_date = date("Y-m-d H:i:s");
	
	$adsToBeDeleted = array();
	
	$ads = mysql_query('SELECT cid, date as date1, CURDATE() as cur FROM ' . DB_PREFIX."classifieditems". ' ORDER BY cid DESC') or die("dont get classifieditems");
	while($row = mysql_fetch_array($ads)){
		//echo $row['cur']."<br>";
		//echo date("Y-m-d",$row['date1']);echo "<br>";
		//echo $row['cid']."<br>";
		
		//$days = (strtotime($row['cur']) - $row['date1']) / ( 60 * 60 * 24);
		//echo floor($days);echo "<br><br>";
		$date1 = date("Y-m-d",$row['date1']);
		$diff = daysDifference($todays_date,$date1);
		
		if($diff >= $autoDeleteAds){
		//if($diff == 0){
			$adsToBeDeleted[] = $row['cid'];
		}
		
		//echo "<br>-----------------------------------<br>";
	}
	
	function daysDifference($endDate, $beginDate)
	{
	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
	}
	
	
	
	//Delete all the ad details
	//print_r($adsToBeDeleted);
	foreach($adsToBeDeleted as $k=>$v){
		$sql = mysql_query('select * from ' . DB_PREFIX."classifieditems". ' where cid = '.$v);
		
		$res = mysql_fetch_array($sql);
		
		if($res['file1']!=""){
			@unlink("../upload/".$res['file1']);
			@unlink("../upload/s_".$res['file1']);
		}
		if($res['file2']!=""){
			@unlink("../upload/".$res['file2']);
			@unlink("../upload/s_".$res['file2']);
		}
		if($res['file3']!=""){
			@unlink("../upload/".$res['file3']);
			@unlink("../upload/s_".$res['file3']);
		}
		if($res['file4']!=""){
			@unlink("../upload/".$res['file4']);
			@unlink("../upload/s_".$res['file4']);
		}
		if($res['file5']!=""){
			@unlink("../upload/".$res['file5']);
			@unlink("../upload/s_".$res['file5']);
		}
		
		$del = mysql_query('delete from ' . DB_PREFIX."classifieditems". ' where cid = '.$v);
		
	}
	if($del){
		echo "Ads were deleted successfully";
	}
	else{
		echo "No Ads to delete.";
	}
}
?>
