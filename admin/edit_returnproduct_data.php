  <?php
include('session.php');
$code = $_POST['code'];
$ordersno =  $_POST['orderid'];    
$prodid =  $_POST['prodid']; 

$code=   stripslashes($code);
$orderid= stripslashes($ordersno);
$prodid=  stripslashes($prodid);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset($code) && isset($orderid) && !empty($orderid)&& isset($prodid) && !empty($prodid)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
           $customername =""; $email =""; $shipping_ads=""; $order_id =""; $status =""; $orderdate=""; $order_update=""; $proddetails =""; 
           $customerid ="";   $delivery_mode ="";   $payment_id =""; $cust_phone=""; $cust_email="";  $deliveryid ="";
                 $subtotal=""; $ship=""; $grantotal=""; $discountvalue="";  $discountid=""; $curriername =""; $trackid =""; 
                $status_date =""; $refund_amt =""; $refund_txnno=""; $refund_date=""; $pickupdate ="";  $return_status =""; $reason ="";  $return_updateby =""; 
          
    	$resstatus =0;
    	$prodjsonarray = array();
       	$Information = array(  'status' => $resstatus,
	 			                'orderId' => $order_id,
	 			                'username' =>  $customername,
	 			                'custid' =>  $customerid,
	 			                'address' => $shipping_ads,
	 			                'phone' => $cust_phone,
	 			                'email' => $cust_email,
	 			                'orderstatus' => $status,
	 			                'orderdate' =>$orderdate,
	 			                'proddetails' => 	json_encode($prodjsonarray),
	 			                'deliverymode' =>$delivery_mode,
	 			                'paymentid' =>$payment_id,
	 			                'subtotal' => $subtotal,
	 			                'ship' => $ship,
	 			                'grandtotal' => $grantotal,
	 			                'deliveryid' => $deliveryid,
	 			                'discountvalue'=> $discountvalue,
	 			                'discountid'=> $discountid,
	 			                'curriername' =>$curriername,
	 			                'trackid' => $trackid,
	 			                'refund_amt'=>$refund_amt,
	 			                'refund_txnno' => $refund_txnno,
	 			                'refund_date' => $refund_date,
	 			                'pickupdate' =>$pickupdate,
	 			                'reason' => $reason,
	 			                'return_status' =>$return_status,
	 			                'return_updateby' => $return_updateby,
	 			                'status_date'=>$status_date);
	 			                
                     $seller_id =  $_SESSION['seller_id'];
                     $Exist = false;
                  //  echo "order is ".$orderid;
                     $stmt11 = $conn->prepare("SELECT  odr.order_id, odr.status, odr.create_date, odr.update_date, up.full_name, up.email, adr.addressarray, odr.address_id, odr.prod_details, odr.delivery_mode, odr.payment_id, up.user_id, odr.curriername, odr.trackid FROM orders odr, user_profile up, address adr WHERE odr.order_id=? AND odr.user_id = up.user_id AND up.user_id = adr.user_id ORDER BY odr.order_id DESC");
                	 $stmt11 ->bind_param(i,  $orderid);
                	 $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result ( $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col15, $col16);
                	 
                	 while($stmt11->fetch() ){
                	  // echo " order -".$col1."--".$col2."--".$col3."--".$col4."--".$col5."--".$col6."--".$col9."***";
                	   $proddetails = $col9;
                	   $resstatus =1;
                	    $orderdate = date('d-m-y h:i A', strtotime($col3));
                	    $order_update = date('d-m-y h:i A', strtotime($col4));
                	    
                	    $order_id =$col1; $status =$col2;  $customername =$col5; $email = $col6; $shipping_ads = $col7;
                	     $delivery_mode = $col10;  $payment_id = $col11; $customerid = $col12; $curriername =$col15; $trackid =$col16; 
                	      $oldarray = json_decode(  $col7, true) ;
	  	                 
                           foreach($oldarray as $arraykey) {
                              // echo " col8 - ".$col8. "--".$arraykey['address_id'];
                        		 if( $col8 == $arraykey['address_id']){
                        		     $shipping_ads = $arraykey['fullname']."<br> ".$arraykey['address1'].", ".$arraykey['address2']."<br> ".$arraykey['city']
                        		     ."<br> ".$arraykey['state']."<br> ".$arraykey['pincode']."<br> Phone:  ".$arraykey['phone']."<br> Phone 2:  ".$arraykey['phone2']."<br> email :  ".$arraykey['email']."<br> Note:  ".$arraykey['anynote'];
                        		     
                        		     $cust_phone =$arraykey['phone'];
                        		     $cust_email = $arraykey['email'];
                        		 }   
                           }
                        // echo " prod ".$proddetails;  
                	 }
                     //------------------ prod details 
                    //  echo $order_id." prod details ".$proddetails;
                    $prodarray = json_decode( $proddetails, true) ;
                	$i =0;
                	$subtotal = 0.00;
                    $shiparray = array();
                    $nettotal = 0.00;
                           
            	  	 foreach( $prodarray as $arraykey) {
            			 //  echo "<br>--size ".$arraykey['qty']."--".$arraykey['price'];
            	           
	  	                // echo " prod array  ".$arraykey['prod_id'];
                               $sno =$arraykey['prod_id'];
                               if($prodid == $sno){
                                   
                               $size = $arraykey['size'];
                               $color = $arraykey['color'];
                                $msgoncake = $arraykey['msgoncake'];
	 					       $eggless = $arraykey['eggless'];
	 					       
                               $proprice = str_replace(",", '', 	$arraykey['price']);
                             	   
                        		$stmt2 = $conn->prepare("SELECT prod_id, prod_name, prod_img, prod_attr, qty, org_qty, prod_price, cgst, sgst, igst, shipping, total, deliveryid, status, status_date, refund_amt, refund_txnno, refund_date, pickup_date, return_status, return_reason, return_updateby, sellername FROM order_product WHERE prod_id =? AND order_id=?");
                             	$stmt2-> bind_param(is,  $sno, $order_id);
                             	$stmt2->execute();
                             	$stmt2->store_result();
                             	$stmt2->bind_result ( $col20, $col21, $col23, $col233, $colqty, $colorgqty, $col24, $col25, $col255, $col2555, $col26, $col27, $col28, $col29, $col30, $col31,$col32,$col33,$col34,$col35,$col36,$col37 , $col38);
                          
                             	while($stmt2->fetch() ){
                             	  // echo " ---".$col23."--".$col24."--".$col25;
                             	   //   echo "--inside ".$arraykey['size']."--".$arraykey['color'];
                             	      $deliveryid = $col28;
                             	     	$imgarray = json_decode( $col23, true) ;
                            	       	$imageurl =""; $count =1;
                                	  	 foreach($imgarray as $arraykey) {
                                			   if( $count === 1 ){
                                			   	$imageurl = "../media/".$arraykey['url'];
                                			   	 $count++;
                                			   }
                                		  }
                                		 
                             	     	$attriarray = json_decode( $col233, true) ;
                            	       	$weight =      $attriarray['weight'];
                             	    $otherart ="";
                             	    if($size==="" && $color ===""){
                             	      $otherart = " ";
                             	      
                             	    }else if($size==="" && $color !=""){
                             	      $otherart = " Color : ".$color;
                             	      
                             	    }else if($size!="" && $color ===""){
                             	      $otherart =  " Size : ".$size;
                             	      
                             	    }else{
                             	      $otherart = " Size : ".$size." | Color : ".$color;
                             	      
                             	    }
                             	      // msg on cake and eggless
                             	    if($eggless==="" && $msgoncake ===""){
                             	      
                             	    }else if($eggless==="" && $msgoncake !=""){
                             	      $otherart = $otherart."<br> MSG-on-Cake : ".$msgoncake;
                             	      
                             	    }else if($eggless!="" && $msgoncake ===""){
                             	      $otherart = $otherart." : ".$eggless;
                             	      
                             	    }else{
                             	      $otherart = $otherart." : ".$eggless." <br> MSG-on-Cake : ".$msgoncake;
                             	      
                             	    }
                             	    
                             	    $shipqty = $col26;
                             	    if($colqty==0){
                             	         $shipqty  =0;
                             	    }
                             	    $shiparray[$i] =  $shipqty ;
                             	    $subtotal =  $subtotal +$col27;
                             	    $prodjsonarray[$i] = array( 'img' => $imageurl,
                             	                                'prodid' => $col20,
                             	                                'prodname'=> $col21,
                             	                                'otherart' =>  $otherart,
                             	                                'price' =>  $proprice, 
                             	                                'qty' => $colqty,
                             	                                'orgqty' => $colorgqty,
                             	                                'cgst' => $col25,
                             	                                'sgst' => $col255,
                             	                                'igst' => $col2555,
                             	                                'ship' =>  $shipqty ,
                             	                                'total' => number_format($col27,2)." /-",
                             	                                'prodstatus' => $col29,
                             	                                'sellername' => $col38);
                             	  
                             	  $status_date = date('d-m-Y h:i A', strtotime($col30));
                             	  $refund_amt =$col31; $refund_txnno=$col32;
                             	  if($col33=="0000-00-00 00:00:00"){
                             	        $refund_date="";
                             	  }else{
                             	      $refund_date=date('d-m-Y h:i A', strtotime($col33));
                             	      
                             	  }
                             	  if($col34=="0000-00-00 00:00:00"){
                             	          $pickupdate = "DD-MM-YYYY";
                             	  }else{
                             	       $pickupdate = date('d-m-Y h:i A', strtotime($col34));
                             	      
                             	  }
                             	  if($col37=="0000-00-00 00:00:00"){
                             	       $return_updateby ="";
                             	  }else{
                             	       $return_updateby =date('d-m-Y h:i A', strtotime($col37));
                             	      
                             	  }
                             	  $return_status =$col35; $reason =$col36;   
     
                             	}
                             $i= $i+1;
                              } // if prodid == close
            	  	 }// foreach close 
            	 // echo " prod ".json_encode($prodjsonarray);
            	 $discountcode ="";
            
            	//     return_status = 0/ kuch nahi  1/ pickup schedual  2/return successfull   3/ return cancel  4/ refund done
            	  $return_status_txt ="";
            	  if($return_status ==0){
            	     $return_status_txt = "User Req. Placed" ;   
            	  }else if($return_status ==1){
            	     $return_status_txt = "Pickup Scheduled" ;   
            	  }else if($return_status ==2){
            	     $return_status_txt = "Return Successful" ;   
            	  }else if($return_status ==3){
            	     $return_status_txt = "Return Cancel By Admin" ;   
            	  }else if($return_status ==4){
            	     $return_status_txt = "Refund Successful" ;   
            	  }

            	  $grandtotal =$subtotal- $discountvalue;
                 	$Information = array(  'status' => $resstatus,
	 			                'orderId' => $order_id,
	 			                'username' =>  $customername,
	 			                'custid' =>  $customerid,
	 			                'address' => $shipping_ads,
	 			                'phone' => $cust_phone,
	 			                'email' => $cust_email,
	 			                'orderstatus' => $status,
	 			                'orderdate' =>$orderdate,
	 			                'proddetails' => $prodjsonarray,
	 			                 'deliverymode' =>$delivery_mode,
	 			                'paymentid' =>$payment_id,
	 			                'subtotal' => number_format($subtotal, 2) ,
	 			                'ship' => max($shiparray),
	 			                'grandtotal' => number_format($grandtotal+max($shiparray),2),
	 			                'deliveryid' => $deliveryid,
	 			                'discountvalue'=> $discountvalue." -- ".$discountcode,
	 			                'discountid'=> $discountid,
	 			                'curriername' =>$curriername,
	 			                'trackid' => $trackid,
	 			                'refund_amt'=>$refund_amt,
	 			                'refund_txnno' => $refund_txnno,
	 			                'refund_date' => $refund_date,
	 			                'pickupdate' =>$pickupdate,
	 			                'reason' => $reason,
	 			                'return_status' =>$return_status_txt,
	 			                'return_updateby' => $return_updateby ,
	 			                'status_date'=>$status_date);  	
            	 	
            	 $post_data= json_encode(  $Information  );
            	 	
            	 echo $post_data;
        
    }
    catch(Exception $e) {
          echo 'Message: ' .$e->getMessage();
        }        	  	 
    }                  
                
?>
              