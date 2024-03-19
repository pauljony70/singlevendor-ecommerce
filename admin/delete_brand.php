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
   $deletearray=   stripslashes($deletearray);
//$name =   stripslashes($name);

  //  echo " delete array ".$deletearray ;
     function inactiveProduct($id, $conns){
            
             $status = "inactive";
            $stmt11 = $conns->prepare("UPDATE product SET status =? WHERE prod_brand_id IN ( $id ) AND status != ?");
    		$stmt11->bind_param( ss, $status, $status );
        	 $stmt11->execute();
        	// echo " insert done ".$id;
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo " Brand Product's Become Inactive";
        	     
        	 }else{
        	     echo " failed to in-activate product";
        	 }
    }
   
   if(isset($deletearray) &&!empty( $deletearray)  ) {
           
            include('../app/db_connection.php');
            global $conn;
            	
            	if($conn-> connect_error){
            		die(" connecction has failed ". $conn-> connect_error)	;
            	}
            	
            //	 $all =implode(',',$deletearray);
            //	echo " -- ".$all;
            
         	     $stmt2 = $conn->prepare("DELETE FROM brand WHERE brand_id IN( $deletearray )");
        		// $stmt2->bind_param( 's',   $deletearray );
        		 $stmt2->execute();
        		
        		 $rows=$stmt2->affected_rows;
        			
        		if($rows>0){
        			    
        			    echo "Delete Successful. ";
        			     inactiveProduct($deletearray, $conn);
        		}else{
        			    echo "Failed to Delete. ";
        		}
            	 
        
        die;
    }else{
        			    echo "Failed to Delete. ";
    }
}    
?>
