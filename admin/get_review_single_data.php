<?php
include('session.php');
$code  = $_POST['code'];
$reviewid  = $_POST['reviewid'];
$error = ''; // Variable To Store Error Message

$code = stripslashes($code);
$reviewid = stripslashes($reviewid);

//echo "admin is ".$_SESSION['admin'];
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
        
        //  echo  "old array is ".$oldarray;
        $return = array();
        $i      = 0;
        
        $stmt = $conn->prepare("SELECT review_array FROM review WHERE review_id =?");
        $stmt->bind_param("i", $reviewid);
        $stmt->execute();
        $data = $stmt->bind_result($col1);
        //  echo " get col data ";
        
        while ($stmt->fetch()) {
            
                	$oldarray = json_decode( $col1, true) ;
            	  	
            	  	 foreach($oldarray as $arraykey) {
            			 //  echo "prod id ".$arraykey['prod_id'];
                        	  	 
                                     	  	 
                        $return[$i] = array(
                            'id' => $i,
                            'name' => $arraykey['username'],
                            'title' => $arraykey['title'],
                            'rating' => $arraykey['rating'],
                            'feedback' =>  $arraykey['feedback'],
                            'date' => $arraykey['date']
                        );
                        $i          = $i + 1; 	  	     
            	  	 } 
           
            //echo " array created".json_encode($return);
        }
        
        echo json_encode($return);
        //return json_encode($return);    
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}
?>