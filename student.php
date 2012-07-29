<?php
session_start();


$ch = curl_init();

$url = sprintf('https://api.sandbox.slcedu.org/api/rest/v1/students/%s', $_GET['UUID']);

$token = $_SESSION['access_token'];
$code = $_SESSION['code'];

$auth = sprintf('Authorization: bearer %s', $token);
//echo $auth;

$headers = array(
  'Content-Type: application/vnd.slc+json',
  'Accept: application/vnd.slc+json',
  $auth);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, FALSE);
curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

//header('Content-type: application/json');
//echo $result;

$student = json_decode($result);
?>

<html>
  <head>
    <link rel="stylesheet"  href="jq-mobile/jquery.mobile-1.1.0.min.css" />
    <script src="jq-mobile/jquery-1.7.2.min.js"></script>
    <script src="jq-mobile/jquery.mobile-1.1.0.min.js"></script>
  </head>
  <body>
    <div data-role="header" data-position="fixed" data-position="inline"> 
	<h1>ClassView</h1> 
  <a href="start.php" data-rel="back" data-icon="back" class="ui-btn-right">Back</a>
</div>
    <h2 style="text-align: center"><?php echo $student->name->firstName . ' ' . $student->name->lastSurname ?></h2>
    <h3><?php echo $student->gradeLevel ?></h3>


<?php
/* 
foreach ($json as $student) {
  echo '<li><a href="#">';
  echo $student->name->firstName . ' ' . $student->name->lastSurname . '<br/>';
  echo '</a></li>';
}
 * 
 */
?>

    <div data-role="footer" data-position="fixed"> 
	<h1></h1> 
</div>
  </body>

</html>

