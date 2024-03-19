<?php
include('session.php');
$code = $_POST['code'];
$ordersno = $_POST['orderid'];
$action = $_POST['action'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$grandtotal = $_POST['grandtotal'];
// $seller_id =$_SESSION['seller_id'];

$code =   stripslashes($code);
$ordersno =   stripslashes($ordersno);
$action =   stripslashes($action);
$phone =   stripslashes($phone);
$email =   stripslashes($email);
$grandtotal =   stripslashes($grandtotal);

if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
  // echo " dashboard redirect to index";
} else if (isset($code) && isset($ordersno) && isset($action)) {

  include('../app/db_connection.php');
  global $conn;
  try {

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $datetime = date('Y-m-d H:i:s');

    $rowProdJsonArray = "";
    //   echo "inside ";
    $stmt11 = $conn->prepare("UPDATE orders SET status =?, update_date=? WHERE sno=?");
    $stmt11->bind_param("ssi", $action, $datetime,  $ordersno);
    $stmt11->execute();
    $stmt11->store_result();

    // echo " insert done ";
    $rows = $stmt11->affected_rows;
    if ($rows > 0) {
      echo " Order Status Change Successfully ";
      // SEND OTP SMS
      if ($action === "dispatch") {
        $action = "dispatched";
      }

      $actionmsg = "Your Order Status has changed to $action. Order total Price is Rs. $grandtotal";

      include('send_otp.php');
      sendotp($phone, $actionmsg);

      // SEND email

      include('send_mail_orderstatus.php');
      $subject = "Your Order Has " . $action;
      $bodymsg = "Your order status has changed to " . $action . ". Order total Price is Rs. " . $grandtotal;
      send_mail($email, $subject, $bodymsg);
    } else {
      echo "Failed to Update Order Status. Please try again";
    }
  } //catch exception
  catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
}
