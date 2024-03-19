<?php

include('db_connection.php');

$email = htmlentities($_POST['email']);
$otp = htmlentities($_POST['otp']);

$email = stripslashes($email);
$otp = stripslashes($otp);

if (isset($email) && !empty($email) && isset($otp) && !empty($otp)) {

    global $conn;

    if ($conn->connect_error) {
        die("Connection has failed: " . $conn->connect_error);
    }

    // Check if the email exists in user_profile
    $checkProfileQuery = "SELECT sno, full_name, display_name, user_id, email FROM user_profile WHERE email = ?";
    $checkProfileStmt = $conn->prepare($checkProfileQuery);
    $checkProfileStmt->bind_param("s", $email);
    $checkProfileStmt->execute();
    $profileResult = $checkProfileStmt->get_result();

    if ($profileResult->num_rows > 0) {
        // Email exists in user_profile, check OTP
        $checkOTPQuery = "SELECT * FROM otps WHERE email = ? AND otp = ? AND expired_at > NOW()";
        $checkOTPStmt = $conn->prepare($checkOTPQuery);
        $checkOTPStmt->bind_param("ss", $email, $otp);
        $checkOTPStmt->execute();
        $otpResult = $checkOTPStmt->get_result();

        if ($otpResult->num_rows > 0) {
            // OTP is valid, provide user information in the response
            $userData = $profileResult->fetch_assoc();
            $response = [
                "status" => "success",
                "message" => "Login successful",
                "data" => [
                    "sno" => $userData['sno'],
                    "full_name" => $userData['full_name'],
                    "display_name" => $userData['display_name'],
                    "user_id" => $userData['user_id'],
                    "email" => $userData['email']
                ]
            ];

			// Mark the OTP as used (optional)
            $updateOTPQuery = "UPDATE otps SET expired_at = CURRENT_TIMESTAMP WHERE email = ?";
            $updateOTPStmt = $conn->prepare($updateOTPQuery);
            $updateOTPStmt->bind_param("s", $email);
            $updateOTPStmt->execute();
            $updateOTPStmt->close();

            echo json_encode($response);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid OTP or OTP has expired", "data" => []]);
        }
		$checkOTPStmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Email not found, please sign up", "data" => []]);
    }

    $checkProfileStmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Missing Parameters", "data" => []]);
}
?>
