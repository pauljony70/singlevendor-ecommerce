<?php

include('session.php');
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else{
    
    $code=   stripslashes($code);
    $timevalue = $_POST['timevalue'];
  
//$name =   stripslashes($name);
 
   if(isset($code) &&!empty( $timevalue)  ) {
           
            include('../app/db_connection.php');
            global $conn;
            	
            	if($conn-> connect_error){
            		die(" connecction has failed ". $conn-> connect_error)	;
            	}
            
         	     $stmt2 = $conn->prepare("DELETE FROM deliverytime WHERE timevalue=?");
        		 $stmt2->bind_param( 's',   $timevalue );
        		 $stmt2->execute();
        		
        		 $rows=$stmt2->affected_rows;
        			
        		if($rows>0){
        			    
        			    echo "Delete Successful. ";
        			  
        		}else{
        			    echo "Failed to Delete. ";
        		}
            	 
        
        die;
    }else{
        	echo "Failed to Delete. ";
    }
}    
?>
