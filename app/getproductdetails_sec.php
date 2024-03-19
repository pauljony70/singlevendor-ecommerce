<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$prodid =  htmlentities($_POST['prodid']);

$langauge =  stripslashes($language);
$securecode = stripslashes($securecode);  //  "1234567890";//
$prodid =    stripslashes($prodid);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($prodid)  && !empty($prodid)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT pd.*, bd.brand_id, bd.brand_name, ct.cat_id, ct.cat_name FROM product, productdetails pd, brand bd, category ct WHERE product.prod_id = pd.prod_id AND pd.prod_id = ? AND pd.brand_id = bd.brand_id AND ct.cat_id = pd.cat_id AND product.status = 'active'");
	$stmt->bind_param("i", $prodid);
	$stmt->execute();
	$result = $stmt->get_result();
	$prod_result = $result->fetch_assoc();
	$stmt->close();

	if (!empty($prod_result)) {
		$prod_result['prod_img_url'] = json_decode($prod_result['prod_img_url'], true);
		$prod_result['offpercent'] = number_format((($prod_result['prod_mrp'] - $prod_result['prod_price']) / $prod_result['prod_mrp']) * 100, 2);

		$config_attr_stmt = $conn->prepare("SELECT pa.attr_value, pa.prod_attr_id, pas.attribute FROM product_attribute pa, product_attributes_set pas WHERE pas.id = pa.prod_attr_id AND prod_id = ?");
		$config_attr_stmt->bind_param("i", $prodid);
		$config_attr_stmt->execute();
		$result = $config_attr_stmt->get_result();
		$config_attrs = $result->fetch_all(MYSQLI_ASSOC);
		$config_attr_stmt->close();

		foreach($config_attrs as &$config_attr){
			$config_attr['attr_value'] = json_decode($config_attr['attr_value'], true);
		}
		$prod_result['cofig_attrs'] = $config_attrs;

		$stmt = $conn->prepare("SELECT pd.*, bd.brand_id, bd.brand_name, ct.cat_id, ct.cat_name FROM product, productdetails pd, brand bd, category ct WHERE product.prod_id = pd.prod_id AND product.prod_cat_id = ? AND pd.prod_id != ? AND pd.brand_id = bd.brand_id AND ct.cat_id = pd.cat_id AND product.status = 'active'");
		$stmt->bind_param("ii", $prod_result['cat_id'], $prodid);
		$stmt->execute();
		$result = $stmt->get_result();
		$related_products = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($related_products as &$related_product) {
			$related_product['prod_img_url'] = json_decode($related_product['prod_img_url'], true);
			$related_product['offpercent'] = number_format((($related_product['prod_mrp'] - $related_product['prod_price']) / $related_product['prod_mrp']) * 100, 2);
		}
		$stmt->close();

		$response = [
			'status' => 1,
			'message' => 'Product id fetched successfully',
			'Information' => $prod_result,
			'related_products' => $related_products
		];
	} else {
		$response = [
			'status' => 0,
			'message' => 'No Product Found',
			'Information' => [],
			'related_products' => []
		];
	}

	echo json_encode($response);
}
