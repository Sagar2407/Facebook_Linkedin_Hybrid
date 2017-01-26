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

	$query = "SELECT Connected_To FROM userconnections where User_ID=$userid";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	$alreadyConnectedUsers = array();
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$alreadyConnectedUsers[$j] = $row[0];
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
   <div  class=" w3-center w3-serif w3-teal"><h2><strong>Connect with other users and Build your Network</strong></h2></div>
   <button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="jobPortal.php">Apply for Jobs</a>
   <button class="w3-btn w3-ripple w3-right"><a href="connectUsers.php">Connections</a>
   <button class="w3-btn w3-ripple w3-right"><a href="storyBoard.php">Story Board</a>
   <button class="w3-btn w3-ripple w3-right"><a href="employeeProfile.php">Home</a></button>
</div>

  <?php

echo <<<_END

<br><br><br>
<table border="1">
_END;


	$query = "SELECT * FROM users where type = 'employee'";	
    $result = $conn->query($query);
    if(!$result) die ("Database access failed: ". $conn->error);	
	$rows = $result -> num_rows;
	$end = $rows-1;
	
	$urows = intval($rows/3);
	++$urows;
	$count =0;
	static $j=0;
	$i=0;
	
	for(;$i<$urows;$i++)
	{
		echo <<<_END
		<tr>
_END;
		
		while($count<3)
		{
			$result->data_seek($j);
			$row = $result->fetch_array(MYSQLI_NUM);
			if(!($userid == $row[5]))
			{
				echo <<<_END
			<td><b>$row[0] $row[1]</b><br/>
_END;
			for($s=0;$s<count($alreadyConnectedUsers);$s++)
			{
				if($alreadyConnectedUsers[$s] == $row[5]) 
					{
						echo <<<_END
						<label><font size="2">In Your Network!</font></label>
_END;
						--$end;
						$flag = 1;
						break;
					}
			}
			
			       if($flag != 1)
					{
                       echo <<<_END
						<form action="connectUsersHandler.php" method="POST">
						<input type="hidden" name="toBeConnectedUser" value="$row[5]">
						<input type="submit" value="connect">
						</form></td>
_END;
						--$end;
					}
					$flag = 0;		
			}
		     $j++;
			 if($j == $rows) break;
             ++$count;
		}
		
		$count = 0;
		if($end == 0) break;
				echo <<<_END
		</tr>
_END;
	}

?>