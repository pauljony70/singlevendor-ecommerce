<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$recentarray =  htmlentities($_POST['recentarray'] );

$langauge =   stripslashes($language); 
$securecode = stripslashes($securecode);  //  "1234567890";//
$recentarray =  stripslashes($recentarray); 


//echo "  outside ";
if(isset($securecode)  && !empty($securecode)  ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	
	$status =0;
	if($langauge ==="default"){
        $msg ="No Product found";
    	$Information = "No Product found";
    		    
    }else{
        $msg ="No Product found";
    	$Information = "No Product found";
    	    
	}
	$jsonarray =  array();
	$filtersize = array();
	$filtercolor = array();
	$filterbrand = array();
	$count =0;

// 	echo "recent array -- ". $recentarray;
$array=array_map('intval', explode(',', $recentarray));
$array = implode("','",$array);

	$active ="active";	
 	$stmt = $conn->prepare("SELECT pd.prod_id, pd.prod_name, pd.name_ar, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.pricearray, pd.stock , pd.prod_rating, pd.prod_rating_count, pd.review_id FROM product prod, productdetails pd, brand bd WHERE prod.prod_id = pd.prod_id AND prod.prod_brand_id= bd.brand_id AND prod.status=? AND prod.prod_id IN  ('".$array."') LIMIT 9");
 	$stmt-> bind_param("s", $active);
 	$stmt->execute();
 	$stmt->store_result();
 	$stmt->bind_result ( $col1, $col2,$col2ar, $col3, $col4, $col5, $col6,$col7, $col8, $col9, $col10 , $col11, $col12, $col13, $col14, $col15  );
 
 	
 	while($stmt->fetch() ){
 	     $pname =   $col2;
 	            if( $language !="default" ){ $pname =    json_encode( $col2ar,  JSON_UNESCAPED_UNICODE);}
 	         if($pname == "\"\""){ $pname =$col2;}
 	         
 			  	     $offpercent =  ($col4 - $col5)*100/  $col4;
 			 //    echo " off ".$offpercent;
 				$status =1;
				$msg =" Recentview Product details are here";
				$jsonarray[$count] = array(
	 					 'id' => $col1,
	 					 'name' => $pname,
	 					 'short_desc' => $col3,
	 					 'offpercent' =>  number_format($offpercent,0),
	 					 'mrp' =>number_format($col4,2),
	 					 'price' =>number_format($col5,2),
	 					 'w_price' => number_format($col6,2),
	 					 'w_qty' => $col7,
	 					 'attr' => $col8,
	 					 'img_url' => $col9,
	 					 'brand' => $col10,
	 					 'pricearray' => $col11,
	 					 'stock' => $col12,
						 'rating' => $col13,
						 'ratingcount' => $col14,
						 'reviewid' => $col15);
 			
 			// filter option brand
	 	  //  print_r($myArray);
                  $brand = $col10;
    	  	     // echo "  i ".$i."--".$arraykey."--";
    	  	      if (!in_array($brand, $filterbrand) && $brand!="" && $brand!=="")
                  {
                   // echo " **add**".$arraykey;
            	   array_push( $filterbrand,$brand);
    		
                  }
          	 
	 		// filter option size
	 		$attrobj = json_decode( $col8, true) ;
	 	  // echo " size--".$attrobj['size'];
	 	   $tempsizeArray = explode(',', $attrobj['size']);
          //  print_r($myArray);
          	$i =0; 
    	  	 foreach($tempsizeArray as $arraykey) {
    	  	     // echo "  i ".$i."--".$arraykey."--";
    	  	      if (!in_array($arraykey, $filtersize) && $arraykey!="" && $arraykey!=="")
                  {
                   // echo " **add**".$arraykey;
            	   array_push( $filtersize,$arraykey);
    		
                  }
              $i= $i+ 1;  
    	  	 }
	 	   	
	  	// filter option color
	 	 	$attrobj = json_decode( $col8, true) ;
	 	  // echo " color--".$attrobj['color'];
	 	   $tempcolorArray = explode(',', $attrobj['color']);
           // print_r($tempcolorArray);
          	$j =0; 
    	  	 foreach($tempcolorArray as $arraykeycc) {
    	  	     // echo "  j--".$arraykeycc."--";
    	  	      if (!in_array($arraykeycc, $filtercolor) && $arraykeycc!="" && $arraykeycc!=="")
                  {
                    //echo " **add**".$arraykeycc[$j];
            	   array_push( $filtercolor,$arraykeycc);
    		
                  }
              $j= $j+ 1;  
    	  	 }
	        
	        // filter multiprice array with size
    	  	$multipricearray = json_decode( $col11, true) ;
    	  	
    	  //	$i =0; 
    	  	 foreach($multipricearray as $arraykey) {
    			  // echo " attrname-- ".$arraykey['attrnam'];
    			  if (!in_array($arraykey['attrnam'], $filtersize) && $arraykey['attrnam']!==""&& $arraykey['attrnam']!="")
                  {
            	   array_push( $filtersize,$arraykey['attrnam']);
    		
                 // echo "Match found";
                  }
            	  
    			 $i++;  
    			   
    	  }
     		
 		$count = $count+1;				
 	}
  	
	$Information = $jsonarray;

 	
 	mysqli_close($conn);
 	
 	$post_data = array(
 			 'status' => $status,
 			 'msg' => $msg,
 			 'Information' => $Information,
 			 'size' =>$filtersize,
 			 'color' =>$filtercolor,
 			 'brand'=> $filterbrand);
 	
 	
 	$post_data= json_encode( $post_data );
 	
 	echo $post_data;
 	
 	

 }
 
 	
 
 	
 		

?>