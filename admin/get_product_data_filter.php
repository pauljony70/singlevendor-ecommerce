<?php
include('session.php');
$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$sortcat = $_POST['sortcat'];
$catid = $_POST['catid'];
$applysize =  $_POST['size'] ;
$applycolor = $_POST['color'];
$error = ''; // Variable To Store Error Message

$code =  stripslashes($code);
$page =  stripslashes($page);
$rowno = stripslashes($rowno);
$sortcat =  stripslashes($sortcat);
$catid =  stripslashes($catid);
$applysize =  stripslashes($applysize);
$applycolor =  stripslashes($applycolor);  

//echo " value ".$page."---".;
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if ($code == "123") {
    
    $seller_id = $_SESSION['seller_id'];
    //Calculating start for every given page number
    
    include('../app/db_connection.php');
    global $conn;
    try {
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
    $jsonarray =  array();
	$filtersize = array();
	$filtercolor = array();
	$filterbrand = array();
	$bothfilter = 0;
   // echo "--".$applysize."---".$applycolor."--";
    if($applysize !=="blank" && $applycolor !== "blank"){
    
      $bothfilter = 1;  
    }

	$count =0;  $count_c=0;
	
	$applybrand = explode(',', $applybrand);
    $applysize  = explode(',', $applysize);
	$applycolor = explode(',', $applycolor);
	
          $Exist = false;
         $status =0;
         $information = array();
         $prodstatus = "active";
        $limit = 100; 
        $start = ($page - 1) * $limit; 
        $totalrow =0;
       
         if($catid!== "blank"){
            $stmt12 = $conn->prepare("SELECT count(prod_id) FROM product pd WHERE prod_cat_id=?");
            $stmt12->bind_param("i", $catid);
                 
         }else{
         
            $stmt12 = $conn->prepare("SELECT count(prod_id) FROM product");
            $stmt12->bind_param("s", $prodstatus);    
         }
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col5);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col5;
           // echo "total";
         
        }
        //	echo "here";//
         if($page ==99999){
            $start =   $totalrow -($totalrow % $limit); 
            $page = (int)(($totalrow / $limit) +1);
          //  echo " stat ".$start." limi ".$limit." page ".$page;
            if($start == $totalrow){
                $start = $start -$limit;
                $page = (int)((($totalrow-$limit) / $limit) +1);
                            
            }
         }
        
        //  echo  "old array is ".$oldarray  12113 12110  1212 4420;
        $return = array();
        $i      = 0;   $i_i=0;
        $filterrowcount =false;
       //$start = 12110; $limit =10; 
        // $start = 10109; $limit =10;
       //  echo " stat ".$start." limi ".$limit." page ".$page." totalrow ".$totalrow;
       
        if($sortcat=== "true"){
             //$stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.create_date DESC, odr.status DESC LIMIT ?, ?");
      //    $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock,  pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY ct.cat_name ASC LIMIT ?, ?");
     //    $stmt ->bind_param(ii, $start, $limit);
          $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock,  pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY ct.cat_name ASC");
        
        }else if($catid!== "blank"){
                $filterrowcount =true;
          //  echo " cat blank ";
             //$stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.create_date DESC, odr.status DESC LIMIT ?, ?");
        //  $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id AND pt.cat_id=? ORDER BY ct.cat_name ASC LIMIT ?, ?");
        //  $stmt ->bind_param(iii, $catid, $start, $limit);  
          $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id AND pt.cat_id=? ORDER BY ct.cat_name ASC");
          $stmt ->bind_param(i, $catid);  

        }else{
          //  echo "  elese part ";
          //  $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url, pt.stock, ct.cat_name, pr.status, pt.hsn_code, pt.other_attribute, pt.pricearray FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY pt.prod_name ASC LIMIT ?, ?");
        //  $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY pt.prod_name ASC LIMIT ?, ?");
        //  $stmt ->bind_param(ii, $start, $limit);
          $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY pt.prod_name ASC");
    
        }
        
        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
        //  echo " get col data ";
        
        while ($stmt->fetch()) {
           // echo " prod data is " .$col1;  
            	$Exist = true;
            $imgarray = json_decode($col9, true);
            $imageurl = "";
            $imgcount    = 1;
            foreach ($imgarray as $arraykey) {
                if ($imgcount === 1) {
                    $imageurl = "../media/" . $arraykey['url'];
                    $imgcount++;
                }
            }
            
            //echo " array created".json_encode($return);
           $price = $col5;  $prodsize =""; $prodcolor =""; 
           $stock = $col12;
            if(  $stock<=0){
                      $stock = "Low";
            }
          	$filterprod = 0; 
          	$sizeexist =  0; $colorexist = 0;	
            // filter option size
	 		$attrobj = json_decode( $col8, true) ;
	 	  // echo " size--".$attrobj['size'];
	 	   $tempsizeArray = explode(',', $attrobj['size']);
          //  print_r($myArray);
            $firstsizearray =0;
    	  	 foreach($tempsizeArray as $arraykey) {
    	  	    // echo "  i ".$i."--".$arraykey."--";
    	  	     if(    $firstsizearray ==0){
    			      $prodsize = $arraykey; 
    			 }
    	  	      if (!in_array($arraykey, $filtersize) && $arraykey!="" && $arraykey!=="")
                  {
                  //  echo " **add**".$arraykey;
            	   array_push( $filtersize,$arraykey);
    		
                  }
                  
                  // if size is in applysize filter 
          	      if (in_array($arraykey, $applysize) && $arraykey!="" && $arraykey!=="")
                  {
                   //   echo " size filter apply ".$arraykey."--".$col1;
            	  // array_push( $filtersize,$arraykey);
    	        	$filterprod = 1; 	$sizeexist =  1;
    	        	 $prodsize = $arraykey;
                  }
               
                  
                $firstsizearray++; 
    	  	 }
	 	   	
	  	// filter option color
	 	 	$attrobj = json_decode( $col8, true) ;
	 	  // echo " color--".$attrobj['color'];
	 	   $tempcolorArray = explode(',', $attrobj['color']);
           // print_r($tempcolorArray);
          $firstcolor =0;
    	  	 foreach($tempcolorArray as $arraykeycc) {
    	  	     if($firstcolor ==0){
    			      $prodcolor = $arraykeycc; 
    			 }
    	  	    // echo "  j--".$arraykeycc."--".$applycolor;
    	  	      if (!in_array($arraykeycc, $filtercolor) && $arraykeycc!="" && $arraykeycc!=="")
                  {
                    //echo " **add**".$arraykeycc[$j];
            	   array_push( $filtercolor,$arraykeycc);
    		
                  }
                   // if color is in applycolor filter 
                  if (in_array($arraykeycc, $applycolor) && $arraykeycc!="" && $arraykeycc!=="")
                  {
                   // echo " color found-- ".$arraykeycc."--".$col1;
            	  // array_push( $filtersize,$arraykey);
    	        	$filterprod = 1;  $colorexist = 1;
    	        	$prodcolor = $arraykeycc;
                  }
                  
              //$i= $i+ 1; 
              $firstcolor++;
    	  	 }
	        
	        // filter multiprice array with size
    	  	$multipricearray = json_decode( $col11, true) ;
    	  	
    	 	$firstprice =0; 
    	  	 foreach($multipricearray as $arraykey) {
    			 //  echo " attrname-- ".$arraykey['attrnam']."--";
    			 if($firstprice ==0){
    			      $price =  $arraykey['attrvalue'];
    			      $prodsize = $arraykey['attrnam']; 
    			       $stock = $arraykey['attrstockvalue'];
    			 }
    			  if (!in_array($arraykey['attrnam'], $filtersize) && $arraykey['attrnam']!==""&& $arraykey['attrnam']!="")
                  {
            	   array_push( $filtersize,$arraykey['attrnam']);
    		
                   // echo "Match found";
                  }
            	  
            	    // if size if in applysize filter 
          	      if (in_array($arraykey['attrnam'], $applysize) && $arraykey['attrnam']!="" && $arraykey['attrnam']!=="")
                  {
                   // echo " pricesize found ".$arraykey['attrnam']."--".$col1;
            	  // array_push( $filtersize,$arraykey);
    		            $filterprod = 1;    $sizeexist =  1;
    		            $price =  $arraykey['attrvalue'];
    		            $prodsize = $arraykey['attrnam']; 
                  }
                  if($arraykey['attrstockvalue']<=0){
                      $stock = "Low";
                  }
            	  
    		 $firstprice++;  
    			   
    	  }
     	
     	 // product details array
     	 if($i >= $start && $i<($start+$limit)){
     	     
            $return[$i_i] = array(
                'id' => $col1,
                'name' => $col2,
                'desc' => $col3,
                'price' => $price,
                'color' => $prodcolor,
                'size' => $prodsize,
                'img' => $imageurl,
                'cat' => $col10,
                'stock' => $stock,
                'active' => $col13,
                'hsncode' => $col14
            );
            $i_i = $i_i+1;
     	 }
        $i  = $i + 1;
           // product details array close
     	
     	if($filterprod==1 ){
     	  //  echo " add ----".$col2."---";
            //  echo "--*bothfiter*-".$bothfilter."---".$col1 ;
                if($bothfilter==1){
           
                  //  echo "***".$sizeexist."-".$colorexist;
                    if(	$sizeexist == 1 && $colorexist == 1 ){
                        
                         if($count >= $start && $count <($start+$limit)){
           
                      //   echo "addfildert";
                        	$jsonarray[$count_c] = array(
             	    	        'id' => $col1,
                                'name' => $col2,
                                'desc' => $col3,
                                'price' => $price,
                                'color' => $prodcolor,
                                'size' => $prodsize,
                                'img' => $imageurl,
                                'stock' => $stock,
                                'cat' => $col10,
                                'active' => $col13,
                                'hsncode' => $col14,
        	 					 'attr' => $col8,
        	 					 'pricearray' => $col11);
            	     	    $count_c = $count_c+1;
                        }// if count 
                        $count = $count+1; 
                		$totalrow = $count;
                        
                    }else{
                     //   echo "both not true";
                    }
                    
                 
                }else{
                          if($count >= $start && $count <($start+$limit)){
           
                   // echo "both not blank";
                    $jsonarray[$count_c] = array(
     	    	        'id' => $col1,
                        'name' => $col2,
                        'desc' => $col3,
                        'price' => $price,
                        'color' => $prodcolor,
                        'size' => $prodsize,
                        'img' => $imageurl,
                        'stock' => $stock,
                        'cat' => $col10,
                        'active' => $col13,
                        'hsncode' => $col14,
	 					 'attr' => $col8,
	 					 'pricearray' => $col11);
	     	        $count_c = $count_c+1;
                          }
                $count = $count+1; 
		        $totalrow = $count;
                    
                }// if else bothfilter 
            
	
     	} // if filterprod ==1		
     
 		
 		
        }// while cloese
   //     echo " $i value ";
  //    print_r($applysize);	
  // print_r($filtersize);
    // print_r($filtercolor);
//    print_r($filterbrand);
    
   // json_encode($jsonarray);
    
         if( $Exist){
            //$totalrow = $i;    	    
              $status = 1;
              $information =array(  'status' => $status,
                                    'totalrow' => $totalrow,
                	                'pageno' =>  $page,
                                    'details' => $return,
                                    'filterarray' => $jsonarray,
                                    'bothfilter' => $bothfilter);
	                        
         }else{
             //echo "  page ".$page;
              
                	 
              $status = 0;
              $information =array( 'status' => $status,
                                   'totalrow' => $totalrow,
                	               'pageno' =>  $page,
                                   'details' => $return,
                                   'filterarray' => $jsonarray,
                                    'bothfilter' => $bothfilter);
         }
                
         echo  json_encode( $information);
        //return json_encode($return);    
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
?>
