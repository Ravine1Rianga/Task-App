<?php
// Check if form data has been submitted (name and email)
if (isset($_POST['name']) && isset($_POST['email'])) {
    
    // Get user's name and email from the form submission
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    
    // Validate email address
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address format.";
        exit();
    }

    // Set the email subject and body (customized with user's name)
    $subject = "Welcome to ICS 2.2! Account Verification";
    $message = "
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

    // Set the headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // Additional headers
    $headers .= 'From: no-reply@ics22.com' . "\r\n";
    
    // Send the email
    if (mail($user_email, $subject, $message, $headers)) {
        echo "Email successfully sent to $user_email.";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Please enter both name and email.";
}
?>
