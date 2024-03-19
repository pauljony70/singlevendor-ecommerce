<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_model extends CI_Model {

   public function __construct() {
        parent::__construct();
		
		$date = $this->date_time = date('Y-m-d H:i:s');
    }
	
	public function get_data()  
    {  
	 $query = $this->db->get('country'); 
	 return $query;  
    } 

	public function user_login($email,$Password)
	{
		$user_result = array();
	   
		$this->db->select('*');
		$this->db->where(array('email' => $email,'password' => $Password));
		$query = $this->db->get('subscriber_profile');
		
		if($query->num_rows() >0){
		   $user_result1 = $query->result_object()[0];
		
			
			$user_result['sno'] = $user_result1->sno;
			$user_result['fullname'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = 'active';
		}else {
			$user_result['status'] = 'not_exist';
		   return $user_result;
		   die();
		}
		
		return $user_result;
	}
   
   function insert_data($full_name,$phone_no,$role,$password)
   {
	$date = $this->date_time = date('Y-m-d H:i:s');
	$query=$this->db->query("select * from user_profile where (phone_no='".$phone_no."')");
		$row = $query->num_rows();
		if($row)
		{
		$data['message']="<h3 style='color:red'>This user already registered</h3>";
		}
		else
		{
		$query=$this->db->query("insert into user_profile set full_name='$full_name',phone_no='$phone_no',password='$password',user_id='0',role='$role',date='$date'");

		$data['message']="<h3 style='color:blue'>You are registered successfully</h3>";
		}

		$this->load->view('admin_user',@$data);
	}

	
	function register_user($email,$fullname,$country_code,$phone,$password,$plan_id)
   {
	$date = $this->date_time = date('Y-m-d H:i:s');
	
		$query=$this->db->query("insert into subscriber_profile set admin_uniqueid='$plan_id',fullname='$fullname',email='$email',country_code='$country_code',phone='$phone',password='$password',datetime='$date'");
		
		//$data = 'register';
		$data['user_id'] = $this->db->insert_id();
		return $data;
	}
	
	public function check_data($email)  
    {  
	 $query=$this->db->query("select * from subscriber_profile where (email='".$email."')");
		$row = $query->num_rows();
		if($row)
		{
		    $data['status']='1';
		}
		else
		{
		    $data['status']='0';
		}

		return $data;
	 
    }  

}
