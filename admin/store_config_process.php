<?php

include('session.php');
$code = $_POST['code'];
$freeship = $_POST['freeship']; 
$minorder = $_POST['minorder'];
$working_hour_start = $_POST['working_hour_start'];
$working_hour_end = $_POST['working_hour_end'];

$error='';  // Variable To Store Error Message
$code =   stripslashes($code);
$freeship =   stripslashes($freeship);
$minorder = stripslashes($minorder);

//echo " get ".$code."--".$name."--".$address."--".$phone."--".$tax."--".$website."--".$image;
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123@384#$$65$"   ) { 
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        //echo " inside ".$name;
        $seller = $_SESSION['seller_id'];
          //  echo " order id ".$col1;
            $newusername  ="freeship";
           
            $stmt11 = $conn->prepare("UPDATE store_config SET value=? WHERE name=?");
    		$stmt11->bind_param( "ss",  $freeship, $newusername );
            $stmt11->execute();
            $stmt11->store_result();
    
            $newusername  ="minorder";
           
            $stmt12 = $conn->prepare("UPDATE store_config SET value=? WHERE name=?");
    		$stmt12->bind_param( "ss",  $minorder, $newusername );
            $stmt12->execute();
            $stmt12->store_result();
			
			$newusername  ="working_hour_start";
           
            $stmt12 = $conn->prepare("UPDATE store_config SET value=? WHERE name=?");
    		$stmt12->bind_param( "ss",  $working_hour_start, $newusername );
            $stmt12->execute();
            $stmt12->store_result();
			
			$newusername  ="working_hour_end";
           
            $stmt12 = $conn->prepare("UPDATE store_config SET value=? WHERE name=?");
    		$stmt12->bind_param( "ss",  $working_hour_end, $newusername );
            $stmt12->execute();
            $stmt12->store_result();
        
          echo "Saved Successfully.";
    	 
    }else{
            echo "failed to save details.";
    }
    die;
?>
