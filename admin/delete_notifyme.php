<?php

include('session.php');
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
   
 $code = $_POST['code'];
 $reqid = $_POST['reqid'];
 
 $code=   stripslashes( $code);
 $reqid=  stripslashes( $reqid);

//  echo "orde".$code. "--".$reviewid."--".$feedid;
 if(isset($code) &&!empty( $code) && isset($reqid) &&!empty( $reqid) ) {
           
        include('../app/db_connection.php');
        global $conn;
            	
        if($conn-> connect_error){
        	die(" connecction has failed ". $conn-> connect_error)	;
        }
        $Exist = false;
      //  echo "inside ".$reviewid." -- ".$feedid; 	
        $stmt = $conn->prepare("DELETE FROM notifyme WHERE sno =?");
        $stmt->bind_param(i, $reqid);
        $stmt->execute();
      	$rows=$stmt->affected_rows;
        			
        if($rows>0){
	        // echo "sdfsad";
            	 		$Exist = true;
        }
        	 
         if( $Exist){
	        //echo  "exist on table";
	        
	      echo "Delete Successful";
             
         }else{
             
             echo "Failed to delete ";
         }
        
        
    }else{
         echo "Failed to Delete. ";
    }
   
    
    
}
 
?>
