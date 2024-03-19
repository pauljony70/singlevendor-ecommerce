<?php

include('db_connection.php');

$language =  1;
$securecode =  1234567890;
$brandid =  $_POST['brand_id'];

$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //  "1234567890";//
$brandid =   stripslashes($brandid);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($brandid)  && !empty($brandid)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}


	$stmt = $conn->prepare("SELECT pd.prod_name, bd.brand_name, prod_img_url, prod_mrp, prod_price, prod_rating, prod_rating_count FROM product prod, productdetails pd, brand bd WHERE prod.prod_brand_id=? AND prod.prod_id = pd.prod_id AND prod.prod_brand_id= bd.brand_id AND prod.status='active' ORDER BY pd.prod_name ASC");
	$stmt->bind_param("i", $brandid);
	$stmt->execute();
	$result = $stmt->get_result();

	$rows = $result->fetch_all(MYSQLI_ASSOC);

	if (!empty($rows)) {
		foreach ($rows as &$row) {
			$row['prod_img_url'] = json_decode($row['prod_img_url'], true)[0];
			$row['offpercent'] = number_format((($row['prod_mrp'] - $row['prod_price']) / $row['prod_mrp']) * 100, 2);
		}
		$response = [
			'status' => 'success',
			'message' => 'Products are fetched succesfully',
			'data' => $rows
		];
	} else {
		$response = [
			'status' => 'success',
			'message' => 'No Product found',
			'data' => []
		];
	}

	$stmt->close();
	$result->close();


	mysqli_close($conn);

	echo json_encode($response);
} else {
	echo "missing fields";
}
