<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Function to generate a random OTP
function generateOTP()
{
    return rand(100000, 999999); // Generates a 6-digit OTP, you can adjust as needed
}
function smtpEmail($email, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'care@reshamdhaage.com';                //SMTP username
        $mail->Password   = 't*3+6mu$rAW4oCre';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('care@reshamdhaage.com', 'no-reply');
        // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress($email);                               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Function to save OTP to the database for later verification
function saveOTPToDatabase($email, $OTP) {
    global $conn;

    // Check if email already exists in the table
    $existingQuery = "SELECT * FROM otps WHERE email = ?";
    $existingStmt = $conn->prepare($existingQuery);
    $existingStmt->bind_param("s", $email);
    $existingStmt->execute();
    $existingResult = $existingStmt->get_result();

    $expired_at = date('Y-m-d H:i:s');
    $expiredDateTime = new DateTime($expired_at);
    $expiredDateTime->add(new DateInterval('PT3M'));
    $expired_at = $expiredDateTime->format('Y-m-d H:i:s');


    if ($existingResult->num_rows > 0) {
        // Email already exists, update the existing record
        $updateQuery = "UPDATE otps SET otp = ?, expired_at = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sss", $OTP, $expired_at, $email);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        // Email does not exist, insert a new record
        $insertQuery = "INSERT INTO otps (email, otp, expired_at) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sss", $email, $OTP, $expired_at);
        $insertStmt->execute();
        $insertStmt->close();
    }

    $existingStmt->close();
}
