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
    updateSetting("TopBannerCode", (($_POST['topbannercode'])));
    updateSetting("LeftBannerCode", (($_POST['leftbannercode'])));
    updateSetting("LeftBottomBannerCode", (($_POST['leftbottombannercode'])));
    updateSetting("LeftBannerOption", (($_POST['leftbanneroption'])));
    updateSetting("RightBannerCode", (($_POST['rightbannercode'])));
    updateSetting("TopClassifiedCode", (($_POST['topclassifiedcode'])));
    updateSetting("RightClassifiedCode", (($_POST['rightclassifiedcode'])));
    updateSetting("BottomClassifiedCode", (($_POST['bottomclassifiedcode'])));
    updateSetting("RightClassifiedDetailsCode", (($_POST['rightclassifieddetailscode'])));
    
    redirect("index.php?m=banners&mode=saved");
}
?>