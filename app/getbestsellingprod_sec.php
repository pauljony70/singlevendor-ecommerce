<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);

// remove back slash from the variable if any...

$langauge = "default"; // stripslashes($language); 
$securecode = "123"; // stripslashes($securecode);  //  "1234567890";//

//echo "  outside ";

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}
	// get current date

	$status = 0;
	if ($langauge === "default") {
		$msg = "No Product found";
		$Information = "No Product found";
	} else {
		$msg = "No Product found";
		$Information = "No Product found";
	}
	$jsonarray =  array();
	$count = 0;


	// ORDER BY id ASC|DESC;
	//echo "  inside ";

	///  select prod_id from trending where order by priority ASC

	// selectprod_name, prod_mp, prod_price, prod_rating from productdetails WHERE prod_id =  prod_id

	$active = "active";
	$stmt = $conn->prepare("SELECT pd.prod_id, pd.prod_name, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.pricearray, pd.prod_rating, pd.prod_rating_count, pd.review_id FROM product prod, productdetails pd, brand bd, popularprod pp WHERE pp.prodid = prod.prod_id AND prod.prod_id = pd.prod_id AND prod.prod_brand_id= bd.brand_id AND prod.status=? ORDER BY pp.orderid ASC");
	$stmt->bind_param("s", $active);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
	
	while ($stmt->fetch()) {
		
		$offpercent =  ($col4 - $col5) * 100 /  $col4;
		//    echo " off ".$offpercent;
		$status = 1;
		$msg = " Product details are here";
		$jsonarray[$count] = array(
			'id' => $col1,
			'name' => $col2,
			'short_desc' => $col3,
			'offpercent' =>  number_format($offpercent, 0),
			'mrp' => number_format($col4, 2),
			'price' => number_format($col5, 2),
			'w_price' => number_format($col6, 2),
			'w_qty' => $col7,
			'attr' => $col8,
			'img_url' => json_decode($col9, true)[0] ?? null,
			'brand' => $col10,
			'pricearray' => $col11,
			'rating' => $col12,
			'ratingcount' => $col13,
			'reviewid' => $col14
		);

		$count = $count + 1;
	}

	$Information = $jsonarray;


	mysqli_close($conn);
} else {

	$status = 0;
	$msg = "";
	$information = "";
}



$post_data = array(
	'status' => $status,
	'msg' => $msg,
	'Information' => $Information
);


$post_data = json_encode($post_data);

echo $post_data;
