<?php

include('session.php');
$code = $_POST['code'];
$newtime = $_POST['newtime'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$newtime =   stripslashes($newtime);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($newtime)   && !empty($newtime)  ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
            	  
                $stmt11 = $conn->prepare("INSERT INTO deliverytime( timevalue )  VALUES (?)");
        		$stmt11->bind_param( s, $newtime );
        	 
                $stmt11->execute();
                $stmt11->store_result();
            	// echo " insert done ";
            	 $rows=$stmt11->affected_rows;
            	 if($rows>0){
            	     echo " Added Successfully.";
            	     
            	 }else{
            	     echo "failed to add.";
            	 }    
    	      
    	  
        	
    	 
    }else{
            echo "failed to add..";
    }
    die;
?>
