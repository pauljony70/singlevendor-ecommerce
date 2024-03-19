<?php

include('session.php');
$code = $_POST['code'];
$title = $_POST['title'];
$description = $_POST['description'];
$image = $_POST['img'];
$dates = date('Y-m-d H:i:s');
$parentid = $_POST['parentid'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$title =   stripslashes($title);
$description =   stripslashes($description);
$parentid =   stripslashes($parentid);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($title)   && !empty($title)  ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
       
          $exist = false;
           $stmt = $conn->prepare("SELECT home_banner_id FROM home_banner WHERE title=?");
    	   $stmt->bind_param( s,   $title );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1);
           $return = array();

       	   while ($stmt->fetch()) { 
    	        $exist = true;
        	   			  
               // echo " array created".json_encode($return);
    	    }
    	    
    	  if( $exist){
    	      echo "Banner Title already exist. Please choose another Title.";
    	      
    	  }  else{
            	  
                $stmt11 = $conn->prepare("INSERT INTO home_banner( title, description, img_url, datetime )  VALUES (?,?,?,?)");
        		$stmt11->bind_param( ssss,  $title, $description, $image, $dates );
        	 
                $stmt11->execute();
                $stmt11->store_result();
            	// echo " insert done ";
            	 $rows=$stmt11->affected_rows;
            	 if($rows>0){
            	     echo "New Banner Added Successfully.";
            	     
            	 }else{
            	     echo "failed to add Banner";
            	 }    
    	      
    	  }
        	
    	 
    }else{
            echo "failed to add Banner.";
    }
    die;
?>
