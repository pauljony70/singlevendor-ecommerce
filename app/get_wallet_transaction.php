<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$user_id =  htmlentities($_POST['user_id']);

// remove back slash from the variable if any...

$langauge =  stripslashes($language);
$securecode =   stripslashes($securecode);  //   "1234567890";//
$user_id =   stripslashes($user_id);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && !empty($user_id)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT * FROM user_profile WHERE user_id = ?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$user_data = $result->fetch_assoc();
	$stmt->close();

	if (!empty($user_data)) {
		$stmt_wallet = $conn->prepare("SELECT * FROM wallets WHERE user_id = ?");
		$stmt_wallet->bind_param("i", $user_id);
		$stmt_wallet->execute();
		$wallet_result = $stmt_wallet->get_result();
		$wallet_data = $wallet_result->fetch_assoc();
		$stmt_wallet->close();

		if (!empty($wallet_data)) {
			$stmt_wallet_transaction = $conn->prepare("SELECT * FROM wallet_transactions WHERE user_id = ?");
			$stmt_wallet_transaction->bind_param("i", $user_id);
			$stmt_wallet_transaction->execute();
			$wallet_transaction_result = $stmt_wallet_transaction->get_result();
			$wallet_transaction_data = $wallet_transaction_result->fetch_all(MYSQLI_ASSOC);
			$stmt_wallet_transaction->close();

			$response = array('status' => 1, 'msg' => 'Wallet transactions habe been fetched succesfully.', 'information' => [
				'transactions' => $wallet_transaction_data,
				'balance' => $wallet_data['amount']
			]);
		}else{
			$response = array('status' => 0, 'msg' => 'Wallet not found.', 'information' => [
				'transactions' => [],
				'balance' => ''
			]);
		}
	} else {
		$response = array('status' => 0, 'msg' => 'User not found.', 'information' => [
			'transactions' => [],
			'balance' => ''
		]);
	}
	echo json_encode($response);

	$conn->close();
}
