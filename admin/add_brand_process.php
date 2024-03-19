<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['name'];
$image = $_POST['img'];
$error = '';  // Variable To Store Error Message
$code =   stripslashes($code);
$name =   stripslashes($name);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == "123" && isset($name)   && !empty($name)) {
    include('../app/db_connection.php');
    global $conn;

    if ($conn->connect_error) {
        die(" connecction has failed " . $conn->connect_error);
    }


    //  echo " inside ".$name;
    // $seller = $_SESSION['seller_id'];
    $order = 0;
    $stmt11 = $conn->prepare("INSERT INTO brand( brand_name, brand_img, brand_order )  VALUES (?,?,?)");
    $stmt11->bind_param("ssi",  $name, $image, $order);

    $stmt11->execute();
    $stmt11->store_result();
    // echo " insert done ";
    $rows = $stmt11->affected_rows;
    if ($rows > 0) {
        echo "Brand Name Added Successfully. ";
    } else {
        echo "failed to add brand";
    }
} else {
    echo "Invalid values.";
}
die;
