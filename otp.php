<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src/Exception.php';
require 'vendor\phpmailer\phpmailer\src/PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = ''; // Handle the missing email case
}

if (isset($_POST['otp'])) {
    $otp = $_POST['otp'];
} else {
    $otp = ''; // Handle the missing OTP case
}

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-email@gmail.com'; // Your Gmail address
    $mail->Password   = 'your-password';        // Your Gmail password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('noreply@shashikipeiris@gmail.com', 'Invikta Coders');
    $mail->addAddress($email); // Add recipient email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'OTP Authentication';
    $mail->Body    = 'Your OTP is: ' . $otp;

    // Send mail
    $mail->send();
    echo 'OTP has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<form method="POST">
    Enter otp
    <input type="number" name="otp" placeholder="Enter OTP">
    <input type="submit" value="Submit">
</form>
