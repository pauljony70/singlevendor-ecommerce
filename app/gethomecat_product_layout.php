<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);


$langauge = stripslashes($language);
$securecode = stripslashes($securecode);  //  "1234567890";//


if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}
	// get current date

	$status = 0;
	if ($langauge === "default") {
		$msg = "No Product found";
		$Information = array();
	} else {
		$msg = "कोई प्रोडक्ट नहीं  मिला है";
		$Information = array();
	}
	$catcount = 0;
	// 0 -h, 1- 2, 2 -3, 3 -v, 4 - f,  5- fb     // banner click 0 - no action, 1 - category, 2 - product

	$stmt1 = $conn->prepare("SELECT catid, catname, layout_type, title, clicktype, prod_id, prod_name, img_url FROM homecat ORDER BY catorder ASC");
	$stmt1->execute();
	$stmt1->store_result();
	$stmt1->bind_result($col21, $col22, $col23, $col24, $col25, $col26, $col27, $col28);
	while ($stmt1->fetch()) {
		//	echo "  -- ".$col21." catname  ".$col22."<br>";
		$catid = $col21;
		$catname = $col22;
		$layouttype = $col23;
		$title = $col24;


		$catprodarray =  array();
		$jsonarray =  array();
		$count = 0;

		if ($layouttype == 5) {
			//echo " layout 5 <br>";
			$status = 1;
			$msg = "Cust Home Cat layout are here";
			$oldarray           = json_decode($col28, true);
			foreach ($oldarray as $arraykey) {
				$url =        $arraykey['url'];
				$clicktype =        $arraykey['clicktype'];
				$catid =        $arraykey['catid'];
				$prodid =        $arraykey['prodid'];

				$jsonarray[$count] = array(
					'id' => $prodid,
					'name' => $col27,   // make search name
					'short_desc' => "",
					'mrp' => 0,
					'price' => 0,
					'offpercent' =>  0,
					'w_price' => 0,
					'w_qty' => "0",
					'attr' => "[]",
					'img_url' => $url,
					'brand' => "",
					'pricearray' => "[]",
					'stock' => 1,
					'rating' => 5,
					'ratingcount' => 243,
					'catid' => $catid,
					'catname' => $col22,
					'clicktype' => $clicktype
				);
				$count = $count + 1;
			}
		} else {
			// echo " indise ".$catid;
			$active = "active";
			$stmt = $conn->prepare("SELECT pd.prod_id, pd.prod_name, pd.name_ar, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.pricearray, pd.stock, pd.prod_rating, pd.prod_rating_count FROM product prod, productdetails pd, brand bd WHERE prod.prod_cat_id=? AND prod.prod_id = pd.prod_id AND prod.prod_brand_id= bd.brand_id AND prod.status=? ORDER BY pd.update_by DESC LIMIT 8");
			$stmt->bind_param("is", $catid, $active);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($col1, $col2, $col2ar, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
			while ($stmt->fetch()) {
				//	echo " here ".$col1."---".$col2ar."<br>";
				$pname =   $col2;
				if ($language != "default") {
					$pname =    json_encode($col2ar,  JSON_UNESCAPED_UNICODE);
				}
				if ($pname == "\"\"") {
					$pname = $col2;
				}

				$offpercent =  ($col4 - $col5) * 100 /  $col4;
				//   echo "  stam extecute ".$col1."  prod_name is  ".$col2;
				$status = 1;
				$msg = "Cust Home Cat layout are here";
				$jsonarray[$count] = array(
					'id' => $col1,
					'name' => $pname,
					'short_desc' => $col3,
					'mrp' => number_format($col4, 2),
					'price' => number_format($col5, 2),
					'offpercent' =>  number_format($offpercent, 0),
					'w_price' => number_format($col6, 2),
					'w_qty' => $col7,
					'attr' => $col8,
					'img_url' => json_decode($col9, true)[0],
					'brand' => $col10,
					'pricearray' => $col11,
					'stock' => $col12,
					'rating' => $col13,
					'ratingcount' => $col14,
					'catid' => $catid,
					'catname' => $catname,
					'clicktype' => "2"
				);

				$count = $count + 1;
			} // inner while close
		} // else close

		//	echo " add into ".$col21." catname  ".$col22."<br>".sizeof($jsonarray);
		$catprodarray = $jsonarray;
		$Information[$catcount] = array(
			'banners_result' => $catprodarray,
			'cat_id' => $catid,
			'cat_name' => $catname,
			'layout' => $layouttype,
			'title' => 	$title
		);

		$catcount = $catcount + 1;
	}  // outter while 


	//echo " final response ".sizeof($Information);

	mysqli_close($conn);

	$result = array(
		'status' => $status,
		'msg' => $msg,
		'Information' => $Information
	);


	$result = json_encode($result, JSON_UNESCAPED_UNICODE);

	echo $result;
}
