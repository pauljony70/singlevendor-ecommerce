<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['name'];
$pin = $_POST['pincode']; 
$shippingfee = $_POST['shipping'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$name =   stripslashes($name);
$pin =   stripslashes($pin);
$shippingfee =   stripslashes($shippingfee);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($name)   && !empty($name) && isset($pin)   && !empty($pin)  ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
       
     //  echo " inside ".$name;
      // $seller = $_SESSION['seller_id'];
       
        $stmt11 = $conn->prepare("INSERT INTO pincode( pincode, name, shippingfee )  VALUES (?,?,?)");
		$stmt11->bind_param( isi, $pin, $name,$shippingfee   );
	 
        $stmt11->execute();
        $stmt11->store_result();
    	// echo " insert done ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "Pin Code Added Successfully. ";
    	     
    	 }else{
    	     echo "failed to add Pin Code";
    	 }	
    	 
    }else{
            echo "Invalid Values.";
    }
    die;
?>
