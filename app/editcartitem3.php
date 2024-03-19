<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$prod_id =  htmlentities($_POST['prod_id']);
$user_id =  htmlentities($_POST['user_id']);
$qty =  htmlentities($_POST['prod_qty']);
// remove back slash from the variable if any...

$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //   "1234567890";//
$prod_id = stripslashes($prod_id);   //  "1";//
$user_id =    stripslashes($user_id); // "12";//
$qty = stripslashes($qty);
//echo "  outside ";

if (isset($langauge)  && !empty($langauge) &&  isset($securecode)  && !empty($securecode) && isset($prod_id)  && !empty($prod_id) && !empty($user_id) && !empty($qty)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}


	$stmt = $conn->prepare("SELECT * FROM cartdetails WHERE user_id = ?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$cart_data = $result->fetch_assoc();
	$stmt->close();

	if (!empty($cart_data)) {
		$cart_items = $cart_data ? json_decode($cart_data['prod_id'], true) : array();

		$existing_key = array_search($prod_id, array_column($cart_items, 'prod_id'));

		if ($existing_key !== false) {
			$cart_items[$existing_key]['qty'] = $qty;

			$updated_cart_data = json_encode($cart_items);

			$stmt_cart_update = $conn->prepare("UPDATE cartdetails SET prod_id = ? WHERE user_id = ?");
			$stmt_cart_update->bind_param("si", $updated_cart_data, $user_id);
			$stmt_cart_update->execute();
			$stmt_cart_update->close();

			$response = [
				'status' => 1,
				'msg' => 'Cart is updated succesfully',
				'Information' => []
			];
		} else {
			$response = [
				'status' => 0,
				'msg' => 'No Product Found',
				'Information' => []
			];
		}
	} else {
		$response = [
			'status' => 0,
			'msg' => 'No Product Found',
			'Information' => []
		];
	}

	$conn->close();

	echo json_encode($response);
}
