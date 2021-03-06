<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page   
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body style="background-image:url(images/wcbg.jpg); color:white;">
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.<br> Welcome to Lightosphere Member Portal.</h1>
		<p>
        <a href="reset-password.php" class="btn btn-warning">Change Password</a>
        <a href="logout.php" class="btn btn-warning">Sign Out of Your Account</a>
    </p></h1>
    </div>
    <p>
    <a href="../filemanager/index.php" class="btn btn-warning">File Management System</a>
       </p>
</body>
</html>
