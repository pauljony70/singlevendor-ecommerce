<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$user_id =  htmlentities($_POST['user_id']);
// remove back slash from the variable if any...

$langauge = stripslashes($language);
$securecode =  stripslashes($securecode);  //  "1234567890";//
$user_id =   stripslashes($user_id);


if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)  && !empty($user_id)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT * FROM address WHERE user_id = ?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$address_data = $result->fetch_assoc();
	$stmt->close();

	$existing_addresses = json_decode($address_data['addressarray'], true) ?? array();

	if (!empty($existing_addresses)) {
		$address_data['addressarray'] = $existing_addresses;
		$address_data['org_addressarray'] = json_decode($address_data['org_addressarray'], true) ?? array();;
		$response = array('status' => 1, 'msg' => 'Address found successfully.', 'information' => $address_data);
	} else {
		$response = array('status' => 0, 'msg' => 'No address found.', 'information' => array(
			'user_id' => $user_id,
			'addressarray' => [],
			'defaultaddress' => '',
			'org_addressarray' => [],
			'pincode' => '',
		));
	}

	echo json_encode($response);
}
