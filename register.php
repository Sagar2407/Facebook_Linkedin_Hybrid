<?php

require_once 'dblogin.php';
$conn = new mysqli($hn,$un,$pwd,$db);
if($conn->connect_error) die($conn->connect_error);

 session_start();
 $emailError = "";
 $error = 0;
 
 if ( isset($_POST['btn-signup']) ) {
  
  $f_name = trim($_POST['f_name']);
  $f_name = strip_tags($f_name);
  $f_name = htmlspecialchars($f_name);
  
  $l_name = trim($_POST['l_name']);
  $l_name = strip_tags($l_name);
  $l_name = htmlspecialchars($l_name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = 1;
   $emailError = "*Please enter valid email address.";
  } else {
   $query = "SELECT Email_ID FROM users WHERE Email_ID = '$email'";
   $result = $conn->query($query);
   if(!$result) die ("Database access failed: ". $conn->error);	
   $count = $result->num_rows;
	
   if($count!=0){
    $error = 1;
    $emailError = "*Provided Email is already in use.";
   }
  }

  
  $password = hash('sha256', $pass);
  
  	  
	  if (isset($_POST["type"])){
	  if($_POST["type"]=="employee")
		  $type = "employee";
	  if($_POST["type"]=="employer")
		  $type = "employer";

  if( $error== 0 ) {

   
   //$query = "insert into users (First_Name, Last_Name, Email_ID, Pass, User_ID, type) values('$f_name','$l_name','$email','$password', NULL, '$x')";
   //$res = mysql_query($query);
   $stmt = $conn->prepare('INSERT INTO users (First_Name, Last_Name, Email_ID, Pass, type) VALUES(?,?,?,?,?)');	 
   $stmt->bind_param('sssss',$f_name,$l_name,$email,$password,$type);
   
   if ($stmt->execute()) {
	
	$query = "SELECT User_ID,First_Name FROM users where Email_ID = '$email'";
	$result = $conn->query($query);
	if(!$result) die ("Database access failed: ". $conn->error);	
	
	$rows = $result -> num_rows;
	
	for($j=0;$j<$rows;++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$userID = $row[0];
		$username = $row[1];
	}
	$_SESSION['user'] = $userID;
	$_SESSION['username'] = $username;
    if($_POST["type"]=="employee")
	{
		header('Location: employeeLanding');
	    exit();
	}
	if($_POST["type"]=="employer")
	{
		header('Location: companyLanding.php');
	    exit();
	}
	  $stmt->close();
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
  }
  }
  $conn->close();
 }
?>
<!DOCTYPE html>
<html>
<title>Login & Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylesheet.css">
<body>
<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    
     <div style = "text-align:center"class="col-md-12">
        
         <div class="form-group">
             <h2 class="" style = "text-align:center">Sign Up.</h2>
            </div>
        
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
     <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            
			<input type="text" name="f_name" class="form-control" placeholder="Enter your First Name" maxlength="50" required/>
		    </div>
                <span class="text-danger"></span>
            </div>
            
			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            
				<input type="text" name="l_name" class="form-control" placeholder="Enter your Last Name" maxlength="50" required />
			</div>		
			<span class="text-danger"></span>
				</div>
				
			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
				<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" required/>
               </div> <span class="text-danger"><?php echo $emailError?></span>
			</div>
			
			
		   <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" required/>
            </div> <span class="text-danger"></span>
            </div>
			
			<div>
			<label for="employer">Are you an employer</label>
			<input type="radio" name="type" value="employer" required>
			
			<label for="employee">Are you an employee</label>
			<input type="radio" name="type" value="employee" required><br>
			</div>
			
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            
            <div class="form-group">
             <a href="index.php">Sign in Here</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>