<?php

include('session.php');
$code = $_POST['code'];
$topbar_offer = $_POST['topbar_offer']; 
$error='';  // Variable To Store Error Message
$code =   stripslashes($code);
$topbar_offer =   stripslashes($topbar_offer);
$minorder = stripslashes($minorder);

//echo " get ".$code."--".$name."--".$address."--".$phone."--".$tax."--".$website."--".$image;
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123@384#$$65$"   ) { 
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        //echo " inside ".$name;
        $seller = $_SESSION['seller_id'];
          //  echo " order id ".$col1;
            $newusername  ="topbar_offer";
           
            $stmt11 = $conn->prepare("UPDATE store_config SET value=? WHERE name=?");
    		$stmt11->bind_param( "ss",  $topbar_offer, $newusername );
            $stmt11->execute();
            $stmt11->store_result();
        
          echo "Saved Successfully.";
    	 
    }else{
            echo "failed to save details.";
    }
    die;
?>
