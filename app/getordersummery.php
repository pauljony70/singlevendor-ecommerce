<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$user_id =  htmlentities($_POST['user_id'] );
$qoute_id =  htmlentities($_POST['qoute_id'] );
// remove back slash from the variable if any...

$langauge =  stripslashes($language); 
$securecode =   stripslashes($securecode);  //  "1234567890";//
$user_id =     stripslashes($user_id);
$qoute_id =   stripslashes($qoute_id);

//echo "  outside "; 
    $cashondelivery  ="false";
	$minordervalue ="0";
	$freeship ="100";
	$freeshipping = 0;
	
	$status =0;
	$jsonarray =  array();
	$rowProdJsonArray = array();
	$subtotal =0;
	$ordertotal =0;

	$cgst  =0; $sgst = 0; $igst =0;
	//$shiparray = array();
	$shippingfees =0;
	
	if($langauge ==="default"){
    		$msg ="No Product exist on User cart";
    	    
    }else{
    		$msg ="No Product exist on User cart";
	}
	$information = array(  		  'prod_details' => $jsonarray, 
					   'subtotal' =>   $subtotal ,
					   'shippingfee' =>   '0.00', 
					   'csgt' =>   '0.00' ,
					   'sgst' =>   '0.00' ,
					   'igst' =>   '0.00' ,
					   'ordertotal' =>   $ordertotal,
					   'feeshipping' => $freeshipping,
					   'minorder' => $minordervalue,
					   'cashondelivery'=>    $cashondelivery) ;
					   
	
	$count =0;
	$notExist = true;
//	$prodcounty = 0;
	
	

if(isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)  && !empty($user_id)   ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date

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
	 
	//$msg = "No Product exist on User 888 cart ". $notExist ; 
	 if( $notExist ){
	 		// user didn't add any product till now
	 		$status =1;
			if($langauge ==="default"){
            		$msg ="No Product exist on User cart";
            	    
            }else{
            		$msg ="No Product exist on User cart";
        	}
	
	 
	 
	 }else {
	 
	 		
	 	$oldarray = json_decode( $rowProdJsonArray, true) ;
	  	
	  	$prodIDexist = false;
	 	$freeship_essential =0;   // for essential product give freeshiping if the product is only item in cart.
	  	
	  	 foreach($oldarray as $arraykey) {
			 //  echo "prod id ".$arraykey['prod_id'];
			 // for each product id get product details from table productdetails  
			 
			 
			 $stmt = $conn->prepare("SELECT prod_id, prod_name, prod_price, cgst, sgst, igst, shipping, other_attribute, cashon, prod_img_url, freeship  FROM productdetails WHERE prod_id=?");
			 $stmt ->bind_param(i, $arraykey['prod_id']);
			 $stmt->execute();
			 $stmt->store_result();
			 $stmt->bind_result ( $col1, $col2, $col3, $col4, $col44, $col444, $col5, $col6, $col7, $col8, $col9);
			  
			   while($stmt->fetch() ){
	 
	           		$freeship_essential = $col9;
	           		$weight = json_decode( $col6, true) ;
	 	
					$msg =" user cart details is here";
			
			        $subtotal =  $subtotal  + $arraykey['price'] * $arraykey['qty'];
    			    $cgst = $cgst + ($arraykey['price'] * $arraykey['qty']) - (($arraykey['price'] * $arraykey['qty']) * 100) / (100+ $col4) ; 
    			    $sgst = $sgst + ($arraykey['price'] * $arraykey['qty']) - (($arraykey['price'] * $arraykey['qty']) * 100) /(100 + $col44);
    			    $igst = 0;     //$igst +  ($arraykey['price'] * $arraykey['qty']) - (($arraykey['price'] * $arraykey['qty']) * 100) /(100 + $col444);
    			 
    			    $price = $arraykey['price'] * $arraykey['qty'];
    			  //  echo " tax --".$tax;
    			    $shiparray[$count] = $col5;
    			  //  $shippingfees = $shippingfees +($col5 *$arraykey['qty']);
    				$jsonarray[$count] = array(
    	 					 'id' => $col1,
    	 					 'name' => $col2,				 	
    	 					 'price' => number_format($price, 2),	 			 
    	 					  'qty' => $arraykey['qty']	,
    	 					  'size' => $arraykey['size'], 
    	 					  'color' => $arraykey['color'],
    	 					  'weight' => $weight['weight'],
    	 					  'cashon' => $col7,
    	 					  'image' => $col8,
    	 					 'msgoncake' => $arraykey['msgoncake'],
    	 					 'eggless' => $arraykey['eggless']);
    	 					 
			 	$count = $count+1;				
			 }
			  
		  }// foreach close
    	 
	 
	            		 
    	 $stmt3 = $conn->prepare("SELECT name, value FROM store_config");
    	// $stmt3 ->bind_param(s,$minorder);
    	 $stmt3->execute();
    	 $stmt3->store_result();
    	 $stmt3->bind_result ( $col31, $col32);
    	 while($stmt3->fetch() ){
    	     if($col31=="minorder"){
    	          $minordervalue = $col32;
    	     }else if($col31=="freeship"){
    	          $freeship = $col32;
    	     }else if($col31=="cashondelivery"){
    	          $cashondelivery = $col32;
    	     } 
    	   
    	 }
		  
		  $status =1;
	//	  echo "order ". number_format($subtotal , 2)."--". $tax  ."--". max($shiparray);
		  $ordertotal = $subtotal  ;
		  $shippingfees = max($shiparray); //  $shippingfees ;  
		  if( $ordertotal > $freeship){
		      $shippingfees = "0.00";
		      $freeshipping = 1;
		      $msg ="Your Order Value is greater than $freeship.\n\n You Get Free Shipping. ";
		  }
		  
		    // for each product id get product details from table productdetails 
    	//echo " count ".$count."------".$freeship_essential;
    	 if($count ==1 && $freeship_essential ==1){
	      	 $shippingfees = "0.00";
	      }
		  $ordertotal = $subtotal +  $shippingfees ;
	//	  echo "--".	  $ordertotal;
		  $information = array(  'prod_details' => $jsonarray, 
					   'subtotal' =>   number_format( $subtotal, 0) ,
					   'shippingfee' => number_format(  $shippingfees, 0)   , 
					   'cgst' =>   number_format(  $cgst,  0) ,
					   'sgst' =>   number_format(  $sgst,  0) ,
					   'igst' =>   number_format(  $igst,  0) ,
					   'ordertotal' =>  number_format(  $ordertotal, 0),
					   'feeshipping' => $freeshipping ,
					   'minorder' => $minordervalue,
					   'cashondelivery'=>    $cashondelivery ) ;
						
						//$jsonarray;
		//  $msg = "No Product exist on ---cart ". $notExist ;
		  
	 
	 }
	 
  	
	

 	
 	mysqli_close($conn);
 	 
 	
 	$post_data = array(
 			 'status' => $status,
 			 'msg' => $msg,
 			 'Information' => $information );
 	
 	
 	$post_data= json_encode( $post_data );
 	
 	echo $post_data;
 	

 }


 //	echo " max--".max($shiparray);
 		

?>