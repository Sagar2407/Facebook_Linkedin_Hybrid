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
	<div  class=" w3-center w3-serif w3-teal"><h2><strong>Company Details</strong></h2></div>
	<button class="w3-btn w3-ripple w3-right"><a href="logout.php">Logout</a>
    <button class="w3-btn w3-ripple w3-right">Home</button>
	

<?php		echo <<<_END
	
<form action="companyDetailsSubmission.php" method="post">
<table>
<tr>
<td>
<label>Company Title: </label>
</td>
<td>
<input type="text" name="companyTitle" required>
</td>
</tr>
<tr>
<td>
<label>Company Description: </label>
</td>
<td>
<textarea name="companyDescription" rows="10" cols="40" required></textarea>
</td>
</tr>
<tr>
<td>
<label>Company Website: </label>
</td>
<td>
<input type="text" name="companyWebsite" required>
</td>
</tr>
<tr>
_END;

if(isset($_GET['param1']) && isset($_GET['param2']))
{
	$param1 = $_GET['param1'];
	$param2 = $_GET['param2'];
	
	echo <<<_END
	<td><input type="hidden" name="storageProcedure" value=$param1></td>
	<td><input type="hidden" name="cmpnyId" value=$param2></td>
_END;
	
}


echo <<<_END
<td colspan=2 align="center"><input type="submit" value="Enter details to profile"></td>
</tr>
</table>
</body>
</html>
_END;
?>