<?php

include('session.php');
$code = $_POST['code'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['password'];
$repass = $_POST['repassword'];
$error='';  // Variable To Store Error Message

$code=    stripslashes($code);
$fname =   stripslashes($fname);
$lname =   stripslashes($lname);
$email =   stripslashes($email);
$pass =   stripslashes($pass);
$repass =   stripslashes($repass);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($fname) && !empty($fname) && isset($lname)  && !empty($lname) && isset($email)   && !empty($email) && isset($repass)  && !empty($repass)  ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
       	date_default_timezone_set("Asia/Kuwait");
       	$datetime = date('Y-m-d H:i:s');
     	$roll ="user"; $status ="active";
     	
            $exist = false;
           $stmt = $conn->prepare("SELECT seller_id FROM seller_login WHERE email=?");
    	   $stmt->bind_param( s,   $email );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result( $col1);
           $return = array();

       	   while ($stmt->fetch()) { 
    	        $exist = true;
        	   			  
               // echo " array created".json_encode($return);
    	    }
     	
     	if($exist){
     	    echo "Email ID already exist.";
     	    
     	}else{
     	    
     	
     	
     //  echo "sdf";
        $stmt11 = $conn->prepare("INSERT INTO seller_login( fname, lname, email, password, status, roll, date )  VALUES (?,?,?,?,?,?,?)");
		$stmt11->bind_param( sssssss,  $fname, $lname, $email, $pass, $status, $roll, $datetime );
	 
        $stmt11->execute();
        $stmt11->store_result();
    	// echo " insert done ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "User Added Successfully. ";
    	     
    	 }else{
    	     echo "failed to add user";
    	 }
     	} 
    	 
    }
    die;
?>
