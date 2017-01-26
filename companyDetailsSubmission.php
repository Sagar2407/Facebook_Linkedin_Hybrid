<?php
require_once 'dblogin.php';
$conn = new mysqli($hn,$un,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);


session_start();

if(isset($_POST['companyTitle']) &&
isset($_POST['companyDescription']) &&
isset($_POST['companyWebsite']))
{
$companyTitle = get_post($conn,'companyTitle');
$companyTitle = sanitizeString($companyTitle);
$companyTitle = sanitizeMySQL($conn, $companyTitle);
$_SESSION['companyTitle'] = $companyTitle;
$companyDescription = get_post($conn,'companyDescription');
$companyDescription = sanitizeString($companyDescription);
$companyDescription = sanitizeMySQL($conn, $companyDescription);
$companyWebsite = get_post($conn,'companyWebsite');
$companyWebsite = sanitizeString($companyWebsite);
$companyWebsite = sanitizeMySQL($conn, $companyWebsite);


if(isset($_POST['storageProcedure']))
{
	$toBeUpdatedCompany = $_POST['cmpnyId'];
	
	$query = "UPDATE company SET Company_Title='$companyTitle', Company_Description='$companyDescription',
								  Company_Website='$companyWebsite'
                                  where Company_ID=$toBeUpdatedCompany";
$result = $conn->query($query);
if(!$result) echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";

header('Location: companyProfile.php');
exit();
}
else
{
    $userID = $_SESSION['user'];
	$stmt = $conn->prepare('INSERT INTO company VALUES(?,?,?,NULL,?)');	 
	$stmt->bind_param('sssi',$companyTitle,$companyDescription,$companyWebsite,$userID);
	$stmt->execute();
	$stmt->close();
	$conn->close();

	header('Location: companyProfile.php');
	exit();
}

}

function get_post($conn, $var){
  return $conn->real_escape_string($_POST[$var]);
}

function sanitizeString($var)
{
$var = stripslashes($var);
$var = strip_tags($var);
$var = htmlentities($var);
return $var;
}

function sanitizeMySQL($connection, $var)
{
$var = $connection->real_escape_string($var);
$var = sanitizeString($var);
return $var;
}

?>
