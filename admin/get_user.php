<?php
include('session.php');
$code = $_POST['code'];
$code=  stripslashes($code);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123"){
    
    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       
        // echo "class id is  ".$class_id;     
        $inactive = "admin";
           $stmt = $conn->prepare("SELECT seller_id, fname, lname, email FROM seller_login WHERE roll !=? ORDER BY fname ASC");
    	   $stmt->bind_param( s,  $inactive );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col3, $col4);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	       
        	   	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' => $col2." ".$col3,
        						'email' => $col4);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
    
    	  	 echo  json_encode($return);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>