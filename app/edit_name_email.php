<?php
include('db_connection.php');

//  userid, password;
$code =  htmlentities($_POST['securecode'] );
$language =  htmlentities($_POST['language'] );
$userid =  htmlentities($_POST['userid'] );
$name =  htmlentities($_POST['name'] );
$email =  htmlentities($_POST['email'] );
$updatetype =  htmlentities($_POST['updatetype'] );

$code = stripslashes($code); 
$langauge = stripslashes($language); 
$userid = stripslashes($userid); 
$name =  stripslashes($name);
$email =  stripslashes($email);
$updatetype = stripslashes($updatetype);


if(isset($code)  && !empty($code) && isset($langauge)  && !empty($langauge) && isset($userid) && !empty($userid)  && isset($updatetype) && !empty($updatetype)  ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	date_default_timezone_set("Asia/Kuwait");
	$date = date("Y-m-d");
	$status =0;
	$msg ="";
	$information ="";
	
	
	// check whether user password is a new password or not ?
	$notExist = true;
	
	$stmt11 = $conn->prepare("SELECT password FROM user_profile WHERE user_id =?");
	$stmt11->bind_param( s, $userid);
	 $stmt11->execute();
	 $stmt11->store_result();
	 $stmt11->bind_result ( $col1);
	 	
	 while($stmt11->fetch() ){
	 
	 
	 	if($col1=== $password ){
	 	
			$notExist = false;
	 
	 	}
					
	 }	  	
	// echo "  not exist value is ".$notExist;	
		
	if($notExist)
	{
	    $stmt11 ="";
	    if($updatetype ==="name"){
	        
	         $stmt11 = $conn->prepare("UPDATE user_profile SET full_name=? WHERE user_id=?") ;
			 $stmt11->bind_param( si, $name, $userid);
			
	        
	    }else if($updatetype ==="email"){
	         $stmt11 = $conn->prepare("UPDATE user_profile SET email=? WHERE user_id=?") ;
			 $stmt11->bind_param( si, $email, $userid);
			
	    }
	    	 $stmt11->execute();
		   $rows=$stmt11->affected_rows;
			//echo " row ".$rows;
			if($rows>0){	
			   		//echo " row affected is ".;
				   	$status =1;
				 	if($langauge ==="default"){
                        $msg = "Update Successful";
    				 	$information  = "Update Successful";
    				 		    
                    }else{
                        $msg = "ಯಶಸ್ವಿಯಾಗಿ ನವೀಕರಿಸಿ";
    				 	$information  = "ಯಶಸ್ವಿಯಾಗಿ ನವೀಕರಿಸಿ";
    			  	    
                	}
			    	
			
			
			}else{
			
			
				$status =0;
			 		if($langauge ==="default"){
                       	$msg = "Failed to Update. Please try again";
    			 	    $information  = "Failed to Update. Please try again";
    			    	 		    
                    }else{
                        $msg = "ನವೀಕರಿಸಲು ವಿಫಲವಾಗಿದೆ. ದಯವಿಟ್ಟು ಪುನಃ ಪ್ರಯತ್ನಿಸಿ";
    				 	$information  = "ನವೀಕರಿಸಲು ವಿಫಲವಾಗಿದೆ. ದಯವಿಟ್ಟು ಪುನಃ ಪ್ರಯತ್ನಿಸಿ";
    			  	    
                	}
			
			
			}
			
	
	
	}else{
	            $status =0;
			 		if($langauge ==="default"){
                       	$msg = "Failed to Update. Please try again";
    			 	    $information  = "Failed to Update. Please try again";
    			    	 		    
                    }else{
                        $msg = "ನವೀಕರಿಸಲು ವಿಫಲವಾಗಿದೆ. ದಯವಿಟ್ಟು ಪುನಃ ಪ್ರಯತ್ನಿಸಿ";
    				 	$information  = "ನವೀಕರಿಸಲು ವಿಫಲವಾಗಿದೆ. ದಯವಿಟ್ಟು ಪುನಃ ಪ್ರಯತ್ನಿಸಿ";
    			  	    
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