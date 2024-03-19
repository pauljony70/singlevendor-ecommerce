<?php
include('session.php');
$code = $_POST['code'];
$parentid = $_POST['parentid'];

$code=  stripslashes($code);
$parentid=   stripslashes($parentid);

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
        $inactive = "active";
        $parentname ="";
           $stmt = $conn->prepare("SELECT variant_id, variant_name, parent_id, variant_order FROM product_variant_cat WHERE parent_id=? ORDER BY variant_order ASC");
    	   $stmt->bind_param( "i",  $parentid );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1, $col2, $col4, $col5);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	       
        	   	$return[$i] = 
        					array(	
        					    'id' => $col1,
        						'name' => $col2,
        						'parentid' => $col4,
        						'orderno' => $col5);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
    	    
    	   $stmt2 = $conn->prepare("SELECT variant_name FROM product_variant_cat WHERE variant_id=?");
    	   $stmt2->bind_param( "i",  $parentid );
    	   $stmt2->execute();	 
     	   $data = $stmt2->bind_result( $col5);
         
       	   while ($stmt2->fetch()) { 
    	       
        	   $parentname = $col5;
              		 		  
               // echo " array created".json_encode($return);
    	    }
    	    $info = array('parentv'=> $parentname,
    	                  'subcat' => $return);
    
    	  	 echo  json_encode($info);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>