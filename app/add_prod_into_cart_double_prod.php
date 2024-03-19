<?php

include('db_connection.php');
$language =  htmlentities($_POST['language']);
$securecode =  htmlentities($_POST['securecode']);
$prod_id =  htmlentities($_POST['prod_id']);
$user_id =  htmlentities($_POST['user_id']);
$qty =  htmlentities($_POST['qty']);
$config_attr = $_POST['config_attr'];

$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //   "1234567890";//
$prod_id =   stripslashes($prod_id);   //  "1";//
$user_id =   stripslashes($user_id); // "12";//
$qty =  stripslashes($qty);


if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($prod_id)  && !empty($prod_id) && !empty($user_id) && !empty($qty)) {

	global $conn;

	if ($conn->connect_error) {
		die(" connecction has failed " . $conn->connect_error);
	}

	$stmt = $conn->prepare("SELECT * FROM productdetails pd WHERE pd.prod_id = ?");
	$stmt->bind_param("i", $prod_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$prod_result = $result->fetch_assoc();
	$stmt->close();

	if (!empty($prod_result)) {
		$stmt_pav = $conn->prepare("SELECT * FROM product_attribute_value pav WHERE pav.product_id = ?");
		$stmt_pav->bind_param("i", $prod_id);
		$stmt_pav->execute();
		$result = $stmt_pav->get_result();
		$prod_result = $result->fetch_all(MYSQLI_ASSOC);
		$stmt_pav->close();

		if (!empty($prod_result)) {
			if (empty($config_attr)) {
				$response = [
					'status' => 0,
					'msg' => 'Please choose the attribute',
					'Information' => [
						'cart_count' => ''
					]
				];
			} else {;
				$config_attrs = json_decode($_POST['config_attr'], true);
				$config_query = '';

				if (is_array($config_attrs) && !empty($config_attrs)) {
					foreach ($config_attrs as $config_data) {
						$config_attr_value = ':"' . addslashes($config_data['attr_value']) . '"';
						$config_query .= " AND prod_attr_value LIKE '%" . $config_attr_value . "%'";
					}

					$stmt_config_price = $conn->prepare("SELECT pav.price, pav.mrp, pav.stock, pav.conf_image FROM product_attribute_value pav WHERE pav.product_id = ?" . $config_query);
					$stmt_config_price->bind_param("i", $prod_id);
					$stmt_config_price->execute();
					$result = $stmt_config_price->get_result();
					$prod_config_result = $result->fetch_assoc();
					$stmt_config_price->close();

					if (!empty($prod_config_result)) {
						if ($prod_config_result['stock'] == 0) {
							$response = [
								'status' => 0,
								'msg' => 'Product is out of stock',
								'Information' => [
									'cart_count' => ''
								]
							];
						} else if ($qty > $prod_config_result['stock']) {
							$response = [
								'status' => 0,
								'msg' => 'Only ' . $prod_config_result['stock'] . ' product is available',
								'Information' => [
									'cart_count' => ''
								]
							];
						} else {
							$stmt_cart = $conn->prepare("SELECT * FROM cartdetails WHERE user_id = ?");
							$stmt_cart->bind_param("i", $user_id);
							$stmt_cart->execute();
							$cart_result = $stmt_cart->get_result();
							$cart_data = $cart_result->fetch_assoc();
							$stmt_cart->close();

							$cart_items = $cart_data ? json_decode($cart_data['prod_id'], true) : array();

							$existing_key = array_search($prod_id, array_column($cart_items, 'prod_id'));

							if ($existing_key !== false) {
								$cart_items[$existing_key]['qty'] = $qty;
								$cart_items[$existing_key]['config_attr'] = $config_attr;
							} else {
								$new_item = array(
									'index' => count($cart_items),
									'prod_id' => $prod_id,
									'qty' => $qty,
									'config_attr' => $config_attr,
									'date' => date('Y-m-d'),
								);

								$cart_items[] = $new_item;
							}

							$updated_cart_data = json_encode($cart_items);

							if ($cart_data) {
								$stmt_cart_update = $conn->prepare("UPDATE cartdetails SET prod_id = ? WHERE user_id = ?");
								$stmt_cart_update->bind_param("si", $updated_cart_data, $user_id);
								$stmt_cart_update->execute();
								$stmt_cart_update->close();
							} else {
								$stmt_cart_insert = $conn->prepare("INSERT INTO cartdetails (user_id, prod_id) VALUES(?, ?)");
								$stmt_cart_insert->bind_param("is", $user_id, $updated_cart_data);
								$stmt_cart_insert->execute();
								$stmt_cart_insert->close();
							}

							$response = [
								'status' => 1,
								'msg' => 'Product is succesfully added into cart',
								'Information' => [
									'cart_count' => count($cart_items)
								]
							];
						}
					} else {
						$response = [
							'status' => 0,
							'msg' => 'Please choose the attribute',
							'Information' => [
								'cart_count' => ''
							]
						];
					}
				} else {
					$response = [
						'status' => 0,
						'msg' => 'Please choose the attribute',
						'Information' => [
							'cart_count' => ''
						]
					];
				}
			}
		} else {
			$stmt_cart = $conn->prepare("SELECT * FROM cartdetails WHERE user_id = ?");
			$stmt_cart->bind_param("i", $user_id);
			$stmt_cart->execute();
			$cart_result = $stmt_cart->get_result();
			$cart_data = $cart_result->fetch_assoc();
			$stmt_cart->close();

			$cart_items = $cart_data ? json_decode($cart_data['prod_id'], true) : array();

			$existing_key = array_search($prod_id, array_column($cart_items, 'prod_id'));

			if ($existing_key !== false) {
				$cart_items[$existing_key]['qty'] = $qty;
				$cart_items[$existing_key]['config_attr'] = '';
			} else {
				$new_item = array(
					'index' => count($cart_items),
					'prod_id' => $prod_id,
					'qty' => $qty,
					'config_attr' => '',
					'date' => date('Y-m-d'),
				);

				$cart_items[] = $new_item;
			}

			$updated_cart_data = json_encode($cart_items);

			if ($cart_data) {
				$stmt_cart_update = $conn->prepare("UPDATE cartdetails SET prod_id = ? WHERE user_id = ?");
				$stmt_cart_update->bind_param("si", $updated_cart_data, $user_id);
				$stmt_cart_update->execute();
				$stmt_cart_update->close();
			} else {
				$stmt_cart_insert = $conn->prepare("INSERT INTO cartdetails (user_id, prod_id) VALUES(?, ?)");
				$stmt_cart_insert->bind_param("is", $user_id, $updated_cart_data);
				$stmt_cart_insert->execute();
				$stmt_cart_insert->close();
			}

			$response = [
				'status' => 1,
				'msg' => 'Product is succesfully added into cart',
				'Information' => [
					'cart_count' => count($cart_items)
				]
			];
		}
	} else {
		$response = [
			'status' => 0,
			'msg' => 'Product not found',
			'Information' => [
				'cart_count' => ''
			]
		];
	}

	echo json_encode($response);

	mysqli_close($conn);
}
