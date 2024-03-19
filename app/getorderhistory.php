<?php
include('db_connection.php');
$language          = htmlentities($_POST['language']);
$securecode        = htmlentities($_POST['securecode']);
$user_id           = htmlentities($_POST['user_id']);
// remove back slash from the variable if any...
$langauge          = stripslashes($language); 
$securecode        = stripslashes($securecode);  //  "1234567890";//
$user_id           = stripslashes($user_id);
$count             = 0;
$emptyorderhistory = true;
$orderid           = "";
$address           = "";
$price             = "";
$date              = "";
$orderstatus       = "";
$curriername       = "";
$trackid           = "";
$notExist       = true;
$status            = 0;
if ($langauge === "default") {
    $msg = "Order History is empty.";
} else {
    $msg = "Order History is empty.";
}
$information = array();
if (isset($langauge) && !empty($langauge) && isset($securecode) && !empty($securecode) && !empty($user_id)) {
    global $conn;
    if ($conn->connect_error) {
        die(" connecction has failed " . $conn->connect_error);
    }
    // get current date
    $stmt = $conn->prepare("SELECT order_id, address_id, total_price, create_date, status, curriername, trackid FROM orders WHERE user_id=? ORDER BY order_id DESC");
    $stmt->bind_param(i, $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2, $col3, $col4, $col15, $col16, $col17);
    while ($stmt->fetch()) {
        $notExist           = false;
        $timestamp         = strtotime($col4);
        $new_date          = date('d-m-Y', $timestamp);
        $emptyorderhistory = false;
        $orderid           = $col1;
        $address           = $col2;
        $price             = number_format($col3, 2);
        $date              = $new_date;
        $orderstatus       = $col15;
        $curriername       = $col16;
        $trackid           = $col17;
        $tempaddress       = "";
        $finaladddress     = "";
        // get user address using address id
        $stmt2             = $conn->prepare("SELECT org_addressarray FROM address WHERE user_id=?");
        $stmt2->bind_param(i, $user_id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($col5);
        while ($stmt2->fetch()) {
            $tempaddress = $col5;
        }
        $oldarray    = json_decode($tempaddress, true);
        $prodIDexist = false;
        foreach ($oldarray as $arraykey) {
            if ($arraykey['address_id'] === $address) {
                $finaladddress = $arraykey['address1'] . " " . $arraykey['address2'] . " " . $arraykey['city'] . " " . $arraykey['state'] . " " . $arraykey['pincode'] . "\nPhone- " . $arraykey['phone'];
            }
        }
        // store complete address in address variable
        $address             = $finaladddress;
        $information[$count] = array(
            'order_id' => $orderid,
            'shippingaddress' => $address,
            'price' => $price,
            'date' => $date,
            'orderstatus' => $orderstatus,
            'curriername' => $curriername,
            'trackid' => $trackid
        );
        $count               = $count + 1;
    }
    //$msg = "No Product exist on User 888 cart ". $notExist ; 
    if ($notExist) {
        // user didn't add any product till now
        $status = 0;
        if ($langauge === "default") {
            $msg = "Order History is empty.";
        } else {
            $msg = "Order History is empty.";
        }
        $information = array();
    } else {
        $status = 1;
        $msg    = "User Order History is details.";
    }
    $post_data = array(
        'status' => $status,
        'msg' => $msg,
        'Information' => $information
    );
    $post_data = json_encode($post_data);
    echo $post_data;
    mysqli_close($conn);
}
?>