<?php
include_once("config.php");

if(isset($_REQUEST['code'])){
	$gClient->authenticate();
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {

	 $ticket = $gClient->verifyIdToken($gClient->getAccessToken()->id_token);
	  if ($ticket) {
	    $data = $ticket->getAttributes();
	    if(isset($data['payload']['hd'])) {
	    	if($data['payload']['hd']=="teamroots.org"){
	    			$userProfile = $google_oauthV2->userinfo->get();
					$_SESSION['google_data_teamroots'] = $userProfile; // Storing Google User Data in Session
					$_SESSION['token'] = $gClient->getAccessToken();
					header("location: addUsers.php");
	    	} else {
	    		header("location: logout.php?logout");
	    	}
	    } else {
	    		header("location: logout.php?logout");
	    }
	  }
	
} else {
	$authUrl = $gClient->createAuthUrl();
}

if(isset($authUrl)) {
	header('Location: '.$authUrl);
	echo '<style>
			body {
				text-align: center;
			}
			img {
				height:100px;
			}
		</style>';
	echo '<a href="'.$authUrl.'"><img style="height:100px;" src="images/glogin.png" alt=""/></a>';
} else {
	echo '<a href="logout.php?logout">Logout</a>';
}