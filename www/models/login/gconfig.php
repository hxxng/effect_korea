<?php
//Include Google Client Library for PHP autoload file
require_once 'google/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('setClientId.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('setClientSecret');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri(STATIC_HTTP.'/models/login/login.php');

$google_client->addScope('email');

//start session on web page
session_start();

?>