<?php
include('session.php');
$code = $_POST['code'];

$orderid = $_POST['orderid'];    
$prodid = $_POST['prodid'];  
$refundamt = $_POST['refundamt'];    
$refundtxn = $_POST['refundtxn']; 
$refunddate = $_POST['refunddate'];  
$phone = $_POST['phone'];

$orderid =     stripslashes( $orderid);
$prodid = stripslashes( $prodid);
$refundamt =     stripslashes( $refundamt);
$refundtxn = stripslashes( $refundtxn);
$refunddate =   stripslashes( $refunddate);
$phone  =   stripslashes( $phone );

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if( !empty( $orderid)&& !empty( $prodid)&& isset( $refundamt) && !empty( $refundamt)&& isset( $refundtxn) && !empty($refundtxn) && isset( $refunddate) && !empty($refunddate)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kuwait");
       	$datetime = date('Y-m-d H:i:s');
      
      $refunddate  = date('Y-m-d H:i:s', strtotime($refunddate));
        //  echo "inside ".$orderid;   return_status = 0/ kuch nahi  1/ pickup schedual  2/return successfull   3/ return cancel  4/ refund done
        $reqstatus ="Return_init";
        $returnstatus = 4;
        $stmt11 = $conn->prepare("UPDATE order_product SET return_status=?, refund_amt =?, refund_txnno=?, refund_date=?, return_updateby=? WHERE order_id=? AND prod_id=? AND status=?");
    	$stmt11->bind_param( iissssis, $returnstatus, $refundamt, $refundtxn,$refunddate, $datetime, $orderid, $prodid, $reqstatus);
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Refund Details Saved Successfully";
                // SEND OTP SMS
             $actionmsg = "Dear Customer, We have refund the amount KWD .$refundamt for your Order number ". $orderid;           		     
		    include('send_otp.php');
            sendotp( $phone, $actionmsg);  
          
             
         }else{
             echo "Failed to Save Details. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>