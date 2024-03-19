<?php
include('session.php');
$code = $_POST['code'];

  $code=   stripslashes($code);

$error='';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="123"){
    
    include('../app/db_connection.php');
    global $conn;
    try{
    
      if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       
        // echo "class id is  ".$class_id;     
        $inactive = "active";
           $stmt = $conn->prepare("SELECT sno, catid, catname, catorder, layout_type, title, clicktype, prod_id, prod_name, img_url FROM homecat ORDER BY catorder ASC");
    	   //$stmt->bind_param( s,  $inactive );
    	   $stmt->execute();	 
     	   $data = $stmt->bind_result($col0, $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
           $return = array();
    	   $i =0;
       	   while ($stmt->fetch()) { 
    	       
        	   	$return[$i] = 
        					array(
        					    'sno' => $col0,
        					    'catid' => $col1,
        						'catname' => $col2,
        						'orderno' => $col3,
        						'layouttype' => $col4,
        						'title' => $col5,
        						'clicktype' => $col6,
        						'prodid' => $col7,
        						'prodname' => $col8,
        						'imgurl' =>"../media/".  $col9);
              		   $i = $i+1;  			  
               // echo " array created".json_encode($return);
    	    }
    
    	  	 echo  json_encode($return);
        //return json_encode($return);    
     }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

}
?>