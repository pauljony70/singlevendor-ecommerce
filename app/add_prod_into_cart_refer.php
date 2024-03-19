<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$prod_id =  htmlentities($_POST['prod_id'] );
$size =  htmlentities($_POST['size'] );
$color =  htmlentities($_POST['color'] );
$user_id =  htmlentities($_POST['user_id'] );
$prod_price =  htmlentities($_POST['prod_price'] );
$qty =  htmlentities($_POST['qty'] );
$referid =  htmlentities($_POST['referid'] );
$msgoncake =  htmlentities($_POST['msgoncake'] );
$eggless =  htmlentities($_POST['eggless'] );

// remove back slash from the variable if any...

$langauge =  stripslashes($language); 
$securecode =  stripslashes($securecode);  //   "1234567890";//
$prod_id =   stripslashes($prod_id);   //  "1";//
$size =     stripslashes($size); 
$color =    stripslashes($color); 
$user_id =   stripslashes($user_id); // "12";//
$prod_price =  stripslashes($prod_price);
$qty =  stripslashes($qty);
$referid =  stripslashes($referid);  
$msgoncake =  stripslashes($msgoncake); 
$eggless =  stripslashes($eggless); 

//echo "  outside ";
$prod_price = str_replace(",", "", $prod_price);
$prod_price = str_replace("\u20b9 ", "", $prod_price);


if(isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($prod_id)  && !empty($prod_id) && !empty($user_id) && !empty($qty) ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	date_default_timezone_set("Asia/Kuwait");
	$date = date("Y-m-d");
	
	$status =0;
	$msg ="failled to add product into cart";
	$information = "failled to add product into cart";
	$detailsarray =  array();
	//echo "inside if";
	if($langauge ==="default"){
    	$msg ="failed to add product into cart";
    	$information = "failed to add product into cart";
	    
	}else{
    	$msg ="failed to add product into cart";
    	$information = "failed to add product into cart";
	    
	}
	
	// check userID exist or not
	$notExist = true;
	$qouteId = 1000;
	$rowUser_id = 0;
	$rowProdJsonArray = array();
	$cartcount =0;
	
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
	    // echo  "userid doesn't exist on table";
	  
		 $stmt = $conn->prepare("SELECT qoute_id FROM cartdetails ORDER BY user_id DESC LIMIT 1");
		 $stmt->execute();
		 $stmt->store_result();
		 $stmt->bind_result ( $col4);
		 //$qouteno = 1000;
		 	
		 while($stmt->fetch() ){
		 
		 		$qouteId = $col4;
		 		//echo "last qoute id ".		$qouteId;		
		 }
		// create product id json array-
		
		$prod_json_array[0] =	array(
	 			 'prod_id' => $prod_id,
	 			 'qty' => $qty,
	 			 'size' => $size,
	 			 'color' => $color,
	 			 'price' => $prod_price,
	 			 'date' => $date,
	 			 'referid' => $referid,
	 			 'msgoncake' => $msgoncake,
	 			 'eggless' => $eggless);
	 			 
		//echo " prod array is ".	json_encode( $prod_json_array );
		 
		 $prod_jsonarray = json_encode( $prod_json_array );
	
		// add prod id into cartdetails table
		 $qouteId =  $qouteId+1;	
		// echo " qute id ". $qouteId;
	
	 	 $stmt2 = $conn->prepare("INSERT INTO cartdetails ( user_id, prod_id, qoute_id )  VALUES (?,?,?)");
		 $stmt2->bind_param( isi, $user_id, $prod_jsonarray, $qouteId);
		 $stmt2->execute();
		 
		 if (!($stmt2->insert_id) === 0 ||  !is_null($stmt2->insert_id)){
		//if(!empty($stmt2->insert_id)){
		
			//echo "  insert sus ";
			$cartcount =1;
			$status =1;
		//	$msg ="Successfully added product into cart.";
			if($langauge ==="default"){
            	$msg ="Successfully added product into cart.";
         	    
        	}else{
        	   	$msg ="ಕಾರ್ಟ್ಗೆ ಉತ್ಪನ್ನವನ್ನು ಯಶಸ್ವಿಯಾಗಿ ಸೇರಿಸಿದೆ.";
         
        	}
			$information =  array(  'qoute_id' => $qouteId, 
						'cart_count' =>  $cartcount ) ;
		
				
		}else{
			//echo " no display msg ";
		}
	
	 
	 
	 }else{
	     // echo " yes userid exist";
	   	
	   	$newjsonObject = array(
	 			 'prod_id' => $prod_id,
	 			  'qty' =>$qty,
	 			  'size' => $size,
	 			 'color' => $color,
	 			  'price' =>$prod_price,
	 			  'date' => $date,
	 			  'referid' => $referid,
	 			 'msgoncake' => $msgoncake,
	 			  'eggless' => $eggless);
	 			 
	  	$oldarray = json_decode( $rowProdJsonArray, true) ;
	  	
	  	$prodIDexist = false;
	  	$prodattr = false;
	  	$i =0;
	  	 foreach($oldarray as $arraykey) {
			   
			   if( $prod_id === $arraykey['prod_id'] ){
		    	   	$prodIDexist = true;
			       	//echo " prodId exist in table ";
			   	     if( $size === $arraykey['size'] && $color === $arraykey['color'] && $prod_price === $arraykey['price'] 
			          && $qty === $arraykey['qty'] && $msgoncake === $arraykey['msgoncake'] && $eggless === $arraykey['eggless'] ){
        			   		$prodattr = true;
        			  
        			 }else{
        			     	$oldarray [$i] ['size'] = $size;
        			     	$oldarray [$i] ['color'] = $color;
        			       	$oldarray [$i] ['price'] = 	$prod_price;
        			       	$oldarray [$i] ['qty'] = 	$qty;
        			       	$oldarray [$i] ['msgoncake'] = 	$msgoncake;
        			       	$oldarray [$i] ['eggless'] = 	$eggless;
        			 }
			   }
			   $i++;	
			  $cartcount = 	$cartcount+1;
			   
		  }
		 
		// echo " cart cou nt ".$cartcount ;
		  if($prodIDexist){
		  
		  		//echo " don't update table";
		  		if(	$prodattr){
    		  		$status =1;
    			   	if($langauge ==="default"){
                    	$msg ="Successfully added product into cart.";
                 	    
                	}else{
                	   	 	$msg ="ಕಾರ್ಟ್ಗೆ ಉತ್ಪನ್ನವನ್ನು ಯಶಸ್ವಿಯಾಗಿ ಸೇರಿಸಿದೆ.";
                 
                	}
				    $information  =  array(  'qoute_id' => $qouteId, 
					    	                 'cart_count' => $cartcount ) ;
    				    
		  		}else{
		  		    // update color & size
		  		     $oldarray = array_values($oldarray);
		  		     $tempnewarray = 	 json_encode( $oldarray);
              				  
        		 	 $stmt2 = $conn->prepare("UPDATE cartdetails SET prod_id=? WHERE user_id=?");
		             $stmt2->bind_param( si, $tempnewarray, $user_id );
        			 $stmt2->execute();
        			 $rows=$stmt2->affected_rows;
        			//echo " row ".$rows;
        			
        			if($rows>0){
        			 	   	$status =1;
    				 	  	if($langauge ==="default"){
                            	$msg ="Successfully added product into cart.";
                         	    
                        	}else{
                            	$msg ="Successfully added product into cart.";
                         
                        	}
				            $information  =  array(  'qoute_id' => $qouteId, 
					    	                    'cart_count' => $cartcount ) ;
        			}else{
        				$status =0;
        			 	$msg = " Fail to add product into cart.";
        			 	if($langauge ==="default"){
                        	$msg =" Fail to add product into cart.";
                     	    
                    	}else{
                    	   	$msg ="ಉತ್ಪನ್ನವನ್ನು ಕಾರ್ಟ್ಗೆ ಸೇರಿಸಲು ವಿಫಲವಾಗಿದೆ.";
                     
                    	}
        			 	$information  =  array(  'qoute_id' => $qouteId, 
        				        		         'cart_count' => $cartcount ) ;
        			}
		  		    
		  		}
		  		
		  		
				 	
		  }else{
		  
		  	 array_push( $oldarray , $newjsonObject   );
		  	 
		  	 
		  	   $tempnewarray = 	 json_encode( $oldarray);
	 			  $cartcount = 	$cartcount+1; 
	 	  
	 	 $stmt2 = $conn->prepare("UPDATE cartdetails SET prod_id=? WHERE user_id=?");
		 $stmt2->bind_param( si, $tempnewarray, $user_id );
		 $stmt2->execute();
		
		 
		$rows=$stmt2->affected_rows;
			//echo " row ".$rows;
			
			if($rows>0){	
			   		//echo " row affected is ";
				   	$status =1;
				 	$msg = "Successfully Product Added into the card";
				 	$information  =  array(  'qoute_id' => $qouteId, 
						                 'cart_count' => $cartcount ) ;
			    	
			
			
			}else{
			
			
				$status =0;
			 	$msg = " Fail to add product into cart.";
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
	