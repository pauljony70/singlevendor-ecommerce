<?php

include('session.php');
$code = $_POST['code'];
$coupancode = $_POST['coupancode'];
$cvalue = $_POST['cvalue'];
$capvalue = $_POST['capvalue'];
$minorder = $_POST['minorder'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$coupancode =   stripslashes($coupancode);
$cvalue =   stripslashes($cvalue);
$capvalue =   stripslashes($capvalue);
$minorder =   stripslashes($minorder);
$fromdate =   stripslashes($fromdate);
$todate =   stripslashes($todate);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($coupancode)   && !empty($coupancode)&& isset($cvalue)   && !empty($cvalue)  ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
       
      //  echo " inside ".$name;
      // $seller = $_SESSION['seller_id'];
       $active ="active";
        $stmt11 = $conn->prepare("INSERT INTO coupancode( name, value, fromdate, todate, activate, cap_value, min_order )  VALUES (?,?,?,?,?,?,?)");
		$stmt11->bind_param( sisssii,  $coupancode , $cvalue, $fromdate,$todate, $active, $capvalue, $minorder);
	 
        $stmt11->execute();
        $stmt11->store_result();
    	// echo " insert done ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "Coupan Added Successfully. ";
    	     
    	 }else{
    	     echo "failed to add Coupan";
    	 }	
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
