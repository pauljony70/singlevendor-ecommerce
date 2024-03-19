<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$user_id =  htmlentities($_POST['user_id']);
$fullname =  htmlentities($_POST['fullname']);
$email =  htmlentities($_POST['email']);
$address =  htmlentities($_POST['address']);
$city =  htmlentities($_POST['city_value']);
$state =  htmlentities($_POST['state_value']);
$pincode =  htmlentities($_POST['pincode']);
$phone =  htmlentities($_POST['phone']);
$defaultaddress =  htmlentities($_POST['defaultaddress']);

// remove back slash from the variable if any...

$langauge =  stripslashes($language);
$securecode =   stripslashes($securecode);  //   "1234567890";//
$user_id =   stripslashes($user_id);  // "12";//
$fullname =   stripslashes($fullname);
$email =   stripslashes($email);
$address =  stripslashes($address);
$city =   stripslashes($city);
$state =  stripslashes($state);
$pincode = stripslashes($pincode);
$phone =  stripslashes($phone);
$defaultaddress =  stripslashes($defaultaddress);


//echo "  outside ";

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($fullname)  && !empty($fullname) && !empty($user_id)) {

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

	$address_id = empty($existing_addresses) ? 1 : end($existing_addresses)['address_id'] + 1;
	$address_array = empty($existing_addresses) ? array() : $existing_addresses;
	$defaultaddressvalue = empty($existing_addresses) ? 1 : $address_data['defaultaddress'];

	$new_address = array(
		'address_id' => $address_id,
		'fullname' => $fullname,
		'email' => $email,
		'phone' => $phone,
		'address' => $address,
		'pincode' => $pincode,
		'state' => $state,
		'city' => $city
	);

	if ($defaultaddress) {
		$defaultaddressvalue = $address_id;
	}

	// Add the new address to the existing addresses
	$address_array[] = $new_address;

	// Convert the array to JSON
	$address_json = json_encode($address_array);

	if (!empty($address_data)) {
		// Update the existing entry
		$stmt = $conn->prepare("UPDATE address SET addressarray = ?, defaultaddress = ?, org_addressarray = ?, pincode = ? WHERE user_id = ?");
		$stmt->bind_param("sisii", $address_json, $defaultaddressvalue, $address_json, $pincode, $user_id);
		$stmt->execute();
		$stmt->close();
	} else {
		// Insert a new entry
		$stmt = $conn->prepare("INSERT INTO address (user_id, addressarray, defaultaddress, org_addressarray, pincode) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("isisi", $user_id, $address_json, $defaultaddressvalue, $address_json, $pincode);
		$stmt->execute();
		$stmt->close();
	}

	$response = array('status' => 1, 'msg' => 'Address is saved successfully.');

	echo json_encode($response);

	$conn->close();
}
