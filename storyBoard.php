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

<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="stylesheet.css">

		<div class="w3-container ">
   <div class=" w3-center w3-serif w3-teal"><h2><strong>Story Board</strong></h2></div>
   <button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="jobPortal.php">Apply for Jobs</a>
   <button class="w3-btn w3-ripple w3-right"><a href="connectUsers.php">Connections</a>
   <button class="w3-btn w3-ripple w3-right"><a href="employeeProfile.php">Home</a></button>
</div><table border="1">

<?php

	$query = "SELECT * FROM userspost";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);
    $rows = $result -> num_rows;
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$uId = $row[3];
		$post = $row[1];
		$postDate = $row[2];
		
		$nquery = "SELECT First_Name,Last_Name FROM users where User_ID = $uId";	
		$nresult = $conn->query($nquery);
		if(!$nresult) die ("Database access failed: ". $conn->error);	
		$nrow = $nresult -> fetch_array(MYSQLI_NUM);
		
		$name = $nrow[0]." ".$nrow[1];
		
		echo <<<_END
        <tr>
		<td>$name <br/>  $postDate</td>
		<td><p>$post<p></td>
		</tr>
_END;
		
	}
	
	echo <<<_END
	<tr>
	<td colspan=2>
	<form action="addUserPostForm.php" method="POST">
	<input type="submit" value="Add Your Story">
	</form>
	</td>
	</tr>
	</table>
_END;
?>