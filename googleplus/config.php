<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '878193191958-ol01mfir21ubo13lvj68c50j56e79qpu.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'aOqV-lKGildi6_US5-R5J9xL'; //Google CLIENT SECRET
$redirectUrl = 'http://adityaaggarwal.com/Team-Roots-Web/googleplus/index.php';  //return url (url to script)
$homeUrl = 'http://adityaaggarwal.com/Team-Roots-Web/googleplus/index.php';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);