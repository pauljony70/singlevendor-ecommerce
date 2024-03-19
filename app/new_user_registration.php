<?php

include('db_connection.php');

$fullname = htmlentities($_POST['fullname']);
$email = htmlentities($_POST['email']);
$otp = htmlentities($_POST['otp']);

$fullname = stripslashes($fullname);
$email = stripslashes($email);
$otp = stripslashes($otp);

if (isset($fullname) && !empty($fullname) && isset($email) && !empty($email) && isset($otp) && !empty($otp)) {

    global $conn;

    if ($conn->connect_error) {
        die("Connection has failed: " . $conn->connect_error);
    }

    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM user_profile WHERE email = ?";
    $checkUserStmt = $conn->prepare($checkUserQuery);
    $checkUserStmt->bind_param("s", $email);
    $checkUserStmt->execute();
    $existingUserResult = $checkUserStmt->get_result();

    if ($existingUserResult->num_rows > 0) {
        // User already exists, provide a message for login
        echo json_encode(["status" => "error", "message" => "User already exists. Please log in.", "data" => []]);
    } else {
        // Validate the OTP and check if it's not expired
        $validateOTPQuery = "SELECT * FROM otps WHERE email = ? AND otp = ? AND expired_at > NOW()";
        $validateOTPStmt = $conn->prepare($validateOTPQuery);
        $validateOTPStmt->bind_param("ss", $email, $otp);
        $validateOTPStmt->execute();
        $otpResult = $validateOTPStmt->get_result();

        if ($otpResult->num_rows > 0) {
            // OTP is valid and not expired

            // Generate displayname from the first name of the user
            $displayname = explode(' ', $fullname)[0];

            // Get the last user_id from the database and increase by 1
            $getLastUserIDQuery = "SELECT MAX(user_id) as last_id FROM user_profile";
            $lastUserIDResult = $conn->query($getLastUserIDQuery);
            $lastUserIDRow = $lastUserIDResult->fetch_assoc();
            $newUserID = ($lastUserIDRow['last_id'] ?? 10000) + 1;

            // Example: Insert the user into the 'user_profile' table
            $registerQuery = "INSERT INTO user_profile (user_id, full_name, email, display_name) VALUES (?, ?, ?, ?)";
            $registerStmt = $conn->prepare($registerQuery);
            $registerStmt->bind_param("isss", $newUserID, $fullname, $email, $displayname);
            $registerStmt->execute();
            $registerStmt->close();

			$data = [
				"sno" => $conn->insert_id,
				"full_name" => $fullname,
				"display_name" => $displayname,
				"user_id" => $newUserID,
				"email" => $email
			];

            // Mark the OTP as used (optional)
            $updateOTPQuery = "UPDATE otps SET expired_at = CURRENT_TIMESTAMP WHERE email = ?";
            $updateOTPStmt = $conn->prepare($updateOTPQuery);
            $updateOTPStmt->bind_param("s", $email);
            $updateOTPStmt->execute();
            $updateOTPStmt->close();

            echo json_encode(["status" => "success", "message" => "User registered successfully", 'data' => $data]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid OTP or OTP has expired", "data" => []]);
        }
        $validateOTPStmt->close();
    }

    $checkUserStmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Missing Parameters", "data" => []]);
}
?>
