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



if (isset($_SESSION['user']))
{
	if(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP") $userid=$_POST['connectedUserID'];
	else
	{
		$userid = $_SESSION['user'];
	}
	
    $query = "SELECT * FROM user_profile where User_ID = '$userid'";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$row = $result->fetch_array(MYSQLI_NUM);
	
	$userProfileID = $row[0];
	$_SESSION['userProfileID'] = $userProfileID;
	
	
	
	if(isset($_POST['connectedUserFullName']) && $_POST['fromSelf'] == "VP") 
	{
		$cuserFullName=$_POST['connectedUserFullName'];
		$name = $row[1].$cuserFullName;
	}	
	else
	{
		$name = $row[1].$uname;
	}
	
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
	
		<body>
		
		
		<div id="header-wrap" class="w3-container">
   <div  class=" w3-center w3-serif w3-teal"><h2><strong>Employee Profile</strong></h2></div>
   <button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="jobPortal.php">Apply for Jobs</a>
   <button class="w3-btn w3-ripple w3-right"><a href="connectUsers.php">Connections</a>
   <button class="w3-btn w3-ripple w3-right"><a href="storyBoard.php">Story Board</a>
   <button class="w3-btn w3-ripple w3-right"><a href="employeeProfile.php">Home</a></button>
</div>

  <?php
    if(isset($_POST['connectedUserFullName']) && $_POST['fromSelf'] == "VP") 
	{
		echo <<<_END
		<br><br><br><br><br>

		<h1><b>PROFILE VIEW OF - $name</b></h1>
_END;
	}	

echo <<<_END
<br><br><br>
	    <table>
		<tr>
		<td><label>Name: </label></td>
		<td><label>
		
		<script>
		string = "$name"
		with (string)
		{
		document.write(toUpperCase())
		}
		</script>
	
		</label></td>
		</tr>
		<tr>
		<td><label>Located at: </label></td>
		<td><label>$row[2]</label></td>
		</tr>
		<tr>
		<td><label>Summary: </label></td>
		<td><label>$row[3]</label></td>
		</tr>
		<tr>
		<td><label>Profile Link: </label></td>
		<td><label>$row[4]</label></td>
		</tr>
		<tr>
		<td><label>Marital Status: </label></td>
		<td><label>$row[5]</label></td>
		</tr>
		<tr>
		<td><label>Professional Email ID: </label></td>
		<td><label>$row[6]</label></td>
		</tr>
		<tr>
		<td><label>Contact Phone: </label></td>
		<td><label>$row[7]</label></td>
		</tr>
_END;

if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
{
echo <<<_END
		<tr>
		<tr><td colspan=2><a href="employeeLanding.php?param1=UUPD&amp;param2=$userProfileID"><u>Update Personal Profile</u></a></td></tr>
_END;
}

echo <<<_END
		</table>
		<br/><br/><br/><br/>
_END;

	$query = "SELECT * FROM work_experience where User_Profile_ID = '$userProfileID'";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	
	echo <<<_END
		<h3>Work Experiences</h3>
		<hr>
	     <table>
_END;
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$expID = $row[0];
		echo <<<_END
		<tr>
		<td><label>Job Title: </label></td>
		<td><label>$row[1]</td>
		</tr>
		<tr>
		<td><label>Job Description: </label></td>
		<td><label>$row[2]</td>
		</tr>
		<tr>
		<td><label>Start Date: </label></td>
		<td><label>$row[3]</td>
		</tr>
		<tr>
		<td><label>End Date: </label></td>
		<td><label>$row[4]</td>
		</tr>
_END;
		if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
		{
			echo <<<_END
		<tr>
		<td colspan=2><a href="addEmployeeExpForm.php?param1=UUExpD&amp;param2=$expID"><u>Update this experience</u></a></td>
		</tr>
_END;
		}
	}
if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
{
echo <<<_END
		<tr>
		<td align="center">
		<form action="addEmployeeExpForm" method="post">
		<input type="hidden" name="userProfileID" value=$userProfileID>
		<input type="submit" value="Add Expereince">
		</form>
		<td>
		</tr>
_END;
}

echo <<<_END
	     </table>
		 <br/><br/><br/><br/>
_END;

	$query = "SELECT * FROM education where User_Profile_ID = '$userProfileID'";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	
	echo <<<_END
	     <h3>Education</h3>
		 <hr>
	     <table>
_END;
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$eduID = $row[0];
		echo <<<_END
		<tr>
		<td><label>University: </label></td>
		<td><label>$row[1]</td>
		</tr>
		<tr>
		<td><label>College: </label></td>
		<td><label>$row[2]</td>
		</tr>
		<tr>
		<td><label>Degree: </label></td>
		<td><label>$row[3]</td>
		</tr>
		<tr>
		<td><label>GPA: </label></td>
		<td><label>$row[4]</td>
		</tr>
		<tr>
		<td><label>Start Date: </label></td>
		<td><label>$row[5]</td>
		</tr>
		<tr>
		<td><label>End Date: </label></td>
		<td><label>$row[6]</td>
		</tr>
_END;
if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
{
echo <<<_END
		<tr>
		<td colspan=2><a href="addEmployeeEduForm.php?param1=UUEduD&amp;param2=$eduID"><u>Update this education</u></a></td>
		<td>
		</tr>
_END;
}
	}
if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
{
	echo <<<_END
		<tr>
		<td align="center">
		<form action="addEmployeeEduForm.php" method="POST">
		<input type="hidden" name="userProfileID" value=$userProfileID>
		<input type="submit" value="Add Education">
		</form>
		<td>
		</tr>
_END;
}	
echo <<<_END
		</table>
		<br/><br/><br/><br/>
_END;

if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
{
	echo <<<_END
	<h3>Applied Jobs</h3>
	<hr>
	<table>
	<tr>
	<th>Job ID</th>
	<th>Job Title</th>
	<th>Company</th>
	</tr>
_END;

	$query = "SELECT Job_ID FROM userjob where User_ID = '$userid'";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$jobID = $row[0];
		
		$nquery = "SELECT Job_Title,Company_ID FROM job where Job_ID = $jobID";	
		$nresult = $conn->query($nquery);
		if(!$nresult) die ("Database access failed: ". $conn->error);	
		$nrow = $nresult -> fetch_array(MYSQLI_NUM);
		$companyID = $nrow[1];
		
		echo <<<_END
		<tr>
		<td><label>$jobID</label></td>
		<td><label>$nrow[0]</label></td>
_END;
        $nquery = "SELECT Company_Title FROM company where Company_ID = $companyID";	
		$nresult = $conn->query($nquery);
		if(!$nresult) die ("Database access failed: ". $conn->error);	
		$nrow = $nresult -> fetch_array(MYSQLI_NUM); 
		
		echo <<<_END
		<td><label>$nrow[0]</label></td>
		</tr>	
_END;
	}
	
	echo <<<_END
		</table>
_END;
}
	
if(!(isset($_POST['connectedUserID']) && $_POST['fromSelf'] == "VP"))
{
echo <<<_END
		<h3>Your Network</h3>
		<hr>
	     <table>
		 <tr>
		<th>Name</th>
		<th></th>
		</tr>
_END;

	$query = "SELECT Connected_To FROM userconnections where User_ID = '$userid'";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	
for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$connectedUserID = $row[0];
		
		$nquery = "SELECT First_Name,Last_Name FROM users where User_ID = $connectedUserID";	
		$nresult = $conn->query($nquery);
		if(!$nresult) die ("Database access failed: ". $conn->error);	
		$nrow = $nresult -> fetch_array(MYSQLI_NUM);
		$connectedUserFName = $nrow[0];
		$connectedUserLName = $nrow[1];
		$connectedUserFullName = $nrow[0]." ".$nrow[1];
		
		echo <<<_END
		<tr>
		<td><label>$connectedUserFullName</label></td>
		<td>
		<form action="employeeProfile.php" method="POST">
		<input type="hidden" name="fromSelf" value="VP">
		<input type="hidden" name="connectedUserFullName" value="$connectedUserFullName">
		<input type="hidden" name="connectedUserID" value="$connectedUserID">
		<input type="submit" value="View Profile">
		</form></td>
		</tr>
_END;
	}
}

echo <<<_END
        </table>
		</body>
		</html>
_END;
}
?>