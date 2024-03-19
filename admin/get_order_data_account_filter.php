<?php
include('session.php');
$code = $_POST['code'];
$cust_name = $_POST['cust_name'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$search =   stripslashes($cust_name);

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
                   // $search =  array('Placed', 'Dispatch');
                  //  echo "ease ".$search;
                  // $search = implode(',', $search);
                    $pl =  $search; //  "'Placed', 'Cancelled', 'Dispatch'";
                     
                     $binds = array('id' => $pl);
                      /*  $stmt = $conn->prepare('SELECT order_id FROM orders WHERE status IN (' . $binds['id'] . ')');
                        $stmt->execute();
                        $stmt->store_result();
                	   while($stmt->fetch() ){
                	         echo " order id ".$col1;
                	   }
                	   */
                     
                     $Exist = false;
                     $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.total_price, odr.create_date, up.full_name, sum(op.prod_price*op.qty), sum(op.cgst), sum(op.sgst), op.shipping, sum(op.total)  FROM orders odr, user_profile up, order_product op WHERE odr.user_id = up.user_id AND odr.order_id = op.order_id AND odr.status IN (".$binds['id'].") GROUP BY op.order_id ORDER BY odr.status DESC");
                    // $stmt11->bindParam('s',  array($param));
                	 $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result (  $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
                	 
                	 while($stmt11->fetch() ){
                	  //echo " order id ".$col1;
                	 		$Exist = true;
                	 		$return[$i] = 
                                					array(
                                					    'sno' => $col1,
                                					    'orderid' => $col2,
                                						'orderstatus' => $col3,
                                						'ord_total' => number_format($col4,2),
                                						'orderdate' =>  date('d-m-Y h:i A', strtotime($col5)),
                                       					 'name' =>$col6,
                                       					 'price' => number_format($col7,2),
                                       					 'cgst' => number_format($col8,2), 
                                       					 'sgst' => number_format($col9,2),
                                       					 'ship' => number_format($col10,2),
                                       					 'grandtotal' => number_format($col11+ $col10,2));
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