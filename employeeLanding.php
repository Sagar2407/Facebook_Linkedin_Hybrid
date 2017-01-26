<?php
session_start();
if(!$_SESSION['user'])  
{  
    header("Location: index.php");
} 
$uname = $_SESSION['username'];

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
<?php

echo <<<_END
<h2 align="right">$uname | CANNOT LOGOUT AT THIS POINT OF TIME</h2>   
	<div class="form">
		<h1>Welcome to the Site!</h1>
	    <h2>Please submit Your Information Below</h2>
		<h3>Personal Information</h3>
		<h4 class = "w3-red">Please hit enter after filling up the form</h4>
	    <form action="addEmployeeInfoHandler.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<label for="title">Title:</label><br/>
  		  	<input type="radio" name="title" value="Mr." required> Mr.
  		  	<input type="radio" name="title" value="Mrs." required> Mrs.
  		  	<input type="radio" name="title" value="Ms." required> Ms.
		</div>
		<div class="row">
			<label for="location">Location:</label>
			<select name="location" required>
			  <option value="USA">USA</option>
			  <option value="Europe">Europe</option>
			  <option value="Asia">Asia</option>
			  <option value="Africa">Africa</option>
			</select>
		</div>
		<div class="row">
			<label for="maritalStatus">Marital Status:</label>
			<select name="maritalStatus" required>
			  <option value="D">Divorced</option>
			  <option value="N">Single</option>
			  <option value="Y">Married</option>
			</select>
		</div>

		
		</br></br>	
		<div class="form">
		<h3>Professional Information</h3>
	    <div class="row">
	        <label for="summary">Professional Summary:</label>
	        <textarea id="summary" class="input" name="summary" rows="7" cols="30" required></textarea><br />
	    </div>
		<div class="row">
	        <label for="email">Professional Email:</label>
	        <input id="email" class="input" name="email" type="text" size="30" required/><br />
	    </div>
	    <div class="row">
	        <label for="phoneNumber">Professional Phone Number:</label>
	        <input id="phoneNumber" class="input" name="phoneNumber" type="text" size="30" required/><br />
	    </div>
		<div class="row">
	        <label for="prolink">Website/Profile Link:</label>
	        <input id="prolink" class="input" name="prolink" type="text" size="30" required/><br />
	    </div>
		</br></br>
		<div class="row">
_END;

if(!(isset($_GET['param1']) && isset($_GET['param2'])))
{	
   echo <<<_END
   <input type="hidden" name="actionEvent" value="IUPD"/>
_END;
}

					
		echo <<<_END
			        <input id="submitEmployee" class="input" type="submit" value="Submit" size="30" /></br>
		</div>
		
_END;



if(isset($_GET['param1']) && isset($_GET['param2']))
{
	$param1 = $_GET['param1'];
	$param2 = $_GET['param2'];
	
	echo <<<_END
	<input type="hidden" name="actionEvent" value="$param1">
	<input type="hidden" name="userProfileID" value="$param2">
_END;
}
echo <<<_END
</form>	
</body> 
</html>
_END;
	


?>