<?php

include('session.php');
//include('../db_connection.php');
//session_start();// Starting Session

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
    

    $deletearray = $_POST['deletearray'];
    $deletearray =   stripslashes($deletearray);
   // echo " delete array ".$deletearray ;
    
   
   if(isset($deletearray) &&!empty( $deletearray)  ) {
           
            include('../app/db_connection.php');
            global $conn;
            	
            	if($conn-> connect_error){
            		die(" connecction has failed ". $conn-> connect_error)	;
            	}
            
         	     $stmt2 = $conn->prepare("DELETE FROM seller_login WHERE seller_id IN( $deletearray )");
        		// $stmt2->bind_param( 's',   $deletearray );
        		 $stmt2->execute();
        		
        		 $rows=$stmt2->affected_rows;
        			
        		if($rows>0){
        			    
        			    echo "Delete Successful. ";
        		}else{
        			    echo "Failed to Delete. ";
        		}
            	 
        
        die;
    }
}    
?>
