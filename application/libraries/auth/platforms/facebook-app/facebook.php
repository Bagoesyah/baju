<?php session_start();
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONH Social Auth v3 #
|| # Facebook SDK 5.x #
|| ##########################################||
\*==========================================*/
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
	'app_id' => $_SESSION['fb_appid'],
	'app_secret' => $_SESSION['fb_appsecret'],
	'default_graph_version' => 'v2.5'
]);


// Set Redirect_uri
$_SESSION['ssa_return_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$helper = $fb->getRedirectLoginHelper();

if ( !empty($_SESSION['access_token']) ) {

	// Return Auth Station Page
	header("Location: ".$_SESSION['authstation']);
	
}
else {
	
	try {
		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo '1. Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo '2. Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	if (isset($accessToken)) { // Logged in
		
		// Logged in!
		$_SESSION['access_token'] = (string) $accessToken;
		
		try {
			// Returns a `Facebook\FacebookResponse` object
			$response = $fb->get('/me?fields=id,name,email,gender,verified', $_SESSION['access_token']);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo '3. Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo '4. Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
	
		$user = $response->getGraphUser();
		
		$_SESSION["userprofile"]['id'] = $user['id'];
		$_SESSION["userprofile"]['email'] = $user['email'];
		$_SESSION["userprofile"]['name'] = $user['name'];
		$_SESSION["userprofile"]['gender'] = $user['gender'];
		$_SESSION["userprofile"]['verified'] = $user['verified'];
		
		
		// Return Auth Station Page
		header("Location: ".$_SESSION['authstation']);
		
	}
	else { // Not Login
		$permissions = ['email', 'user_likes']; // optional
		$loginUrl = $helper->getLoginUrl($_SESSION['ssa_return_url'], $permissions);

		header("Location: $loginUrl");

	}
}

?>