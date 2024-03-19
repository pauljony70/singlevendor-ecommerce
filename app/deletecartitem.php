<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$prod_id =  htmlentities($_POST['prod_id'] );
$user_id =  htmlentities($_POST['user_id'] );

// remove back slash from the variable if any...

$langauge =  stripslashes($language); 
$securecode =  stripslashes($securecode);  //   "1234567890";//
$prod_id =  stripslashes($prod_id);   //  "1";//
$user_id =  stripslashes($user_id); // "12";//

//echo "  outside ";

if(isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($prod_id)  && !empty($prod_id) && !empty($user_id) ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	date_default_timezone_set("Asia/Kuwait");
	$date = date("Y-m-d");
	
	$status =0;
	$totalPrice = 0;
	// check userID exist or not
	$notExist = true;
	$qouteId = 1000;
	$rowUser_id = 0;
	$rowProdJsonArray = array();
	$cartcount =0;
	
	if($langauge ==="default"){
    	$msg ="fail to delete product from cart";
    	    
    }else{
    	$msg ="fail to delete product from cart";
    }

	  $information  =  array(  'qoute_id' => $qouteId, 
					    	                 'cart_count' => $cartcount ) ;
	$detailsarray =  array();
	//echo "inside if";
	
	 $stmt = $conn->prepare("SELECT user_id, prod_id, qoute_id FROM cartdetails WHERE user_id=?");
	 $stmt ->bind_param(i, $user_id);
	 $stmt->execute();
	 $stmt->store_result();
	 $stmt->bind_result ( $col1, $col2, $col3);
	 
	 while($stmt->fetch() ){
	 
	 		$notExist = false;

	 		$rowUser_id = $col1;
	 		$rowProdJsonArray = $col2;
	 		$qouteId = $col3;
	 					
	 }
	
	 
	 if( $notExist){
	  /// no  userid doens't exist on table
	  
		
	
	 
	 
	 }else{
	   /// yes userid exist
	   	
	 	//echo " hh";		 
	  	$oldarray = json_decode( $rowProdJsonArray, true) ;
	  	
	  	$prodIDexist = false;
	  	$i=0;
	  	
	  	
	  	
	  	 foreach($oldarray as $arraykey) {
			 //  echo "prod id ".$arraykey['prod_id'];
			   
			   if( $prod_id === $arraykey['prod_id'] ){
			   	  $prodIDexist = true;
			   	  
			   	    unset($oldarray[$i]);
			   	    $cartcount--;
			   	  //  $oldarray[$i]['qty']  = $newqty;
			   	    
			   	
			   	
			   	
			   	//echo " prodId exist in table ";
			   }
			   
			  $cartcount++; 
			$i++;   
		  }
		  
		 if($prodIDexist){
		  
		  		//echo " don't update table";
		  		
		  	 
		  	 	$oldarray=	array_values($oldarray);
		  	 	
		  	   $tempnewarray = 	 json_encode( $oldarray);
	 			  
	 	  
	 	 $stmt2 = $conn->prepare("UPDATE cartdetails SET prod_id=? WHERE user_id=?");
		 $stmt2->bind_param( si, $tempnewarray, $user_id );
		 $stmt2->execute();
		
		 
		$rows=$stmt2->affected_rows;
			//echo " row ".$rows;
			
			if($rows>0){	
			   		//echo " row affected is ".;
				   	$status =1;
				
					 if($langauge ==="default"){
                    	 $msg = "Successfully Delete product from cart";	    
                    }else{
                    	 $msg = "Successfully Delete product from cart";	    
                	}
					    $information  =  array(  'qoute_id' => $qouteId, 
					    	                 'cart_count' => $cartcount ) ;
				
			
			}else{
			
			
				$status =1;
			 	if($langauge ==="default"){
                	$msg ="fail to delete product from cart";
                	    
                }else{
                	$msg ="fail to delete product from cart";
            	}
			     $information  =  array(  'qoute_id' => $qouteId, 
					    	                 'cart_count' => $cartcount ) ;
			
			}
	 	
		  
		  } 
		  
	
	 } 
	 
	 

	
	$post_data = array(
	 			 'status' => $status,
	 			 'msg' => $msg,
	 			 'Information' => $information );
	 	
	 	
	 $post_data= json_encode( $post_data );
	 	
	 echo $post_data;
	 	
	 mysqli_close($conn);
	



}

	
?>	
	