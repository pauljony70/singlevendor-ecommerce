<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['name'];
$image = $_POST['img'];
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
	$stmt = $conn->prepare("SELECT cat_id FROM category WHERE cat_name=? AND parent_id=?");
	$stmt->bind_param("si", $name, $parentid);
	$stmt->execute();
	$data = $stmt->bind_result($col1);
	$return = array();

	while ($stmt->fetch()) {
		$exist = true;

		// echo " array created".json_encode($return);
	}

	if ($exist) {
		echo "Category name already exist. Please choose another name.";
	} else {

		$stmt11 = $conn->prepare("INSERT INTO category( cat_name, cat_img, parent_id )  VALUES (?,?,?)");
		$stmt11->bind_param("ssi",  $name, $image, $parentid);

		$stmt11->execute();
		$stmt11->store_result();
		// echo " insert done ";
		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			echo "New Category Added Successfully.";
		} else {
			echo "failed to add category";
		}
	}
} else {
	echo "failed to add category.";
}
die;
