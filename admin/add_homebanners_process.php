<?php
include('session.php');
//echo 'dddd';
//if(!$Common_Function->user_module_premission($_SESSION,$Brand)){
	//echo "<script>location.href='no-premission.php'</script>";die();
//}

//print_r($_SESSION);
//print_r($_POST);
//die;
$code = $_POST['code'];
$banner_link = $_POST['banner_link'];
$banner_section = $_POST['banner_section'];
$banner_type = $_POST['banner_type'];
$banner_title = $_POST['banner_title'];
$banner_description = $_POST['banner_description'];
$banner_btn = $_POST['banner_btn'];


$error='';  // Variable To Store Error Message
$code=   stripslashes($code);
$banner_link =   stripslashes($banner_link);
$banner_section =   stripslashes($banner_section);
$banner_type =   stripslashes($banner_type);
$banner_title =   stripslashes($banner_title);
$banner_description =   stripslashes($banner_description);
$banner_btn =   stripslashes($banner_btn);

$parent_cat = '';
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
 // echo " dashboard redirect to index";
}else
// $code == $_SESSION['_token'] && 
if(isset($banner_link) && isset($banner_section) && isset($banner_type)  ) {
    
    //code for Check Brand Exist - START
    $main_name = $banner_section.$banner_type;
	$query1 = $conn->query("SELECT * FROM `layoutsection` WHERE name ='".$banner_section."' and type = '".$banner_type."'");
	while($rows1 = $query1->fetch_assoc()){
		 $layoutsection_id = $rows1['sno'];
	}
	$banner_image ='';
		
		
		date_default_timezone_set("Asia/Kolkata");
  	 $time = date("h:i:sa");
  	 $date = date("Y-m-d");
  	  mkdir("../media/".$date);    
  	    $filename = str_replace(" ", "-", $_FILES['banner_image']['name']);  		
		$filename_explode = explode('.',$filename);		
		$extension = strtolower(end($filename_explode));		
		if(!in_array($extension,array('php','js','html'))){		
			// echo "filename is ". $filename;
			move_uploaded_file($_FILES['banner_image']['tmp_name'], '../media/'.$date.'/'. $filename);
			if($filename==""){
			}else{
				//echo "Upload successfully--".$date.'/'.$filename;
			}
			$newUploadFile= '../media/'.$date.'/'. $filename;
	   
		}else{
			echo "Please upload valid file";
		}  
        
	
        //die;
		
		if($query1->num_rows > 0){
			$rows1 = $query1->fetch_assoc();
			//$layoutsection_id = '';
			 $query1 = $conn->query("UPDATE `sectionvalue`  SET title = '".$banner_title."',description = '".$banner_description."',image='".$date.'/'.$filename."',button = '".$banner_btn."',onclick_url='".$banner_link."' WHERE layoutsection_id ='".$layoutsection_id."'");
		}else{			
			 
			 	$query_main = $conn->query("INSERT INTO `layoutsection`(name,type) VALUES('".$banner_section."','".$banner_type."') ");
		        $id = mysqli_insert_id($conn);
			 $query1 = $conn->query("INSERT INTO `sectionvalue`(layoutsection_id,title,description,image,button,onclick_url) VALUES('".$id."','".$banner_title."','".$banner_description."','".$date.'/'.$filename."','".$banner_btn."','".$banner_link."') ");
		

		}
    	 echo "Banner Added Successfully. ";
    }else{
            echo "Invalid values.";
    }
    die;
?>
