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
	   <div  class=" w3-center w3-serif w3-teal"><h2><strong>Thanks for Contributing to the Job Board!</strong></h2></div>

   <button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
   <button class="w3-btn w3-ripple w3-right"><a href="companyProfile.php">Home</a></button>

		
		<?php
		echo <<<_END
	<div class="form">
		<h1></h1>
	    <h2>Please submit The Information for Your New Job Posting</h2>
	    <form id="contact_form" action="addJobInfoHandler.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<label for="jobTitle">Job Title:</label><br />
			<input id="jobTitle" class="input" name="jobTitle" type="text" value="" size="30" required/><br />
		</div>
		<div class="row">
			<label for="jobDesc">Job Description:</label><br />
			<textarea id="jobDesc" class="input" name="jobDesc" rows="7" cols="30" required></textarea><br />
		</div>
		<div class="row">
			<label for="jobRequirements">Job Requirements:</label><br/>
			<textarea id="jobRequirements" class="input" name="jobRequirements" rows="7" cols="30" required></textarea><br />
		</div>
	    <div class="row">
	        <label for="postDate">Job Posting Date:</label><br />
	        <input id="postDate" class="input" name="postDate" type="date" value="" size="30" required/><br />
	    </div>
	    <div class="row">
	        <label for="jobID">Job ID:</label><br />
	        <input id="jobID" class="input" name="jobID" type="text" value="" size="30" required/><br />
	    </div>
			<input id="submit_button" type="submit" value="Submit" />
		</form>
</body> 
</html>
_END;

?>