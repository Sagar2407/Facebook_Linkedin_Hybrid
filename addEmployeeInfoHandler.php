<?php
//This is addEmployeeInfoHandler.php
require_once 'dblogin.php';
$conn = new mysqli($hn,$un,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);

session_start();
if(!$_SESSION['user'])  
{  
    header("Location: index.php");
} 
$uname = $_SESSION['username'];
$userID = $_SESSION['user'];

if(isset($_POST['title']) &&
isset($_POST['location']) &&
isset($_POST['maritalStatus']) &&
isset($_POST['email']) &&
isset($_POST['phoneNumber']) &&
isset($_POST['summary']) &&
isset($_POST['prolink']))
{
$personalTitle=get_post($conn,'title');
$personalTitle = sanitizeString($personalTitle);
$personalTitle = sanitizeMySQL($conn, $personalTitle);
$location=get_post($conn,'location');
$location = sanitizeString($location);
$location = sanitizeMySQL($conn, $location);
$maritalStatus=get_post($conn,'maritalStatus');
$maritalStatus = sanitizeString($maritalStatus);
$maritalStatus = sanitizeMySQL($conn, $maritalStatus);
$email=get_post($conn,'email');
$email = sanitizeString($email);
$email = sanitizeMySQL($conn, $email);
$phoneNumber=get_post($conn,'phoneNumber');
$phoneNumber = sanitizeString($phoneNumber);
$phoneNumber = sanitizeMySQL($conn, $phoneNumber);
$proSummary=get_post($conn,'summary');
$proSummary = sanitizeString($proSummary);
$proSummary = sanitizeMySQL($conn, $proSummary);
$proLink=get_post($conn,'prolink');
$proLink = sanitizeString($proLink);
$proLink = sanitizeMySQL($conn, $proLink);
}


if(isset($_POST['actionEvent'])&& $_POST['actionEvent'] == "IUPD")
{
$profileQuery = "INSERT INTO user_profile  values (NULL,'$personalTitle','$location','$proSummary','$proLink','$maritalStatus','$email','$phoneNumber',$userID)";
$profileQueryResult = $conn->query($profileQuery);
if(!$profileQueryResult) {
	die("Database Access Failed: " . $conn->error);
}else{
	header('LOCATION: employeeProfile.php');
	$conn->close();
}
}

if(isset($_POST['actionEvent'])&& $_POST['actionEvent'] == "UUPD")
{
	$userProfileID = $_POST['userProfileID'];
	
	$query = "UPDATE user_profile SET Title='$personalTitle', Location='$location',
								  Summary='$proSummary', Profile_Link='$proLink',
								  Marital_Status='$maritalStatus',Contact_Email_ID='$email',
								  Phone_Number='$phoneNumber' where User_Profile_ID=$userProfileID";
	$result = $conn->query($query);
	if(!$result) echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";

	header('Location: employeeProfile.php');
	exit();
}

function get_post($conn, $var){
  return $conn->real_escape_string($_POST[$var]);
}

function sanitizeString($var)
{
$var = stripslashes($var);
$var = strip_tags($var);
$var = htmlentities($var);
return $var;
}

function sanitizeMySQL($connection, $var)
{
$var = $connection->real_escape_string($var);
$var = sanitizeString($var);
return $var;
}
?>