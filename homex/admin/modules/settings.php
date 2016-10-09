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

if (isset($_POST['saveSettings']))

{

    updateSetting("email", trim($_POST['email']));

    updateSetting("projectName", trim($_POST['projectName']));

    updateSetting("url", trim($_POST['url']));

    updateSetting("timeZone", trim($_POST['timeZone']));

    updateSetting("signUp", trim($_POST['signUp']));

    updateSetting("googleMaps", trim($_POST['googleMaps']));

    updateSetting("counters", trim(($_POST['counters'])));

    updateSetting("headMeta", trim($_POST['headMeta']));

    updateSetting("skin", trim($_POST['skin']));

    updateSetting("payPalEmail", trim($_POST['payPalEmail']));

    updateSetting("title2", trim($_POST['title2']));

    updateSetting("keys2", trim($_POST['keys2']));

    updateSetting("descr2", trim($_POST['descr2']));

    updateSetting("ShowFooterLink", trim($_POST['showAffiliateFooterLink']));

    updateSetting("AffiliateID", trim($_POST['AffiliateID']));

    updateSetting("captchaPublicKey", trim($_POST['captchaPublicKey']));

    updateSetting("captchaPrivateKey", trim($_POST['captchaPrivateKey']));

    updateSetting("defaultLanguage", trim($_POST['defaultLanguage']));

    updateSetting("autoDeleteAds", trim($_POST['autoDeleteAds']));

    updateSetting("cronInstruction", trim($_POST['cronInstruction']));

    updateSetting("classPerPage", trim($_POST['classPerPage']));

    updateSetting("classPrice1", trim($_POST['classPrice1']));

    updateSetting("classPrice2", trim($_POST['classPrice2']));
    
    updateSetting("adsPrice", trim($_POST['adsPrice']));

    updateSetting("classCurrency", $_POST['classCurrency']);

    updateSetting("classDefCountry", trim($_POST['classDefCountry']));

    updateSetting("classPayDays", trim($_POST['classPayDays']));

    

    $disableStates  = ($_POST['disableStates'] == "1") ? '1' : '0';

    $autoapproveads = ($_POST['autoapproveads'] == "1") ? '1' : '0';

    $projectNameDisplay = ($_POST['projectNameDisplay'] == "1") ? '1' : '0';

    $showcategorycount = ($_POST['showcategorycount'] == "1") ? '1' : '0';

    updateSetting("disableStates", $disableStates);

    updateSetting("autoapproveads", $autoapproveads);

    updateSetting("projectNameDisplay", $projectNameDisplay);

    updateSetting("showcategorycount", $showcategorycount);

    

    updateSetting("newsPerPage", trim($_POST['newsSet1']));

    updateSetting("newsLength", trim($_POST['newsSet2']));

    updateSetting("articlesPerPage", trim($_POST['articlesSet1']));

    updateSetting("articlesLength", trim($_POST['articlesSet2']));

    

    $headerImage = getSet('headerImage');

    if(isset($_POST['headerImageDelete']) && $headerImage!='')

    {

        updateSetting("headerImage", '');

        @unlink('../'.$headerImage);

    }

        

    if($_FILES['headerImage']['size']>0 && strstr($_FILES['headerImage']['type'], 'image'))

    {

        $tmp_name   = $_FILES['headerImage']['tmp_name'];

        $file_name  = $_FILES['headerImage']['name'];

        $file_names = explode('.',$file_name);

        $ext        = $file_names[count($file_names)-1];

        

        $file_name = 'images/header.'.$ext;

        copy($tmp_name, '../'.$file_name);

        

        updateSetting("headerImage", $file_name);

        if($file_name!=$headerImage)

            @unlink('../'.$headerImage);

    }

    

    addToLog($_SESSION['uid'], 10, 0, 4);

    

    redirect("index.php?m=settings&mode=saved");

}

function get_template_folders(){

    $templates_dir = "../templates/";

    if( file_exists($root . $templates_dir) ) {

        $files = scandir($root . $templates_dir);

        natcasesort($files);

        if( count($files) > 2 ) { /* The 2 accounts for . and .. */

            $dir = array();

            foreach( $files as $file ) {

                if( file_exists($root . $templates_dir . $file) && $file != '.' && $file != '..' && is_dir($root . $templates_dir . $file)) {

                    $dir[] = $file;

                }

            }

        }

    }

    

    return $dir;

}

function get_languages(){

    $templates_dir = "../langs/";

    if( file_exists($root . $templates_dir) ) {

        $files = scandir($root . $templates_dir);

        natcasesort($files);

        if( count($files) > 2 ) { /* The 2 accounts for . and .. */

            $dir = array();

            foreach( $files as $file ) {

                if( file_exists($root . $templates_dir . $file) && $file != '.' && $file != '..') {

                    $file = explode(".",$file);

                    $dir[] = strtoupper($file[0]);

                }

            }

        }

    }

    

    return $dir;

}

?>