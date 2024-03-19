<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$user_id =  htmlentities($_POST['user_id']);
$order_id = htmlentities($_POST['order_id']);

// remove back slash from the variable if any...
$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //  "1234567890";//
$user_id =    stripslashes($user_id);
$order_id =  stripslashes($order_id);


if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)  && !empty($user_id) && !empty($order_id)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt_order = $conn->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
	$stmt_order->bind_param("ii", $order_id, $user_id);
	$stmt_order->execute();
	$order_result = $stmt_order->get_result();
	$order_data = $order_result->fetch_assoc();
	$stmt_order->close();

	$stmt_order_product = $conn->prepare("SELECT * FROM order_product WHERE order_id = ? AND user_id = ?");
	$stmt_order_product->bind_param("ii", $order_id, $user_id);
	$stmt_order_product->execute();
	$order_product_result = $stmt_order_product->get_result();
	$order_product_data = $order_product_result->fetch_all(MYSQLI_ASSOC);
	$stmt_order_product->close();

	if (!empty($order_data) && !empty($order_product_data)) {
		foreach ($order_product_data as &$order_product) {
			$order_product['prod_img'] = json_decode($order_product['prod_img']);
			$order_product['prod_attr'] = json_decode($order_product['prod_attr']) ?? array([
				'attr_id' => '',
				'attr_name' => '',
				'attr_value' => ''
			]);
		}
		$response = [
			'status' => 1,
			'msg' => 'Order Found Succesfully',
			'information' => [
				'order' => $order_data,
				'order_products' => $order_product_data
			],
		];
	} else {
		$response = [
			'status' => 0,
			'msg' => 'No Order Found',
			'information' => [
				'order' => '',
				'order_products' => ''
			],
		];
	}

	echo json_encode($response);

	$conn->close();
}
