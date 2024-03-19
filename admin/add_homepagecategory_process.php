<?php

include('session.php');
$code = $_POST['code'];
$title = $_POST['title'];
$layout = $_POST['layout'];
$clicktype = $_POST['clicktype'];
$prodid = $_POST['prodid'];
$prodname = $_POST['prodname'];
$catid = $_POST['catid'];
$catname = $_POST['catname'];
$img = $_POST['img'];

$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$title =   stripslashes($title);
$layout =   stripslashes($layout);
$clicktype =   stripslashes($clicktype);
$prodid =   stripslashes($prodid);
$prodname =   stripslashes($prodname);
$catid =   stripslashes($catid);
$catname =   stripslashes($catname);
$img =   stripslashes($img);

$name = str_replace('-', '', $name);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123uhbj234567"   ) {
        include('../app/db_connection.php');
        global $conn;
        	
       	if($conn-> connect_error){
        		die(" connecction has failed ". $conn-> connect_error)	;
       	}
        	
    //   echo " inside ".$name;
      // $seller = $_SESSION['seller_id'];
       $orderid =0;
        $stmt11 = $conn->prepare("INSERT INTO homecat( catid, catname, catorder, layout_type, title, clicktype, prod_id, prod_name, img_url )  VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt11->bind_param( isiisiiss, $catid, $catname, $orderid, $layout, $title, $clicktype, $prodid, $prodname, $img );
	 
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
