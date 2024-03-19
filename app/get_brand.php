<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);

$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //  "1234567890";//

//echo "  outside ";

if (isset($securecode)  && !empty($securecode)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}
	// get current date

	$status = 0;
	$msg = "No brand found";
	$Information = "No brand found";

	$jsonarray =  array();
	$count = 0;

	$parent = 0;
	$stmt = $conn->prepare("SELECT  brand_id, brand_name, brand_img FROM brand ORDER BY brand_order ASC, brand_name ASC");
	//$stmt-> bind_param(i, $parent);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($col1, $col2, $col3);
	while ($stmt->fetch()) {
		$status = 1;
		$msg = "brand details is here";
		$jsonarray[$count] = array(
			'id' => $col1,
			'name' => $col2,
			'img_url' => $col3
		);

		$count = $count + 1;
	}

	$Information = $jsonarray;


	mysqli_close($conn);

	$post_data = array(
		'status' => $status,
		'msg' => $msg,
		'Information' => $Information
	);


	$post_data = json_encode($post_data);

	echo $post_data;
}
