<?php
session_start();
if(!$_SESSION['user'])  
{  
    header("Location: index.php");
} 
$uname = $_SESSION['username'];

require_once 'dblogin.php';
$conn = new mysqli($hn,$un,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['empExpJobTitle']) &&
isset($_POST['empExpJobDescription']) &&
isset($_POST['empExpJobStart']) &&
$_POST['whatEmpSectionIsBeingAdded'] == "WE")
{
$empExpJobTitle=get_post($conn,'empExpJobTitle');
$empExpJobTitle = sanitizeString($empExpJobTitle);
$empExpJobTitle = sanitizeMySQL($conn, $empExpJobTitle);
$empExpJobDescription=get_post($conn,'empExpJobDescription');
$empExpJobDescription = sanitizeString($empExpJobDescription);
$empExpJobDescription = sanitizeMySQL($conn, $empExpJobDescription);
$empExpJobStart=get_post($conn,'empExpJobStart');
$empExpJobStart = sanitizeString($empExpJobStart);
$empExpJobStart = sanitizeMySQL($conn, $empExpJobStart);
$empExpJobEnd = get_post($conn,'empExpJobEnd');
$empExpJobEnd = sanitizeString($empExpJobEnd);
$empExpJobEnd = sanitizeMySQL($conn, $empExpJobEnd);


if(isset($_POST['actionEvent'])&& $_POST['actionEvent'] == "IUExpD")
{
	$userProfileID = $_POST['userProfileID'];
	$query = "INSERT INTO work_experience  values (NULL,'$empExpJobTitle','$empExpJobDescription','$empExpJobStart','$empExpJobEnd',$userProfileID)";
	$result = $conn->query($query);
	if(!$result) die("Database Access Failed: " . $conn->error);
	else
	{
		header('LOCATION: employeeProfile.php');
		$conn->close();
	}
}

if(isset($_POST['actionEvent'])&& $_POST['actionEvent'] == "UUExpD")
{	
    $expID = $_POST['expID'];
	$query = "UPDATE work_experience SET Job_Title='$empExpJobTitle', Description='$empExpJobDescription',
								  Start_Date='$empExpJobStart', End_Date='$empExpJobEnd'
								  where Experience_ID=$expID";
	$result = $conn->query($query);
	if(!$result) echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";

	header('Location: employeeProfile.php');
	exit();
}

}

if(isset($_POST['university']) &&
isset($_POST['college']) &&
isset($_POST['degree']) &&
isset($_POST['GPA']) &&
isset($_POST['empEduJobStart']) &&
$_POST['whatEmpSectionIsBeingAdded'] == "EDU")
{
$university=get_post($conn,'university');
$university = sanitizeString($university);
$university = sanitizeMySQL($conn, $university);
$college=get_post($conn,'college');
$college = sanitizeString($college);
$college = sanitizeMySQL($conn, $college);
$degree=get_post($conn,'degree');
$degree = sanitizeString($degree);
$degree = sanitizeMySQL($conn, $degree);
$GPA = get_post($conn,'GPA');
$GPA = sanitizeString($GPA);
$GPA = sanitizeMySQL($conn, $GPA);
$empEduJobStart = get_post($conn,'empEduJobStart');
$empEduJobStart = sanitizeString($empEduJobStart);
$empEduJobStart = sanitizeMySQL($conn, $empEduJobStart);
$empEduJobEnd = get_post($conn,'empEduJobEnd');
$empEduJobEnd = sanitizeString($empEduJobEnd);
$empEduJobEnd = sanitizeMySQL($conn, $empEduJobEnd);

if(isset($_POST['actionEvent'])&& $_POST['actionEvent'] == "IUEduD")
{
	$userProfileID = $_POST['userProfileID'];
	$query = "INSERT INTO education values (NULL,'$university','$college','$degree','$GPA','$empEduJobStart','$empEduJobEnd',$userProfileID)";
	$result = $conn->query($query);
	if(!$result) die("Database Access Failed: " . $conn->error);
	else
	{
		header('LOCATION: employeeProfile.php');
		$conn->close();
	}
}

if(isset($_POST['actionEvent'])&& $_POST['actionEvent'] == "UUEduD")
{	
    $eduID = $_POST['eduID'];
	
	$query = "UPDATE education SET University='$university', College='$college',
	                              Degree='$degree', GPA='$GPA',
								  Start_Date='$empEduJobStart', End_Date='$empEduJobEnd'
								  where Education_ID=$eduID";
	$result = $conn->query($query);
	if(!$result) echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";

	header('Location: employeeProfile.php');
	exit();
}



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