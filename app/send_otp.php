<?php

include('db_connection.php');
include('common_functions.php');

function sendLoginOtp($code, $email)
{
	$code =  htmlentities($code);
	$email =  stripslashes($email);

	if (isset($code)  && !empty($code) && isset($email) && !empty($email)) {

		global $conn;

		if ($conn->connect_error) {
			die(" connecction has failed " . $conn->connect_error);
		}

		// Check if email exists in user_profile
		$query = "SELECT * FROM user_profile WHERE email = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			// Email exists, send OTP
			// $OTP = generateOTP(); // You need to implement a function to generate OTP
			$OTP = '123456';

			$subject = 'Your OTP for Log In';

			ob_start();
			include('emails/otp.php');
			$message = ob_get_clean();

			// Replace the {{OTP}} placeholder with the actual OTP value
			$message = str_replace('{{OTP}}', $OTP, $message);

			// Code to send OTP to email (you need to implement this)
			smtpEmail($email, $subject, $message);

			// You can also store the OTP in the database for verification later
			// Save OTP in the database for later verification
			saveOTPToDatabase($email, $OTP);

			// Return success response
			echo json_encode(["status" => "success", "message" => "OTP sent to email"]);
		} else {
			// Email does not exist, prompt user to sign up
			echo json_encode(["status" => "error", "message" => "Email not found, please sign up"]);
		}

		$stmt->close();
		$conn->close();
	}
}

function sendSignUpOtp($code, $email)
{
	$code =  htmlentities($code);
	$email =  stripslashes($email);

	if (isset($code)  && !empty($code) && isset($email) && !empty($email)) {

		global $conn;

		if ($conn->connect_error) {
			die(" connecction has failed " . $conn->connect_error);
		}

		// Check if email exists in user_profile
		$query = "SELECT * FROM user_profile WHERE email = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			// Email already exist, prompt user to log in
			echo json_encode(["status" => "error", "message" => " Email is already exists. Please log in"]);
		} else {
			// Email does not exists, send OTP
			// $OTP = generateOTP(); // You need to implement a function to generate OTP
			$OTP = '123456';

			$subject = 'Your OTP for Sign Up';
			
			ob_start();
			include('emails/otp.php');
			$message = ob_get_clean();

			// Replace the {{OTP}} placeholder with the actual OTP value
			$message = str_replace('{{OTP}}', $OTP, $message);

			// Code to send OTP to email (you need to implement this)
			smtpEmail($email, $subject, $message);

			// You can also store the OTP in the database for verification later
			// Save OTP in the database for later verification
			saveOTPToDatabase($email, $OTP);

			// Return success response
			echo json_encode(["status" => "success", "message" => "OTP sent to email"]);
		}

		$stmt->close();
		$conn->close();
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === "sendLoginOtp" && isset($_POST['email']) && isset($_POST['securecode'])) {
	sendLoginOtp($_POST['securecode'], $_POST['email']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === "sendSignUpOtp" && isset($_POST['email']) && isset($_POST['securecode'])) {
	sendSignUpOtp($_POST['securecode'], $_POST['email']);
}
