<?php
include('session.php');
$code = $_POST['code'];
$ordersno =  $_POST['orderid'];

$code =  stripslashes($code);
$orderid =  stripslashes($ordersno);


if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if (isset($code) && isset($orderid)) {

	include('../app/db_connection.php');
	global $conn;
	try {

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$seller_id =  $_SESSION['seller_id'];
		$status = 0;
		$order_data = array();
		$order_product_data = array();

		$stmt11 = $conn->prepare("SELECT * FROM orders odr WHERE odr.sno=?");
		$stmt11->bind_param("i",  $orderid);
		$stmt11->execute();
		$result = $stmt11->get_result();

		// Loop through the result set and fetch each row
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				// Print or use the data as needed
				$order_data = $row;
			}
		}

		$stmt11->close();

		if (!empty($order_data)) {

			$stmt2 = $conn->prepare("SELECT * FROM order_product WHERE order_id=?");
			$stmt2->bind_param("i", $order_data['order_id']);
			$stmt2->execute();
			$result = $stmt2->get_result();

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$status = 1;
					$order_product_data[] = $row;
				}
			}

			$stmt2->close();
		}

		$ord_totalprice = 0;

		$Information = array(
			'status' => $status,
			'order' => $order_data,
			'order_product' =>  $order_product_data
		);

		echo json_encode($Information);
	} catch (Exception $e) {
		echo 'Message: ' . $e->getMessage();
	}
}
