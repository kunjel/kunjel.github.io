<?php
// *************************************************************************
// *                                                                       *
// * Top Classified Software                                               *
// * Copyright (c) Top Classified Software. All Rights Reserved,           *
// * Release Date: September 23, 2011                                         *
// * Version 4.0.0                                                         *
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
function mailx($mail) {
  list ($head, $body) = preg_split("/\r?\n\r?\n/s", $mail, 2);
  $to = "";
  if (preg_match('/^To:\s*([^\r\n]*)[\r\n]*/m', $head, $p)) {
    $to = @$p[1]; 
    $head = str_replace($p[0], "", $head);
  }
  $subject = "";
  if (preg_match('/^Subject:\s*([^\r\n]*)[\r\n]*/m', $head, $p)) {
    $subject = @$p[1];
    $head = str_replace($p[0], "", $head);
  }
  mail($to, $subject, $body, trim($head));
}
function mailenc($mail) {
  list ($head, $body) = preg_split("/\r?\n\r?\n/s", $mail, 2);
  $encoding = '';
  $re = '/^Content-type:\s*\S+\s*;\s*charset\s*=\s*(\S+)/mi';
  if (preg_match($re, $head, $p)) $encoding = $p[1];
  $newhead = "";
  foreach (preg_split('/\r?\n/s', $head) as $line) {
    $line = mailenc_header($line, $encoding);
    $newhead .= "$line\r\n";
  }
  return "$newhead\r\n$body";
}
function mailenc_header($header, $encoding) {
  if (!$encoding) return $header;
  $GLOBALS['mail_enc_header_encoding'] = $encoding;
  return preg_replace_callback(
    '/([\x7F-\xFF][^<>\r\n]*)/s',
    'mailenc_header_callback',
    $header
  );
}
function mailenc_header_callback($p) {
  $encoding = $GLOBALS['mail_enc_header_encoding'];
  preg_match('/^(.*?)(\s*)$/s', $p[1], $sp);
  return "=?$encoding?B?".base64_encode($sp[1])."?=".$sp[2];
}
function cms_template_mail($from, $to, $subject, $body, $charset="UTF-8") {
    $tos = array();
    $tos[] = $to;
    $to = trim($to);
    $subject = trim($subject);
    foreach ($tos as $to)
    {
       $mail  = "From: ". $from ."\r\n";
       $mail .= "To: ". $to ."\r\n";
       $mail .= "Reply-To: ". $from ."\r\n";
       $mail .= "Subject: ". $subject ."\r\n";
       $mail .= "Content-type: text/html; \r\n";
       $mail .= "\t charset=".$charset." \r\n\r\n";
       $mail .= $body;
       $mail = mailenc($mail);
       mailx($mail);
    }
}
?>