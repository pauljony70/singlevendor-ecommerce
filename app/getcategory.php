<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );

$langauge =  stripslashes($language); 
$securecode =   stripslashes($securecode);  //  "1234567890";//

//echo "  outside ";

if(isset($securecode)  && !empty($securecode) ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	
	$status =0;
	if($langauge ==="default"){
        $msg ="No Category found";
    	$Information = "No Category found";
    		    
    }else{
        $msg ="कोई श्रेणी नहीं मिली";
    	$Information = "कोई श्रेणी नहीं मिली";
    	    
	}
	$jsonarray =  array();
	$count =0;
	
	// ORDER BY id ASC|DESC;
	//echo "  inside ";
	
	///  select prod_id from trending where order by priority ASC
	
	// selectprod_name, prod_mp, prod_price, prod_rating from productdetails WHERE prod_id =  prod_id
	
	$parent =0;	
 	$stmt = $conn->prepare("SELECT  cat_id, cat_name, cat_name_ar, cat_img, parent_id FROM category WHERE parent_id=? ORDER BY cat_order ASC LIMIT 8");
 	$stmt-> bind_param(i, $parent);
 	$stmt->execute();
 	$stmt->store_result();
 	$stmt->bind_result ( $col1, $col2, $col2ar, $col3 , $col4 );
 
 	
 	while($stmt->fetch() ){
 	
 	            $pname =   $col2;
 	            if( $language !="default" ){ $pname =    json_encode( $col2ar,  JSON_UNESCAPED_UNICODE);}
 	         if($pname == "\"\""){ $pname =$col2;}
 	         
 			       $catid = $col1;
 			        $prodcount =0;
 			    	$stmt2 = $conn->prepare("SELECT  count(prod_id) FROM productdetails WHERE cat_id=?");
                 	$stmt2-> bind_param(i, $catid);
                 	$stmt2->execute();
                 	$stmt2->store_result();
                 	$stmt2->bind_result ( $col5 );
                 	while($stmt2->fetch() ){
                 	     $prodcount = $col5;
                 	    
                 	}
                     
 				$status =1;
				$msg =" category details is here";
				$jsonarray[$count] = array(
	 					 'id' => $col1,
	 					 'name' => $pname,	 					 
	 					 'img_url' => $col3,
	 					'parent' => $col4,
	 					'prodcount'=>  $prodcount);
 			
 		
 		$count = $count+1;				
 	}
  	
	$Information = $jsonarray;

 	
 	mysqli_close($conn);
 		
 	$post_data = array(
 			 'status' => $status,
 			 'msg' => $msg,
 			 'Information' => $Information );
 	
 	
 	$post_data= json_encode( $post_data );
 	
 	echo $post_data;
 	

 }
 
 
	
 		

?>