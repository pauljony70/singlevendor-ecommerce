<?php

include('session.php');
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else{
   
   
 $code = $_POST['code'];
 $reviewid = $_POST['reviewid'];
 $feedid = $_POST['feedid'];
 
 $code=   stripslashes( $code);
 $reviewid=   stripslashes( $reviewid);
 $feedid=   stripslashes( $feedid);

//  echo "orde".$code. "--".$reviewid."--".$feedid;
 if(isset($code) &&!empty( $code) && isset($reviewid) &&!empty( $reviewid) ) {
           
        include('../app/db_connection.php');
        global $conn;
            	
        if($conn-> connect_error){
        	die(" connecction has failed ". $conn-> connect_error)	;
        }
        $Exist = false;
      //  echo "inside ".$reviewid." -- ".$feedid; 	
        $stmt = $conn->prepare("SELECT review_array FROM review WHERE review_id =?");
        $stmt->bind_param(i, $reviewid);
        $stmt->execute();
        $data = $stmt->bind_result($col1);
         while($stmt->fetch() ){
	        // echo "sdfsad";
            	 		$Exist = true;
                    	$reviewJsonArray = $col1;
            	 	
        }
        	 
         if( $Exist){
	        //echo  "exist on table";
	        
	        $oldarray = json_decode( 	$reviewJsonArray, true) ;
	        $prodIDexist = false;
	  	    $i=0;
	  		 foreach($oldarray as $arraykey) {
			   
    			   if( $i == $feedid ){
    			   	  $prodIDexist = true;
    			   	    unset($oldarray[$i]);
    		   	    
    			   }
    			   
    			$i++;   
    		  }
    		   if($prodIDexist){
		  	 
		    	 	$oldarray=	array_values($oldarray);
		  	     $tempnewarray = 	 json_encode( $oldarray);
	 			 $stmt2 = $conn->prepare("UPDATE review SET review_array=? WHERE review_id=?");
        		 $stmt2->bind_param( si, $tempnewarray, $reviewid );
        		 $stmt2->execute();
        	     $rows=$stmt2->affected_rows;
        			//echo " row ".$rows;
        			
        		 if($rows>0){	
        			   		echo " Delete Successful.";
        			
        		}else{
        			 echo "Failed to Delete. ";    
        		}
	    
             
         }else{
             
             echo "Failed to delete ";
         }
        
        
    }else{
        			    echo "Failed to Delete. ";
    }
   
    }
    
}
 
?>
