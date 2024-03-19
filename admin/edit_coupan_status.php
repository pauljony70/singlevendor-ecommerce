<?php

include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}else{
    
    $coupanid = $_POST['coupanid'];
    $statusid = $_POST['statusid'];
    $code = $_POST['code'];
    
    $coupanid =   stripslashes($coupanid);
    $statusid =   stripslashes($statusid);
    $code =  stripslashes($code);
   // echo " delete array ".$deletearray ;
    
   if(isset($coupanid) &&!empty( $coupanid) && isset($statusid) &&!empty( $statusid)  &&!empty( $code)   ) {
           
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
            
         	     $stmt2 = $conn->prepare("UPDATE coupancode SET activate=? WHERE sno =?");
        		 $stmt2->bind_param( 'si',   $statusid, $coupanid );
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
