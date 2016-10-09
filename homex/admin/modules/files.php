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
	if (isset($_GET['delete']))
		DeleteFile();
	$upId = 1;
	if (isset($_POST['upload2']))
    	$upId = 2;
    else if (isset($_POST['upload3']))
    	$upId = 3;
	if (isset($_POST['upload' . $upId]))
	{
  	    $newFile = $_FILES['file' . $upId];
  	    $tmpName = $newFile['tmp_name'];
  	    if(file_exists($tmpName))
  	    {
  	    	$newName = $newFile['name'];
  	    	if ($upId == 1)
  	    		$path = "../upload/images/";
            else if ($upId == 2)
  	    		$path = "../upload/docs/";
            else
  	    		$path = "../upload/other/";
  	    	if (file_exists($path . $newName))
  	    	{
  	    		while(file_exists($path . $newName))
  	    		{
  	    			$i = 1;
  	    			$newName = $i . $newName;
  	    			$i++;
  	    		}
  	    	}
  	    	move_uploaded_file($tmpName, $path . $newName);
  	    	$uploadedFile = $path . $newName;
  	    }
	}
	function DeleteFile()
	{
		$deleteFrom = $_GET['deleteFrom'];
		if ($deleteFrom == "1")
			$d = "images";
		else if ($deleteFrom == "2")
	    	$d = "docs";
		else
	    	$d = "other";
		$fname = "../upload/" . $d . "/" . $_GET['delete'];
		if (file_exists($fname))
	  		Unlink($fname);
	  	redirect("index.php?m=files&tab=" . $deleteFrom . "&mode=deleted");
	}
?>
