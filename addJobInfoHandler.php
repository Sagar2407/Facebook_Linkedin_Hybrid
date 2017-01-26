<?php
//This is addJobInfoHandler.php
session_start();

if(!$_SESSION['user'])  
{  
    header("Location: index.php");
} 
$uname = $_SESSION['username'];

require_once 'dblogin.php';
$conn = new mysqli($hn,$un,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);

$jobTitle=$_POST['jobTitle'];
$jobDesc=$_POST['jobDesc'];
$jobRequirements=$_POST['jobRequirements'];
$postDate=$_POST['postDate'];
$jobID=$_POST['jobID'];
$companyID=$_SESSION['companyID'];

$query = "INSERT INTO job (Job_Title, Job_Description, Job_Requirements, Post_Date,Job_ID,Company_ID) values ('$jobTitle','$jobDesc','$jobRequirements','$postDate','$jobID','$companyID')";
$result = $conn->query($query);
if(!$result) {
	die("Database Access Failed: " . $conn->error);
}else{
	echo "Your addition was successful.";
}

$conn->close();
header('LOCATION: companyProfile.php')
?>