 
<?php

require $_SERVER['DOCUMENT_ROOT'] . '/pswd/PHPMailer/PHPMailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/pswd/PHPMailer/PHPMailer/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'] . '/pswd/PHPMailer/PHPMailer/Exception.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/pswd/mail_configuration.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "game.tutor.9@gmail.com";
    $mail->Password = "xgu7udx!i6u6";
    $mail->SetFrom("admin@lightosphere.com.au");
    $mail->Subject = "Forgot Password Recovery";
    $mail->Body = "<div>Dear Member,<br><br><p>Click this link to recover your password<br><a href='" . PROJECT_HOME . "reset_password.php?name=" . $user["username"] . "'>" . PROJECT_HOME . "reset_password.php?name=" . $user["username"] . "</a><br><br></p>Regards,<br> Admin.</div>";
    $mail->AddAddress($user["username"]);


     if(!$mail->Send()) {
	$error_message = 'Problem in Sending Password Recovery Email';
} else {
	$success_message = 'Please check your email to reset password!';
}
?>