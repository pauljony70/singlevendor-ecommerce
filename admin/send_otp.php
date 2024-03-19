<?php

//$phone =  htmlentities($_POST['phone'] );

//$phone =  stripslashes($phone); 

//sendotp("9144040888", "Dispatch");

function sendotp($phone, $action){
   $phone =  stripslashes($phone); 
//   echo " sms to ". $phone ." msg --".$action ;
   
    if(isset($phone) && !empty($phone)  ) {

    include('../app/db_connection.php');
    global $conn;
    	
    	if($conn-> connect_error){
    		die(" connecction has failed ". $conn-> connect_error)	;
    	}
    	// get current date
    	date_default_timezone_set('Asia/Kolkata');
    	$date = date("Y-m-d");

	 	//------- send sms to user phone number
	 	
	 /*	// Your authentication key

		$authKey = $OTPauthKey;

			// Multiple mobiles numbers separated by comma

			$mobileNumber = "91".$phone;

			// Sender ID,While using route4 sender id should be 6 characters long.

			$senderId = $senderid;

			// Your message to send, Add URL encoding here.

			$message = urlencode("$action");

			// Define route

			$route = "4";

			// Prepare you post parameters

			$postData = array(
				'authkey' => $authKey,
				'mobiles' => $mobileNumber,
				'message' => $message,
				'sender' => $senderId,
				'route' => $route
			);

			// API URL

			$url = "https://control.msg91.com/api/sendhttp.php";

			// init the resource

			$ch = curl_init();
			curl_setopt_array($ch, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $postData

				// ,CURLOPT_FOLLOWLOCATION => true

			));

			// Ignore SSL certificate verification

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


			// get response echo " before output ";
			$output = curl_exec($ch);
            //echo "out ".$output;
			// Print error if any

			if (curl_errno($ch))
				{
				echo 'error:' . curl_error($ch);
				}

			curl_close($ch);
	 			 
	 	*/
	 	
	 //$post_data= json_encode( $post_data );
	 	
	// echo $post_data;
	 
	 
 }	
    
 return "send SMS";    
    
}


?>
