<?php


$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$user_id =  htmlentities($_POST['user_id']);
$default_addressid =  htmlentities($_POST['default_addressid']);

$langauge =  stripslashes($language);
$securecode = stripslashes($securecode);  //  "1234567890";//
$user_id =   stripslashes($user_id);
$default_addressid =   stripslashes($default_addressid);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)  && !empty($user_id) && !empty($default_addressid)) {
	include('db_connection.php');
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

	$address = array_search($default_addressid, array_column($existing_addresses, 'address_id'));

	if ($address !== false) {
		$stmt = $conn->prepare("UPDATE address SET defaultaddress = ? WHERE user_id = ?");
		$stmt->bind_param("ii",$default_addressid, $user_id);
		$stmt->execute();
		$stmt->close();

		$response = array('status' => 1, 'msg' => 'Default address is updated successfully.');
	} else {
		$response = array('status' => 0, 'msg' => 'No address found.');
	}

	echo json_encode($response);
}
