<?php

include('session.php');
$code = $_POST['code'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$tax = $_POST['tax'];
$website = $_POST['website'];
$image = $_POST['imagejson']; 
$whatsapp = $_POST['whatsapp'];
$termc = $_POST['termc'];
$aboutus = $_POST['aboutus'];
$email = $_POST['email'];
$youtube = $_POST['youtube'];

$error='';  // Variable To Store Error Message
$code =   stripslashes($code);
$name =   stripslashes($name);
$address=   stripslashes($address);
$phone=    stripslashes($phone);
$tax=   stripslashes($tax);
$website=  stripslashes($website);
$image=   stripslashes($image);
$whatsapp=   stripslashes($whatsapp);
$termc=   stripslashes($termc);
$aboutus=   stripslashes($aboutus);
$email=   stripslashes($email);
$youtube=   stripslashes($youtube);

//echo " get ".$code."--".$name."--".$address."--".$phone."--".$tax."--".$website."--".$image;
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123" && isset($name)   && !empty($name) && isset($address)   && !empty($address)&& isset($phone)   && !empty($phone)   ) {
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
       
        //echo " inside ".$name;
        $seller = $_SESSION['seller_id'];
        
         $stmt10 = $conn->prepare("SELECT seller_id FROM store_setting");
        $stmt10->execute();
        $stmt10->store_result();
    	// echo " insert done ";
    	 $rows=$stmt10->affected_rows;
    	 //echo "row ".$rows;
    	 if($rows>0){
    	    
    	    $stmt11 = $conn->prepare("UPDATE store_setting SET store_name=?, address=?, phone=?, tax_no=?, logo=?, web_url=?, whatsappno=?, termcondition=?, aboutus=?, email=?, youtubeurl=? WHERE seller_id=?");
    		$stmt11->bind_param("sssssssssssi", $name, $address, $phone, $tax, $image,$website, $whatsapp, $termc, $aboutus, $email, $youtube, $seller );
    	 
            $stmt11->execute();
            $stmt11->store_result();
        	// echo " insert done ";
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo "Business Details Saved Successfully.";
        	      
        	 }else{
        	     echo "failed to save details";
        	 }
    	  
    	     
    	 }else{
    	  
    	    $stmt11 = $conn->prepare("INSERT INTO store_setting( seller_id, store_name, address, phone, tax_no, logo, web_url, whatsappno, termcondition, aboutus, email, yoututbeurl )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    		$stmt11->bind_param("isssssssssss", $seller, $name, $address, $phone, $tax, $image, $website,$whatsapp, $termc, $aboutus, $email, $youtube  );
    	 
            $stmt11->execute();
            $stmt11->store_result();
        	// echo " insert done ";
        	 $rows=$stmt11->affected_rows;
        	 if($rows>0){
        	     echo "Business Details Saved Successfully.";
        	     
        	 }else{
        	     echo "failed to save details";
        	 }
    	  
    	  
    	 }	
    	 
        
       //   echo "Business Details Saved Successfully.";
    	 
    }else{
            echo "failed to save details.";
    }
    die;
?>
