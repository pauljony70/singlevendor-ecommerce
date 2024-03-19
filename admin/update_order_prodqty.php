<?php
include('session.php');
$code = $_POST['code'];
$ordersno = $_POST['orderid'];    
$prodid = $_POST['prodidd'];
$qty = $_POST['qtyy'];
  
   // $seller_id =$_SESSION['seller_id'];
 
$code=   stripslashes($code);
$ordersno =   stripslashes($ordersno);
$prodid =   stripslashes($prodid);
$qty =   stripslashes($qty);

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else if(isset($code) && isset($ordersno)&& isset($prodid) && isset($qty)  ) {

    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
        $prodarray    = json_decode("$prodid", true);
        $qtyarray    = json_decode("$qty", true);
        
       // echo " prod id ".count($prodarray)."  qty ".sizeof($qtyarray)." order ".$ordersno ; 

       	date_default_timezone_set("Asia/Kolkata");
       	$datetime = date('Y-m-d H:i:s');
       	$flag = false;
      
        for ($x = 0; $x < count($prodarray); $x++) {
         //   echo "The number is:".$prodarray[$x]." <br>";
       
           $prodvalue = $prodarray[$x];
            $qtyvalue =  $qtyarray[$x];
                 $price=0;   $cgst = 0;  $sgst = 0;  $igst = 0;   $shipping = 0;
		       
            	$stmt2 = $conn->prepare("SELECT prod_name, prod_price,  cgst, sgst, igst, shipping FROM productdetails WHERE prod_id =?");
                $stmt2-> bind_param("i",  $prodvalue);
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result ( $col21,$col22, $col23,$col24, $col25, $col26);
                          
                while($stmt2->fetch() ){
                   // echo "price is ".$col22;
                    $price=$col22;   $cgst = $col23;  $sgst = $col24;  $igst = $col25;   $shipping = $col26;
		        }
		      if($qtyvalue ==0){
		          $shipping =0;
		      }
		      $total = ($price * $qtyvalue) + (($price * $qtyvalue) * $cgst )/100 + (($price * $qtyvalue) * $sgst )/100+ (($price * $qtyvalue) * $igst )/100 +  $shipping;
		                           
        //    $stmt11 = $conn->prepare("UPDATE order_product SET qty =?, update_date=?, total=? WHERE order_id=? AND prod_id=?");
            $stmt11 = $conn->prepare("UPDATE order_product SET prod_price=?, qty =?, update_date=?, total=? WHERE order_id=? AND prod_id=?");
        
        	$stmt11->bind_param( "disdsi",  $price, $qtyvalue, $datetime,  $total, $ordersno,  $prodvalue );
    		$stmt11->execute();
    	    $stmt11->store_result();
        
           //  echo " insert done ";
            $rows=$stmt11->affected_rows;
            if($rows>0){
               $flag= true;  
                 
             }
            
        }
        
        if($flag){
            echo "Saved";
        }else{
            echo "Nothing Saved";
        }
       	
        
    }//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
    
}   


?>