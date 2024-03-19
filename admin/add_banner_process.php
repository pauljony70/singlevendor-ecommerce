<?php
include('session.php');

//if(!$Common_Function->user_module_premission($_SESSION,$HomepageSettings)){
//	echo "<script>location.href='no-premission.php'</script>";die();
//}
//print_r($_POST);
$code = $_POST['code'];
$image = $_POST['banner_image'];
$prodid = $_POST['product_id'];
$catid = $_POST['cat_id'];
$ctype = $_POST['banner_type'];
$product_name = $_POST['product_name'];
$error='';  // Variable To Store Error Message

$code=   stripslashes($code);
$prodid =   stripslashes($prodid);
$catid =   stripslashes($catid);
$ctype =   stripslashes($ctype);
$product_name =   stripslashes($product_name);
/*
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
 // $code == $_SESSION['_token'] && 
}else if(isset($ctype) ) {
	//code for upload images - START
	$banner_image ='';
	
	if($ctype ==1){
		$banner_id = $catid;
	}elseif($ctype ==3){ 
		$banner_id = $product_name;
	} else{
		$banner_id = $prodid;
	}
			
	$stmt11 = $conn->prepare("INSERT INTO `banners`( `img_url`, `banner_id`, `clicktype`)  VALUES (?,?,?)");
    $stmt11->bind_param( 'ssi', $banner_image, $banner_id, $ctype );
        
    $stmt11->execute();
    $stmt11->store_result();
    $rows=$stmt11->affected_rows;
    if($rows>0){
        echo " Banner Added Successfully.";
        
    }else{
        echo "failed to add banner.";
    }    
    	      
    	  
        	
    	 
}else 
*/
if($_POST['keyword']){


	  $query = $conn->query("SELECT prod_id,prod_name FROM productdetails WHERE  prod_name like '%".trim($_POST['keyword'])."%' ORDER BY prod_name ASC");
                           
     if($query->num_rows > 0){
		 echo '<ul id="country-list">';
        while($row = $query->fetch_assoc()){
				
			echo '<li onClick="selectCountry(\''.$row['prod_name'].'\',\''.$row['prod_id'].'\');">'.$row['prod_name'].'</li>';
			}
		}
         echo '</ul>';                       
}else{
     echo "Invalid Request.";
}
    die;
?>
