<?php
include('session.php');
$code =  $_POST['code'];
$page = $_POST['page'];
$rowno = $_POST['rowno'];
$cust_name = $_POST['cust_name'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$cust_name =  stripslashes($cust_name);

//echo "admin is ";
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
if($code=="1"){
    
    $seller_id =  $_SESSION['seller_id'];
    
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
                     $limit = 30; 
                    $start = ($page - 1) * $limit; 
                        $totalrow =0;
                     $cust_name = "%".$cust_name."%";
                   	 $stmt12 = $conn->prepare("SELECT count(sno) FROM user_profile WHERE full_name LIKE ?  OR phone_no LIKE ?");
                	 $stmt12 ->bind_param("ss",  $cust_name,$cust_name);
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
                    //echo "start " . $start. " page ".$page." totalrow ". $totalrow."--".$cust_name;
                   
                    $stmt11 = $conn->prepare("SELECT sno, full_name, phone_no, email  FROM user_profile WHERE full_name LIKE ? OR phone_no LIKE ? ORDER BY full_name ASC LIMIT ?, ?");
                	 $stmt11 ->bind_param("ssii",  $cust_name,$cust_name, $start, $limit);
                     
                	 $stmt11->execute();
                	 $stmt11->store_result();
                	 $stmt11->bind_result ( $col01, $col1, $col2, $col3);
                	 
                	 while($stmt11->fetch() ){
                	 // echo " order id ".$col1;
                	 		$Exist = true;
                	 		
                	 		$return[$i] = 
                                					array(
                                					    'sno' => $col01,
                                					    'name' => $col1,
                                						'phone' => $col2,
                                       					'email' =>$col3);
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