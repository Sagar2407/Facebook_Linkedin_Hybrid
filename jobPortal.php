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
$userid = $_SESSION['user'];
$flag = 0;

	$query = "SELECT Job_ID FROM userjob where User_ID=$userid";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	$alreadyAppliedJobs = array();
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$alreadyAppliedJobs[$j] = $row[0];
	}	
	
	
?>
<html>
		<title>
			LinkedInR
		</title>
		<head>
		<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}
</style>

<script>
onerror = errorHandler
function errorHandler(message, url, line)
{
out = "Sorry, an error was encountered.\n\n";
out += "Error: " + message + "\n";
out += "URL: " + url + "\n";
out += "Line: " + line + "\n\n";
out += "Click OK to continue.\n\n";
alert(out);
return true;
}
</script>


</head>
			<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="stylesheet.css">

		<body>
		<div class=" w3-center w3-serif w3-teal w3-margin-top"><h2><strong>Job Portal</strong></h2></div>
   <button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="connectUsers.php">Connections</a>
   <button class="w3-btn w3-ripple w3-right"><a href="storyBoard.php">Story Board</a>
   <button class="w3-btn w3-ripple w3-right"><a href="employeeProfile.php"> Home </a></button>
	</div>
	<br><br><br>

 <table border="1">
<tr>
<th>Job ID</th>
<th>Job Title</th>
<th>Job Description</th>
<th>Job Requirements</th>
<th>Job Post Date</th>
<th>Company</th>
<th></th>
</tr>
<?php

	$query = "SELECT * FROM job";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$companyID = $row[5];
		
		$nquery = "SELECT Company_Title FROM company where Company_ID=$companyID";	
		$nresult = $conn->query($nquery);
		if(!$nresult) die ("Database access failed: ". $conn->error);
		$nrow = $nresult->fetch_array(MYSQLI_NUM);
		
		echo <<<_END
		<tr>
		<td><label>$row[4]</label></td>
		<td><label>$row[0]</label></td>
		<td><label>$row[1]</label></td>
		<td><label>$row[2]</label></td>
		<td><label>$row[3]</label></td>
		<td><label>$nrow[0]</label></td>
_END;

	   for($i=0;$i<count($alreadyAppliedJobs);$i++)
	   {		  
	      if($alreadyAppliedJobs[$i] == $row[4]) 
	       {
		      echo <<<_END
		      <td><label>Already Applied</label></td></tr>
_END;
			  $flag = 1;
               break;
	       }
	
	    }
		
		if($flag != 1)
		{
		       echo <<<_END
			   <td>
			   <form action="userJobApplication.php" method="POST">
			   <input type="hidden" name="jobID" value="$row[4]">
			   <input type="submit" value="Apply">
			   </form>
			   </td>
			   </tr>
_END;
		}
		
		$flag = 0;
		
		
		
	}
	

?>