<?php
include('db_connection.php');

$random =  htmlentities($_POST['random'] );

$random = stripslashes($random);  //  "9144040888";//

if(isset($random)  && !empty($random)   ) {
    
    
  			$status =1;
        	$msg ="Please Update to new version to get more exciting deals!!!"; 
        	$Information = array(
                                 'appversion' => 1,
                                  'date' => "25-04-2021"  );  

    	$post_data = array(
 			 'status' => $status,
 			 'msg' => $msg,
 			 'forcelogout' => false,
 			 'logoutversion' => 1,
 			 'Information' => $Information );
 	
 	
 	$post_data= json_encode( $post_data );
 	
 	echo $post_data;
}

?>