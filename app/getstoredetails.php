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
        $msg ="No Details found";
    	$Information = "No Details found";
    		    
    }else{
        $msg ="कोई जानकारी अभी उपलब्ध नहीं है";
    	$Information = "कोई जानकारी अभी उपलब्ध नहीं है";
    	    
	}
	$jsonarray =  array();
	$count =0;

 	$stmt = $conn->prepare("SELECT store_name, address, phone, tax_no, logo, web_url, whatsappno, termcondition, aboutus, email, youtubeurl FROM store_setting");
 	//$stmt-> bind_param("s", $phone);
 	$stmt->execute();
 	$stmt->store_result();
 	$stmt->bind_result ( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11  );
 
 	
 	while($stmt->fetch() ){
 	
 			        //echo "  stam extecute ".$col1."  prod_name is  ".$col2;
 				$status =1;
				$msg =" details is here";
				$jsonarray= array(
	 					 'name' => $col1,
	 					 'address' => $col2,	 					 
	 					 'phone' => $col3,
	 					 'tax' => $col4,
	 					 'logo' => $col5,
	 					 'website' => $col6,
	 					 'whatsapp' => $col7,
	 					 'termc' => $col8,
	 					 'aboutus' => $col9,
	 					 'email' => $col10,
	 					 'youtube' => $col11);
 			
 		
 					
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