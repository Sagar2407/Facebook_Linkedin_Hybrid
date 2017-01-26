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
<title>LinkedIn prototype</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylesheet.css">

<body>
<div class="w3-container">


  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">×</span>
        </div>

      <form method="post" class="w3-container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Email ID" name="email" required>
		  
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="pass" required>
          <button class="w3-btn-block w3-green w3-section w3-padding" type="submit" name = "btn-login">Login</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
      </div>

    </div>
  </div>
  
   <div class=" w3-center w3-serif w3-teal"><h2><strong>Make Work Personal Again</strong></h2></div>
	<div style = "text-align:right ;  text-decoration:none;">	
	<button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-green w3-large">Login</button>

		<a href = "register.php"> Register</a>
	</div>
<h3>Who We Are</h3>
<p>Our team is made up of three highly motivated individuals who came together
  to create a site dedicated to showcasing the talent of the workforce.
  Each team member has a unique role on our team and is key to the
  success of the site. Tyler Sauer currently serves as the team lead coordinator,
  Sagar Singh is currently serving as the team lead analyst, and Yash Nerella is
  currently serving as the team lead programmer.
</p>
<h3>What We Believe</h3>
<p>Many workers across the world look at their jobs as a means to an end.
  It is a way to pay the mortgage, or to purchase that ring for the girl
  of your dreams. Although these are good reasons to work, we feel that
  you should have a deeper connection to something that you spend close
  to a third of your life participating in. We believe that LinkedIn has
  provided quite a bit of value to companies by allowing workers to showcase
  their talents on a digital resume. We would like to do the same by creating
  a space where users can showcase their personal interests and pastimes.
  With our site, employees can learn more about one another, find common ground,
  talking points, and connect on a deeper level than,
  “How’s that database upgrade going?”
</p>
<h3>Our Team</h3>
<h4>Leonardo "Tyler Sauer"</h4>
<p>
  Tyler Sauer is in his last year of the MSIS program. He currently works at the
  University of Utah and has realized that there remains a level of diconnect between
  his fellow co-workers. Some of them have been working together for nearly 5 years and
  are still learning little oddities about one another. Although this is a a fun discovery process,
  there are many co-workers that Tyler could have conencted with years ago had he have known that
  his collegues enjoyed certain activities. Tyler is excited to be part of the team to make work personal again.
</p>
<h4>Donatelo "Yash Nerella"</h4>
<p>
  Yash is a brillant programmer! He shares a passion for employee engagement, and knows how to translate that passion into code that can address the need.
</p>
<h4>Rafael "Sagar Singh"</h4>
<p>
  Sagar is relentless! Both Sagar and Tyler came into the company with little to no programming experience. Sagar worked tirelessly and was able to bruteforce his way into incredible things. 
  Our MD5 hashing advancement is thanks to Sagar's hard work!
</p>
<h4>Michaelangelo "We All Have a Little Michaelangelo in Us..."</h4>
    <p>Here are ECN, we work hard to bring the best site to our customers as we can, but we also love to play hard! 
	The company likes to engage in employee outings such as Top Golf and/or hosting a game night.</p>
</div>
</body>
</html>
