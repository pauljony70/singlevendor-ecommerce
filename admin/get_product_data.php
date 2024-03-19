<?php
include('session.php');
$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$sortcat = $_POST['sortcat'];
$error = ''; // Variable To Store Error Message

$code =stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$sortcat =  stripslashes($sortcat);

//echo " value ".$page."---".$rowno."---".$sortcat;
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if ($code == "123") {
    
    $seller_id = $_SESSION['seller_id'];
    //Calculating start for every given page number
    
    include('../app/db_connection.php');
    global $conn;
    try {
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
          $Exist = false;
         $status =0;
         $information = array();
         $prodstatus = "active";
        $limit = 10; 
        $start = ($page - 1) * $limit; 
        $totalrow =0;
       
        
        $stmt12 = $conn->prepare("SELECT count(prod_id) FROM product");
      //  $stmt12->bind_param("s", $prodstatus);
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col5);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col5;
         
        }
        
         if($page ==99999){
            $start =   $totalrow -($totalrow % $limit); 
            $page = (int)(($totalrow / $limit) +1);
           // echo " stat ".$start." limi ".$limit." page ".$page;
            if($start == $totalrow){
                $start = $start -$limit;
                $page = (int)((($totalrow-$limit) / $limit) +1);
                            
            }
         }
        
        //  echo  "old array is ".$oldarray  12113 12110  1212 4420;
        $return = array();
        $i      = 0;
       //$start = 12110; $limit =10; 
        // $start = 10109; $limit =10;
        // echo " stat ".$start." limi ".$limit." page ".$page." totalrow ".$totalrow;
       
        if($sortcat=== "true"){
             //$stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.create_date DESC, odr.status DESC LIMIT ?, ?");
          $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url,  pt.stock, ct.cat_name, pr.status FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY ct.cat_name ASC LIMIT ?, ?");
      
        }else{
            $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url, pt.stock, ct.cat_name, pr.status FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY pt.prod_name ASC LIMIT ?, ?");
         //    $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url, pt.stock, ct.cat_name, pr.status FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id LIMIT ?, ?");
       
            
        }
        $stmt ->bind_param(ii, $start, $limit);
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
                                    'totalrow' => $totalrow,
                	                 'pageno' =>  $page,
                                    'details' => $return);
	                        
         }else{
             //echo "  page ".$page;
              
                	 
              $status = 0;
              $information =array( 'status' => $status,
                                    'totalrow' => $totalrow,
                	               'pageno' =>  $page,
                                'details' => $return);
         }
                
         echo  json_encode( $information);
        //return json_encode($return);    
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
?>