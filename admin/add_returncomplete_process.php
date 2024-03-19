<?php
include('session.php');
$code = $_POST['code'];
$orderid = $_POST['orderid'];    
$prodid = $_POST['prodid']; 
 $phone = $_POST['phone'];
 
$orderid =     stripslashes( $orderid);
$prodid = stripslashes( $prodid);
$phone  =   stripslashes( $phone );

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $orderid) && isset( $orderid)&& isset( $prodid) && !empty($prodid)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kuwait");
       	$datetime = date('Y-m-d H:i:s');
      
        //  echo "inside ".$orderid;   return_status = 0/ kuch nahi  1/ pickup schedual  2/return successfull   3/ return cancel 4/ refund done
        $reqstatus ="Return_init";
        $returnstatus = 2;
        $stmt11 = $conn->prepare("UPDATE order_product SET return_status=?, return_updateby=? WHERE order_id=? AND prod_id=? AND status=?");
    	$stmt11->bind_param( issis, $returnstatus, $datetime, $orderid, $prodid, $reqstatus);
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Return Request Completed Successfully";
             // SEND OTP SMS
             $actionmsg = "Dear Customer, Your Request for return the item has complete successfully. your Order No ". $orderid;           		     
		    include('send_otp.php');
            sendotp( $phone, $actionmsg);  
             
         }else{
             echo "Failed to Complete Return Request. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>