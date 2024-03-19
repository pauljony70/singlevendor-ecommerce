<?php

include('db_connection.php');


//  userid, password;
$language =  htmlentities($_POST['language'] );
$userid =  htmlentities($_POST['userid'] );
$password =  htmlentities($_POST['password'] );

$langauge =  stripslashes($language); 
$userid =  stripslashes($userid); 
$password =  stripslashes($password);


if(isset($langauge)  && !empty($langauge) && isset($userid) && !empty($userid)  && isset($password) && !empty($password)  ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	date_default_timezone_set("Asia/Kolkata");
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
	
			// update tablename SET colname =?, sdf WHERE userrid=?
			
			 $stmt11 = $conn->prepare("UPDATE user_profile SET password=? WHERE user_id=?") ;
			
			 $stmt11->bind_param( si, $password, $userid);
			
		
			 $stmt11->execute();
			
			   	 
			// check whether password already exist on same row or not
			   	
			  $rows=$stmt11->affected_rows;
			//echo " row ".$rows;
			if($rows>0){	
			   		//echo " row affected is ".;
				   	$status =1;
				 	if($langauge ==="default"){
                        $msg = "Password Update Successful";
    				 	$information  = "Password Update Successful";
    				 		    
                    }else{
                        $msg = "ಪಾಸ್ವರ್ಡ್ ಅಪ್ಡೇಟ್ ಯಶಸ್ವಿಯಾಗಿದೆ";
    				 	$information  = "ಪಾಸ್ವರ್ಡ್ ಅಪ್ಡೇಟ್ ಯಶಸ್ವಿಯಾಗಿದೆ";
    			  	    
                	}
			    	
			
			
			}else{
			
			
				$status =0;
			 		if($langauge ==="default"){
                       	$msg = "Failed to Update Password. Please try again";
    			 	    $information  = "Failed to Update Password. Please try again";
    			    	 		    
                    }else{
                        $msg = "ಪಾಸ್ವರ್ಡ್ ನವೀಕರಿಸಲು ವಿಫಲವಾಗಿದೆ. ದಯವಿಟ್ಟು ಪುನಃ ಪ್ರಯತ್ನಿಸಿ";
    				 	$information  = "ಪಾಸ್ವರ್ಡ್ ನವೀಕರಿಸಲು ವಿಫಲವಾಗಿದೆ. ದಯವಿಟ್ಟು ಪುನಃ ಪ್ರಯತ್ನಿಸಿ";
    			  	    
                	}
			
			
			}
			
	
	
	}else{
	
			$status =0;
			if($langauge ==="default"){
            	$msg ="Password already exist, Please create new password";
    			$information ="Password already exist, Please create new password";
    				    	 		    
            }else{
                 $msg = "ಪಾಸ್ವರ್ಡ್ ಈಗಾಗಲೇ ಅಸ್ತಿತ್ವದಲ್ಲಿದೆ, ದಯವಿಟ್ಟು ಹೊಸ ಪಾಸ್ವರ್ಡ್ ರಚಿಸಿ";
    			$information  = "ಪಾಸ್ವರ್ಡ್ ಈಗಾಗಲೇ ಅಸ್ತಿತ್ವದಲ್ಲಿದೆ, ದಯವಿಟ್ಟು ಹೊಸ ಪಾಸ್ವರ್ಡ್ ರಚಿಸಿ";
    			  	    
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