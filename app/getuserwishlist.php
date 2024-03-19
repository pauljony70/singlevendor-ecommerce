<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$user_id =  htmlentities($_POST['user_id'] );

// remove back slash from the variable if any...

$langauge =  stripslashes($language); 
$securecode =  stripslashes($securecode);  //  "1234567890";//
$user_id =  stripslashes($user_id);


//echo "  outside ";

if(isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)  && !empty($user_id)   ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	
	$status =0;
	
	if($langauge ==="default"){
    	$msg ="No Product exist on User wishlist";
    	$information = "No Product exist on User wishlist";
    	    
    }else{
    	$msg ="No Product exist on User wishlist";
    	$information = "No Product exist on User wishlist";
  
        
    }
	
	$jsonarray =  array();
	$count =0;
	$notExist = true;
	$rowProdJsonArray = array();
	
	
	
	 $stmt = $conn->prepare("SELECT user_id, prod_id FROM wishlist WHERE user_id=?");
	 $stmt ->bind_param(i, $user_id);
	 $stmt->execute();
	 $stmt->store_result();
	 $stmt->bind_result ( $col1, $col2);
	 
	 while($stmt->fetch() ){
	 
	 		$notExist = false;

	 		$rowUser_id = $col1;
	 		$rowProdJsonArray = $col2;
	 		
	 					
	 }
	 
	 if( $notExist ){
	 		// user didn't add any product till now
	 		$status =1;
			if($langauge ==="default"){
            	$msg ="No Product exist on User wishlist";
            	$information = "No Product exist on User wishlist";
            	    
            }else{
          	$msg ="No Product exist on User wishlist";
    	$information = "No Product exist on User wishlist";
  
                
            }	//echo " insdie  if part ";
	 
	 }else {
	 		//echo " insdie else ";
	 		
	 	$oldarray = json_decode( $rowProdJsonArray, true) ;
	  	
	  	$prodIDexist = false;
	  	
	  	 foreach($oldarray as $arraykey) {
			 //  echo "prod id ".$arraykey['prod_id'];
			 // for each product id get product details from table productdetails  
			 
			 
			 $stmt = $conn->prepare("SELECT prod_id, prod_name, prod_mrp, prod_price, prod_rating, prod_rating_count, prod_img_url, pricearray FROM productdetails WHERE prod_id=?");
			 $stmt ->bind_param(i, $arraykey['prod_id']);
			 $stmt->execute();
			 $stmt->store_result();
			 $stmt->bind_result ( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
			  
			   while($stmt->fetch() ){
	 
		
			 			
						$msg =" user wishlist is here";
			
				$jsonarray[$count] = array(
	 					 'id' => $col1,
	 					 'name' => $col2,	 					 
	 					 'mrp' =>number_format($col3, 2),
	 					 'price' => number_format($col4, 2),
	 					 'rating' => $col5,
	 					 'rating_count' => $col6,	 			 
	 					 'img_url' => $col7,
	 					 'size' => $arraykey['size'],
	 					 'color' => $arraykey['color'],
	 					 'pricearray' => $col8);
	 					 
			 	$count = $count+1;				
			 }
			  
					   
		  }
		  $status =1;
	 
	 }
	 
  	
	$information = $jsonarray;

 	
 	mysqli_close($conn);
 	
 	
 	$post_data = array(
 			 'status' => $status,
 			 'msg' => $msg,
 			 'Information' => $information );
 	
 	
 	$post_data= json_encode( $post_data );
 	
 	echo $post_data;
 	
  }		

?>