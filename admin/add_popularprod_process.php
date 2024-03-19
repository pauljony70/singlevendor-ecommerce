<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['name'];
$id = $_POST['id'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$name =   stripslashes($name);
$id =   stripslashes($id);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($name)   && !empty($name) && !empty($id)  ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
       
    //   echo " inside ".$name;
      // $seller = $_SESSION['seller_id'];
       $orderid =0;
        $stmt11 = $conn->prepare("INSERT INTO popularprod( prodid, prodname, orderid )  VALUES (?,?,?)");
		$stmt11->bind_param( isi, $id, $name, $orderid );
	 
        $stmt11->execute();
        $stmt11->store_result();
    	// echo " insert done ";
    	 $rows=$stmt11->affected_rows;
    	 if($rows>0){
    	     echo "Added Successfully. ";
    	     
    	 }else{
    	     echo "failed to add";
    	 }	
    	 
    }else{
            echo "Invalid values.";
    }
    die;
?>
