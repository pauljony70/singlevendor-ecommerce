<?php
include('session.php');
$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$page = stripslashes($page);
$rowno =  stripslashes($rowno);

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if ($code == "123") {
    
    $seller_id = $_SESSION['seller_id'];
    include('../app/db_connection.php');
    global $conn;
    try {
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $Exist = false;
         $limit = 10; 
        $start = ($page - 1) * $limit; 
        $totalrow =0;
        $stmt12 = $conn->prepare("SELECT count(review_id) FROM review");
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col15);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col15;
                	     
        }
            	 
        if($page ==99999){
            $start =   $totalrow -($totalrow % $limit); 
            $page = (int)(($totalrow / $limit) +1);
                       // echo " stat ".$start." limi ".$limit;
        }        
        //  echo  "old array is ".$oldarray;
        $return = array();
        $i      = 0;
        $status = "active";
        
        $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_img_url, pt.prod_rating, pt.prod_rating_count, rv.review_array, rv.review_id FROM productdetails pt, review rv WHERE rv.review_id = pt.review_id GROUP BY rv.review_id ORDER BY pt.prod_id DESC LIMIT ?, 30");
        $stmt->bind_param("i", $start);
        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
        //  echo " get col data ";
        
        while ($stmt->fetch()) {
            //echo " prod data is " .$col1;  
            $Exist = true;
            $imgarray = json_decode($col3, true);
            $imageurl = "";
            $count    = 1;
            foreach ($imgarray as $arraykey) {
                if ($count === 1) {
                    $imageurl = "../media/" . $arraykey['url'];
                    $count++;
                }
            }
            
            $json_array  = json_decode($col6, true);
            $elementCount  = count($json_array);
            
            $return[$i] = array(
                'id' => $col1,
                'name' => $col2,
                'img' => $imageurl,
                'rating' => number_format($col4,1),
                'rating_count' => $col5,
                'feedback' =>  $elementCount,
                'reviewid' => $col7
            );
            $i          = $i + 1;
            //echo " array created".json_encode($return);
        }
        
        if( $Exist){
                	    
         $status = 1;
          $information =array( 'status' => $status,
                                'totalrow' => $totalrow,
                                'pageno' => $page,
                                'details' => $return);
	                        
        }else{
                	 
              $status = 0;
              $information =array( 'status' => $status,
                                    'totalrow' => $totalrow,
                                 'pageno' => $page,
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