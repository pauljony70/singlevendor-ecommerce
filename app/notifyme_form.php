<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$prodid =  htmlentities($_POST['prodid'] );
$email =  htmlentities($_POST['email'] );
$phone =  htmlentities($_POST['phone'] );
$remark =  htmlentities($_POST['remark'] );

// remove back slash from the variable if any...

$langauge =   stripslashes($language); 
$securecode =   stripslashes($securecode);  //   "1234567890";//
$prodid =  stripslashes($prodid);  // "12";//
$email =  stripslashes($email); 
$phone =  stripslashes($phone);
$remark =  stripslashes($remark);

//echo "  outside ";

if(isset($langauge)  && !empty($langauge) && isset($securecode)  && !empty($securecode)   && !empty($phone) && !empty($prodid) ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	date_default_timezone_set("Asia/Kuwait");
	$date = date("Y-m-d h:i:sa");
	
	
	$jsonarray =  array();
	$addressid_count =1;
	
	$status =0;
	if($langauge ==="default"){
    	$msg ="failed to add Request";
        $information = "failed to add Request";
	    
    }else{
    	$msg ="अनुरोध जोड़ने में विफल";
        $information = "अनुरोध जोड़ने में विफल";

	}
	
	//echo "inside if";
	// check userID exist or not
	$notExist = true;

	$rowUser_id = 0;
	$rowAddressArray = array();

	 $stmt = $conn->prepare("SELECT sno FROM notifyme WHERE phone=? AND prodid=?");
	 $stmt ->bind_param(si, $phone, $prodid);
	 $stmt->execute();
	 $stmt->store_result();
	 $stmt->bind_result ( $col1);
	 
	 while($stmt->fetch() ){
	 
	 		$notExist = false;

	 }

	 if( $notExist){
	     
	     
	    $action ="request";
	 	 $stmt2 = $conn->prepare("INSERT INTO notifyme ( prodid, phone, email, remark, createby, action )  VALUES (?,?,?,?,?,?)");
		 $stmt2->bind_param( isssss, $prodid,  $phone, $email, $remark, $date, $action);
		 $stmt2->execute();
		
			$status =1;
			if($langauge ==="default"){
            	$msg ="Your request has submitted successfully";
    			$information = "Your request has submitted successfully";
    			    
            }else{
            	$msg ="आपके अनुरोध को सफलतापूर्वक सबमिट कर दिया गया है";
                $information = "आपके अनुरोध को सफलतापूर्वक सबमिट कर दिया गया है";
        
        	}
        	
        	  	$phoneExist = false;
            	$adminphone ="";
            	$stmt17 = $conn->prepare("SELECT phone FROM store_setting");
            	 $stmt17->execute();
            	 $stmt17->store_result();
            	 $stmt17->bind_result ( $col77);
            	 	
            	 while($stmt17->fetch() ){
            		$phoneExist =true;
            		$adminphone = $col77;
            	 }	  	
            		
            	if($phoneExist)
            	{
            	    //$adminphone = "9144040888";//
            	       	$actionmsg = "New Notify_ME Request from $phone";
                    	include('../admin/send_otp.php');
                        sendotp( $adminphone , $actionmsg); 
        		
                 }
                 
             // SEND email
             
            include('../admin/send_mail_orderstatus.php');
            $subject ="New Notify_Me Request From ".$phone;
            $bodymsg = "You have received new request for notify_me about product from $email, $phone. Please Login to Admin Panel for Full details";
            send_mail(  "info@afrahalkhaleej.com", $subject, $bodymsg);  
         
	 
	 }else{
	   /// yes userid exist
	   	
	   	 $status =1;
			if($langauge ==="default"){
                 $msg = "You have already submitted the request for Same Product.";
				    
            }else{
            	 $msg = "आप पहले ही निवेदन प्रस्तुत कर चुके हैं";
	        
        	}		 	
		   $information = $msg;
		 
	 } // useer address array else
	 
	 
	$post_data = array(
	 			 'status' => $status,
	 			 'msg' => $msg,
	 			 'Information' => $information );
	 	
	 	
	 $post_data= json_encode( $post_data );
	 	
	 echo $post_data;
	 	
	 mysqli_close($conn);
	



}

	
?>	
	