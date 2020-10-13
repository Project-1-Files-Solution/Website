<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Please enter email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = " &nbsp &nbsp &nbsp &nbsp &nbsp The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<!-- Head -->

<head>
    <title>Member Login</title>
    
     <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <!-- //fonts -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->
	
	<!-- Google fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
	<!-- Google fonts -->

</head>
<!-- //Head -->
<!-- Body -->

<body>

<section class="main">
	<div class="layer">
		<div class="bottom-grid">
			<div class="logo">
				<h1><a>Member Login</a></h1>
			</div>
		</div>
		<div class="content-w3ls">
			<div class="text-center icon">
				<img src="images/logo.png">
			</div>
			<div class="content-bottom">
				 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="field-group">

						
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						
						
						<div class="wthree-field">
						<ul style="display:inline; padding-left:25px;">
							<li><span class="fa fa-user" aria-hidden="true"></span></li>
							<li><input name="username" id="text1" type="text" class="form-control" value="<?php echo $username; ?>" placeholder="Email"></li>
							</ul>
							<br>
						<span class="help-block"><?php echo $username_err; ?></span>
						</div>
						               
						</div> 
			
			
						
					</div>
					<div class="field-group">
				
						
						
						
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
               <div class="wthree-field">
			   <ul style="display:inline; padding-left:25px;">
			   <li><span class="fa fa-lock" aria-hidden="true"></span></li>
							<li><input name="password" id="myInput" class="form-control" type="password" placeholder="Password">
						</li>
						</ul></div>
                
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			
			
						
					</div>
				
					<div class="wthree-field">
						<button type="submit" class="btn btn-primary" value="Login">Log In</button>
					</div>
					<br>			
					<ul class="list-login-bottom">
						<li class="">
							<a href="pswd/index.php" class="">Forgot password?</a>
						</li>
						
						<li class="">
							<a href="register.php" class="">Sign Up</a>
						</li>
						<li class="clearfix"></li>
					</ul>
				</form>
			</div>
		</div>
		<div class="bottom-grid1">
			<div class="links">
				<ul class="links-unordered-list">
					<li class="">
						<a href="about.html" class="">About Us</a>
					</li>
					<li class="">
						<a href="privacypolicy.html" class="">Privacy Policy</a>
					</li>
					<li class="">
						<a href="returnpolicy.html" class="">Return Policy</a>
					</li>
				</ul>
			</div>
			<div class="copyright">
				<p>© 2020 Lightosphere. All rights reserved.
				</p>
			</div>
		</div>
    </div>
</section>

</body>
<!-- //Body -->
</html>
