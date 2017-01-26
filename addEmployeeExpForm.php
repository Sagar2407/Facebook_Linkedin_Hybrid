<?php
session_start();
if(!$_SESSION['user'])  
{  
    header("Location: index.php");
} 
$uname = $_SESSION['username'];

if(isset($_POST['userProfileID']))
$userProfileID = $_POST['userProfileID'];


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
   <div  class=" w3-center w3-serif w3-teal"><h2><strong>Work Experience</strong></h2></div>
   <button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="jobPortal.php">Apply for Jobs</a>
   <button class="w3-btn w3-ripple w3-right"><a href="connectUsers.php">Connections</a>
   <button class="w3-btn w3-ripple w3-right"><a href="storyBoard.php">Story Board</a>
   <button class="w3-btn w3-ripple w3-right"><a href="employeeProfile.php">Home</a></button>
</div>

  <?php
echo <<<_END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html lang="en"> 
<head> <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
	<!--This is submitEmployeeInfo.html-->
	<title>LinkedInR</title> 
</head> 
<body> 
<h2 align="right">$uname | <a href="logout.php">Logout</a></h2>   
		<div class="row"><br><br>
		<form action="addEmployeeEInfoHandler.php" method="POST">
	        <label for="empExpJobTitle">Job Title:</label>
	        <input type="text" class="input" name="empExpJobTitle" required><br/>
		</div>
	    <div class="row">
	        <label for="empExpJobDescription">Job Description:</label>
	        <input class="input" name="empExpJobDescription" type="text" size="30" required/><br />
	    </div>
	    <div class="row">
	        <label for="empExpJobStart">When Did You Start at This Job:</label>
	        <input class="input" name="empExpJobStart" type="date" required/><br />
	    </div>
	    <div class="row">
	        <label for="empExpJobEnd">When Did You End This Employment: (leave this field if you are currently working in this place)</label>
			<input type="date" name="empExpJobEnd">
		</div>
_END;

if(!(isset($_GET['param1']) && isset($_GET['param2'])))
{	
   echo <<<_END
   <input type="hidden" name="actionEvent" value="IUExpD"/>
_END;
}

if(isset($_GET['param1']) && isset($_GET['param2']))
{
	$param1 = $_GET['param1'];
	$param2 = $_GET['param2'];
	
	echo <<<_END
	<input type="hidden" name="actionEvent" value="$param1">
	<input type="hidden" name="expID" value="$param2">
_END;
}

echo <<<_END
		 <div class="row">
		    <input type="hidden" name="whatEmpSectionIsBeingAdded" value="WE">
_END;
            if(isset($_POST['userProfileID']))
			{
				echo <<<_END
				<input type="hidden" name="userProfileID" value="$userProfileID">
_END;
			}
			
echo <<<_END
			<input type="submit" value="Add">
		</div>
_END;


echo <<<_END
</form>	
<form action="employeeProfile" method="post">
<input type="submit" value="cancel">
</form>

_END;


?>

</body> 
</html>
