<?php

include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else{
    
    $prodid = $_POST['prodid'];
    $prodstatus = $_POST['prodstatusid'];
    $code = $_POST['code'];
    
    $prodid =   stripslashes($prodid);
    $prodstatus =   stripslashes($prodstatus);
    $code =  stripslashes($code);
   // echo " delete array ".$deletearray ;
    
   if(isset($prodid) &&!empty( $prodid) && isset($prodstatus) &&!empty( $prodstatus)  &&!empty( $code)   ) {
           
            include('../app/db_connection.php');
            global $conn;
            	
            	if($conn-> connect_error){
            		die(" connecction has failed ". $conn-> connect_error)	;
            	}
            	
            //	 $all =implode(',',$deletearray);
            //	echo " -- ".$all;
                if($prodstatus ==="active"){
                   $prodstatus = "inactive"; 
                }else {
                    $prodstatus = "active"; 
                }
            
         	     $stmt2 = $conn->prepare("UPDATE product SET status=? WHERE prod_id =?");
        		 $stmt2->bind_param( 'si',   $prodstatus, $prodid );
        		 $stmt2->execute();
        		
        		 $rows=$stmt2->affected_rows;
        			
        		if($rows>0){
        			 $information =array( 'status' => 1,
                                           'msg' =>   "Status Update Successful. "   );
        			   
        		}else{
        			    
        			     $information =array( 'status' => 0,
                                           'msg' =>   "Failed to Update. "   );
        		}
        		
               echo  json_encode( $information);	 
        
        die;
    }
}    
?>
