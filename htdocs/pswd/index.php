<?php
	if(!empty($_POST["forgot-password"])){
	    /* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql301.epizy.com');
define('DB_USERNAME', 'epiz_26697856');
define('DB_PASSWORD', 'LvB5u5U06L');
define('DB_NAME', 'epiz_26697856_demo');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
		
		$condition = "";
		if(!empty($_POST["user-login-name"])) 
			$condition = " username = '" . $_POST["user-login-name"] . "'";
		if(!empty($_POST["username"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " username = '" . $_POST["username"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from users " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("forgot-password-recovery-mail.php");
		} else {
			$error_message = 'No User Found';
		}
	}
?>
<link href="demo-style.css" rel="stylesheet" type="text/css">
<style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>

<script>
function validate_forgot() {
	if((document.getElementById("user-login-name").value == "") && (document.getElementById("username").value == "")) {
		document.getElementById("validation-message").innerHTML = "Login name or Email is required!"
		return false;
	}
	return true
}
</script>
<html>

<body style="background-image:url(images/bg.jpg); color:white;">

<a href="http://filessolution.great-site.net/index.php"><img src="images/logo.png" height="118px" width="289px"></a>
    <div class="wrapper" style="margin:auto; margin-top:50px;"></div>
<form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
<h1>Forgot Password?</h1>
<p>Enter your email to get reset link.</p>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>
    
	<div class="field-group">
		
	
	<div class="field-group">
		<div><label for="email">Email</label></div>
		<div><input type="text" name="username" id="username" class="input-field" required></div>
	</div>
	
	<div class="field-group">
		<div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="form-submit-button"></div>
	</div>	
</form>
</body>
</html>