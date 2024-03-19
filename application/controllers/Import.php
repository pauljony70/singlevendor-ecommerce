<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	
	function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Import_model');

    }

	public function index()
	{
		 $this->load->database();  
		 $this->load->view('import');
		//$this->load->view('admin_user');
	}
	
	public function cron()
	{
	   echo 'test';
	   $date = $this->date_time = date('Y-m-d H:i:s');
        $query=$this->db->query("insert into order_data set order_id='cscs',name='csc',email='ccscs',phone='95563562363',state='cscs',order_status='cscs',telecallerid='66636',add_date='$date'");

	      
	}

	
	public function importdata()
	{
		
		$datetime = date('Y-m-d');
		$msg =  '';
		 if($this->session->userdata('type') != 'admin'){
		  header("Location: index.php");
		 // echo " dashboard redirect to index";
		}else{
			//if($code==$_SESSION['_token']){
				//$table_name = 'import_product_'.strtolower($_SESSION['admin']);
				//$Common_Function->create_table($conn,$table_name);
				
				//$table_name2 = 'import_product2_'.strtolower($_SESSION['admin']);
			
				//$Common_Function->create_table($conn,$table_name2);
				
				$mand_headers = array('name','sku','url_key','attribute_set','product_type','categories','short_description','description','mrp','price','tax_class','qty','stock_status','visibility','country_of_manufacture','hsn_code','product_purchase_limit','brand','return_policy','configurable_variations','remarks','youtube_video_link','related_skus','upsell_skus');
				
				// Allowed mime types
				$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
			
				// Validate whether selected file is a CSV file
				if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
					
					// If the file is uploaded
					if(is_uploaded_file($_FILES['file']['tmp_name'])){
						
						// Open uploaded CSV file with read-only mode
						$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
						
						// Skip the first line
						$header =  fgetcsv($csvFile);
						$header_diff = array_diff($mand_headers,$header);
						if(count($header_diff) >0 ){
							$msg = "CSV header not valid.";
						}
						$final_array = array();
						// Parse data from CSV file line by line
						while(($line = fgetcsv($csvFile)) !== FALSE){
							$array_comb = array_combine($header,$line);		
							$data_array = array();
							$data_array['id'] = $array_comb['Name'];
							$data_array['date'] = date('d-m-Y',strtotime($array_comb['Created at']));
							$data_array['name'] = $array_comb['Billing Name'];
							$data_array['email'] = $array_comb['Email'];
							$data_array['phone'] = $array_comb['Billing Phone'];
							$data_array['state'] = $array_comb['Billing Province'];
							$data_array['order_status'] = $array_comb['Fulfillment Status'];
							$data_array['telecallerid'] = $array_comb['telecallerid'];
							
							
							$this->Import_model->insert_data($data_array['id'],$data_array['name'],$data_array['email'],$data_array['phone'],$data_array['state'],$data_array['order_status'],$data_array['telecallerid'],$data_array['date']);
						    
							
							$keys = $array_comb['Name'];
							$final_array[] = $data_array;
							
						}
						
						//echo json_encode($final_array):
						// Close opened CSV file
						fclose($csvFile);
						
					}

				}
				
		}
			//print_r($final_array);
			echo json_encode($final_array);
			//echo '<script>alert("'.$msg.'"); location.href="manage_product.php";</script>';
			//echo json_encode($final_array):
			die;
	
	}


}
