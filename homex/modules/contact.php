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
global $p;
global $e;
global $l;
	
$publickey  = getSet("captchaPublicKey");
$privatekey = getSet("captchaPrivateKey");
if (isset($_POST['contactSend']))
{
    if ($_POST["recaptcha_response_field"])
    {
        $resp     = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
        $name 	  	= htmlspecialchars(trim($_POST['contact_name']));
        $email 		 = htmlspecialchars(trim($_POST['contact_email']));
        $subject 	= htmlspecialchars(trim($_POST['contact_subject']));
        $message 	= htmlspecialchars(trim($_POST['contact_message']));
        
        $erStr    = "";
        $errorReqFields = 0;
        
        if ($resp->is_valid)
        {
            $mess = $e['approvalMailName'].": ". $name . "<br/>";
            $mess .= $e['emailAddress'].": ". $email . "<br/>";
            $mess .= $l['subject'].": ". $subject . "<br/>";
            $mess .= $e['emailMessage'].": <br/>". $message . "<br/>";
        
            if (strlen($erStr) == 0 && $errorReqFields == 0) // ok
            {
                $send_email   = getSet("email");
                $mail_subject = "Contact from ".getSet("projectName");
                cms_template_mail($email, $send_email, $mail_subject, $mess);
                
                redirect($p."/Contact/1");
            }
        }
        else
            redirect($p."/Contact/2");
    }
    else
        redirect($p."/Contact/2");
}
?>
