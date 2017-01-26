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
   <div  class=" w3-center w3-serif w3-teal"><h2><strong>Add your story to the Story Board</strong></h2></div>
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
	<title>LinkedInR</title> 
</head> 
<body> 
		<div class="row">
		<br><br><br><br><br>

		<form action="addUserPostHandler.php" method="POST">
	        <label for="post">Enter text here: </label>
	        <textarea name="post" rows="4" cols="50" required></textarea>
		</div>
		<div class="row">
		<input type="submit" value="Add">
		</form>
		<form action="storyBoard.php" method="POST">
		<input type="submit" value="cancel">
		</form>
		</div>
		</body> 
		</html>		
_END;
?>