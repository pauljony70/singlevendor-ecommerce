<?php
$code = $_POST['code'];
$code=   stripslashes($code);

if($code=="6521587545"){
    
    include('db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       
       	$status =0;
       	$msg ="Fail to Get Delivery Area";
        $return = array();
        // echo "class id is  ".$class_id;     
        $inactive = "active";
           $stmt = $conn->prepare("SELECT pincode, name FROM pincode ORDER BY name ASC");
    	   //$stmt->bind_param( s,  $inactive );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2);
         
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	       	$status =1; 
    	       	$msg ="Delivery Area Details";
        	   	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' => $col2);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
    
    
 	
 	mysqli_close($conn);
 	 
 	
 	$post_data = array(
 			 'status' => $status,
 			 'msg' => $msg,
 			 'Information' => $return );
 	
 	
 	$post_data= json_encode( $post_data );
 	
 	echo $post_data;
 	    //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}


?>