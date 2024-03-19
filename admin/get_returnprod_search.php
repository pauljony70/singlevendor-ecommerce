<?php
include('session.php');
$code = $_POST['code'];
$order_id = $_POST['order_id'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$search =   stripslashes($order_id);

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="1"){
    
    $seller_id =  $_SESSION['seller_id'];
     //Calculating start for every given page number
//    $limit = 30; 
   // $start = ($page - 1) * $limit; 
    
    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
                    $status =0;
                    $information = array();
                    $i =0;
                    $search = "%".$search."%";
                 //  echo "ease ".$search;
                     $Exist = false;
                      $prodstatus= "Return_init";
                     $stmt11 = $conn->prepare("SELECT prod_id, prod_name, prod_img, order_id, return_status, status_date FROM order_product WHERE status=? AND order_id LIKE ? ORDER BY status_date");
                  	 $stmt11 ->bind_param(ss, $prodstatus, $search);
                  
                 //    $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.total_price, odr.create_date, up.full_name, sum(op.prod_price*op.qty), sum(op.cgst), sum(op.sgst), max(op.shipping), sum(op.total), op.deliveryid  FROM orders odr, user_profile up, order_product op WHERE odr.user_id = up.user_id AND odr.order_id = op.order_id AND odr.order_id LIKE ? GROUP BY op.order_id ORDER BY odr.sno DESC");
                //	 $stmt11 ->bind_param(s, $search);
             	     $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result (  $col1, $col2, $col3, $col4, $col5, $col6);
                   	 
                	 while($stmt11->fetch() ){
                	 // echo " order id ".$col1;
                	 		$Exist = true;
                 	 		$return[$i] = 
                                					array(
                                					    'prodid' => $col1,
                                					    'prodname' => $col2,
                                						'image' => $col3,
                                						'orderid' =>  $col4,
                                						'returnstatus' => $col5,
                                						'statusdate' => date('d-m-Y h:i A', strtotime($col6)));
                                      		   $i = $i+1; 
                	 }
                	 if( $Exist){
                	    
                	      $status = 1;
                	      $information =array( 'status' => $status,
                	                            'details' => $return);
	                        
                	 }else{
                	 
                	    // echo " No Order in seller account ";
                	      $status = 0;
                	      $information =array( 'status' => $status,
                	                            'details' => $return);
                	 }
                
                  echo  json_encode( $information);
                  
       
       
    
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>