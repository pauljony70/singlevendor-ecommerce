<?php
include('session.php');
$code =   $_POST['code'];
$error='';  // Variable To Store Error Message

$code=  stripslashes($code);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123"){

    //$seller_id =  $_SESSION['seller_id'];
     //Calculating start for every given page number
    $limit = 30; 
    $start = ($page - 1) * $limit; 
    
    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
                    $i =0;
                     $Exist = false;
                    $cancel_count =0; $comt_count=0; $pending=0; $total =0; $total_sale =0;
                   
                     $order_sum = array();
                    // echo "here";
                   //  $stmt11 = $conn->prepare("SELECT count(total_price), status, sum(total_price) FROM orders od, order_product GROUP BY status");
                    $stmt11 = $conn->prepare("SELECT count(odr.total_price), odr.status, sum(op.prod_price*op.qty) + sum(((op.prod_price*op.qty)*op.cgst)/100) + sum(((op.prod_price*op.qty)*op.sgst)/100)+ max(op.shipping)  FROM orders odr, order_product op WHERE odr.order_id = op.order_id GROUP BY op.order_id ORDER BY odr.sno");
                  
                //	 $stmt11 ->bind_param(i, $seller_id);
                	 $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result (  $col1, $col2, $col3);
                	 
                	 while($stmt11->fetch() ){
                	   // echo " order id ".$col2."--".$col1."--".$col3."<br>";
                	 		$Exist = true;
                	 	  $total  =  $total  +1;
                	 	    	if($col2 =="Cancelled")
                	 		    {
                                    $cancel_count = $cancel_count+1 ;
                                  //  $total  =  $total  +$col1;
                                   //  $total_sale =  $total_sale + $col3;
                            	}else if($col2 =="Completed"){
                            	    $comt_count = $comt_count+1;
                                    // $total  =  $total  +$col1;
                                     $total_sale =  $total_sale + $col3;
                    	 		}else if($col2 =="Placed"){
                    	 		    $pending = $pending + 1;
                     		       //  $total  =  $total  +$col1;
                    		         $total_sale =  $total_sale + $col3;
                    	 		}else if($col2 =="Dispatch"){
                    	 		     $pending = $pending + 1;
                    		         // $total  =  $total  +$col1;
                    		          $total_sale =  $total_sale + $col3;
                    	 		}
                	 }
                	 
                	   $prod_count =0;
                    $stmt12 = $conn->prepare("SELECT prod_id FROM product");
                //	 $stmt11 ->bind_param(i, $seller_id);
                	 $stmt12->execute();
                	 $stmt12->store_result();
                	 $stmt12->bind_result (  $col21);
                //	 echo " sdfs ".$prod_count;
                	while($stmt12->fetch() ){
                	    //	 echo " prod--".$prod_count;
                	      $prod_count = $prod_count+1; 
                	 } 

                $return = array( 'prod' => $prod_count,
                                'total_order' => $total,
                                'total_sale' => number_format($total_sale, 2),
                                 'cancel' =>$cancel_count,
                                 'completed' =>  $comt_count,
                                 'pending' =>  $pending);
                               
        echo json_encode($return);  
        
    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>