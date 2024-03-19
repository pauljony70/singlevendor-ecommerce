<?php
/*$data = file_get_contents("php://input");
//file_put_contents('log_'.date("j.n.Y").'.log', $data, FILE_APPEND);
$my_file = 'json.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
fwrite($handle, $data);
fclose($handle);
*/
?>

<?php

$data = file_get_contents("php://input");
//file_put_contents('log_'.date("j.n.Y").'.log', $data, FILE_APPEND);
/*$my_file = 'json.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
fwrite($handle, $data);
fclose($handle);
*/
// $request_req = json_encode( $_REQUEST );
//$request_res = $_REQUEST;
$request_data =   json_decode($data, true); //json_encode($_POST);

$amount = $request_data['amount'];
$customer_email = $request_data['customer_email'];
$order_no = $request_data['order_no'];
$reference_number= $request_data['reference_number'];
$result = $request_data['result'];
$gateway_response= json_encode($request_data['gateway_response']);

$error='';  // Variable To Store Error Message


if( isset($order_no)   && !empty($amount) && isset($order_no)   && !empty($reference_number)  ) {
       include ('../db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
      //  echo " inside ".$name;
       $active ="active";
        $stmt11 = $conn->prepare("INSERT INTO knet_payment( amount, order_no, result, gateway_response, customer_email, reference_number, cmp_res   )  VALUES (?,?,?,?,?,?,?)");
		$stmt11->bind_param( sssssss, $amount , $order_no, $result, $gateway_response, $customer_email, $reference_number, $data );
	 
        $stmt11->execute();
        $stmt11->store_result();
    	// echo " insert done ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo " Added Successfully. ";
    	     
    	 }else{
    	     echo "failed to add";
    	 }	
    	 
   }else{
            echo "Invalid values.";
    }
    
    die;
?>
