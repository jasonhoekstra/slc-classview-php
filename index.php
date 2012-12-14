<?php

session_start();

include 'settings.php';

// If the session verification code is not set, redirect to the SLC Sandbox authorization endpoint
if (!isset($_GET['code'])) {
  $url = 'https://api.sandbox.slcedu.org/api/oauth/authorize?client_id=' . CLIENT_ID . '&redirect_uri=' . REDIRECT_URI;
header('Location: ' . $url);
    die('Redirect'); 
} else {
  
session_start();
    
$url = 'https://api.sandbox.slcedu.org/api/oauth/token?client_id=' . CLIENT_ID . '&client_secret=' . CLIENT_SECRET . '&grant_type=authorization_code&redirect_uri='.REDIRECT_URI.'&code='. $_GET['code'];


//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 'Content-Type: application/vnd.slc+json');
curl_setopt($ch, CURLOPT_HEADER, 'Accept: application/vnd.slc+json');

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

// de-serialize the result into an object
$result = json_decode($result);

// set the session with the access_token and verification code
$_SESSION['access_token'] = $result->access_token;
$_SESSION['code'] = $_GET['code'];

// redirect to the start page of the application
header('Location: ' . 'start.php');
}
?>
