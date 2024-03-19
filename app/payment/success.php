<?php

$var = json_encode( $_REQUEST );
$sime = $_REQUEST;

$orderno= $_REQUEST["order_no"];
$refno= $_REQUEST["reference_number"];
	
	if( isset($orderno)   && !empty($orderno) && isset($refno)   && !empty($refno)  ) {
       include ('../db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        $havedata = false;	
       // echo " inside ".$name;
        $stmt = $conn->prepare("SELECT amount, result, gateway_response, customer_email FROM knet_payment WHERE order_no=? && reference_number=?");
		$stmt->bind_param( ss, $orderno,  $refno);
    	$stmt->execute();
     	$stmt->store_result();
     	$stmt->bind_result ( $col1, $col2, $col3, $col4  );
     	while($stmt->fetch() ){
     	    if($col2== "success"){
     	        $havedata = true; 
     	    }
     	   
        
     	}
     	
     	if($havedata == true){
     	    echo "<h2>Thank You,</h2>";
     	    echo "<h3>Your payment status is - ". $col2.".</h3>";
            echo "<p>Your Transaction ID for this transaction is ".$refno.".</p>";
             header("refresh:5;URL=http://app.afrahalkhaleej.com/app/payment/result_success_txtid.php?txtid=".$refno);
            echo "<p>We have received a payment of KWD ".$col1." From ". $col4.". Thank you for shopping with us.</p>";
             echo "<h4>Window will close automatically in 5 second. </h4>"; 
     	}else{
     	    echo "<h2>Error</h2>";
     	    echo "<h3>Payment Transaction Status - Failled.</h3>";
             header("refresh:5;URL=http://app.afrahalkhaleej.com/app/payment/result_failed.php");
            echo "<p>if amount has been deducted from your account, It will be refund soon. Please contact us for more details. </p>"; 
            echo "<h4>Window will close automatically in 5 second. </h4>"; 
            
     	    
     	}
    	 
   }else{
            echo "Invalid";
    }
		   
//		   }
/*

● Captured - Transaction is approved by the Payment Gateway. (result: CAPTURED or SUCCESS)
● Not Captured - Transaction is not approved by the Payment Gateway. (result: NOT CAPTURED or FAILED)
{
  "customer_email": "customer@example.com",
  "gateway_name": "kpayt",
  "order_no": "CUSTOMER1215",
  "reference_number": "45FLU",
 
  "amount": "15.000",
  "result": "success",
  "gateway_account": "kpay",
  "currency_code": "KWD",
  
  "gateway_response": {
    "postdate": "1031",
    "trackid": "45FLU",
    "authRespCode": "00",
    "tranid": "201930381348293",
    "udf2": "customer@example.com",
    "avr": "N",
    "paymentid": "100201930381369958",
    "auth": "B61792",
    "ref": "930310000693",
    "amt": "15.000",
    "result": "CAPTURED"
  }
}
*/


?>	