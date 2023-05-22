<?php session_start();
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONHlab Social Auth v3 #
|| ##########################################||
\*==========================================*/

if ( $_SESSION['app'] == 'facebook' ) { // Facebook App

	// App ID
	$_SESSION['fb_appid'] = '128925170990046';
	// App Secret
	$_SESSION['fb_appsecret'] = '94a2972cc34ba8ed5387464985cf0394';
	
}
elseif ( $_SESSION['app'] == 'twitter' ) { // Twitter App

	// Consumer Key
	$_SESSION['tt_key'] = '<replace-your-consumer-key-here>';
	// Consumer Secret
	$_SESSION['tt_secret'] = '<replace-your-consumer-secret-here>';

}
elseif ( $_SESSION['app'] == 'google' ) { // Google App
	
	// Client ID
	$_SESSION['gg_appid'] = '<replace-your-client-id-here>';
	// Client Secret
	$_SESSION['gg_appsecret'] = '<replace-your-client-secret-here>';
	
}