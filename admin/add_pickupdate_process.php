<?php
include('session.php');
$code = $_POST['code'];
$orderid = $_POST['orderid'];    
$prodid = $_POST['prodid']; 
$pickupdate = $_POST['pickupdate']; 
$phone = $_POST['phone'];
 
$orderid =     stripslashes( $orderid);
$prodid = stripslashes( $prodid);
$pickupdate =   stripslashes( $pickupdate);
$phone  =   stripslashes( $phone );

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $orderid) && isset( $orderid)&& isset( $prodid) && !empty($prodid) && isset( $pickupdate) && !empty($pickupdate)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kuwait");
       	$datetime = date('Y-m-d H:i:s');
      
      $tempdate = date('d-m-Y', strtotime($pickupdate));
      $pickupdate  = date('Y-m-d H:i:s', strtotime($pickupdate));
        //  echo "inside ".$orderid;   return_status = 0/ kuch nahi  1/ pickup schedual  2/return successfull   3/ return cancel 4/ refund done
        $reqstatus ="Return_init";
        $returnstatus = 1;
        $stmt11 = $conn->prepare("UPDATE order_product SET pickup_date =?, return_status=?, return_updateby=? WHERE order_id=? AND prod_id=? AND status=?");
    	$stmt11->bind_param( sissis, $pickupdate, $returnstatus, $datetime, $orderid, $prodid, $reqstatus);
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Item Pickup Date has Scheduled to ".$pickupdate;
                      // SEND OTP SMS
             $actionmsg = "Dear Customer, Our Delivery Boy will pickup the item on $tempdate for your Order No ". $orderid;           		     
		    include('send_otp.php');
            sendotp( $phone, $actionmsg);  
       
             
         }else{
             echo "Failed to Update Item Pickup date. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>