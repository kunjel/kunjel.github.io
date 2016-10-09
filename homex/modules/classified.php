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

?>

<?

    global $p;

	

	global $e;

	$error = null;

	

	function getSocialNetworkingIcons(){

	?>

	<iframe src="//www.facebook.com/plugins/like.php?app_id=239514526096475&amp;href=<?php echo "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>

		<br />

	<!-- Google +1 Code -->

	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

		<g:plusone size="medium"></g:plusone>

	  <!-- Social network buttons -->

		<br />

	 <!-- <div class="addthis_menu1">

		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">

		<a class="addthis_button_preferred_1"></a>

		<a class="addthis_button_preferred_2"></a>

		<a class="addthis_button_preferred_3"></a>


		</div>

		<br />

		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4d4ecba542ae98b2"></script>

	  </div>-->

	<?php

	}

	function getShareThisIcons(){

	?>

	  <!--<div class="addthis_menu1">

		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">

		<a class="addthis_button_preferred_1"></a> 

		<a class="addthis_button_preferred_2"></a>

		<a class="addthis_button_preferred_3"></a>

		<a class="addthis_button_preferred_4"></a>

		<a class="addthis_button_compact"></a>

		</div>

		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4d4ecba542ae98b2"></script>

	  </div>-->

	<?php

	}

		

	

	$publickey = getSet("captchaPublicKey");

	$privatekey = getSet("captchaPrivateKey");

    if (isset($_POST['search_x']))

    {

	    $search_text = trim( $_POST['searchText'] );

	    $search_text = substr( $search_text, 0, 64 );

	    $search_text = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search_text);

	    $searched = trim(preg_replace("/\s(\S{1,1})\s/", " ", ereg_replace(" +", "  "," $search_text ")));

	    $search_text = ereg_replace(" +", " ", $search_text);

 //$search_text = str_replace("%20", "+", $search_text);

 //echo  $search_text;exit;

  $search_text = str_replace(" ","-",$search_text);

    	redirect($p . "/Classified/search/" . $search_text);

    }

	//Contact form input

	if($_POST['contact_name']!=""){

		if ($_POST["recaptcha_response_field"]) {

			$resp = recaptcha_check_answer ($privatekey,

											$_SERVER["REMOTE_ADDR"],

											$_POST["recaptcha_challenge_field"],

											$_POST["recaptcha_response_field"]);

			$name 		= htmlspecialchars(trim($_POST['contact_name']));

	

			$email 		= htmlspecialchars(trim($_POST['contact_email']));

	

			$message 	= htmlspecialchars(trim($_POST['contact_message']));

			

			$url 	= htmlspecialchars(trim($_POST['url']));

			$seller_email = htmlspecialchars(trim($_POST['seller_email']));

			

			$subject = $e['contact_seller'];

	

			if ($resp->is_valid) {

					

					$erStr = "";

					$errorReqFields = 0;

					$mess = $e['firstNameLastName'].": ". $name . "<br/>";

					$mess .= $e['emailAddress'].": ". $email . "<br/>";

					$mess .= $e['emailMessage'].": ". $message . "<br/>";

					$mess .= $e['emailURL'].": ". $url . "<br/>";

					if (strlen($erStr) == 0 && $errorReqFields == 0) // ok

					{

						$message = "";

						$message .= "";

						cms_template_mail($email, $seller_email, $subject, $mess);

						redirect($url."?e=".$seller_email."&success=1"); 

					}

					

					

			} else {

					# set the error code so that we can display it

					$error = $resp->error;

					redirect($url."?e=".$seller_email."&success=2");

			}

		}

		else{

			# set the error code so that we can display it

			$error = $resp->error;

			redirect($url."?e=".$seller_email."&success=2");

		}

	}

?>

