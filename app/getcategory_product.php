<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$catid =  htmlentities($_POST['catid']);

$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //  "1234567890";//
$catid =   stripslashes($catid);
//echo "  outside ";

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($catid)  && !empty($catid)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT pd.*, bd.brand_id, bd.brand_name, ct.cat_id, ct.cat_name FROM product, productdetails pd, brand bd, category ct WHERE product.prod_id = pd.prod_id AND product.prod_cat_id = ? AND pd.brand_id = bd.brand_id AND ct.cat_id = pd.cat_id AND product.status = 'active'");
	$stmt->bind_param("i", $catid);
	$stmt->execute();
	$result = $stmt->get_result();
	$products = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();

	if (!empty($products)) {
		foreach ($products as &$product) {
			$product['prod_img_url'] = json_decode($product['prod_img_url'], true);
			$product['offpercent'] = number_format((($product['prod_mrp'] - $product['prod_price']) / $product['prod_mrp']) * 100, 2);
		}

		$response = [
			'status' => 'success',
			'message' => 'Products are fetched successfully',
			'data' => $products,
		];
	} else {
		$response = [
			'status' => 'success',
			'message' => 'No Product Found',
			'data' => [],
		];
	}

	echo json_encode($response);
}
