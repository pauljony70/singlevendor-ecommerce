<?php
if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';       
    }
    else {
   	 date_default_timezone_set("Asia/Kolkata");
  	 $time = date("h:i:sa");
  	 $date = date("Y-m-d");
  	  mkdir("../media/".$date);    
  	    $filename = str_replace(" ", "-", $_FILES['file']['name']);  		
		$filename_explode = explode('.',$filename);		
		$extension = strtolower(end($filename_explode));		
		if(!in_array($extension,array('php','js','html'))){		
			// echo "filename is ". $filename;
			move_uploaded_file($_FILES['file']['tmp_name'], '../media/'.$date.'/'. $filename);
			if($filename==""){
			}else{
				echo "Upload successfully--".$date.'/'.$filename;
			}
			$newUploadFile= '../media/'.$date.'/'. $filename;
	   
		}else{
			echo "Please upload valid file";
		}  
    }
?>