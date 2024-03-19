<?php
include('session.php');
$code = $_POST['code'];
$prod_name = $_POST['prod_name'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$search =   stripslashes($prod_name);

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
       
         $Exist = false;
         $status =0;
         $information = array();
        //  echo  "old array is ".$oldarray;
        $return = array();
        $i      = 0;
        $status = "active";
        $search = "%".$search."%";
        $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url, pr.prod_stock, ct.cat_name, pr.status FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id AND pt.prod_name LIKE ? ORDER BY pt.prod_id DESC");
        $stmt ->bind_param(s, $search);
        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8);
        //  echo " get col data ";
        
        while ($stmt->fetch()) {
            //echo " prod data is " .$col1;  
            	$Exist = true;
            $imgarray = json_decode($col5, true);
            $imageurl = "";
            $count    = 1;
            foreach ($imgarray as $arraykey) {
                if ($count === 1) {
                    $imageurl = "../media/" . $arraykey['url'];
                    $count++;
                }
            }
            
            
            $return[$i] = array(
                'id' => $col1,
                'name' => $col2,
                'desc' => $col3,
                'price' => $col4,
                'img' => $imageurl,
                'stock' => $col6,
                'cat' => $col7,
                'active' => $col8
            );
            $i          = $i + 1;
            //echo " array created".json_encode($return);
        }
         if( $Exist){
                	    
              $status = 1;
              $information =array( 'status' => $status,
                                    'totalrow' =>   $i  ,
                	                 'pageno' => 1 ,
                                    'details' => $return);
	                        
         }else{
                	 
              $status = 0;
              $information =array( 'status' => $status,
                                 'totalrow' => 0,
                	                 'pageno' => 1,
                                'details' => $return);
         }
                
         echo  json_encode( $information);
     
      /*
       //----------
                    $status =0;
                    $information = array();
                    $i =0;
                    $search = "%".$search."%";
                   // echo "ease ".$search;
                     $Exist = false;
                     $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.total_price, odr.create_date, up.full_name, sum(op.prod_price*op.qty), sum(op.cgst), sum(op.sgst), max(op.shipping), sum(op.total)  FROM orders odr, user_profile up, order_product op WHERE odr.user_id = up.user_id AND odr.order_id = op.order_id AND up.full_name LIKE ? GROUP BY op.order_id ORDER BY odr.sno DESC");
                	 $stmt11 ->bind_param(s, $search);
                	 $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result (  $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11);
                	 
                	 while($stmt11->fetch() ){
                	 // echo " order id ".$col1;
                	 		$Exist = true;
                	 		$return[$i] = 
                                					array(
                                					    'sno' => $col1,
                                					    'orderid' => $col2,
                                						'orderstatus' => $col3,
                                						'ord_total' => number_format($col4,2),
                                						'orderdate' =>  date('d-m-y h:i A', strtotime($col5)),
                                       					 'name' =>$col6,
                                       					 'price' => number_format($col7,2),
                                       					 'cgst' => number_format($col8,2), 
                                       					 'sgst' => number_format($col9,2),
                                       					 'ship' => number_format($col10,2),
                                       					 'grandtotal' => number_format($col11,2));
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
                  
       */
       
    
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>