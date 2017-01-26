<?php
 session_start();
 require_once 'dbconnect.php';
 
 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "*Please enter valid email address.";
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
  
  if (!$error) {
   
   $password = hash('sha256', $pass);   
   $res = mysql_query("SELECT * FROM users WHERE Email_ID='$email'");
   $row = mysql_fetch_array($res);
   $count = mysql_num_rows($res); 
   
   if( $count == 1 && $row['Pass']==$password ) {
    $_SESSION['user'] = $row['User_ID'];
	$_SESSION['username'] = $row['First_Name'];
	$_SESSION['fromIndex'] = "loginsuccessful";
	if($row['type'] == "employer")
		header("Location: companyProfile.php");
    if($row['type'] == "employee")
	  header("Location: employeeProfile.php");			
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
    
  }
  
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12" style = "text-align:center">
        
         <div class="form-group">
             <h2 class="" style = "text-align:center">Sign In</h2>
            </div>
        
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" required>
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>

            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            
            <div class="form-group">
             <a href="register.php">Sign Up Here</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>