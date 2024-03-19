
<?php

include('session.php');
//session_start();// Starting Session
/*if(!isset($_SESSION['admin'])){
  header("Location: index.php");
  echo " going home";
}else{
*/    
    $prodid = $_POST['prodid'];
    //$prodstatus = $_POST['prodstatusid'];
    $code = $_POST['code'];
    
    $prodid =   stripslashes($prodid);
   // $prodstatus =   stripslashes($prodstatus);
    $code =  stripslashes($code);
   // echo " delete array ".$deletearray ;
    
   if(isset($prodid) &&!empty( $prodid)   &&!empty( $code)   ) {
           
            include('../app/db_connection.php');
            global $conn;
            	
            	if($conn-> connect_error){
            		die(" connecction has failed ". $conn-> connect_error)	;
            	}
            	
            
         	     $stmt2 = $conn->prepare("DELETE FROM productdetails WHERE prod_id=?");
        		 $stmt2->bind_param( 'i',   $prodid );
        		 $stmt2->execute();
        		
        		 $rows=$stmt2->affected_rows;
        			
        		if($rows>0){
        			    
        			   	 $information =array( 'status' => 1,
                                           'msg' =>   "Delete Successful. "   );
                                           
        			      $stmt3 = $conn->prepare("DELETE FROM product WHERE prod_id=?");
                		 $stmt3->bind_param( 'i',   $prodid );
                		 $stmt3->execute();
        			 
        		}else{
        			     $information =array( 'status' => 0,
                                           'msg' =>   "Failed to Update. "   );
        		}
        		
                echo  json_encode( $information);	 
        
        die;
    }
//}    
?>
