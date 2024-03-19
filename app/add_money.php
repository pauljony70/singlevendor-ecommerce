<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$user_id =  htmlentities($_POST['user_id']);
$amount =  htmlentities($_POST['amount']);
$remarks =  htmlentities($_POST['remarks']);

// remove back slash from the variable if any...

$langauge =  stripslashes($language);
$securecode =   stripslashes($securecode);  //   "1234567890";//
$user_id =   stripslashes($user_id);
$amount =   stripslashes($amount);
$remarks =   stripslashes($remarks);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($amount)  && !empty($amount) && !empty($user_id)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT * FROM user_profile WHERE user_id = ?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$address_data = $result->fetch_assoc();
	$stmt->close();

	if (!empty($address_data)) {
		$stmt_wallet = $conn->prepare("SELECT * FROM wallets WHERE user_id = ?");
		$stmt_wallet->bind_param("i", $user_id);
		$stmt_wallet->execute();
		$wallet_result = $stmt_wallet->get_result();
		$wallet_data = $wallet_result->fetch_assoc();
		$stmt_wallet->close();

		if (empty($wallet_data)) {
			$stmt_wallet_insert = $conn->prepare("INSERT INTO `wallets` (`user_id`, `amount`) VALUES (?, 0)");
			$stmt_wallet_insert->bind_param("i", $user_id);
			$stmt_wallet_insert->execute();
			$stmt_wallet_insert->close();
		}

		$balance = !empty($wallet_data) ? $wallet_data['amount'] + $amount : $amount;

		$stmt_wallet_transaction = $conn->prepare("INSERT INTO `wallet_transactions` (`user_id`, `amount`, `balance`, `payment_type`, `remarks`) VALUES (?, ?, ?, 'cr', ?)");
		$stmt_wallet_transaction->bind_param("idds", $user_id, $amount, $balance, $remarks);
		$stmt_wallet_transaction->execute();
		$stmt_wallet_transaction->close();

		$stmt_wallet_update = $conn->prepare("UPDATE `wallets` SET `amount` = ? WHERE `user_id` = ?");
		$stmt_wallet_update->bind_param("di", $balance, $user_id);
		$stmt_wallet_update->execute();
		$stmt_wallet_update->close();

		$response = array('status' => 1, 'msg' => 'Wallet has beeen credited succesfully.');
	} else {
		$response = array('status' => 0, 'msg' => 'User not found.');
	}
	echo json_encode($response);

	$conn->close();
}
