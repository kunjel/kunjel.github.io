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

$cc  = array();

$cid = 0;

if ($_GET['pid'] == "Classified" && $_GET['mode'] != "search")

{

    $parentCat = mysql_query("SELECT cid, pid,level FROM cms_classifiedcategories WHERE url='". $_GET['mode']."' ORDER BY name".langId()." ASC") or die(mysql_error());

    $parentCat = mysql_fetch_assoc($parentCat);

    $cid       = $parentCat['cid'];

}

while (count($cc)==0)

{

    if ($_GET['pid'] == "Classified" && $_GET['mode'] != "search")

    {

        $classifiedcategory_sql = "SELECT * FROM cms_classifiedcategories WHERE pid='$cid' ORDER BY name".langId()." ASC";

        $classifiedcategory_rs  = mysql_query($classifiedcategory_sql);

        

        if(mysql_num_rows($classifiedcategory_rs)==0)

        {

            $parentCat = mysql_query("SELECT cid, pid,level FROM cms_classifiedcategories WHERE cid='$cid' ORDER BY name".langId()." ASC") or die(mysql_error());

            $parentCat = mysql_fetch_assoc($parentCat);

            $cid       = $parentCat['pid'];

        }

    }

    else

        $classifiedcategory_sql = "SELECT * FROM cms_classifiedcategories WHERE level=1 ORDER BY name".langId()." ASC";

        

    $classCats = mysql_query($classifiedcategory_sql) or die(mysql_error());

    for($cc = array(); $cv = mysql_fetch_assoc($classCats); $cc[] = $cv);

}

function subcategory($cid)

{

    $cids = 0;

    

    $sql = "SELECT * FROM cms_classifiedcategories WHERE pid='$cid'";

    $rs  = mysql_query($sql);

    while ($row = mysql_fetch_assoc($rs))

    {

        	$cids .= ",".$row['cid'];

        	$cids .= ",".subcategory($row['cid']);

    }

    

    return $cids;

}

$showcategorycount = getSet("showcategorycount");

foreach ($cc as $key=>$category)

{

    $cid  = $cids = $category['cid'];

    $cids .= ','.subcategory($cid);

    $sql = "SELECT * FROM cms_classifieditems WHERE pid IN ($cids) AND approved=1 AND pay_status=1";

//    echo $sql.'<br><br>';

    $rs  = mysql_query($sql);

    $cc[$key]['count'] = '';

    if($showcategorycount==1)

        $cc[$key]['count'] = ' ('.mysql_num_rows($rs).')';

}

//exit;

$randItems = mysql_query("SELECT cms_classifieditems.name2, cms_classifieditems.url, cms_classifieditems.file1, cms_classifiedcategories.url as catUrl FROM cms_classifieditems LEFT JOIN cms_classifiedcategories ON cms_classifiedcategories.cid = cms_classifieditems.pid WHERE cms_classifieditems.file1 != '' AND cms_classifieditems.approved=1 AND cms_classifieditems.pay_status=1 ORDER BY cms_classifieditems.cid DESC LIMIT 7") or die("dont get categories");

for($ni = array(); $cv = mysql_fetch_assoc($randItems); $ni[] = $cv);

?>