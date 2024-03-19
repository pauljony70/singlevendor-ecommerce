<?php
include('session.php');
$code =  $_POST['code'];
$page = $_POST['page'];
$rowno = $_POST['rowno'];
$sortdate = $_POST['sortdate'];
$sortstatus = $_POST['sortstatus'];
$error='';  // Variable To Store Error Message

$code=    stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$sortdate =  stripslashes($sortdate);
$sortstatus =  stripslashes($sortstatus);

//echo "admin is ";
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="1"){
    
    $seller_id =  $_SESSION['seller_id'];
     //Calculating start for every given page number
    
    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
     //  echo "sfsadf";
                    $status =0;
                    $information = array();
                    $i =0;
                     $Exist = false; 
                     $limit = 10; 
                    $start = ($page - 1) * $limit; 
                        $totalrow =0;
                   	 $prodstatus= "Return_init";
                    
                   	 $stmt12 = $conn->prepare("SELECT count(prod_id)  FROM order_product WHERE status=?");
                	 $stmt12 ->bind_param(s, $prodstatus);
                     $stmt12->execute();
                	 $stmt12->store_result();
                	 $stmt12->bind_result (  $col5);
                	 
                	 while($stmt12->fetch() ){
                	    $totalrow = $col5;
                	     
                	 }
                	 
                     if($page ==99999){
                        $start =   $totalrow -($totalrow % $limit); 
                        $page = (int)(($totalrow / $limit) +1);
                        
                        if($start == $totalrow){
                            $start = $start -$limit;
                            $page = (int)((($totalrow-$limit) / $limit) +1);
                            
                        }
                       // echo " stat ".$start." limi ".$limit;
                     }
                   // echo "start " . $start. " page ".$page." totalrow ". $totalrow;
                     $stmt11 = $conn->prepare("SELECT prod_id, prod_name, prod_img, order_id, return_status, status_date FROM order_product WHERE status=? ORDER BY status_date DESC LIMIT ?, ?");
                  	 $stmt11 ->bind_param(sii, $prodstatus, $start, $limit);
                     
                	 $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result (  $col1, $col2, $col3, $col4, $col5, $col6);
                	 
                	 while($stmt11->fetch() ){
                	//  echo " order id ".$col1;
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
                	                            'totalrow' => $totalrow,
                	                            'pageno' => $page,
                	                            'details' => $return);
	                        
                	 }else{
                	 
                	    // echo " No Order in seller account ";
                	      $status = 0;
                	      $information =array( 'status' => $status,
                	                            'totalrow' => $totalrow,
                	                             'pageno' => $page,
                	                            'details' => $return);
                	 }
                
                  echo  json_encode( $information);
                  
                	 //----------
       
       
    
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>