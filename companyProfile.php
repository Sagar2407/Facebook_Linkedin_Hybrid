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

if (isset($_SESSION['companyTitle']) || isset($_SESSION['fromIndex']))
{
	if(!isset($_SESSION['fromIndex'])) $companyTitle = $_SESSION['companyTitle'];
	else
	{
		 $userid = $_SESSION['user'];
		 $query = "SELECT Company_Title FROM company where User_ID = '$userid'";	
		 $result = $conn->query($query);
		 if(!$result) die ("Database access failed: ". $conn->error);	
		 $row = $result->fetch_array(MYSQLI_NUM);
		 $companyTitle = $row[0];
		 $_SESSION['companyTitle'] =  $companyTitle;
	}
	
	
	$query = "SELECT * FROM company where Company_Title = '$companyTitle'";
	$result = $conn->query($query);
	if(!$result) die ("Database access failed: ". $conn->error);	

	$rows = $result -> num_rows;	
?>

<html>
		<title>
			LinkedInR
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="stylesheet.css">
		<style>
		#header-wrap {
    position: fixed;
    height: auto;
    width: 100%;
    z-index: 100
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


<?php
	
	echo <<<_END
		
		
		<body>
		<div id="header-wrap" class="w3-container">
   <div  class=" w3-center w3-serif w3-teal"><h2><strong>Company Portal</strong></h2></div>
	<button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="companyProfile.php">Home</a></button>
		<br><br><br><br>
			<div id = "wrapper">
<table>
_END;

$row = "";
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<tr>
		<td><label>Company Title: </label></td>
		<td><label>$row[0]</td>
		</tr>
		<tr>
		<td><label>Company Description: </label></td>
		<td><label>$row[1]</td>
		</tr>
		<tr>
		<td><label>Company Website: </label></td>
		<td><label>$row[2]</td>
		</tr>
_END;
	}
	
	echo <<<_END
	<tr><td colspan=3><a href="companyLanding.php?param1=userClickedUpdate&amp;param2=$row[3]" class="w3-blue"><u>Update Company Details</u></a></td></tr>
	</table></div>
_END;
	
	$companyID = $row[3];
	$_SESSION['companyID'] = $companyID;
	
	$companyTitle = $_SESSION['companyTitle'];
	$query = "SELECT * FROM job where Company_ID = '$companyID'";
	$result = $conn->query($query);
	if(!$result) die ("Database access failed: ". $conn->error);	

	$rows = $result -> num_rows;
	
	echo <<<_END
		<br><br><br>
		<table>
		<tr>
		<th><label>Job Title </label></th>
		<th><label>Job Description </label></th>
		<th><label>Job Post Date </label></th>
		<th><label>Job ID </label></th>
		</tr>
_END;
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<tr>
		<td><label>$row[0]</label></td>
		<td><label>$row[1]</td>
		<td><label>$row[3]</label></td>
		<td><label>$row[4]</label></td>
		</tr>
_END;
	}
	
	echo <<<_END
		<tr>
		<td colspan=4 align="center">
		<form action="submitJobInfo.php" method="post">
		<input type="hidden" name="companyID" value=$companyID>
		<input type="submit" value="add job">
		</form>
		<td>
		</tr>
         </table>
		 
_END;
}
?>