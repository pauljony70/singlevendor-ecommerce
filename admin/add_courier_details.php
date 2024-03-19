<?php
include('session.php');
$code = $_POST['code'];
$orderid = $_POST['orderid'];    
$couriername = $_POST['couriername']; 
$trackingid = $_POST['trackingid']; 
 
$orderid =     stripslashes( $orderid);
$couriername = stripslashes( $couriername);
$trackingid =   stripslashes( $trackingid);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $orderid) && isset( $orderid)&& isset( $trackingid) && !empty($trackingid) && isset( $couriername) && !empty($couriername)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kuwait");
       	$datetime = date('Y-m-d H:i:s');
      
        $rowProdJsonArray = "";
        //  echo "inside ".$orderid;
        $stmt11 = $conn->prepare("UPDATE orders SET curriername =?, trackid=? WHERE sno=?");
    	$stmt11->bind_param( ssi, $couriername, $trackingid,  $orderid );
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Courier Name update Successfully ";
             
         }else{
             echo "Failed to Update Courier Name. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>