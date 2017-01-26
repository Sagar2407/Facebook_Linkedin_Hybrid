<?php
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

$toBeConnectedUserID = $_POST['toBeConnectedUser'];

$Query = "INSERT INTO userconnections  values ($userID,$toBeConnectedUserID)";
$QueryResult = $conn->query($Query);
if(!$QueryResult) {
	die("Database Access Failed: " . $conn->error);
}else{
	$conn->close();
	header('LOCATION: employeeProfile.php');
	exit();
}
?>