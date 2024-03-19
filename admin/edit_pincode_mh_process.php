<?php

include('session.php');
$code = $_POST['code'];
$shipfees = $_POST['shipfees']; 

$error='';  // Variable To Store Error Message
$code =   stripslashes($code);
$shipfees =   stripslashes($shipfees);

//echo " get ".$code."--".$name."--".$address."--".$phone."--".$tax."--".$website."--".$image;
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="212125487785"   ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        //echo " inside ".$name;
        $seller = $_SESSION['seller_id'];
          //  echo " order id ".$col1;
            $newusername  ="mh_ship";
           
            $stmt11 = $conn->prepare("UPDATE store_config SET value=? WHERE name=?");
    		$stmt11->bind_param( ss,  $shipfees, $newusername );
            $stmt11->execute();
            $stmt11->store_result();
    
        
          echo "Saved Successfully.";
    	 
    }else{
            echo "failed to save details.";
    }
    die;
?>
