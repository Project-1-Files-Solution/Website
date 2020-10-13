<?php
	if(isset($_POST["reset-password"])) {
	    
	    /* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql301.epizy.com');
define('DB_USERNAME', 'epiz_26697856');
define('DB_PASSWORD', 'LvB5u5U06L');
define('DB_NAME', 'epiz_26697856_demo');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
		$sql = "UPDATE `epiz_26697856_demo`.`users` SET `password` = '" . password_hash($_POST["member_password"], PASSWORD_DEFAULT). "' WHERE `users`.`username` = '" . $_GET["name"] . "'";
		$result = mysqli_query($conn,$sql);
		$success_message = "Password is reset successfully.";
    }
?>
<link href="demo-style.css" rel="stylesheet" type="text/css">
<style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px;}
        #frmReset {
    padding: 20px 600px;
    background: transparent;
    color: white;
    display: inline-block;
    border-radius: 4px;
}
    </style>
<script>
function validate_password_reset() {
	if((document.getElementById("member_password").value == "") && (document.getElementById("confirm_password").value == "")) {
		document.getElementById("validation-message").innerHTML = "Please enter new password!"
		return false;
	}
	if(document.getElementById("member_password").value  != document.getElementById("confirm_password").value) {
		document.getElementById("validation-message").innerHTML = "Both passwords should be same!"
		return false;
	}
	
	return true;
}


</script>
<html>

<body style="background-image:url(images/bg.jpg); color:white;">

<a href="http://filessolution.great-site.net/index.php"><img src="images/logo.png" height="118px" width="289px"></a>
    <div class="wrapper" style="margin:auto; margin-top:50px;"></div>
<form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">
<h1>Reset Password</h1>
	
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>

	<div class="field-group">
		<div><label for="Password">New Password</label></div>
		<div>
		<input type="password" name="member_password" id="member_password" class="input-field"></div>
	</div>
	
	<div class="field-group">
		<div><label for="email">Confirm Password</label></div>
		<div><input type="password" name="confirm_password" id="confirm_password" class="input-field"></div>
	</div>
	
	<div class="field-group">
		<div><input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="form-submit-button"></div>
	</div>	
</form>
</body>
</html>
				