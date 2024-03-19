<?php
include('session.php');
$code = $_POST['code'];
$newvalue = $_POST['store_open_status'];    
 
 $code =   stripslashes( $code);
 $newvalue =   stripslashes( $newvalue);
 
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset( $code) && !empty( $code)&& !empty( $newvalue)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
      
        $status = "0";
        $msg ="Failed to Update";
        $name = "store_open_status";
        $tooglevalue ="0";
        $tooglevalue1 ="";
        
        //  echo "inside ".$catimg;
        if($newvalue =="Open"){
              $tooglevalue = "1";
			  $tooglevalue1 = "Close";
			  
        }else{
             $tooglevalue = "0";
             $tooglevalue1 = "Open";
        }
        $stmt11 = $conn->prepare("UPDATE store_config SET value =? WHERE name=?");
    	$stmt11->bind_param( "ss", $tooglevalue, $name );
		$stmt11->execute();
	    $stmt11->store_result();
    
       //  echo " insert done ";
        $rows=$stmt11->affected_rows;
        if($rows>0){
              $status = "1";
             $msg =" Update Successful ";
          //   echo " Update Successful ";
             
         }else{
               $status = "0";
               $msg ="Failed to Update. Please try again";
            // echo "Failed to Update. Please try again";
         }	
         
         	$Information = array(  'statusv' => $status,
         	                        'newvalue' =>  $tooglevalue1,
	 			                   'msg' => $msg);  	
            	 	
            	 $post_data= json_encode(  $Information  );
            	 	
            	 echo $post_data;
        
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>