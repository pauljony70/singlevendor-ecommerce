<?php

include('db_connection.php');
$language =  htmlentities($_POST['language'] );
$securecode =  htmlentities($_POST['securecode'] );
$prod_id =  htmlentities($_POST['prod_id'] );
$user_id =  htmlentities($_POST['user_id'] );
$user_name =  htmlentities($_POST['user_name'] );
$rating =  htmlentities($_POST['rating'] );
$title =  htmlentities($_POST['title'] );
$feedback =  htmlentities($_POST['feedback'] );

// remove back slash from the variable if any...

$langauge =  stripslashes($language);
$securecode =  stripslashes($securecode);  //   "1234567890";//
$prod_id =      stripslashes($prod_id);   //  "1";//
$user_id =     stripslashes($user_id);    //"12";//
$username =     stripslashes($user_name);
$rating =     stripslashes($rating);
$title =     stripslashes($title);
$feedback =     stripslashes($feedback);

//echo "  outside "; 

if(isset($langauge)  && !empty($langauge) &&  isset($securecode)  && !empty($securecode) && isset($prod_id)  && !empty($prod_id) && !empty($user_id)&& !empty($title)&& !empty($rating) ) {

global $conn;
	
	if($conn-> connect_error){
		die(" connecction has failed ". $conn-> connect_error)	;
	}
	// get current date
	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");	

	$status =0;
	//	echo "inside if ".$user_id." ".$prod_id;
	if($langauge ==="default"){
        $msg ="fail to submit review. Please Try Again.";
	    
    }else{
    	$msg ="रिव्यु सबमिट नहीं हुआ है कृपया पुन: प्रयास करें।";
	}
	$Exist = false;
	$prod_rating =0;
	$prod_rating_count =0;
	$prod_reviewid =0;

	 $stmt11 = $conn->prepare("SELECT op.order_id, pd.prod_rating, pd.prod_rating_count, pd.review_id FROM order_product op, productdetails pd WHERE op.user_id =? AND op.prod_id=? AND op.prod_id= pd.prod_id");
	 $stmt11->bind_param( ii, $user_id, $prod_id);
	 $stmt11->execute();
	 $stmt11->store_result();
	 $stmt11->bind_result ( $col1, $col2, $col3, $col4);
	 	
	 while($stmt11->fetch() ){
	 //	echo " sdf";
	 	$Exist = true;
	    $prod_rating = $col2;
	 	$prod_rating_count = $col3;	
	 	$prod_review_id = $col4;
	 }
	// 	echo " prod reviewid ".$prod_review_id;
	 if($Exist){
	 
	 //	echo " prod reviewid ".$prod_review_id;
	 	/// get last qoute id 

		if($prod_review_id ==0){
		
			$ratingdate = date("d/m/Y");
			
			$prod_review_array[0] = array( 
										  'title' => $title,
										  'feedback'=> $feedback,
										  'rating'=> $rating,
										  'username'=> $username,
										  'userid' => $user_id,
										  'date'=> $ratingdate );
								
			
			$prod_reviewarray= json_encode( $prod_review_array );
			//echo " prod_id_array ".	$prod_id_array;
			
			 $stmt2 = $conn->prepare("INSERT INTO review ( review_array )  VALUES (?)");
			 $stmt2->bind_param( s, $prod_reviewarray);
			 $stmt2->execute();
			 $stmt2->store_result();
			
			if(!empty($stmt2->insert_id)){
			
				$status =1;
				if($langauge ==="default"){
                    $msg ="Thank You for Submitting Review.";
					    
                }else{
                	$msg ="रिव्यु देने के लिए धन्यवाद";
            	}
				$id = $stmt2->insert_id;
			//	echo " review id ".$id;
				$newcount = $prod_rating_count +1;
				$newrating = (($prod_rating * $prod_rating_count) +$rating)/ $newcount;
			
				$stmt33 = $conn->prepare("UPDATE productdetails SET prod_rating=?, prod_rating_count=?, review_id=? WHERE prod_id=?") ;			
				$stmt33->bind_param( diii, $newrating, $newcount, $id , $prod_id);
				$stmt33->execute();
					 
				// check whether password already exist on same row or not	   	
				 $rows=$stmt32->affected_rows;
			
					
			}else{
				$status =1;
			}

		}else{
			//	echo "update review ";
				$prod_review_array ="[]";
				$stmt22 = $conn->prepare("SELECT review_array FROM review WHERE review_id=?") ;			
				$stmt22->bind_param( i, $prod_review_id);
				$stmt22->execute();
				$stmt22->store_result();
				 $stmt22->bind_result ( $col31);
					
				 while($stmt22->fetch() ){
					$prod_review_array = $col31;
				
				 }
				
				$oldArray = json_decode($prod_review_array, true);
				$userIDexist = false;
				
				foreach($oldArray as $arraykey) {
			    // echo "user id ".$user_id." reivewuser ". $arraykey['userid'];
				   if( $user_id === $arraykey['userid'] ){
						$userIDexist = true;
						   
					}
				}	 
				
				if($userIDexist){
					$status = 1;
					if($langauge ==="default"){
    					$msg ="You have already submitted the review for this product";
    					    
                    }else{
                    	$msg ="आप पहले भी इसी प्रोडक्ट के लिए रिव्यु दे चुके है";
                	}	
				}else{
				
					$ratingdate = date("d/m/Y");	
					$newreview_array = array( 
											  'title' => $title,
											  'feedback'=> $feedback,
											  'rating'=> $rating,
											  'username'=> $username,
											  'userid' => $user_id,
											  'date'=> $ratingdate );
				
							 
					array_push( $oldArray, $newreview_array  );
					
					//echo " old arrays is ".json_encode( $oldArray);
					$newProdArray = json_encode( $oldArray);
					
					$stmt32 = $conn->prepare("UPDATE review SET review_array=? WHERE review_id=?") ;			
					$stmt32->bind_param( si, $newProdArray, $prod_review_id);
					$stmt32->execute();
						 
					// check whether password already exist on same row or not	   	
					 $rows=$stmt32->affected_rows;
					//echo " row ".$rows;
					if($rows>0){	
						//echo " row affected is ";
						$status =1;
						if($langauge ==="default"){
                            $msg ="Thank You for Submitting Review.";
        					    
                        }else{
                        	$msg =" रिव्यु देने के लिए सुक्रिया";
                    	}	
					}else{
						
						$status =1;
						if($langauge ==="default"){
                            $msg = "Failed to submit review. Please try again";
						        
                        }else{
                        	$msg ="रिव्यु सबमिट नहीं हुआ है कृपया पुन: प्रयास करें।";
                    	}
					}
					
						
				}
										
		
		}

	 	
	
	}else{
		//echo "id exist ".$rowUserId." qoute id ".$rowQouteId. " products  ".	$prod_id_array;
		$status =1;
		if($langauge ==="default"){
        	$msg = "You can't submit the review. Please buy the product then you can submit review";
						        
        }else{
            	$msg ="कृपया प्रोडक्ट को खरीदने के बाद रिव्यु सबमिट करे";
        }		
	
	}

	
	
	$post_data = array(
	 			 'status' => $status,
	 			 'msg' => $msg );
	 	
	 	
	 $post_data= json_encode( $post_data );
	 	
	 echo $post_data;
	 	
	 mysqli_close($conn);
	



}

	
?>	
	