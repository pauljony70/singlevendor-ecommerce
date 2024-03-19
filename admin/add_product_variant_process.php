<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['name'];
$parentid = $_POST['parentid'];
$error = '';  // Variable To Store Error Message

$code =   stripslashes($code);
$name =   stripslashes($name);
$parentid =   stripslashes($parentid);

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == "123" && isset($name)   && !empty($name)) {
	include('../app/db_connection.php');
	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}


	$exist = false;
	$stmt = $conn->prepare("SELECT variant_id FROM product_variant_cat WHERE parent_id=? AND variant_name=?");
	$stmt->bind_param("is", $parentid, $name);
	$stmt->execute();
	$data = $stmt->bind_result($col1);
	$return = array();

	while ($stmt->fetch()) {
		$exist = true;
		// echo " array created".json_encode($return);
	}

	if ($exist) {
		echo "Variant Category name already exist. Please choose another name.";
	} else {

		$v_order = 0;
		$stmt11 = $conn->prepare("INSERT INTO product_variant_cat( variant_name, parent_id, variant_order )  VALUES (?,?,?)");
		$stmt11->bind_param("sii",  $name, $parentid, $v_order);

		$stmt11->execute();
		$stmt11->store_result();
		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			echo "New variant added successfully.";
		} else {
			echo "failed to add variant";
		}
	}
} else {
	echo "failed to add variant category.";
}
die;
