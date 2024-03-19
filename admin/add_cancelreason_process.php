<?php
include('session.php');
$code = $_POST['code'];
$orderid = $_POST['orderid'];    
$prodid = $_POST['prodid']; 
$reason = $_POST['reason'];
 $phone = $_POST['phone'];
 
$orderid =     stripslashes( $orderid);
$prodid = stripslashes( $prodid);
$reason =   stripslashes( $reason);
$phone  =   stripslashes( $phone );

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $orderid) && isset( $orderid)&& isset( $prodid) && !empty($prodid) && isset( $reason) && !empty($reason)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
      
      $pickupdate  = date('Y-m-d H:i:s', strtotime($pickupdate));
        //  echo "inside ".$orderid;   return_status = 0/ kuch nahi  1/ pickup schedual  2/return successfull   3/ return cancel
        $reqstatus ="Return_init";
        $returnstatus = 3;
        $stmt11 = $conn->prepare("UPDATE order_product SET return_reason =?, return_status=?, return_updateby=? WHERE order_id=? AND prod_id=? AND status=?");
    	$stmt11->bind_param( sissis, $reason, $returnstatus, $datetime, $orderid, $prodid, $reqstatus);
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Update Successfull. Return Request has canceled";
            $actionmsg = "Dear Customer, Your Request for return the item for OrderNo.  $orderid has canceled because of -". $reason;           		     
		    include('send_otp.php');
            sendotp( $phone, $actionmsg);  
             
         }else{
             echo "Failed to Cancel Return Request. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>