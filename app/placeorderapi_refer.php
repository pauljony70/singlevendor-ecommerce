<?php

include('db_connection.php');
$language 				=  htmlentities($_POST['language']);
$securecode 			=  htmlentities($_POST['securecode']);
$user_id 				=  htmlentities($_POST['user_id']);
$fullname 				=  htmlentities($_POST['fullname']);
$email 					=  htmlentities($_POST['email']);
$mobile 				=  htmlentities($_POST['mobile']);
$fulladdress 			=  htmlentities($_POST['fulladdress']);
$city 					=  htmlentities($_POST['city']);
$state 					=  htmlentities($_POST['state']);
$pincode 				=  htmlentities($_POST['pincode']);
$total_price 			=  htmlentities($_POST['total_price']);
$payment_id 			=  htmlentities($_POST['payment_id']);
$payment_mode 			=  htmlentities($_POST['payment_mode']);
$use_wallet_balance 	=  htmlentities($_POST['use_wallet_balance']);


$language 				=	stripslashes($language);
$securecode 			=	stripslashes($securecode);  //   "12345"; //
$user_id 				=	stripslashes($user_id);
$fullname 				=	stripslashes($fullname);
$email 					=	stripslashes($email);
$mobile 				=	stripslashes($mobile);
$fulladdress 			=	stripslashes($fulladdress);
$city 					=	stripslashes($city);
$state 					=	stripslashes($state);
$pincode 				=	stripslashes($pincode);
$total_price 			=	stripslashes($total_price);
$payment_id 			=	stripslashes($payment_id);
$payment_mode 			=	stripslashes($payment_mode);
$use_wallet_balance 	=   stripslashes($use_wallet_balance);

if (isset($language) && !empty($language) && isset($securecode) && !empty($securecode) && isset($user_id) && !empty($user_id) && isset($fullname) && !empty($fullname) && isset($email) && !empty($email) && isset($mobile) && !empty($mobile) && isset($fulladdress) && !empty($fulladdress) && isset($city) && !empty($city) && isset($state) && !empty($state) && isset($pincode) && !empty($pincode) && isset($payment_id) && !empty($payment_id) && isset($payment_mode) && !empty($payment_mode)) {
	$stmt = $conn->prepare("SELECT * FROM cartdetails WHERE user_id = ?");
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$cart_details = $result->fetch_assoc();
	$stmt->close();

	if (!empty($cart_details)) {
		$cart_prod_details = json_decode($cart_details['prod_id'], true);

		$cart_result = array();
		$total_cart_value = 0;

		if (!empty($cart_prod_details)) {
			foreach ($cart_prod_details as $key => $cart_prod_detail) {
				$prodid = $cart_prod_detail['prod_id'];

				$stmt_product = $conn->prepare("SELECT pd.prod_id, pd.prod_name, pd.prod_mrp, pd.prod_price, pd.prod_img_url, ct.cat_name, pd.unit, pd.pricearray, pd.stock, prod.status FROM productdetails pd, product prod, category ct WHERE prod.prod_id = pd.prod_id AND ct.cat_id= pd.cat_id AND pd.prod_id = ? AND prod.status = 'active'");
				$stmt_product->bind_param("i", $prodid);
				$stmt_product->execute();
				$prod_result = $stmt_product->get_result();
				$prod_array = $prod_result->fetch_assoc();
				$stmt_product->close();

				if (!empty($prod_array)) {
					$configAttrArray = json_decode($cart_prod_detail['config_attr'], true);
					if (is_array($configAttrArray) && !empty($configAttrArray)) {
						$attributes = [];
						$like_attr = '';
						foreach ($configAttrArray as $index => $attr) {
							// $attributes[$index] = $attr['attr_value'];
							$like_attr .= ' AND prod_attr_value LIKE \'%:"' . $attr['attr_value'] . '"%\'';
						}
						// $attributes = (object) $attributes;
						// $prodAttrValue = json_encode($attributes);

						// $stmt_attr = $conn->prepare("SELECT * FROM product_attribute_value WHERE product_id = ? AND prod_attr_value = ?");
						// $stmt_attr->bind_param("is", $prodid, $prodAttrValue);
						$stmt_attr = $conn->prepare("SELECT * FROM product_attribute_value WHERE product_id = ?" . $like_attr);
						$stmt_attr->bind_param("i", $prodid);
						$stmt_attr->execute();
						$attr_result = $stmt_attr->get_result();
						$result_prod_attr = $attr_result->fetch_assoc();
						$stmt_attr->close();

						if (!empty($result_prod_attr)) {
							$total_cart_value += $result_prod_attr['price'] * intval($cart_prod_detail['qty']);
							$offpercent = ($result_prod_attr['mrp'] - $result_prod_attr['price']) * 100 /  $result_prod_attr['mrp'];

							$prod_array['prod_mrp'] = $result_prod_attr['mrp'];
							$prod_array['prod_price'] = $result_prod_attr['price'];
							$prod_array['offpercent'] = $offpercent;
							$prod_array['stock'] = $result_prod_attr['stock'];
							$prod_array['config_attr'] = $configAttrArray;
							$prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
							$prod_array['qty'] = intval($cart_prod_detail['qty']);
							$cart_result[] = $prod_array;
						}
					} else {
						$total_cart_value += $prod_array['prod_price'] * intval($cart_prod_detail['qty']);
						$offpercent = ($prod_array['prod_mrp'] - $prod_array['prod_price']) * 100 /  $prod_array['prod_mrp'];
						$prod_array['prod_mrp'] = $prod_array['prod_mrp'];
						$prod_array['prod_price'] = $prod_array['prod_price'];
						$prod_array['offpercent'] = $offpercent;
						$prod_array['config_attr'] = "";
						$prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
						$prod_array['qty'] = intval($cart_prod_detail['qty']);
						$cart_result[] = $prod_array;
					}
				}
			}

			if (!empty($cart_result)) {
				$orderid = 100000;

				$stmt_order = $conn->prepare("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
				$stmt_order->execute();
				$order_result = $stmt_order->get_result();
				$order_details = $order_result->fetch_assoc();
				$stmt_order->close();
				$orderid = !empty($order_details) ? $order_details['order_id'] : 100000;

				$orderid = $orderid + 1;

				$data['order_id'] = $orderid;
				$data['user_id'] = $user_id;
				$data['status'] = 'Placed';
				$data['customer_name'] = $fullname;
				$data['customer_email'] = $email;
				$data['customer_phone'] = $mobile;
				$data['customer_address'] = $fulladdress;
				$data['customer_city'] = $city;
				$data['customer_state'] = $state;
				$data['customer_pincode'] = $pincode;
				$data['total_price'] = $total_cart_value;
				$data['payment_id'] = $payment_id;
				$data['payment_mode'] = $payment_mode;

				$order_insert_sql = "INSERT INTO orders (order_id, user_id, status, customer_name, customer_email, customer_phone, customer_address, customer_city, customer_state, customer_pincode, total_price, payment_id, payment_mode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$stmt_order_insert = $conn->prepare($order_insert_sql);

				$stmt_order_insert->bind_param("iisssssssisss", $data['order_id'], $data['user_id'], $data['status'], $data['customer_name'], $data['customer_email'], $data['customer_phone'], $data['customer_address'], $data['customer_city'], $data['customer_state'], $data['customer_pincode'], $data['total_price'], $data['payment_id'], $data['payment_mode']);
				$stmt_order_insert->execute();

				$total_price = $discount = 0;

				if ($stmt_order_insert->affected_rows > 0) {
					foreach ($cart_result as $cart_prod) {
						$data1['order_id'] = $orderid;
						$data1['user_id'] = $user_id;
						$data1['prod_id'] = $cart_prod['prod_id'];
						$data1['prod_name'] = $cart_prod['prod_name'];
						$data1['prod_img'] = json_encode($cart_prod['prod_img_url']);
						$data1['prod_attr'] = $cart_prod['config_attr'] ? json_encode($cart_prod['config_attr']) : NULL;
						$data1['qty'] = $cart_prod['qty'];
						$data1['prod_mrp'] = $cart_prod['prod_mrp'];
						$data1['prod_price'] = $cart_prod['prod_price'];
						$total_price += $cart_prod['prod_price'] * intval($cart_prod['qty']);
						$data1['total'] = $cart_prod['prod_price'] * intval($cart_prod['qty']);

						$sql_order_product_insert = "INSERT INTO order_product (order_id, user_id, prod_id, prod_name, prod_img, prod_attr, qty, prod_mrp, prod_price, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

						$stmt_order_product_insert = $conn->prepare($sql_order_product_insert);

						$stmt_order_product_insert->bind_param("iissssiidd", $orderid, $user_id, $data1['prod_id'], $data1['prod_name'], $data1['prod_img'], $data1['prod_attr'], $data1['qty'], $data1['prod_mrp'], $data1['prod_price'], $data1['total']);
						$stmt_order_product_insert->execute();


						$stmt_order_product_insert->close();
					}

					if ($use_wallet_balance == 1) {
						$stmt_wallet = $conn->prepare("SELECT * FROM wallets WHERE user_id = ?");
						$stmt_wallet->bind_param("i", $user_id);
						$stmt_wallet->execute();
						$wallet_result = $stmt_wallet->get_result();
						$wallet_details = $wallet_result->fetch_assoc();
						$stmt_wallet->close();

						if ($wallet_details['amount'] > 0) {
							$discount = min($wallet_details['amount'], $total_price, 25);
						}

						if ($discount > 0) {
							$order_update_sql = "UPDATE orders SET discountvalue = ? where user_id = ? AND order_id = ?";
							$stmt_order_insert = $conn->prepare($order_update_sql);
							$stmt_order_insert->bind_param("dii", $discount, $data['user_id'], $orderid);
							$stmt_order_insert->execute();

							$balance = $wallet_details['amount'] - $discount;

							$stmt_wallet_transaction = $conn->prepare("INSERT INTO `wallet_transactions` (`user_id`, `amount`, `balance`, `payment_type`, `remarks`) VALUES (?, ?, ?, 'dr', 'Place Order')");
							$stmt_wallet_transaction->bind_param("idd", $user_id, $discount, $balance);
							$stmt_wallet_transaction->execute();
							$stmt_wallet_transaction->close();

							$stmt_wallet_update = $conn->prepare("UPDATE `wallets` SET `amount` = ? WHERE `user_id` = ?");
							$stmt_wallet_update->bind_param("di", $balance, $user_id);
							$stmt_wallet_update->execute();
							$stmt_wallet_update->close();
						}
					}

					$stmt_cart_delete = $conn->prepare("DELETE FROM cartdetails WHERE user_id = ?");
					$stmt_cart_delete->bind_param("i", $user_id);
					$stmt_cart_delete->execute();
					$stmt_cart_delete->close();

					$response = [
						'status' => 1,
						'msg' => 'Order placed successfully',
						'Information' => $orderid
					];
				} else {
					$response = [
						'status' => 0,
						'msg' => 'Error inserting order',
						'Information' => []
					];
				}
				$stmt_order_insert->close();
			} else {
				$response = [
					'status' => 0,
					'msg' => 'Cart is empty',
					'Information' => []
				];
			}
		} else {
			$response = [
				'status' => 0,
				'msg' => 'Cart is empty',
				'Information' => []
			];
		}
	} else {
		$response = [
			'status' => 0,
			'msg' => 'Cart is empty',
			'Information' => []
		];
	}
	echo json_encode($response);
} else {
	echo "Invalid values.";
}
