<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if form data is submitted
if (isset($_POST['name']) && isset($_POST['email'])) {

    $user_name = $_POST['name'];
    $user_email = $_POST['email'];

    // Validate the email address
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address format.";
        exit();
    }

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'ravine.rianga@strathmore.edu';           // SMTP username
        $mail->Password   = 'msah wggt omyw ggwh';            // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                              // TCP port to connect to

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'ICS 2.2 Admin');
        $mail->addAddress($user_email);                       // Add recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Welcome to ICS 2.2! Account Verification';
        $mail->Body    = "
        <html>
        <head>
            <title>Welcome to ICS 2.2!</title>
        </head>
        <body>
            <p>Hello $user_name,</p>
            <p>You requested an account on ICS 2.2.</p>
            <p>To complete your registration, please <a href='http://yourdomain.com/verify'>Click Here</a>.</p>
            <p>Regards,<br>Systems Admin<br>ICS 2.2</p>
        </body>
        </html>
        ";

        // Send email
        $mail->send();
        echo 'Email has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Please enter both name and email.";
}
