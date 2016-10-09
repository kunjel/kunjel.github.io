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

if ($_GET['page']=="success")

{

    $user_id = trim($_SESSION['uid']);

    $now     = now();

    $paidTo  = time() + (getSet("classPayDays") * 60 * 60 * 24);

        

    list($classified_id, $type)= explode('_', trim($_GET['mode']));

    

    $ptype = ($type==3) ? 1 : (($type==4) ? 2 : $type);

    

    if($type==0)

        $classified_sql = "pay_status=1";

    else

        $classified_sql = "pay='$ptype',paidTo='$paidTo',pay_status=1";

        

    mysql_query("UPDATE ".DB_PREFIX."classifieditems SET $classified_sql WHERE cid='$classified_id'") or die(mysql_error()); 

    //if($ptype==1 || $ptype==2)

        mysql_query("INSERT INTO ".DB_PREFIX."payments SET cid='$classified_id',uid='$user_id',date='$now',ptype='$ptype'") or die(mysql_error());



    redirect($p."/myAds/successPay");

}

else if ($_GET['page'] == "cancel")

{

    redirect($p."/myAds/cancelPay");

}



if (isset($_POST['pay']) && $_GET['mode'] > 0)

{

    $classified_id  = trim($_GET['mode']);

    $classified_pt  = trim($_POST['pt']);

    

    $ppEmail        = getSet("payPalEmail");

    $ccode          = getSet("classCurrency");    

    $featured_price = getSet("classPrice1");

    $bold_price     = getSet("classPrice2");

    $ads_price      = getSet("adsPrice");

    

    if ($classified_pt==1)

        $amount    = $featured_price;

    elseif ($classified_pt==2)

        $amount    = $bold_price;    

    elseif ($classified_pt==0)

        $amount    = $ads_price;

    elseif ($classified_pt==3)

        $amount    = $featured_price + $ads_price;

    elseif ($classified_pt==4)

        $amount    = $bold_price + $ads_price;

        

    $invoiceId = "{$classified_id}_{$classified_pt}";    

    $returnUrl = "$p/pay/$invoiceId/success";

    $cancelUrl = "$p/pay/$invoiceId/cancel";



    redirect("https://www.paypal.com/cgi-bin/webscr?business=$ppEmail&cmd=_xclick&item_name=Invoice%20No%20$invoiceId&amount=$amount&currency_code=$ccode&no_shipping=1&return=$returnUrl&cancel_return=$cancelUrl"); exit;

}

?>