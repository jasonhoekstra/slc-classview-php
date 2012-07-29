<?php
session_start();

//open connection
$ch = curl_init();
//https://api.sandbox.slcedu.org/api/rest/v1/studentSectionAssociations?studentId=2012al-b7019126-bcf8-11e1-8506-0247757a1887
$url = 'https://api.sandbox.slcedu.org/api/rest/v1/students/2012an-b7022d67-bcf8-11e1-8506-0247757a1887';
//$url = 'https://api.sandbox.slcedu.org/api/rest/v1/students/2012an-b7022d67-bcf8-11e1-8506-0247757a1887/studentParentAssociations';
//$url = 'https://api.sandbox.slcedu.org/api/rest/v1/students/2012an-b7022d67-bcf8-11e1-8506-0247757a1887/courseTranscripts/courses';
//$url = 'https://api.sandbox.slcedu.org/api/rest/v1/students';

$token = $_SESSION['access_token'];
$code = $_SESSION['code'];

$auth = sprintf('Authorization: bearer %s', $token);
//echo $auth;

$headers = array(
  'Content-Type: application/vnd.slc+json',
  'Accept: application/vnd.slc+json',
  $auth);

curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HEADER, TRUE);
//curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);  
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, FALSE);
curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

//execute post
$result = curl_exec($ch);


//echo '<br/><br/>' . print_r(curl_getinfo($ch));
//close connection
curl_close($ch);

header('Content-type: application/json');
echo $result;

die();
$json = json_decode($result);

//print_r($json);
//print_r($json[0]);
?>