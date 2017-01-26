<?php
session_start();

if(!$_SESSION['user'])  
{  
    header("Location: index.php");
} 
$uname = $_SESSION['username'];
$userid = $_SESSION['user'];

require_once 'dblogin.php';
$conn = new mysqli($hn,$un,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);

$post=$_POST['post'];
$postDate=date("Y/m/d");

$query = "INSERT INTO userspost (post,post_date,userid) values ('$post','$postDate','$userid')";
$result = $conn->query($query);
if(!$result) {
	die("Database Access Failed: " . $conn->error);
}else{
$conn->close();
header('LOCATION: storyBoard.php');
}
?>
