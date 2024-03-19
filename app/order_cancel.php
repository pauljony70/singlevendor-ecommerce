<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$orderid =  htmlentities($_POST['orderid']);
$userid =  htmlentities($_POST['userid']);

$langauge =  stripslashes($language);
$securecode =   stripslashes($securecode);  //  "1234567890";//
$orderid =   stripslashes($orderid);
$userid = stripslashes($userid);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($orderid)  && !empty($orderid) && !empty($userid)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}
	// get current date

	$status = 0;
	if ($langauge === "default") {
		$msg = "Unable to do, Please try again.";
		$Information = "Unable to do, Please try again.";
	} else {
		$msg = "Unable to do, Please try again.";
		$Information = "Unable to do, Please try again.";
	}

	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d H:i:s");

	$userphone = "";

	$stmt = $conn->prepare("SELECT ord.status, up.phone_no, ord.create_date FROM orders ord, user_profile up WHERE ord.user_id= up.user_id AND ord.order_id=? AND ord.user_id=?");
	$stmt->bind_param("si", $orderid, $userid);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($col1, $col3, $col4);

	while ($stmt->fetch()) {
		// echo " order ".$col1;
		$createdate = $col4;
		$userphone = $col3;

		// if order cancel after 2 days
		$date1 = date_create($createdate);
		$date2 = date_create($date);

		$diff = date_diff($date1, $date2);
		//now convert the $diff object to type integer
		$intDiff = $diff->format("%R%a");
		$intDiff = intval($intDiff);

		if ($intDiff >= 2) {
			$status = 0;
			$msg = "Order can't be cancell after two days.";
		} else {

			if ($col1 == "Placed") {

				// echo " prod exist ";
				$prodstatus = "Cancelled";
				$stmt11 = $conn->prepare("UPDATE orders SET status=?, update_date=? WHERE user_id=? AND order_id=?");
				$stmt11->bind_param("ssii", $prodstatus, $date, $userid, $orderid);
				$stmt11->execute();
				$rows = $stmt11->affected_rows;

				if ($rows > 0) {
					$status = 1;
					$msg = "Order item has been cancelled.";
				} else {
					$status = 0;
					$msg = "Unable to Cancel Product this time, Please try again later.";
				}
			} else if ($col1 == "Dispatch") {
				if ($sno == $prodid) {
					$msg = "Order has been Dispatched. Please Cancel Product After Delivery.";
				}
			} else if ($col1 == "Completed") {
				if ($sno == $prodid) {
					$prodstatus = "Return_init"; // return initial  /// return suc when successfull
					$stmt11 = $conn->prepare("UPDATE orders SET status=?, update_date=? WHERE user_id=? AND order_id=?");
					$stmt11->bind_param("ssii", $prodstatus, $date, $userid, $orderid);
					$stmt11->execute();
					$rows = $stmt11->affected_rows;

					if ($rows > 0) {
						$status = 1;
						$msg = "Your request has received. Soon We will pickup the item from your address";
					} else {
						$status = 0;
						$msg = "Unable to initiate return request this time, Please try again later.";
					}
				}
			} else if ($col1 == "Cancelled") {
				if ($sno == $prodid) {
					$msg = "Order Already Cancelled by Admin.";
				}
			}
		} // if else >= 2          

	} // while close

	$Information = $jsonarray;


	$post_data = array(
		'status' => $status,
		'msg' => $msg,
		'Information' => $msg
	);


	$post_data = json_encode($post_data);

	echo $post_data;

	mysqli_close($conn);
}
