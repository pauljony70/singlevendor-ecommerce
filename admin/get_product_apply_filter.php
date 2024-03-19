<?php
include('session.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$catid =  htmlentities($_POST['catid'] );
$applybrand =  htmlentities($_POST['brand'] );
$applysize =  htmlentities($_POST['size'] );
$applycolor =  htmlentities($_POST['color'] );

$langauge = "default";// stripslashes($language); 
$securecode =   stripslashes($securecode);  //  "1234567890";//
$catid =   stripslashes($catid);
$applybrand =  stripslashes($applybrand);
$applysize =   stripslashes($applysize);
$applycolor =  stripslashes($applycolor);

//echo "  outside ";

if(isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode) && isset($catid)  && !empty($catid) ) {

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
    	$msg ="कोई प्रोडक्ट नहीं  मिला है";
    	$Information = "कोई प्रोडक्ट नहीं  मिला है";
    	    
	}
	$jsonarray =  array();
	$filtersize = array();
	$filtercolor = array();
	$filterbrand = array();
	$count =0;
	
	$applybrand = explode(',', $applybrand);
    $applysize  = explode(',', $applysize);
	$applycolor = explode(',', $applycolor);
	// print_r($applysize);
	// selectprod_name, prod_mp, prod_price, prod_rating from productdetails WHERE prod_id =  prod_id
	
	$active ="active";	
 	$stmt = $conn->prepare("SELECT pd.prod_id, pd.prod_name, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.pricearray, pd.stock FROM product prod, productdetails pd, brand bd WHERE prod.prod_id = pd.prod_id AND prod.prod_brand_id= bd.brand_id AND prod.status=? ORDER BY pd.prod_name ASC");
 	$stmt-> bind_param("s", $active);
 	$stmt->execute();
 	$stmt->store_result();
 	$stmt->bind_result ( $col1, $col2, $col3, $col4, $col5, $col6,$col7, $col8, $col9, $col10, $col11 , $col12 );
 
 	
 	while($stmt->fetch() ){
 	
 			     //   echo "  stam extecute ".$col1."  prod_name is  ".$col2;
 			$filterprod = false;
 				$status =1;
				$msg =" Product details are here";
			
	 					 
	 	// filter option brand
	 	  //  print_r($myArray);
                  $brand = $col10;
    	  	     // echo "  i ".$i."--".$arraykey."--";
    	  	      if (!in_array($brand, $filterbrand) && $brand!="" && $brand!=="")
                  {
                   // echo " **add**".$arraykey;
            	   array_push( $filterbrand,$brand);
    		
                  }
                 // if brand if in applybrand filter 
          	    if (in_array($brand, $applybrand) && $brand!="" && $brand!=="")
                  {
                   // echo " brand filter ".$brand;
            	   //array_push( $filterbrand,$brand);
    		        $filterprod = true;
                  }
                  
	 		// filter option size
	 		$attrobj = json_decode( $col8, true) ;
	 	  // echo " size--".$attrobj['size'];
	 	   $tempsizeArray = explode(',', $attrobj['size']);
          //  print_r($myArray);
          //	$i =0; 
    	  	 foreach($tempsizeArray as $arraykey) {
    	  	    // echo "  i ".$i."--".$arraykey."--";
    	  	      if (!in_array($arraykey, $filtersize) && $arraykey!="" && $arraykey!=="")
                  {
                  //  echo " **add**".$arraykey;
            	   array_push( $filtersize,$arraykey);
    		
                  }
                  
                  // if size is in applysize filter 
          	      if (in_array($arraykey, $applysize) && $arraykey!="" && $arraykey!=="")
                  {
                //    echo " size filter apply ".$arraykey;
            	  // array_push( $filtersize,$arraykey);
    	        	$filterprod = true;
                  }
               
                  
            //  $i= $i+ 1;  
    	  	 }
	 	   	
	  	// filter option color
	 	 	$attrobj = json_decode( $col8, true) ;
	 	  // echo " color--".$attrobj['color'];
	 	   $tempcolorArray = explode(',', $attrobj['color']);
           // print_r($tempcolorArray);
          //	$j =0; 
    	  	 foreach($tempcolorArray as $arraykeycc) {
    	  	    // echo "  j--".$arraykeycc."--".$applycolor;
    	  	      if (!in_array($arraykeycc, $filtercolor) && $arraykeycc!="" && $arraykeycc!=="")
                  {
                    //echo " **add**".$arraykeycc[$j];
            	   array_push( $filtercolor,$arraykeycc);
    		
                  }
                   // if color is in applycolor filter 
                  if (in_array($arraykeycc, $applycolor) && $arraykeycc!="" && $arraykeycc!=="")
                  {
                   // echo " color found-- ".$arraykeycc;
            	  // array_push( $filtersize,$arraykey);
    	        	$filterprod = true;
                  }
                  
              //$i= $i+ 1;  
    	  	 }
	        
	        // filter multiprice array with size
    	  	$multipricearray = json_decode( $col11, true) ;
    	  	
    	  //	$i =0; 
    	  	 foreach($multipricearray as $arraykey) {
    			 //  echo " attrname-- ".$arraykey['attrnam']."--";
    			  if (!in_array($arraykey['attrnam'], $filtersize) && $arraykey['attrnam']!==""&& $arraykey['attrnam']!="")
                  {
            	   array_push( $filtersize,$arraykey['attrnam']);
    		
                   // echo "Match found";
                  }
            	  
            	    // if size if in applysize filter 
          	      if (in_array($arraykey['attrnam'], $applysize) && $arraykey['attrnam']!="" && $arraykey['attrnam']!=="")
                  {
                   // echo " filter apply ".$arraykey['attrnam'];
            	  // array_push( $filtersize,$arraykey);
    		            $filterprod = true;
                  }
            	  
    		//	 $i++;  
    			   
    	  }
     	
     	if($filterprod ){
     	    
     	  //  echo " add ----".$col2."---";
     	    	$jsonarray[$count] = array(
	 					 'id' => $col1,
	 					 'name' => $col2,
	 					 'short_desc' => $col3,
	 					 'mrp' =>number_format($col4,0),
	 					 'price' =>number_format($col5,0),
	 					 'w_price' => number_format($col6,0),
	 					 'w_qty' => $col7,
	 					 'attr' => $col8,
	 					 'img_url' => $col9,
	 					 'brand' => $col10,
	 					 'pricearray' => $col11,
	 					 'stock' => $col12);
		$count = $count+1; 					 
     	}		
 		
 					
 	}
  print_r($applysize);	
   print_r($filtersize);
    print_r($filtercolor);
    print_r($filterbrand);
  	
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
