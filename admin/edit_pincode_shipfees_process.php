<?php
include('session.php');
    $code = $_POST['code'];
    $pincodeid = $_POST['pincodeid'];    
    $areaname = $_POST['areaname']; 
    $shipfees = $_POST['shipfees']; 
 
    $pincodeid=    stripslashes( $pincodeid);
    $areaname =   stripslashes( $areaname);
    $shipfees =   stripslashes( $shipfees);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $pincodeid) && isset( $areaname)&& isset( $pincodeid) && isset( $areaname)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
      
        $rowProdJsonArray = "";
        //  echo "inside ".$catimg;
        $stmt11 = $conn->prepare("UPDATE pincode SET name =?, shippingfee=? WHERE pincode=?");
    	$stmt11->bind_param( sii, $areaname, $shipfees,  $pincodeid );
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
             echo "Update Successfully ";
             
         }else{
             echo "Failed to Update. Please try again";
         }	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>