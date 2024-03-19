<?php

include('db_connection.php');
$language   = htmlentities($_POST['language']);
$securecode = htmlentities($_POST['securecode']);
$user_id    = htmlentities($_POST['user_id']);
$qoute_id   = htmlentities($_POST['qoute_id']);


$langauge   = stripslashes($language);
$securecode = stripslashes($securecode); //  "1234567890";//
$user_id    = stripslashes($user_id);
$qoute_id   = stripslashes($qoute_id);

if (isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && !empty($user_id)) {
    global $conn;

    if ($conn->connect_error) {
        die(" connecction has failed " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM cartdetails WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_details = $result->fetch_assoc();
    $stmt->close();

    $cart_result = array();
    $total_cart_value = $total_saving = 0;

    if (!empty($cart_details)) {
        $cart_prod_details = json_decode($cart_details['prod_id'], true);

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
                        $stmt_attr = $conn->prepare("SELECT * FROM product_attribute_value WHERE product_id = ?" . $like_attr);
                        // $stmt_attr->bind_param("is", $prodid, $prodAttrValue);
                        $stmt_attr->bind_param("i", $prodid);
                        $stmt_attr->execute();
                        $attr_result = $stmt_attr->get_result();
                        $result_prod_attr = $attr_result->fetch_assoc();
                        $stmt_attr->close();

                        if (!empty($result_prod_attr)) {
                            $total_cart_value += $result_prod_attr['price'] * intval($cart_prod_detail['qty']);
                            $total_saving += ($result_prod_attr['mrp'] - $result_prod_attr['price']) * intval($cart_prod_detail['qty']);
                            $offpercent = ($result_prod_attr['mrp'] - $result_prod_attr['price']) * 100 /  $result_prod_attr['mrp'];

                            $prod_array['prod_mrp'] = number_format($result_prod_attr['mrp'], 2);
                            $prod_array['prod_price'] = number_format($result_prod_attr['price'], 2);
                            $prod_array['offpercent'] = number_format($offpercent, 0);
                            $prod_array['stock'] = $result_prod_attr['stock'];
                            $prod_array['config_attr'] = $configAttrArray;
                            $prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
                            $prod_array['qty'] = intval($cart_prod_detail['qty']);
                            $cart_result[] = $prod_array;
                        }
                    } else {
                        $total_cart_value += $prod_array['prod_price'] * intval($cart_prod_detail['qty']);
                        $total_saving += ($prod_array['prod_mrp'] - $prod_array['prod_price']) * intval($cart_prod_detail['qty']);
                        $offpercent = ($prod_array['prod_mrp'] - $prod_array['prod_price']) * 100 /  $prod_array['prod_mrp'];
                        $prod_array['prod_mrp'] = number_format($prod_array['prod_mrp'], 2);
                        $prod_array['prod_price'] = number_format($prod_array['prod_price'], 2);
                        $prod_array['offpercent'] = number_format($offpercent, 0);
                        $prod_array['config_attr'] = array([
                            'attr_id' => '',
                            'attr_name' => '',
                            'attr_value' => ''
                        ]);
                        $prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
                        $prod_array['qty'] = intval($cart_prod_detail['qty']);
                        $cart_result[] = $prod_array;
                    }
                }
            }
            $response = [
                'status' => 1,
                'msg' => 'Cart details',
                'Information' => [
                    'cart_result' => $cart_result,
                    'total_cart_value' => number_format($total_cart_value, 2),
                    'total_saving' => number_format($total_saving, 2),
                ]
            ];
        } else {
            $response = [
                'status' => 0,
                'msg' => 'Cart is empty',
                'Information' => [
                    'cart_result' => [],
                    'total_cart_value' => '',
                    'total_saving' => '',
                ]
            ];
        }
    } else {
        $response = [
            'status' => 0,
            'msg' => 'Cart is empty',
            'Information' => [
                'cart_result' => [],
                'total_cart_value' => '',
                'total_saving' => '',
            ]
        ];
    }

    echo json_encode($response);

    $conn->close();
}
